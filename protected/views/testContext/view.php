<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<?php
/* @var $this TestContextController */
/* @var $model TestContext */
?>

<?php
$this->breadcrumbs=array(
	'Test Contexts'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List TestContext', 'url'=>array('index')),
	array('label'=>'Create TestContext', 'url'=>array('create')),
	array('label'=>'Update TestContext', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TestContext', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestContext', 'url'=>array('admin')),
);
?>

<h1>View TestContext #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'id_user',
		'id_app',
		'id_platform',
		'id_device',
		'description',
	),
)); ?>