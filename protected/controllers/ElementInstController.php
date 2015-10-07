<?php

class ElementInstController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','createP2','updateP2','create1','create2','update1','update2'),
				//'users'=>array('@'),
				'expression'=>'$user->isAdmin()',
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'users'=>array('admin'),
				'expression'=>'$user->isAdmin()',
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate1(){
		/*
		ESSA ACTION É CHAMADA NA SEGUNDA TELA DE CRIAÇÃO DO TESCONTEXT, MOMENTO EM QUE ´SISTEMA VERIFICA 
		QUAIS ELEMENTOS ESTÃO DISPONIVEIS PARA SELEÇÃO.
		*/
		$idTestContext = Yii::app()->user->getState('idTestContext');
		$idDevice = Yii::app()->user->getState('idDevice');

		$elements = new Element;
        $elements=Element::model()->with('elementDevices')->findAll('id_device=' . $idDevice);
        $listElements = CHtml::listData($elements,'id','description');
        $arrayExcluded = array();

        $dataProvider=new CActiveDataProvider('Element');
        $dataProvider->setData($elements);

        $arraySelected = array();

        //BOTAO CANCELAR
        if (isset($_POST['buttonCancel'])) {
			$this->redirect("/mtcontrool/index.php/testContext/admin");
		}

		//BOTÃO CONFIRMAR
		if (isset($_POST['confirm'])){
			$totalElements = $_POST['total_elements'];
			$flagSelecionados=0;
			$i=0;
			$typeNull=0;
			//VERIFICA OS ELEMENTO QUE FORAM MARCADOS PARA SEREM USADOS NO TESTXONTEXT
			while($i<$totalElements){
				if(isset($_POST['ID_'.$i])){
					if($_POST['type_'.$i]!=""){
						$arraySelected[$_POST['ID_'.$i]] = $_POST['type_'.$i];
						$flagSelecionados=1;
					}else{
						$flagSelecionados=1;
						$typeNull=1;
					}
				}
				$i = $i+1;
			}
			$redirect=0;

			//VALIDADOR PARA GARANTIR QUE AO MENOS UM ELEMENTO SEJA SELECIONADO
			if($flagSelecionados==1){
				if($typeNull==1){
					Yii::app()->user->setFlash('noType',"NOTE: You must select a type for the chosen elements.");
				}else{
					$redirect=1;
					//$json = json_encode($arraySelected);
			    	//$this->redirect("/mtcontrool/index.php/elementInst/createP2?a=".$json."&idTestContext=".$idTestContext."&idDevice=".$idDevice);
				}
			}else{
				Yii::app()->user->setFlash('noSelection',"NOTE: You must select at least one element..");
			}

			//REDIRECIONA PARA A TERCEIRA TELA DA CRIAÇÃO DO TESTCONTEXT, PARA CRIAR AS INSTANCIAS DOS ELEMENTOS.	
			if($redirect>0){
				$json = json_encode($arraySelected);
				//salva dados para a próxima action
				Yii::app()->user->setState('json', $json);
				Yii::app()->user->setState('idTestContext', $idTestContext);
				Yii::app()->user->setState('idDevice', $idDevice);
				$this->redirect("/mtcontrool/index.php/elementInst/create2");
			}
		}

		//PRIMEIRO RENDER AO ABRIR A TELA A PRIMEIRA VEZ
		$this->render('create_pre',array(
			'listElements'=>$listElements,
			'models'=>$elements,
			'dataProvider'=>$dataProvider,
			'arrayExcluded'=>$arrayExcluded,
			'idTestContext'=>$idTestContext,
		));
	}

	public function actionCreate2(){

		//DELIMITA A QUANTIDADE DE MODELS/FORMS USADOS NA TELA DE INSTANCIAS
		$TOTAL_FORMS=20;
		//recupera os dados
		$idTestContext = Yii::app()->user->getState('idTestContext');
		$idDevice = Yii::app()->user->getState('idDevice');
		$json = Yii::app()->user->getState('json');

		//FUNÇÃO CALLBACK DE ORDENAÇÃO.
		//ESSA FUN~ÇÃO ORDENA O VETOR DE MODELS AFIM DE GARANTEIR QUE OS FORMS DE INSTANCIAS 
		//FIQUEM AGRUPADDOS POR ELEMENTOS.
		function order($a, $b)
	    {
	        $retval = strnatcmp($a['id_element'], $b['id_element']);
	        if(!$retval)
	            return strnatcmp($b['description'], $a['description']);
	        return $retval;
	    }

		if (isset($_POST['buttonCancel'])) {
			$this->redirect("/mtcontrool/index.php/testContext/admin");
		}

		$arrayArrayModels=array();
		$arrayModels=ElementInst::model()->findAll('id_test_context=' . $idTestContext,'ORDER BY id_element');

		//DELETA UMA JNSTANCIA JÁ SALVA
		if (isset($_POST['del'])) {
			$id=$_POST['del'];
			$this->loadModel($id)->delete();
			$this->redirect("/mtcontrool/index.php/elementInst/create2");
		}

		//CHAMA A FUNÇÃO DE ORDENAÇÃO
		usort($arrayModels,'order'); 
		
		//ADICONA FORMS EM UM VETOR DE INSTANCIAS QUE NÃO POSSUI NENHUMA INSTANCIA CADASTRADA.
		$anterior="";
		foreach ($arrayModels as $item){
			$item->sent = $item->behavior_screen;
			if($item->iDELEMENT->description!=$anterior){
				$anterior = $item->iDELEMENT->description;
				$i=0;
				while ($i <= $TOTAL_FORMS) {
					$newInstance = new ElementInst;
					$newInstance->id_element = $item->id_element;
					$newInstance->id_test_context = $item->id_test_context;
					$newInstance->element_type = $item->element_type;
					array_push($arrayModels,$newInstance);
					$i++;
				}
			}	
		}
		
		//SE JÁ EXISTIREM INSTANCIAS CADASTRADAS, AQUI PREEENCHE O VETOR DE INSTANCIAS COM MAIS FORMS
		if($json!=null){
			$arraySelected = json_decode($json);
			foreach($arraySelected as $key => $value){
				$i=0;
				while ($i <= $TOTAL_FORMS) {
					$model = new ElementInst;
		        	$model->id_element=$key;
		        	$model->id_test_context=$idTestContext;
		        	$model->element_type=$value;
		        	//if(!in_array($model,$arrayModels)){
		        		array_push($arrayModels, $model);
		        	//}
		        		$i++;
	        	}
			}
		}
		
	    //ORDENA O ARRAY DE MODELOS DE FORMA QUE OS MODELOS NÃO PREENCHIDOS FIQUEM POR ULTIMO.
		usort($arrayModels,'order'); 

		//RETORNA PARA A TELA DE SELECÇÃO DE ELEMENTOS SE TODOS OS MODELS FOREM DELETADOS
		if(sizeof($arrayModels)==0){
			$this->redirect("/mtcontrool/index.php/elementInst/create1");
		}

		//CONTA A QUANTIDADE DE INSTANCIAS
		$count_elements=0;
		foreach(array_keys($_POST) as $key) {
		    if(strpos($key, "ElementInst") === 0) {
		        //Key matches, test value.
		        $count_elements++;
		    }
		}

		//SALVA NO BANCO DE DADOS AS INSTANCIAS PREENCHIDAS
		$count_saved=0;
		if($count_elements>0){
			foreach($arrayModels as $key=>$model){
				if(isset($_POST["description".$key])){
					if(trim($_POST["description".$key])!=""){
						$model->description = $_POST["description".$key];
						if($model->element_type=="interval"){
							$model->start_param = $_POST["start_param".$key];
							$model->end_param = $_POST["end_param".$key];
						}
						if($model->save()){
							$count_saved++;
						}else{
							print_r($model->getErrors());
						}
					}else{
					}
				}
			}
		}

		//BOTÃO CANCELAR
		if (isset($_POST['buttonSaveOnly'])) {
			$this->redirect("/mtcontrool/index.php/elementInst/create2");
		}

		//BOTÃO RESUME
		if (isset($_POST['buttonXML'])) {
			$this->redirect("/mtcontrool/index.php/testContext/resume?idTestContext=".$idTestContext);
		}

		//PRIMEIRO RENDER AO ABRIR A TELA A PRIMEIRA VEZ.
		$this->render('create',array(
			'arrayModels'=>$arrayModels,
			'idTestContext'=>$idTestContext,
			'idDevice'=>$idDevice,
			'a'=>$json
		));
	}

	
	public function actionUpdate1(){
		//SEGUNDA TELA NO UPDATE DE UM TEST CONTEXT
		//VERIFICA SE EXISTEM ELEMENTOS QUE AINDA NÃO FORAM USADOS.
		//CASO NÃO EXISTAM MAIS ELEMENTOS DISPONÍVEIS, ELE REDIRECIONA AUTOMATICAMNETE PARA A TERCEIRA TELA.
		$idTestContext = Yii::app()->user->getState('idTestContext');
		$idDevice = Yii::app()->user->getState('idDevice');

		//BOTÃO CANCELAR
		if (isset($_POST['buttonCancel'])) {
			$this->redirect("/mtcontrool/index.php/testContext/admin");
		}

		$arrayModels=ElementInst::model()->findAll('id_test_context=' . $idTestContext);
		$arrayTypes = array();
		foreach ($arrayModels as $item){
			$item->sent = $item->behavior_screen;
			$arrayTypes[$item->id_element] = $item->element_type;
		}

		//FUNÇÃO CALLBACK DE ORDENAÇÃO.
		function order($a, $b)
	    {
	        $retval = strnatcmp($a['id_element'], $b['id_element']);
	        if(!$retval)
	            return strnatcmp($b['description'], $a['description']);
	        return $retval;
	    }

		//VERIFICA QUAIS ELEMENTOS ESTÃO ASSICIADOS AO DEVIDE.
		//E CRIA UM NOVO FORM PARA CADA UM DESSES ELEMENTOS
		//ISSO PERMITIRÁ QUE NOVAS INSTANCIA DE ELEMENTOS SEJAM CRIADAS.
		
		$arrayExclude = array();
		$flag=0;
		$exclude=null;
		$elements = new Element;
        $elements=Element::model()->with('elementDevices')->findAll('ID_DEVICE=' . $idDevice);
		if(sizeof($arrayModels)>0){
			//$elements=Element::model()->with('elementDevices')->findAll('ID_DEVICE=' . $idDevice);
			foreach($elements as $i=>$element)
	        {
	        	$model = new ElementInst;
	        	$model->id_element=$element->id;
	        	$model->id_test_context=$idTestContext;
	        	foreach ($arrayTypes as $key=>$value){
					if($model->id_element==$key){
						$model->element_type=$value; 
					}
				}
				if($model->ELEMENT_TYPE!=''){
					array_push($arrayExclude,$element->id);
				}else{
					$flag=1;
				}
	        	array_push($arrayModels, $model);
	        }
	        //ORDENA O ARRAY DE MODELOS DE FORMA QUE OS MODELOS NÃO PREENCHIDOS FIQUEM POR ULTIMO.
	        usort($arrayModels,'order');
	        $exclude = json_encode($arrayExclude);

	        if((sizeof($arrayExclude)>0)and($flag==1)){
	        	//$this->redirect(Yii::app()->createUrl("/elementInst/create", array("idTestContext"=>$idTestContext,"idDevice"=>$idDevice,"exclude"=>$arrayExclude)));
	        }	        
		}else{
			//$this->redirect(Yii::app()->createUrl("/elementInst/create", array("idTestContext"=>$idTestContext,"idDevice"=>$idDevice)));
		}

		$arrayExcluded = array();
        if($exclude!=null){
        	$exclude = json_decode($exclude);
	        foreach ($elements as $key=>$item){
	        	foreach($exclude as $value){
	        		if($item->id == $value){
	        			array_push($arrayExcluded, $elements[$key]);
	        			unset($elements[$key]);
	        		}
	        	}
	        }
	        $elements = array_values($elements);
        }

        $listElements = CHtml::listData($elements,'id','description');
        $dataProvider=new CActiveDataProvider('Element');
        $dataProvider->setData($elements);

        //ORDENA O ARRAY DE MODELOS DE FORMA QUE OS MODELOS NÃO PREENCHIDOS FIQUEM POR ULTIMO.
			usort($arrayModels,'order'); 

		$count_elements=0;
		foreach(array_keys($_POST) as $key) {
		    if(strpos($key, "ElementInst") === 0) {
		        //Key matches, test value.
		        $count_elements++;
		    }
		}
		//SALVA OS DADOS NO BANCO DE DADOS
		$count_saved=0;
		if($count_elements>0){
			foreach($arrayModels as $key=>$model){
				if(isset($_POST["description".$key])){
					if(trim($_POST["description".$key])!=""){
						$model->description = $_POST["description".$key];
						if($model->element_type=="interval"){
							$model->start_param = $_POST["start_param".$key];
							$model->end_param = $_POST["end_param".$key];
						}
						if($model->save()){
							$count_saved++;
						}else{
							print_r($model->getErrors());
						}
					}else{
					}
				}
			}
		}

		
		if (isset($_POST['confirm'])){
			$totalElements = $_POST['total_elements'];
			$flagSelecionados=0;
			$i=0;
			$typeNull=0;
			$arraySelected=null;
			while($i<$totalElements){
				if(isset($_POST['ID_'.$i])){
					if($_POST['type_'.$i]!=""){
						$arraySelected[$_POST['ID_'.$i]] = $_POST['type_'.$i];
						$flagSelecionados=1;
					}else{
						$flagSelecionados=1;
						$typeNull=1;
					}
				}
				$i = $i+1;
			}
			
			$json=null;
			if($arraySelected!=null){
				$json = json_encode($arraySelected);
			}
			
			//salva dados para a próxima action
			//RENDER DA TERCEIRA TELA APÓS SELECIONAR OS ELEMENTOS.
			Yii::app()->user->setState('json', $json);
			Yii::app()->user->setState('idTestContext', $idTestContext);
			Yii::app()->user->setState('idDevice', $idDevice);
			$this->redirect("/mtcontrool/index.php/elementInst/create2");
			
		}
		
		if(sizeof($listElements)==0){
			//SE NÃO EXISTEM MAIS ELEMENTOS DISPONIVEIS, REDIRECIONA PARA A TERCEIRA TELA
			Yii::app()->user->setState('json', null);
			Yii::app()->user->setState('idTestContext', $idTestContext);
			Yii::app()->user->setState('idDevice', $idDevice);
			$this->redirect("/mtcontrool/index.php/elementInst/create2");
		}else{
			//PRIMEIRO RENDER AO ABRIR A TELA A PRIMEIRA VEZ
			$this->render('create_pre',array(
				'listElements'=>$listElements,
				'models'=>$elements,
				'dataProvider'=>$dataProvider,
				'arrayExcluded'=>$arrayExcluded,
				'idTestContext'=>$idTestContext,
			));
		}       
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($a=null,$id,$idTestContext,$idDevice,$form)
	{

		$this->loadModel($id)->delete();
		if($form=="update"){
			//$this->redirect('/mtcontrool/index.php/elementInst/update?idTestContext='.$idTestContext."&idDevice=".$idDevice);
			$this->redirect('/mtcontrool/index.php/elementInst/update1');
		}else if ($form=="create"){
			//$this->redirect('/mtcontrool/index.php/elementInst/createP2?a='.$a.'&idTestContext='.$idTestContext."&idDevice=".$idDevice);
			$this->redirect('/mtcontrool/index.php/elementInst/create2');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ElementInst');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ElementInst('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ElementInst'])) {
			$model->attributes=$_GET['ElementInst'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ElementInst the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ElementInst::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ElementInst $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='element-inst-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}