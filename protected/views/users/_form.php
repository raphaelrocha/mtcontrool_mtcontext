<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
  
    <div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
            
             <?php echo TbHtml::submitButton ( $model->isNewRecord ? '<i class="fa fa-check fa-lg"></i> Create' : 'Save', array ('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'size'=>TbHtml::BUTTON_SIZE_SMALL,
                     'class' => 'btn pull-right',
                     'style'=>'color: white; margin-left: 4px;',
                     'title'=>'Create',
         ));?>
          
                        <?php echo TbHtml::button('<i class="fa fa-times fa-lg"></i> Cancel', array('onclick' => 'js:document.location.href="/mtcontrool"',
                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                        'title'=>'Cancel',
                            'class' => 'btn pull-right',
                             'style'=>'color: white;',
                )); ?>
            
                
        </div>
        
    <div class="well">
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>70)); ?>

            <?php echo $form->textFieldControlGroup($model,'user_name',array('span'=>5,'maxlength'=>60)); ?>

              <?php  echo $form->dropDownListControlGroup($model,'country',CHtml::listData(Country::model()->findAll(), 'id', 'name'),
                    array(
                        'prompt'=>'Selected',
                    )); ?>
    </br>

            <?php echo $form->textFieldControlGroup($model,'business',array('span'=>5,'maxlength'=>300)); ?>

              <?php echo $form->dropDownListControlGroup($model,'level',array('Tester','Admin')); ?>
    </br>

            <?php echo $form->textFieldControlGroup($model,'email',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->passwordFieldControlGroup($model,'password',array('span'=>5,'maxlength'=>120)); ?>
    <?php echo $form->passwordFieldControlGroup($model,'password2',array('span'=>5,'maxlength'=>120)); ?>
    </div>
     
 
    <?php $this->endWidget(); ?>

</div><!-- form -->