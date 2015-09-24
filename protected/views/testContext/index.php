<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<?php
/* @var $this TestContextController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Test Contexts',
);

$this->menu=array(
	array('label'=>'Create TestContext','url'=>array('create')),
	array('label'=>'Manage TestContext','url'=>array('admin')),
);
?>

<h1>Test Contexts</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'test-context-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		//'ID_USER',
		array(
			'header'=>'User',
			'filter'=>CHtml::listData(Users::model()->findAll(),'name', 'name'),
			'name'=>'ID_USER',
			'value'=>'$data->iDUSER->name'
		),
		//'ID_APP',
		array(
			'header'=>'App',
			'filter'=>CHtml::listData(App::model()->findAll(),'name', 'name'),
			'name'=>'ID_APP',
			'value'=>'$data->iDAPP->name'
		),
		//'ID_PLATFORM',
		array(
			'header'=>'Platform',
			'filter'=>CHtml::listData(Platforms::model()->findAll(),'name', 'name'),
			'name'=>'ID_PLATFORM',
			'value'=>'$data->iDPLATFORM->name'
		),
		//'ID_DEVICE',
		array(
			'header'=>'Device',
			'filter'=>CHtml::listData(Device::model()->findAll(),'DESCRIPTION', 'DESCRIPTION'),
			'name'=>'ID_DEVICE',
			'value'=>'$data->iDDEVICE->DESCRIPTION'
		),
		'DESCRIPTION',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{delete}',
		),
	),
)); ?>