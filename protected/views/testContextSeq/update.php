<?php
/* @var $this TestContextSeqController */
/* @var $model TestContextSeq */
?>

<?php
$this->breadcrumbs=array(
	'Test Context Seqs'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestContextSeq', 'url'=>array('index')),
	array('label'=>'Create TestContextSeq', 'url'=>array('create')),
	array('label'=>'View TestContextSeq', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage TestContextSeq', 'url'=>array('admin')),
);
?>

    <h1>Update TestContextSeq <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>