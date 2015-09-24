<?php

class PlatformsController extends Controller
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
		$model=new Platforms;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Platforms'])) {
                                
                    
                                
                                $foto = $_FILES ["image"];
                                $nome = $_POST['Platforms']['name'];
				$nome_imagem = "image_" . $nome . ".png";
                                
				//$caminho_imagem = "C:/xampp/htdocs/mtcontrool/fotos/" . $nome_imagem;
				
				if (move_uploaded_file ( $foto ["tmp_name"], "C:/xampp/htdocs/mtcontrool/fotos/" . $nome_imagem )) {
                                    $model->setAttribute('image',$nome_imagem); 
                        	// carregou o arquivo com sucesso
				} else {
					print "Possivel ataque de upload! Aqui esta alguma informação:\n";
					print_r ( $_FILES );
				}
                                
                                $model->attributes=$_POST['Platforms'];
                   
                        $model->setRelationRecords('characteristic',is_array(@$_POST['Characteristic']) ? $_POST['Characteristic'] : array());
			if ($model->save()) {
                           // var_dump(realpath('/fotos'));
                               
				 Yii::app()->user->setFlash('success', "Platform saved with sucess!");
			}
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

		if (isset($_POST['Platforms'])) {
                    
                     $foto = $_FILES ["image"];
                                $nome = $_POST['Platforms']['name'];
				$nome_imagem = "image_" . $nome . ".png";
                                
				//$caminho_imagem = "C:/xampp/htdocs/mtcontrool/fotos/" . $nome_imagem;
				
				if (move_uploaded_file ( $foto ["tmp_name"], "C:/xampp/htdocs/mtcontrool/fotos/" . $nome_imagem )) {
                                    $model->setAttribute('image',$nome_imagem); 
                        	// carregou o arquivo com sucesso
				} else {
					print "Possivel ataque de upload! Aqui esta alguma informação:\n";
					print_r ( $_FILES );
				}
			$model->attributes=$_POST['Platforms'];
                       // $model->setRelationRecords('characteristic',is_array(@$_POST['Characteristic']) ? $_POST['Characteristic'] : array());
			if ($model->save()) {
				 Yii::app()->user->setFlash('success', "Platform updated with sucess!");
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
		$dataProvider=new CActiveDataProvider('Platforms');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Platforms('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Platforms'])) {
			$model->attributes=$_GET['Platforms'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Platforms the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Platforms::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Platforms $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='platforms-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}