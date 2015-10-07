<?php
/* @var $this ElementInstController */
/* @var $data ElementInst */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_element')); ?>:</b>
	<?php echo CHtml::encode($data->id_element); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_test_context')); ?>:</b>
	<?php echo CHtml::encode($data->id_test_context); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('element_type')); ?>:</b>
	<?php echo CHtml::encode($data->element_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_param')); ?>:</b>
	<?php echo CHtml::encode($data->start_param); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_param')); ?>:</b>
	<?php echo CHtml::encode($data->end_param); ?>
	<br />


</div>