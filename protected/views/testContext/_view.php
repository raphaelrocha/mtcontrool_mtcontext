<?php
/* @var $this TestContextController */
/* @var $data TestContext */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_app')); ?>:</b>
	<?php echo CHtml::encode($data->id_app); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_platform')); ?>:</b>
	<?php echo CHtml::encode($data->id_platform); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_device')); ?>:</b>
	<?php echo CHtml::encode($data->id_device); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>