<?php
/* @var $this CharacteristicPlatformsController */
/* @var $data CharacteristicPlatforms */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_characteristic')); ?>:</b>
	<?php echo CHtml::encode($data->id_characteristic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_platform')); ?>:</b>
	<?php echo CHtml::encode($data->id_platform); ?>
	<br />


</div>