<?php
/* @var $this TestContextSeqController */
/* @var $data TestContextSeq */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TEST_CONTEXT')); ?>:</b>
	<?php echo CHtml::encode($data->ID_TEST_CONTEXT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEQUENCE_ORDER')); ?>:</b>
	<?php echo CHtml::encode($data->SEQUENCE_ORDER); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VARIATION')); ?>:</b>
	<?php echo CHtml::encode($data->VARIATION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BEHAVIOR')); ?>:</b>
	<?php echo CHtml::encode($data->BEHAVIOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BEHAVIOR_SCREEN')); ?>:</b>
	<?php echo CHtml::encode($data->BEHAVIOR_SCREEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DATE_TIME')); ?>:</b>
	<?php echo CHtml::encode($data->DATE_TIME); ?>
	<br />


</div>