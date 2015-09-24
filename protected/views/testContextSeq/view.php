<?php
/* @var $this TestContextSeqController */
/* @var $model TestContextSeq */
?>

<?php
$this->breadcrumbs=array(
	'Test Context Seqs'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List TestContextSeq', 'url'=>array('index')),
	array('label'=>'Create TestContextSeq', 'url'=>array('create')),
	array('label'=>'Update TestContextSeq', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete TestContextSeq', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestContextSeq', 'url'=>array('admin')),
);
?>

<h1>View TestContextSeq #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ID_TEST_CONTEXT',
		'SEQUENCE_ORDER',
		'VARIATION',
		'BEHAVIOR',
		'BEHAVIOR_SCREEN',
		'DATE_TIME',
	),
)); ?>