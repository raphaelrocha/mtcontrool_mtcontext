<?php

class ElementVarController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				//'users'=>array('@'),
				'expression'=>'$user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'users'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($idElement)
	{
		//$model=$this->loadModel($id);
		$arrayModels=ElementVar::model()->findAll('ID_ELEMENT=' . $idElement);
		$model = new ElementVar;
    	$model->ID_ELEMENT=$idElement;
    	array_push($arrayModels, $model);
		

		if (isset($_POST['buttonCancel'])) {
			$_SESSION['model-element']=null;
			$_SESSION['form-element']=null;
			//$this->redirect(array('admin'/*,'id'=>$model->ID*/));
			$this->redirect("/mtcontrool/index.php/element/admin");
		}

		if(isset($_POST['ElementVar']))
	    {

			$valid=true;
	        foreach($arrayModels as $i=>$item)
	        {
	        	if (isset($_POST['ElementVar'][$i])) {
					$item->attributes=$_POST['ElementVar'][$i];
					$valid=$item->validate() && $valid;
	            	$item->save();

					//if ($model->save()) {
					//	$this->redirect(array('view','id'=>$model->ID));
					//}
				}
	            
	        }
	        if(isset($_POST['buttonSave'])){
	        	
	        	$this->redirect("/mtcontrool/index.php/element/admin");
	        }
	        $this->redirect("/mtcontrool/index.php/elementVar/update?idElement=".$idElement);
	    }
		

		$this->render('update',array(
			//'model'=>$model,
			'arrayModels'=>$arrayModels,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$idElement)
	{
	
		$this->loadModel($id)->delete();
		$this->redirect("/mtcontrool/index.php/elementVar/update?idElement=".$idElement);

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ElementVar');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ElementVar('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ElementVar'])) {
			$model->attributes=$_GET['ElementVar'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ElementVar the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ElementVar::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ElementVar $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='element-var-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}