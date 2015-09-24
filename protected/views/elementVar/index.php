<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<?php
/* @var $this ElementVarController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Element Vars',
);

$this->menu=array(
	array('label'=>'Create ElementVar','url'=>array('create')),
	array('label'=>'Manage ElementVar','url'=>array('admin')),
);
?>

<h1>Element Vars</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>