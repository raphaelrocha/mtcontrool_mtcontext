<?php
/* @var $this CharacteristicPlatformsController */
/* @var $model CharacteristicPlatforms */

$this->breadcrumbs=array(
	'Characteristic Platforms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CharacteristicPlatforms', 'url'=>array('index')),
	array('label'=>'Manage CharacteristicPlatforms', 'url'=>array('admin')),
);
?>

<h1>Create CharacteristicPlatforms</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>