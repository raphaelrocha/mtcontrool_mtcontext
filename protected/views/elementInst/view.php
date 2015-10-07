<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<?php
/* @var $this ElementInstController */
/* @var $model ElementInst */
?>

<?php
$this->breadcrumbs=array(
	'Element Insts'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ElementInst', 'url'=>array('index')),
	array('label'=>'Create ElementInst', 'url'=>array('create')),
	array('label'=>'Update ElementInst', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ElementInst', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ElementInst', 'url'=>array('admin')),
);
?>

<h1>View ElementInst #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'id_element',
		'id_test_context',
		'element_type',
		'description',
		'start_param',
		'end_param',
	),
)); ?>