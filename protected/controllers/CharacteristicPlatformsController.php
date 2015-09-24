<?php

class CharacteristicPlatformsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'platAutoComplete','index','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=new CharacteristicPlatforms;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CharacteristicPlatforms']))
		{
			$model->attributes=$_POST['CharacteristicPlatforms'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CharacteristicPlatforms']))
		{
			$model->attributes=$_POST['CharacteristicPlatforms'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
        
         public function actionPlatAutocomplete() {
        $term = trim($_GET['term']) ;
 
        if($term !='') {
            // Note: Users::usersAutoComplete is the function you created in Step 2
        $users = Characteristic::platAutoComplete($term);
            echo CJSON::encode($users);
            Yii::app()->end();
    }
  }
        
	public function actionIndex($id_plat)
	{
            $model = new CharacteristicPlatforms();
		
            if (isset($_POST['CharacteristicPlatforms'])) {
                
                //   echo "post";
                       $model->attributes=$_POST['CharacteristicPlatforms'];
                       $nome =  $_POST['CharacteristicPlatforms']['id_characteristic'];
                      
                      // var_dump($nome);
                      
                       //$str = implode("", $nome);
                    // print_r($str);
                     
                       $model->setAttribute('id_characteristic',$nome);
                       $model->setAttribute('id_platform',$id_plat); 
             
		
			if ($model->save()) {
                            
                          Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,
                         '<strong>Fine!</strong> Sharing saved with sucess!');
                         
			Yii::app()->controller->refresh();	
                           // $this->redirect('/mtcontrool/index/appUsers/index.php');
                                //$this->refresh;
                        }
                
            }
        
               
      
              $nomePlat= Platforms::model ()->findByPk ($id_plat) ;
            
		$this->render('index',array(
                    'id_plat'=>$id_plat,
                    'model'=>$model,
                    'nomePlat'=>$nomePlat->name,
                        
                   //  'Motocicleta'=>$dadosMotocicleta,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CharacteristicPlatforms('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CharacteristicPlatforms']))
			$model->attributes=$_GET['CharacteristicPlatforms'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CharacteristicPlatforms the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CharacteristicPlatforms::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CharacteristicPlatforms $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='characteristic-platforms-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
