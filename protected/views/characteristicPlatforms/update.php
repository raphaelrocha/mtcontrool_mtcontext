<?php
/* @var $this CharacteristicPlatformsController */
/* @var $model CharacteristicPlatforms */

$this->breadcrumbs=array(
	'Characteristic Platforms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CharacteristicPlatforms', 'url'=>array('index')),
	array('label'=>'Create CharacteristicPlatforms', 'url'=>array('create')),
	array('label'=>'View CharacteristicPlatforms', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CharacteristicPlatforms', 'url'=>array('admin')),
);
?>

<h1>Update CharacteristicPlatforms <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>