<?php

class CharacteristicController extends Controller
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
                        array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('lista'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('invalid'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view'),
				'expression'=>'$user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            try{
		$model=new Characteristic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Characteristic'])) {
			$model->attributes=$_POST['Characteristic'];
			if ($model->save()) {
				Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,
    '<strong>Well!</strong> Characteristic created with sucess!');
                   Yii::app()->controller->refresh();
			}
		}}catch (Exception $e){
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    '<strong>Ops!</strong> ERROR!');
                         
			Yii::app()->controller->refresh();
                    }

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            try{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Characteristic'])) {
			$model->attributes=$_POST['Characteristic'];
			if ($model->save()) {
				Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,
    '<strong>Well!</strong> Characteristic updated with sucess!');
                   Yii::app()->controller->refresh();
			}
            }}catch (Exception $e){
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    '<strong>Ops!</strong> ERROR!');
                         
			Yii::app()->controller->refresh();
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
		$dataProvider=new CActiveDataProvider('Characteristic');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Characteristic('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Characteristic'])) {
			$model->attributes=$_GET['Characteristic'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        
        public function actionLista($id, $idPlat)
	{
            
            
                $nomePlat = Platforms::model ()->findByPk ( $idPlat);
            
		$model=new Characteristic('searchLista');
		$model->unsetAttributes();  // clear any default values
		
           
                //if(Yii::app()->request->isAjaxRequest){
       

          
                
                if (isset($_POST['confirm'])) {
                    
                    if(isset($_POST['selectedIds'] )){
                        
                      
                       // print_r($_POST['selectedIds']);
                        foreach($_POST['selectedIds'] as $idT){
                          $array1[] = $idT;
                        }
                        
                        foreach($array1 as $VETOR){
                            
                            $connection=Yii::app()->db;
                          //  $querido = "SELECT test_case.id FROM test_case WHERE id_characteristic =" .$VETOR ;
                            $querido = "SELECT TC.id FROM test_case as TC LEFT JOIN test_platform
                            ON TC.id = test_platform.id_test_case 
                            WHERE test_platform.id_platform = ".$idPlat." AND TC.id_characteristic = ".$VETOR;

                            $commando=$connection->createCommand($querido);
                            $vetorTesteEscolhido=$commando->query();

                            foreach($vetorTesteEscolhido as $vetorzinho){
                                $meuDeus[] = $vetorzinho["id"];
                            }            
                        }
                        
                        
                        
                        $connection=Yii::app()->db;
                        $MY = "SELECT test_case.id FROM test_case LEFT JOIN test_platform ON test_case.id = test_platform.id_test_case WHERE test_case.id_characteristic IS NULL AND test_platform.id_platform = ".$idPlat;
                        $commando=$connection->createCommand($MY);
                        $tentativa=$commando->query();

                    

                        foreach ($tentativa as $vamo){
                            $value[] = $vamo['id'];
                        }

                
                        $result = array_merge($value, $meuDeus);
       
                        $test = json_encode($value);
                        
                        $que = json_encode($meuDeus);
                        
                        $mara = json_encode($result);
                     
                        
                        foreach ( $result as $key ) {
			
		
			if ($key != "") {
				$id_testcase = $key;
				$id_runs = $id;
				$connection = Yii::app ()->db;
				$command = $connection->createCommand ( "INSERT INTO `test_run`(`id_runs`, `id_test_case`, `status`) VALUES (" . $id_runs . "," . $key . ",0)" );
				$rowCount = $command->execute ();
			}
		}
                        
                $this->redirect ( array (
				'runs/view',
				'id' => $id
		) );
                        // $this->redirect(array("/runs/Teste/","que"=>$que,"test"=>$test, "mara"=>$mara));
                    
                    }
		}

		$this->render('lista',array(
			'model'=>$model,
                        'idPlat'=>$idPlat,
                        'nomePlat'=>$nomePlat,
                    
		));
	}
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Characteristic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Characteristic::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Characteristic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='characteristic-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}