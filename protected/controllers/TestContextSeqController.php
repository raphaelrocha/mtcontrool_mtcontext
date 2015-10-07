<?php

class TestContextSeqController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'actions'=>array('create','update','listDevices','generateXml','resume','mef','printMef'),
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
		$id_test_context = Yii::app()->user->getState('id_test_context');

		if($id_test_context==""){
			$this->redirect("/mtcontrool/index.php/testContext/admin");
		}
		$dados_dashboard =  Yii::app()->user->getState('dados_dashboard');
		$array_sequences = Yii::app()->user->getState('sequencias_geradas');
		$arrayModels = array();
		$raw_data_dashboard = array();
		$modelTestContext = testContext::model()->findByPk($id_test_context);

		foreach ($array_sequences as $key => $value) {
			$model=new TestContextSeq;
			$model->id_test_context = $id_test_context;
			$model->sequence_order = $array_sequences[$key][0];
			$model->variation = $array_sequences[$key][1];
			$model->behavior = $array_sequences[$key][2];
			$model->behavior_screen = $array_sequences[$key][3];
			array_push($arrayModels, $model);
		}

		if (isset($_POST['buttonCancel'])) {
			//$this->redirect("/mtcontrool/index.php/testContext/admin");
			$this->redirect('/mtcontrool/index.php/testContext/resume?idTestContext='.$id_test_context);
		}
		//verifica se existem dados do formulário no $_POST.
		if (isset($_POST['TestContextSeq'])) {
			/*var_dump($_POST);
			echo "<br><br>";
			var_dump($_FILES);
			echo "<br><br>";
			/*var_dump($_GET);
			echo "<br><br>";*/
			$cont = 0;
			$total_forms = $_POST["total_forms"];
			$validate=0;
			//echo "<br><br>";

			//loop com a quantidade total de formularios
			while ($cont<$total_forms){
				//verifica se o checkbox foi marcado
				$chkKey = "chk".$cont;
				if (isset($_POST[$chkKey])) {
					$arrayModels[$cont]->id_test_context = $id_test_context;
					$arrayModels[$cont]->variation = $_POST["variation".$cont];
					$arrayModels[$cont]->behavior = $_POST["behavior".$cont];
					$fileKey = "uploadFile".$cont;
					//verifica se tem arquivo no temp.
					if(isset($_FILES[$fileKey]["name"])){
						//verifica se o nome do arquivo não está em branco.
						if($_FILES[$fileKey]["name"]!=""){
							//pega a extensão do arquivo upado.
							$ext = substr(strrchr($_FILES[$fileKey]["name"], "."), 1);
							//gera um time stamp do momento do upload.
		        			$now = date("F j, Y, g:i a");
		        			//gera um nome padrão do sistema para o arquivo upado e aplica um mp5 para codificar o nome.
		        			$file_name = md5($arrayModels[$cont]->id_test_context."_sequence_test_context_".$arrayModels[$cont]->sequence_order."_".$now.".".$ext);
		        			//concatena o nome gerado com a extensão.
		        			$file_name = $file_name.".".$ext;
		        			//$target_file = Yii::app()->params['uploadDirTestContext'] . basename($_FILES[$fileKey]["name"]);
		        			//gera o alvo para salvar o aquivo no diretorio
		        			$target_file = Yii::app()->params['uploadDirTestContext'] . basename($file_name);
		        			//salva o arquivo no diretorio
		        			if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $target_file)) {
		        				//se o salvamento deu certo, o nome é salvo no banco de dados.
		        				$arrayModels[$cont]->behavior_screen = $file_name;

		        			}else{
		        				//erro no salvamento
		        				$arrayModels[$cont]->behavior_screen = "no_file";
		        			}
						}
						//salva sequencia no banco de dados
						if ($arrayModels[$cont]->save()) {
							$validate++;
						}else{
							//imprime o erro ao salvar.
							print_r($arrayModels[$cont]->getErrors());
						}
					}	
				}else{
					//remove objeto do array se o checkbox não foi selecionado.
					unset($arrayModels[$cont]);
				}
				$cont++;
			}

			$totalTests=0;
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

			if($validate>0){
				$dados_dashboard['totalTests']=null;
				$dados_dashboard['totalTests']=$totalTests;
				$dados_dashboard['dados']=null;
				$dados_dashboard['dados']=$raw_data_dashboard;
				$dados_dashboard['json']=null;
				$dados_dashboard['json']=json_encode($raw_data_dashboard);
				$dados_dashboard['nome_teste']=$modelTestContext->description;
				Yii::app()->user->setState('dados_dashbord_final', $dados_dashboard);
				$this->redirect("/mtcontrool/index.php/testContext/dashboard");
			}else{
				Yii::app()->user->setFlash('alert-seq',"NOTE: You must select at least one sequence.");
				$this->redirect("/mtcontrool/index.php/testContextSeq/create");
			}
		}

		$this->render('create',array(
			'models'=>$arrayModels,
			'id_test_context'=>$id_test_context,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['TestContextSeq'])) {
			$model->attributes=$_POST['TestContextSeq'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
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

		$this->redirect("/mtcontrool/index.php/testContext/admin");
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$this->redirect("/mtcontrool/index.php/testContext/admin");
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TestContextSeq the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TestContextSeq::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TestContextSeq $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='test-context-seq-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}