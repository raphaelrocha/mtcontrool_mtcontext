<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form TbActiveForm */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <div class="well">

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>100)); ?>
   
    </div>
    <div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i>', array('onclick' => 'js:document.location.href="/mtcontrool"',
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
            
             <?php echo TbHtml::submitButton ( '<i class="fa fa-check fa-lg"></i>', array ('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'size'=>TbHtml::BUTTON_SIZE_LARGE,
                     'class' => 'btn pull-right',
                     'style'=>'color: white; margin-left: 4px;',
                     'title'=>'Create',
         ));?>
          
                        <?php echo TbHtml::button('<i class="fa fa-times fa-lg"></i>', array('onclick' => 'js:document.location.href="/mtcontrool"',
                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
                        'title'=>'Cancel',
                            'class' => 'btn pull-right',
                             'style'=>'color: white;',
                )); ?>
            
                
        </div>
    
    <?php $this->endWidget(); ?>

</div><!-- form -->