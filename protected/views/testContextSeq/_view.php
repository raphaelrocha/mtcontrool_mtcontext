<?php
/* @var $this TestContextSeqController */
/* @var $data TestContextSeq */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_test_context')); ?>:</b>
	<?php echo CHtml::encode($data->id_test_context); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sequence_order')); ?>:</b>
	<?php echo CHtml::encode($data->sequence_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('variation')); ?>:</b>
	<?php echo CHtml::encode($data->variation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('behavior')); ?>:</b>
	<?php echo CHtml::encode($data->behavior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('behavior_screen')); ?>:</b>
	<?php echo CHtml::encode($data->behavior_screen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_time')); ?>:</b>
	<?php echo CHtml::encode($data->date_time); ?>
	<br />


</div>