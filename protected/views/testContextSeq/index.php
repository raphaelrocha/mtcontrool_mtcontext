<?php
/* @var $this TestContextSeqController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Test Context Seqs',
);

$this->menu=array(
	array('label'=>'Create TestContextSeq','url'=>array('create')),
	array('label'=>'Manage TestContextSeq','url'=>array('admin')),
);
?>

<h1>Test Context Seqs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>