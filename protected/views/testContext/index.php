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
		//'id',
		//'id_user',
		array(
			'header'=>'User',
			'filter'=>CHtml::listData(Users::model()->findAll(),'name', 'name'),
			'name'=>'id_user',
			'value'=>'$data->iDUSER->name'
		),
		//'id_app',
		array(
			'header'=>'App',
			'filter'=>CHtml::listData(App::model()->findAll(),'name', 'name'),
			'name'=>'id_app',
			'value'=>'$data->iDAPP->name'
		),
		//'id_platform',
		array(
			'header'=>'Platform',
			'filter'=>CHtml::listData(Platforms::model()->findAll(),'name', 'name'),
			'name'=>'id_platform',
			'value'=>'$data->iDPLATFORM->name'
		),
		//'id_device',
		array(
			'header'=>'Device',
			'filter'=>CHtml::listData(Device::model()->findAll(),'description', 'description'),
			'name'=>'id_device',
			'value'=>'$data->iDDEVICE->description'
		),
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{delete}',
		),
	),
)); ?>