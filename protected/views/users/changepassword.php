<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */


$this->pageTitle=Yii::app()->name . ' - Change Password.';
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">
       <img src="../../images/password.png" height="70" width="70">
        Change Password</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php  

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
     
	'Change Password',
    ),
)); ?>
    
<?php 
 $this->widget('bootstrap.widgets.TbAlert');  ?>
</br>
<div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
            
             <?php echo TbHtml::submitButton ( '<i class="fa fa-check fa-lg"></i> Create', array ('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'size'=>TbHtml::BUTTON_SIZE_SMALL,
                     'class' => 'btn pull-right',
                     'style'=>'color: white; margin-left: 4px;',
                     'title'=>'Create',
                     'label'=>'Change',
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
    <?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'changePassword-form',
    
    'enableClientValidation'=>true,
    'clientOptions'=>array(
      'validateOnSubmit'=>true,
    ),
  
)); ?>

    <?php echo $form->passwordField($model, 'currentPassword', array('class'=>'span3','placeholder'=>'Old Password')); ?>
    <br/>
    <?php echo $form->passwordField($model, 'newPassword', array('class'=>'span3','placeholder'=>'New Password')); ?>
    <br/>
    <?php echo $form->passwordField($model, 'newPassword_repeat', array('class'=>'span3','placeholder'=>'Repeat Password')); ?>
    
</div>

    
    <?php $this->endWidget(); ?>

  
    
