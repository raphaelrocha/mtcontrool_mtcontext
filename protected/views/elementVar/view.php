<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<?php
/* @var $this ElementVarController */
/* @var $model ElementVar */
?>

<?php
$this->breadcrumbs=array(
	'Element Vars'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ElementVar', 'url'=>array('index')),
	array('label'=>'Create ElementVar', 'url'=>array('create')),
	array('label'=>'Update ElementVar', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ElementVar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ElementVar', 'url'=>array('admin')),
);
?>

<h1>View ElementVar #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ID_ELEMENT',
		'DESCRIPTION',
	),
)); ?>