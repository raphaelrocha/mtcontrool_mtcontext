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

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID_TEST_CONTEXT',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'SEQUENCE_ORDER',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'VARIATION',array('span'=>5,'maxlength'=>10000)); ?>

                    <?php echo $form->textFieldControlGroup($model,'BEHAVIOR',array('span'=>5,'maxlength'=>10000)); ?>

                    <?php echo $form->textFieldControlGroup($model,'BEHAVIOR_SCREEN',array('span'=>5,'maxlength'=>300)); ?>

                    <?php echo $form->textFieldControlGroup($model,'DATE_TIME',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->