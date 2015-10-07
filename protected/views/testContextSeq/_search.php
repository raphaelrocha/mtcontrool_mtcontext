<?php
/* @var $this TestContextSeqController */
/* @var $model TestContextSeq */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_test_context',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'sequence_order',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'variation',array('span'=>5,'maxlength'=>10000)); ?>

                    <?php echo $form->textFieldControlGroup($model,'behavior',array('span'=>5,'maxlength'=>10000)); ?>

                    <?php echo $form->textFieldControlGroup($model,'behavior_screen',array('span'=>5,'maxlength'=>300)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date_time',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->