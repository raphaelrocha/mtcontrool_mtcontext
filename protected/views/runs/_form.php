<?php
/* @var $this RunsController */
/* @var $model Runs */
/* @var $form TbActiveForm */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        
<div class="jumbotron">
<div class="form">
    <?php
				$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
						'id' => 'runs-form',
						
						// Please note: When you enable ajax validation, make sure the corresponding
						// controller action is handling ajax validation correctly.
						// There is a call to performAjaxValidation() commented in generated controller code.
						// See class documentation of CActiveForm for details on this.
						'enableAjaxValidation' => false 
				) );
				?>
     <div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
            
             <?php echo TbHtml::submitButton ('<i class="fa fa-check fa-lg"></i> Create', array ('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'size'=>TbHtml::BUTTON_SIZE_SMALL,
                     'class' => 'btn pull-right',
                     'style'=>'color: white; margin-left: 4px;',
                     'title'=>'Create',
         ));?>
          
                        <?php echo TbHtml::button('<i class="fa fa-times fa-lg"></i> Cancel', array('submit' => CHttpRequest::getUrlReferrer(),
                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                        'title'=>'Cancel',
                            'class' => 'btn pull-right',
                             'style'=>'color: white;',
                )); ?>
            
                
        </div>
    <div class="well">
    <p class="help-block">
		Fields with <span class="required">*</span> are required.
	</p>

        <?php $user_Id = Yii::app()->user->id; ?>
    <?php echo $form->errorSummary($model); ?>

      <!-- array('id_users'=>$user_Id)-->
            <?php //echo $form->textFieldControlGroup($model,'id_app',array('span'=>5)); ?>
      <p><h4>App<h4></p>
   
      <?php echo $form->dropDownList($model,'id_app', App::getApp(), array(
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('Runs/ListarPlataforma'),
                                    //'TestCase' => 'TESTE',
                                    'update' => '#'.CHtml::activeId($model,'id_platform'),
                                ),'prompt'=>'Select'
                                
                            )); ?>
      
        
      <br/><br/>
          
            
      <?php /*echo $form->dropDownListControlGroup($model,'id_platform',array(),array('id'=>'plat','empty'=>'Choose a platform'));*/?>
      
     <?php  echo $form->dropDownListControlGroup($model,'id_platform',CHtml::listData(Platforms::model()->findAll(), 'id', 'name'),
                    array(
                        'prompt'=>'Selected',
                    )); ?>
            
              
              
        <?php /*echo $form->dropDownListControlGroup($model,'id_app',CHtml::listData(App::model()->findAll(), 'id', 'name'),
                    array(
                        'prompt'=>'Selected',
                    ));*/?>
        
            <?php echo $form->textFieldControlGroup($model,'version',array('span'=>5,'maxlength'=>30)); ?>

            <?php echo $form->textAreaControlGroup($model,'changelog',array('span'=>5, 'maxlength'=>30)); ?>
        
    </div>
    
   
    <?php $this->endWidget(); ?>
    
</div>
<!-- form -->