<?php
/* @var $this DeviceController */
/* @var $model Device */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'device-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


<div class="well-button" align="right">
	<?php echo TbHtml::submitButton('<i class="fa fa-times fa-lg"></i> Cancel',array(
		'name' => 'buttonCancel',
	    'color'=>TbHtml::BUTTON_COLOR_DANGER,
	    'size'=>TbHtml::BUTTON_SIZE_SMALL,
	)); ?>
    <?php echo TbHtml::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o"></i> Save' : '<i class="fa fa-floppy-o"></i> Save',array(
	    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
	    'size'=>TbHtml::BUTTON_SIZE_SMALL,
	)); ?>

	
</div>
<div class="well">
	    <p class="help-block">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->dropDownListControlGroup($model,'ID_BRAND',$brandsArray, array(/*'id'=>'BrandField',"disabled"=>"disabled",*/ 'empty' => '--- Choose a brand ---')); ?>
            <?php echo $form->dropDownListControlGroup($model,'ID_PLATFORM',$platformsArray, array(/*'id'=>'BrandField',"disabled"=>"disabled",*/ 'empty' => '--- Choose a platform ---')); ?>

            <?php echo $form->textFieldControlGroup($model,'DESCRIPTION',array('span'=>5,'maxlength'=>50)); ?>
</div>
    
	

    <?php $this->endWidget(); ?>

</div><!-- form -->