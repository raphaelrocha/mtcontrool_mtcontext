<?php

class TestContextController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $layout = '//layouts/main';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'ListDevices'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','listDevices','generateXml','resume','mef','printMef', 'dashboard','Inidashboard'),
				//'users'=>array('@'),
				//'users'=>array('@'),
				'expression'=>'$user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'users'=>array('admin'),
				//'users'=>array('@'),
				'expression'=>'$user->isAdmin()',
			),
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
		/*$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/
		$this->redirect("/mtcontrool/index.php/testContext/admin");
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TestContext;
		$model->id_user = Yii::app()->user->getId();

		$modelsApps= App::model()->findAll();
		$appsArray = CHtml::listData($modelsApps, 'id', 'name');

		$modelsPlatforms= Platforms::model()->findAll();
		$platformsArray = CHtml::listData($modelsPlatforms, 'id', 'name');

		$user_name = Yii::app()->user->getName();

		$users = Users::model()->findAllByAttributes(
			array('user_name'=>$user_name)
		);

		$name="";
		foreach ($users as  $user) {
			$name = $user->name;
		}

		$devicesArray = array();
		
		// Uncomment the following line if AJAX validation is needed
		
		if (isset($_POST['buttonCancel'])) {
				
				$this->redirect(array('admin'/*,'id'=>$model->ID*/));
	    }

		if (isset($_POST['TestContext'])) {
			

			//$_SESSION['flag-test-context-form']=null;
			$model->attributes=$_POST['TestContext'];
			if ($model->save()) {
				Yii::app()->user->setState('idTestContext', $model->id);
				Yii::app()->user->setState('idDevice', $model->id_device);
				
				$this->redirect("/mtcontrool/index.php/elementInst/create1");
			}

		}
			  
		$this->render('create',array(
			'model'=>$model,
			'appsArray'=>$appsArray,
			'platformsArray'=>$platformsArray,
			'devicesArray'=>$devicesArray,
			'name'=>$name
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$sql = "SELECT COUNT(*) FROM test_context_seq WHERE id_test_context = ".$id;
		$numSeqs = Yii::app()->db->createCommand($sql)->queryScalar();
		//echo $numSeqs;

        $user_name = Yii::app()->user->getName();

		$users = Users::model()->findAllByAttributes(
			array('user_name'=>$user_name)
		);

		$name="";
		foreach ($users as  $user) {
			$name = $user->name;
		}

		$modelsApps= App::model()->findAll();
		$appsArray = CHtml::listData($modelsApps, 'id', 'name');

		$modelsPlatforms= Platforms::model()->findAll();
		$platformsArray = CHtml::listData($modelsPlatforms, 'id', 'name');

		$modelsDevice= Device::model()->findAll(array(
		                                    'select'=>'id,description',
		                                    'condition'=>"id_platform='$model->id_platform'"
		                                  ));
		$devicesArray = CHtml::listData($modelsDevice, 'id', 'description');

		// Uncomment the following line if AJAX validation is needed
		
		if (isset($_POST['buttonCancel'])) {
			
			$this->redirect(array('admin'));
		}

		if (isset($_POST['TestContext'])) {
			
			$model->attributes=$_POST['TestContext'];
			if ($model->save()) {
				
				Yii::app()->user->setState('idTestContext', $model->id);
				Yii::app()->user->setState('idDevice', $model->id_device);
								
				$this->redirect("/mtcontrool/index.php/elementInst/update1");
			}
		}
		
	    if($numSeqs==0){
	    	$this->render('update',array(
				'model'=>$model,
				'appsArray'=>$appsArray,
				'platformsArray'=>$platformsArray,
				'devicesArray'=>$devicesArray,
				'name'=>$name
			));
	    }else{
	    	$this->redirect("/mtcontrool/index.php/testContext/inidashboard?idTestContext=".$id);
	    }
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('TestContext');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$this->redirect("/mtcontrool/index.php/testContext/admin");
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TestContext('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['TestContext'])) {
			$model->attributes=$_GET['TestContext'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TestContext the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TestContext::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TestContext $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='test-context-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionListDevices(){
           
    
        if(isset($_POST['categoryid']) && $_POST['categoryid']!=''){
	        $categoryid=$_POST['categoryid'];
	        $usertype=Device::model()->findAll(array(
	                                    'select'=>'id,description',
	                                    'condition'=>"id_platform='$categoryid'"
	                                  ));       
	              
	        $data=CHtml::listData($usertype,'id','description');
	        echo CHtml::tag('option',array('value' => ''),
	                           CHtml::encode('--- Choose a device ---'),true);
	 
	        foreach($data as $id => $value)
	        {
	          echo CHtml::tag('option',array('value'=>$id),CHtml::encode($value),true);
	        }                
	   }else{
	   		echo CHtml::tag('option',array('value' => ''),
	                           CHtml::encode('--- Choose a device ---'),true);
	   }
    }

    public function actionResume($idTestContext){

    	$sql = "SELECT COUNT(*) FROM test_context_seq WHERE id_test_context = ".$idTestContext;
		$numSeqs = Yii::app()->db->createCommand($sql)->queryScalar();		
		$notEdit="false";
		if($numSeqs>0){
			$notEdit="true";
		}

    	$criteria=new CDbCriteria(array(                    
                                'condition'=>'id='.$idTestContext));
    	$dataProvider=new CActiveDataProvider('TestContext', array(
            'criteria'=>$criteria,
    	));

    	$criteriaInst=new CDbCriteria(array( 'condition'=>'id_test_context='.$idTestContext,
                                
								    		));

 
    	$dataProviderInst=new CActiveDataProvider('ElementInst', array(
            'criteria'=>$criteriaInst,
            
    	));

		$arrayModels = ElementInst::model()->findAllBySql("SELECT * FROM element_inst WHERE id_test_context=".$idTestContext." ORDER BY element_type, id_element ASC");

		$this->render('resume',array(
			'notEdit'=>$notEdit,
			'arrayModels'=>$arrayModels,
			'dataProvider'=>$dataProvider,
			'dataProviderInst'=>$dataProviderInst,
			'idTestContext'=>$idTestContext,
		)); 	
    }

    /*
    ACTION USADA PRA RODAR O ALGORITIMO CRIADO PELO RODRIGO PARA A CRIAÇÃO DAS SEQUENCIAS DE TESTE
    */
    public function actionMef($idTestContext){

    	$sql = "SELECT COUNT(*) FROM test_context_seq WHERE id_test_context = ".$idTestContext;
		$numSeqs = Yii::app()->db->createCommand($sql)->queryScalar();

		if($numSeqs>0){
			$this->redirect("/mtcontrool/index.php/testContext/inidashboard?idTestContext=".$idTestContext);
		}
		
    	/*
    	ESTA MATRIZ SERÁ PREENCHIDA NESTA FUNÇÃO E ENCAMINHA PARA O ALGORITIMO.
    	*/
    	$matrixElementsInstances = array();

    	//AQUI É FEITA UMA BUSCA POR TODOS OS ELEMENTOS CADASTRADOS NO BANCO.
    	$elements = Element::model()->findAll();

    	$sql_countElements = "SELECT * FROM test_context JOIN element_inst ON (test_context.id = element_inst.id_test_context)  WHERE test_context.id=$idTestContext GROUP BY id_element";
    	$result_countElements = Yii::app ()->db->createCommand ( $sql_countElements )->queryAll ();

    	$totalElements=0;
    	foreach ($result_countElements as $item) {
    		$totalElements = $totalElements+1;
    	}


    	/*
    	ESTE FOREACH, PERCORRE TODOS OS ELEMENTOS ENCONTRADOS NA BUSCA ACIMA, E PARA CADA
    	ELEMENTO, ELE BUSCA TODOS AS INSTANCIAS DE ELEMENTOS QUE ESTÃO RELACIONADAS
    	AO ELEMENTO DA VEZ NO FOREACH E AO TESTCONTEXT EM QUESTÃO CUJO SEU ID É REEBIDO NESTA
    	FUNÇÃO POR PARÂMETRO.
    	*/
    	foreach ($elements as $item) {
    		$instances = ElementInst::model()->FindAllByAttributes(
    									array("id_element"=>$item->id,
    										  "id_test_context"=>$idTestContext
    										  ));
    		if(sizeof($instances)>0){
    			$matrixElementsInstances[$item->description] = $instances;
    		}
    	}

    	/*
		A PARTIR DAQUI VOCÊ PODE COMEÇAR A IMPLEMENTAR SEU ALGORÍTIMO.
    	*/
		# code ....

    	/*
		AQUI É APENAS UM TESTE DE EXIBIÇÃO, PARA QUE VOCÊ VEJA O COMPORTAMENTO DA MATRIZ.
		AQUI VOCÊ PODE ENTENDER COMO PERCORRER ESTE ARRAY E CONSEGUIR EXTRAI AS INFORMAÇÕES.
    	*/
		
    	$modelTestContext = TestContext::model()->findByPk($idTestContext);

		
		
		$vector = new ArrayObject(); 
	
    	foreach ($matrixElementsInstances as $key=>$element) {
    		
    		
			$vectorHelper = new Vetores();
			$vectorHelper->title = $key;
    		foreach ($element as $model) {
				$vectorHelper->putElement($model);
    		}
			$vector->append($vectorHelper);
    		
    	}
		
		//GERAR TABELA e XML
		
		//Inicializa Class Helper passando os vetores para estruturar o xml e a tabela
		$xmlGerator = new Helper($vector);

		$rawData = array();
		
		//condição que espera um parametro xml na URL
		if(isset($_GET['xml'])) {
			//ElementsParalax() retorna um array com o schema do xml já trabalhado
		    $schema = $xmlGerator->ElementsParalax();
			//prepara o xml e inicia o download passando o schema e o título
			$this->BuildXml($schema, $modelTestContext->description);
		} else {
			//ElementsParalaxTable() retorna um array com os objetos já trabalhados contendo todo o modelo passado pelo BD
			$schema = $xmlGerator->ElementsParalaxTable();
	             
            //mostrar para o raphael a construção da tabela
            //
			//inicia a construção da tabela
			
			$part1 = '<table border="1" style="width:100%">';
	  		$part2 = $part1 . "<tr><th>Variations</th><th>Behavior</th><th>Screenshots</th></th>";
	  		$totalTests = 0;
	  		$partBody=null;	
	  		$contaOrdem=1;
			foreach ($schema as $row) {
				$variatins = "";
				$behavior = "";
				$screen = "";
				$x = 1;
				foreach ($row as $model) {
					//print_r($model);
					//$model é uuma instância de ELEMENT_INST
					//echo $model->iDELEMENT->DESCRIPTION;
					$variatins .= $model->iDELEMENT->description.": ".$model->description;
					if($model->element_type=="interval"){
						$variatins .= " (START = ".$model->start_param."; END = ".$model->end_param.")";
					}
					$variatins .= "\n";
					$behavior .= $model->behavior.", ";
						if($model->behavior_screen != ""){
							
							$screen .= $model->behavior_screen;
							
						}
					$x++;
				}
				
	  			$rowData = array($contaOrdem,$xmlGerator->str_lreplace(",","",$variatins),"","");  			
				$contaOrdem = $contaOrdem+1;
				array_push($rawData, $rowData);
			}
			
			$part4 = $part2.$partBody."</table>";		
		}

    	/*
    	ARQUI SERÁ A CHAMADA PARA A FUNÇÃO QUE MONTARA O XML.
    	*/
    	$nomePlataforma = Platforms::model ()->findByPk ( $modelTestContext->id_platform );
    	$nomeApp = App::model ()->findByPk ( $modelTestContext->id_app );
    	$device = Device::model ()->findByPk ( $modelTestContext->id_device );
    	$user = Users::model ()->findByPk ( $modelTestContext->id_user );
    	$jsonPrint = json_encode($rawData);

    	$dados_dashboard =  array (
				'model' => $modelTestContext,
				'totalElements'=>$totalElements,
				'totalTests'=>$totalTests,
				'table' => $part4,
				'nomeApp' => $nomeApp->name,
				'nomePlataforma' => $nomePlataforma->name,
				'dados' => $rawData,
                'device'=>$device,
                'Image'=> $nomePlataforma->image,
                'json'=> $jsonPrint,
                'user'=>$user->name
				);

    	Yii::app()->user->setState('id_test_context', $idTestContext);
    	Yii::app()->user->setState('sequencias_geradas', $rawData);
    	Yii::app()->user->setState('dados_dashboard', $dados_dashboard );
    	$this->redirect('/mtcontrool/index.php/testContextSeq/create');
    	
    }

    //CARREGA OS DADOS NECESSÁRIOS PARA CONSTRUÇÃO DO DASHBOARD
    public function actionInidashboard($idTestContext){
    	$sql='SELECT * FROM test_context_seq WHERE id_test_context = '.$idTestContext;
		$arrayModels=TestContextSeq::model()->findAllBySql($sql); 
		$modelTestContext = TestContext::model()->findByPk($idTestContext);

    	$raw_data_dashboard = array();
    	$totalTests=0;
    	$cont = 1;
		foreach ($arrayModels as $model) {
			$row_data_dashboard = array();
			$row_data_dashboard[0]=$cont;
			$row_data_dashboard[1]=$model->variation;
			$row_data_dashboard[2]=$model->behavior;
			$screen = $model->behavior_screen;
			$row_data_dashboard[3]=$screen;
			array_push($raw_data_dashboard, $row_data_dashboard);
			$totalTests++;
		}

		$nomePlataforma = Platforms::model ()->findByPk ( $modelTestContext->id_platform );
    	$nomeApp = App::model ()->findByPk ( $modelTestContext->id_app );
    	$device = Device::model ()->findByPk ( $modelTestContext->id_device );
    	$user = Users::model ()->findByPk ( $modelTestContext->id_user );

    	$sql_countElements = "SELECT * FROM test_context JOIN element_inst ON (test_context.id = element_inst.id_test_context)  WHERE test_context.id=$idTestContext GROUP BY id_element";
    	$result_countElements = Yii::app ()->db->createCommand ( $sql_countElements )->queryAll ();

    	$totalElements=0;
    	foreach ($result_countElements as $item) {
    		$totalElements = $totalElements+1;
    	}

		/*$dados_dashboard =  array (
				'table' => $part4,
				);*/
		
		$dados_dashboard=array();
		$dados_dashboard['totalElements']=null;
		$dados_dashboard['totalElements']=$totalElements;
		$dados_dashboard['user']=null;
		$dados_dashboard['user']=$user->name;
		$dados_dashboard['Image']=null;
		$dados_dashboard['Image']=$nomePlataforma->image;
		$dados_dashboard['device']=null;
		$dados_dashboard['device']=$device;
		$dados_dashboard['nomePlataforma']=null;
		$dados_dashboard['nomePlataforma']=$nomePlataforma->name;
		$dados_dashboard['nomeApp']=null;
		$dados_dashboard['nomeApp']=$nomeApp->name;
		$dados_dashboard['model']=null;
		$dados_dashboard['model']=$modelTestContext;
		$dados_dashboard['totalTests']=null;
		$dados_dashboard['totalTests']=$totalTests;
		$dados_dashboard['dados']=null;
		$dados_dashboard['dados']=$raw_data_dashboard;
		$dados_dashboard['json']=null;
		$dados_dashboard['json']=json_encode($raw_data_dashboard);
		$dados_dashboard['nome_teste']=$modelTestContext->description;
		Yii::app()->user->setState('dados_dashbord_final', $dados_dashboard);
		$this->redirect("/mtcontrool/index.php/testContext/dashboard");
    }

    //CHAMA O DASH BOARD
    public function actionDashboard(){
    	$dados_dashboard =  Yii::app()->user->getState('dados_dashbord_final');
    	$this->render ( 'dashboard', $dados_dashboard);
    }

    //TELA DE IMPRESSÃO
    //ESSA TELA FOI CRIADA AQUI PARA NÃO USAR O LAYOUT DEFALT DO PROJEOT NO MOMENTO DO RENDER DA TELA
    public function actionPrintMef(){
    	header('Content-Type: text/html; charset=UTF-8');
    	if(isset($_POST['method'])){
    		if(strcmp('postDashboard', $_POST['method']) == 0){
    			$json = $_POST['json'];
		    	$totalTests = $_POST['totalTests'];
		    	$totalElements = $_POST['totalElements'];
		    	$platform = $_POST['platform'];
		    	$device = $_POST['device'];
		    	$user = $_POST['user'];
		    	$app = $_POST['app'];

		    	$dados = json_decode($json);


					echo "<br>";

		    		echo "<div>";

		    		

		    		echo "<table width='1000' style='table-layout: fixed;'>";
		    			echo "<tr > ";
				    		echo "<td align='left'>";
				    			
				    		echo "</td>";
				    		echo "<td align='left'>";
				    			
				    		echo "</td>";
				    		echo "<td align='right'>";
				    			echo '<input type="image" src="/mtcontrool/images/printer_24px.png" alt="Imprimir" onclick="window.print();" title="Imprimir">';
				    		echo "</td>";
				    		
			    		echo "</tr>";
		    			echo "<tr > ";
				    		echo "<td align='left'>";
				    			echo '<img src="/mtcontrool/images/mt_novo.png" alt="Smiley face" height="34" width="200">';
				    		echo "</td>";
				    		echo "<td align='center'>";
				    			echo "<font size='5'><b>TEST CONTEXT</b></font>";
				    		echo "</td>";
				    		echo "<td align='right'>";
				    			echo '<img id="experts_ico"  src="/mtcontrool/images/logo_experts.png" alt="Smiley face" height="34" width="121">';
				    		echo "</td>";
				    		
			    		echo "</tr>";
		    		echo "<table>";
		    		
		    		echo "<br>";

		    		echo "<table border='1' width='1000' >";
			    		echo "<tr align='center' bgcolor='#000000' color='white'>";
			    			echo "<td>";
				    			echo "<font size='5' color='white'>App Name</font>";
				    		echo "</td>";
				    		echo "<td>";
				    			echo "<font size='5' color='white'>Total Test</font>";
				    		echo "</td>";
				    		echo "<td>";
				    			echo "<font size='5' color='white'>Total Elements</font>";
				    		echo "</td>";
				    		echo "<td>";
				    			echo "<font size='5' color='white'>Platform</font>";
				    		echo "</td>";
				    		echo "<td>";
				    			echo "<font size='5' color='white'>Device</font>";
				    		echo "</td>";
				    		echo "<td>";
				    			echo "<font size='5' color='white'>User</font>";
				    		echo "</td>";
			    		echo "</tr>";

			    		echo "<tr align='center'>";
			    			echo "<td>";
				    			echo $app;
				    		echo "</td>";
				    		echo "<td>";
				    			echo $totalTests;
				    		echo "</td>";
				    		echo "<td>";
				    			echo $totalElements;
				    		echo "</td>";
				    		echo "<td>";
				    			echo $platform;
				    		echo "</td>";
				    		echo "<td>";
				    			echo $device;
				    		echo "</td>";
				    		echo "<td>";
				    			echo $user;
				    		echo "</td>";
			    		echo "</tr>";
		    		echo "</table>";

		    		echo "<br>";
		    	
		    		echo'<table  border="1" width="1000" class="table_result">
		                                <tr class="table-header" align="center" bgcolor="#000000">
		                                	<td>
		                                        <p id="header_field"><font size="5" color="white">nº</font></p>
		                                    </td>
		                                    <td style="width:30%; align="center">
		                                        <p id="header_field"><font size="5" color="white">Variations</font></p>
		                                    </td>
		                                    <td>
		                                        <p id="header_field"><font size="5" color="white">Behaviors</font></p>
		                                    </td>
		                                    <!--td>
		                                        <p id="header_field"><font size="5" color="white">Screenshots</font></p>
		                                    </td-->
		                                </tr>';
		                                $linha=1;
		                                foreach ($dados as $value){
		                                	if($linha%2==0){
			                                	echo '<tr align="center" bgcolor="#DCDCDC" >
			                                		<td>
			                                            <p id="value_field">';
			                                            echo $linha;
			                                            echo '</p> 
			                                        </td>
			                                        <td>
			                                            <p id="value_field" align="left" style="margin-left:5px;  vertical-align:top;">';
			                                            echo str_ireplace("\n", "<br>", $value[1]);
			                                            //echo $value[1];
			                                            echo '</p> 
			                                        </td>
			                                        <td>
			                                            <p id="value_field" align="left" style="margin-left:5px;">';
			                                            echo $value[2];
			                                            echo'</p>
			                                        </td>
			                                        <!--td>
			                                            <p id="value_field">';
			                                            echo $value[3];
			                                            echo '</p>
			                                        </td-->
			                                    </tr>';
		                                	}else{
			                                	echo '<tr align="center">
			                                		<td>
			                                            <p id="value_field">';
			                                            echo $linha;
			                                            echo '</p> 
			                                        </td>
			                                        <td>
			                                            <p id="value_field" align="left" style="margin-left:5px; vertical-align:top;">';
			                                            echo str_ireplace("\n", "<br>", $value[1]);
			                                            //echo $value[1];
			                                            echo '</p> 
			                                        </td>
			                                        <td>
			                                            <p id="value_field" align="left" style="margin-left:5px;">';
			                                            echo $value[2];
			                                            echo'</p>
			                                        </td>
			                                        <!--td>
			                                            <p id="value_field">';
			                                            echo $value[3];
			                                            echo '</p>
			                                        </td-->
			                                    </tr>';
		                                	}
		                                	
		                                    $linha=$linha+1;
		                                }
		  
		                                
                echo "</table>";

                echo "</div>";

                //echo "<br>";

                echo "Generated at ".date("F j, Y, g:i a")." by MTControol";

                echo "<script>window.print();</script>";

    		}
    	}
    }
	
	
	/*
	DAQUI EM DIANTE, TODAS AS CLASSES E FUNÇÕES EXISTENTES SÃO EXCLUSIVAMEBTE PARA APAIAR
	A ACTION CRIADA PELO RODRIGO, QUE GERA AS SEQUENCIAS.
	>>>>>>>>>>> CUIDADO AO MEXER. <<<<<<<<<<<<<<<
	*/
	public function BuildXml($object, $name){
		#versao do encoding xml
				$dom = new DOMDocument("1.0", "ISO-8859-1");
				
				#retirar os espacos em branco
				$dom->preserveWhiteSpace = false;
				
				#gerar o codigo
				$dom->formatOutput = true;
				
				#criando o nó principal (root)
				$root = $dom->createElement("structure");
				$type = $dom->createElement("type", "mealy");
				$automaton = $dom->createElement("automaton");
				
				$spaceX = 84;
				$count = 0;
				// $variavel = (Condicao == resultado ) ? assim : senao ;
				
				$countCom = count($object) - 1;
				#laço
				
				foreach ($object as $com) {
					
					$textLabel = trim($com->label);
					#state
					$state = $dom->createElement("state");
					$state->setAttribute('id', $count);
					$state->setAttribute('name', 'c'.$count);
					$x = $dom->createElement("x", $spaceX);
					$y = $dom->createElement("y", 200);
					$label = $dom->createElement("label", $textLabel);
					$state->appendChild($label);
					$state->appendChild($x);
					$state->appendChild($y);
					if($count == 0){
						$initial = $dom->createElement("initial");
						$state->appendChild($initial);
					}
					if($count < $countCom){
						$r = $com->next;
					#transition
						$transition = $dom->createElement("transition");
						$from = $dom->createElement("from", $count);
						$to = $dom->createElement("to", $count+1);
						$read = $dom->createElement("read", $r);
						$transout = $dom->createElement("transout", 0);
						$transition->appendChild($from);
						$transition->appendChild($to);
						$transition->appendChild($read);
						$transition->appendChild($transout);
						$automaton->appendChild($transition);
					}
					#add ao corpo automaton
					$automaton->appendChild($state);
				
					$spaceX = $spaceX+400;
					$count++;
				
				}
				
				
				#adiciona o nó em (root)
				$root->appendChild($type);
				$root->appendChild($automaton);
				$dom->appendChild($root);
				
				# Para salvar o arquivo, descomente a linha
				//$dom->save("mef.jff");
				header('Content-type: text/xml');
				#header('Content-Length: 202');
				$t=$name;
				header("Content-Disposition: attachment;filename=$t");
				
				# imprime o xml na tela
				
				print $dom->saveXML();
		
		
	}
	

    public function actionGenerateXml($idTestContext){
    	//header('Content-Type: text/html; charset=utf-8');

    	//echo "AQUI SERÁ O GERADOR DO XML<br/>";

    	//echo "<a href='/mtcontrool/index.php/testContext/admin'><< Back to Test Context Area</a>";
		
    	$model=TestContext::model()->findByPk($idTestContext); 
		//Instanciamos o objeto passando como valor a versão do XML e o encoding (código de caractéres)
		$dom = new DOMDocument('1.0','UTF-8');
		 
		//Nesse ponto, informamos para o objeto que não queremos espaços em branco no documento
		$dom->preserveWhiteSpaces = false;
		 
		//Aqui, dizemos para o objeto que queremos gerar uma saída formatada
		$dom->formatOutput = true;
		 
		//Pronto! Configurações inicias realizadas, agora partiremos para a criação dos elementos que compõe a árvore do documento XML
		//Criação do elemento root (elemento pai)
		$root = $dom->createElement('test-context');
		 
		//Vamos criar o elemento nodeOne, conforme o exemplo anterior
		$id = $dom->createElement('id');
		$user = $dom->createElement('user');

		$app = $dom->createElement('app');
			$appId = $dom->createElement('app-id');
			$appName = $dom->createElement('app-name');

		$platform = $dom->createElement('platform');
			$platformId = $dom->createElement('platform-id');
			$platformName = $dom->createElement('platform-name');

		$device = $dom->createElement('device');
			$deviceId = $dom->createElement('device-id');
			$deviceName = $dom->createElement('device-name');
		

		$description = $dom->createElement('description');

		//Agora o elemento nodeTwo
		//$nodeTwo = $dom->createElement('nodeTwo');
		 
		//criados os elementos, vamos adicionar um valor para cada um deles
		$idTxt = $dom->createTextNode($model->id);
		$userTxt = $dom->createTextNode($model->id_user);

		$appIdTxt = $dom->createTextNode($model->id_app);
		$appNameTxt = $dom->createTextNode($model->iDAPP->name);

		$platformIdTxt = $dom->createTextNode($model->id_platform);
		$platformNameTxt = $dom->createTextNode($model->iDPLATFORM->name);

		$deviceIdTxt = $dom->createTextNode($model->id_device);
		$deviceNameTxt = $dom->createTextNode($model->iDDEVICE->description);
		$descriptionTxt = $dom->createTextNode($model->description);

		/*preencher com todas as instancias de elementos*/
		//Pronto! Elementos criados, o próximo passo é organizar essa bagunça, para isso, usaremos o método appendChild() e diremos quem é elemento pai e quem é elemento filho
		$id->appendChild($idTxt);

		$description->appendChild($descriptionTxt);

		$user->appendChild($userTxt);

		$app->appendChild($appId);
			$appId->appendChild($appIdTxt);
		$app->appendChild($appName);
			$appName->appendChild($appNameTxt);
			
		$platform->appendChild($platformId);
			$platformId->appendChild($platformIdTxt);
		$platform->appendChild($platformName);
			$platformName->appendChild($platformNameTxt);
		
		$device->appendChild($deviceId);
			$deviceId->appendChild($deviceIdTxt);
		$device->appendChild($deviceName);
			$deviceName->appendChild($deviceNameTxt);

		$instances = $dom->createElement('instances');
			/*$instanceElement = $dom->createElement('instance-element-1');
			$instanceElementIdTxt = $dom->createTextNode('id do elemento');

			$instanceElement->appendChild($instanceElementIdTxt);
			$instances->appendChild($instanceElement);*/

		$cont=0;
		foreach($model->elementInsts as $value ){
			$instanceElement = $dom->createElement('instance-element-'.$cont);
				$instanceElementId = $dom->createElement('id-element');
				$instanceElementIdTxt = $dom->createTextNode($value->id);
				
				$instanceElementName = $dom->createElement('name-element');
				$instanceElementNameTxt = $dom->createTextNode($value->iDELEMENT->description);
				
				$instanceElementDesc = $dom->createElement('desc-instance');
				$instanceElementDescTxt = $dom->createTextNode($value->description);

				$instanceElementParams = $dom->createElement('params-instance');
					$instanceElementType = $dom->createElement('type-instance');
					$instanceElementTypeTxt = $dom->createTextNode($value->element_type);

			$instanceElement->appendChild($instanceElementId);
				$instanceElementId->appendChild($instanceElementIdTxt);
					//$instances->appendChild($instanceElement);

			$instanceElement->appendChild($instanceElementName);
				$instanceElementName->appendChild($instanceElementNameTxt);

			$instanceElement->appendChild($instanceElementDesc);
				$instanceElementDesc->appendChild($instanceElementDescTxt);

			$instanceElement->appendChild($instanceElementType);
				$instanceElementType->appendChild($instanceElementTypeTxt);
			
			$instanceElement->appendChild($instanceElementParams);
				$instanceElementParams->appendChild($instanceElementType);
					$instanceElementType->appendChild($instanceElementTypeTxt);

			if($value->ELEMENT_TYPE=='interval'){
				
				$instanceElementStartParam = $dom->createElement('start-param');
				$instanceElementStartParamTxt = $dom->createTextNode($value->start_param);
				$instanceElementStartParam->appendChild($instanceElementStartParamTxt);
				$instanceElementParams->appendChild($instanceElementStartParam);

				$instanceElementEndParam = $dom->createElement('end-param');
				$instanceElementEndParamTxt = $dom->createTextNode($value->end_param);
				$instanceElementEndParam->appendChild($instanceElementEndParamTxt);
				$instanceElementParams->appendChild($instanceElementEndParam);
			}

			$instances->appendChild($instanceElement);
			$cont=$cont+1;
		}

		$root->appendChild($id);
		$root->appendChild($description);
		$root->appendChild($user);
		$root->appendChild($app);
		$root->appendChild($platform);
		$root->appendChild($device);
		$root->appendChild($instances);
		$dom->appendChild($root);
		 
		//Dessa forma, dissemos que os elementos nodeOne e nodeTwo são filhos do elemento root, isto é, estão dentro de root ou um nível abaixo de root.
		 
		//Para imprimir na tela, utilizamos o método saveXML()
		//header('Content-type: "text/xml"; charset="utf8"');
   		//header('Content-disposition: attachment; filename="filename.xml"');
		$dom->saveXML();
		 
		//Por fim, para salvarmos o documento, utilizamos o método save()
		$filename = 'xml_test_context_'.$idTestContext.'.xml';
		$dom->save('xml_testcontext/'.$filename);

		$url=Yii::app()->request->getBaseUrl(true);
 
		/*echo "<html>
		<head>
		<title>XML Download Example</title>
		</head>

		<body>
		<a href='".$url."/index.php/testContext/admin'><< Back Test Context Area</a>
		<br/>
		<a href='".$url."/xml_testcontext/".$filename."'>Download XML file</a>

		</body>
		</html>";*/

		//EXECUTA O DOWNLOAD DO XML.
		return Yii::app()->getRequest()->sendFile($filename, @file_get_contents(Yii::app()->params['xmlDirTestContext'] .$filename));
		//ABRE O ARQUIVO XML EM UMA ABA NO WEB-BROWSER
		//$this->redirect($url.'/xml_testcontext/'.$filename);
	}
}


class Vetores{
	
	public $title;
	public $el;
	public $p;
	function __construct(){
		$this->el = new ArrayObject();
		$this->p = 0;
	}	
	
	function putElement($element){
		$this->el->append($element);
		$this->p++;
	}
	
}

class Elements{
	
	public $description;
	function __construct($des){
		$this->description = $des;
	}		
}

class ElementsForXml{
	public $label;
	public $next;
	
	function __construct($label, $next){
		$this->label = $label;
		$this->next = $next;
	}
}


class Helper{
	
	function str_lreplace($search, $replace, $subject){
	    $pos = strrpos($subject, $search);
	
	    if($pos !== false)
	    {
	        $subject = substr_replace($subject, $replace, $pos, strlen($search));
	    }
	
	    return $subject;
	}
	
	public $vetores;
	
	function __construct($vetores){
		$this->vetores = $vetores;
	}
	
	function getDescription($p, $p2){
		return $this->vetores[$p]->el[$p2]->description;
	}
	
	function getObjectModel($p, $p2){
		return $this->vetores[$p]->el[$p2];
	}
	
	function getVetor(){
		$array = [];
		foreach($this->vetores as $test){
			array_push($array, $test->p);
		}
		return $array;
	}
	
	function ElementsParalax(){
		$var = $this->geraAssinaturasTamanhoVetorVariave($this->getVetor());
		$prep = $this->PreparedArray($var);
		$object = new ArrayObject();
		for($i = 0;$i<count($prep);$i++){
			
			if(count($prep)-1 == $i){
				$diff = "";
			} else {
				$diff = $this->diffObj($prep[$i], $prep[$i+1]);
			}
			$object->append(new ElementsForXml(implode("\n", $prep[$i]), $diff));
		}
		
		return $object;
		
	}
	
	function ElementsParalaxTable(){
		$var = $this->geraAssinaturasTamanhoVetorVariave($this->getVetor());
		$prep = $this->PreparedTable($var);
		return $prep;
	}
	
	
	
	function diffObj($array1, $array2){
		
		$two = implode(',',array_diff($array2, $array1));
		return $two;
	}
	
	function PreparedArray($var){
		$array = array();
		foreach($var as $v){
			$ar = explode(",",$v);
			$test = array();
			for($i=0;$i<count($ar);$i++){
				array_push($test, $this->getDescription($i, $ar[$i] - 1));
			}
			array_push($array, $test);
		}
		return $array;
	}
	
	function PreparedTable($var){
		$test = array();
		foreach($var as $v){
			$ar = explode(",",$v);
			$array = new ArrayObject();
			for($i=0;$i<count($ar);$i++){
				$array->append($this->getObjectModel($i, $ar[$i] - 1));
			}
			array_push($test, $array);
		}
		return $test;
	}
	
   function geraAssinaturasTamanhoVetorVariave($tamanhoCadaVetor) {
	        $quantidadeVetores = count($tamanhoCadaVetor);
	        $assinaturas = [];
	        $apontadores = [];
	        $gerouTodasAssinaturas = false;
	        $assinaturaNova;
		    for ($i = 0; $i < $quantidadeVetores; $i++) {
	            $apontadores[$i] = 1;
	        }
	        $apontadores[$quantidadeVetores - 1] = 0;
	        do {
	            $assinaturaNova = false;
	            $indiceVetor = $quantidadeVetores - 1;	
	            while (!$assinaturaNova) {
	                if ($indiceVetor == -1) {			
	                    $gerouTodasAssinaturas = true;
	                    break;
	                }
	                $maximoNumElementosVetor = $tamanhoCadaVetor[$indiceVetor];
	                $apontadores[$indiceVetor]++;					
	                if ($apontadores[$indiceVetor] > $maximoNumElementosVetor) 
	                {
	                   $apontadores[$indiceVetor] = 1;
	                }
	                $novaAssinatura = "";
	                for ($i = 0; $i < $quantidadeVetores - 1; $i++) {
	                    $novaAssinatura = $novaAssinatura.$apontadores[$i].",";
	                }
	                $novaAssinatura = $novaAssinatura.$apontadores[$quantidadeVetores - 1];	
	                if (!in_array($novaAssinatura, $assinaturas)) {			
	                    array_push($assinaturas, $novaAssinatura);
	                    $assinaturaNova = true;
	                } else {													
	                    $apontadores[$indiceVetor]--;
	                    if ($apontadores[$indiceVetor] < 1)
	                    {
	                        $apontadores[$indiceVetor] = $maximoNumElementosVetor;
	                    }
	                    $indiceVetor--;
	                }
	            }
	        } while (!$gerouTodasAssinaturas);
			
	        return $assinaturas;
	    }	
	
}

