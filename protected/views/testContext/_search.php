<?php
/* @var $this TestContextController */
/* @var $model TestContext */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_user',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_app',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_platform',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_device',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'description',array('span'=>5,'maxlength'=>50)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->