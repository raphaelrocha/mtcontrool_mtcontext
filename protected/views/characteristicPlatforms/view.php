<?php
/* @var $this CharacteristicPlatformsController */
/* @var $model CharacteristicPlatforms */

$this->breadcrumbs=array(
	'Characteristic Platforms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CharacteristicPlatforms', 'url'=>array('index')),
	array('label'=>'Create CharacteristicPlatforms', 'url'=>array('create')),
	array('label'=>'Update CharacteristicPlatforms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CharacteristicPlatforms', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CharacteristicPlatforms', 'url'=>array('admin')),
);
?>

<h1>View CharacteristicPlatforms #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_characteristic',
		'id_platform',
	),
)); ?>
