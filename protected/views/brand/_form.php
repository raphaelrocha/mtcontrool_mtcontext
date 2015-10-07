<?php
/* @var $this BrandController */
/* @var $model Brand */
/* @var $form TbActiveForm */
?>
<style type="text/css">
	.btns{
		float: right;
	}
</style>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'brand-form',
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

	    <?php echo TbHtml::submitButton($model->isNewRecord ? 'Save <i class="fa fa-floppy-o"></i> ' : 'Save <i class="fa fa-floppy-o"></i> ',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
		)); ?>
    </div>
    

	
    <div class="well">
    	    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'brand_name',array('span'=>5,'maxlength'=>50)); ?>

     
	</div>

    <?php $this->endWidget(); ?>

</div><!-- form -->