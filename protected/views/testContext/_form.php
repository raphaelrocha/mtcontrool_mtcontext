<?php
/* @var $this TestContextController */
/* @var $model TestContext */
/* @var $form TbActiveForm */
?>

<style type="text/css">

.btns{
  float: right;
}

</style>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'test-context-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'enableAjaxValidation'=>false,
    'enableAjaxValidation'=>true,
        'clientOptions' => array(
        'validateOnSubmit'=>true,
    ),
)); ?>


</script>
<script language="javascript" type="text/javascript">
  /*function selecionaAmbos(){
    document.getElementById("Usuario_ALUNO_2").checked=true
  }*/
  function desableAll(){
    //document.getElementById("dd1").disabled=true;
    //document.getElementById("dd2").disabled=true;

    if (document.getElementById("dd0").selectedIndex==true) {
        document.getElementById("dd1").disabled=false;
        document.getElementById("dd2").disabled=false;
    }else if (document.getElementById("dd0").selectedIndex==false) {
        document.getElementById("dd1").disabled=true;
        document.getElementById("dd2").disabled=true;
    }
  }

  function desableInUpdate(){
      document.getElementById("dd0").disabled=true;
      document.getElementById("dd1").disabled=true;
      document.getElementById("dd2").disabled=true;
  }

  function Hab(){

    if (document.getElementById("dd0").value>0) {
      //if (document.getElementById("dd1").disabled==true) {
        document.getElementById("dd1").disabled=false;
      //}
      //if (document.getElementById("dd2").disabled==true) {
        document.getElementById("dd2").disabled=false;
      //}

    }else if (document.getElementById("dd0").selectedIndex==false) {
      document.getElementById("dd1").disabled=true;
      document.getElementById("dd2").disabled=true;
      document.getElementById("dd1").selectedIndex=false;
      document.getElementById("dd2").selectedIndex=false;
    }

  }

 
</script>


<link rel="stylesheet" type="text/css"
    href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


  <div class="well-button" align="right">

    <?php echo TbHtml::submitButton('<i class="fa fa-times fa-lg"></i> Cancel',array(
          'name' => 'buttonCancel',
          'color'=>TbHtml::BUTTON_COLOR_DANGER,
          'size'=>TbHtml::BUTTON_SIZE_SMALL,
      )); ?>
      
      <?php echo TbHtml::submitButton($model->isNewRecord ? 'Next <i class="fa fa-step-forward"></i>' : 'Next <i class="fa fa-step-forward"></i>',array(
        'name' => 'buttonNext',
        'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
          'size'=>TbHtml::BUTTON_SIZE_SMALL,
      )); ?>

      

    </div>

 <div class="well">
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

        
            <?php //echo $form->textFieldControlGroup($model,'id_user',array('span'=>5)); ?>
            <font size="4">
            <?php echo "<b>Current user: </b>";?>

            <!--?php echo Yii::app()->user->getName();?-->
            <?php echo $name; ?>
            </font>
            <br/><br/>

            <?php echo $form->textFieldControlGroup($model,'description',array('span'=>5,'maxlength'=>50)); ?>
        

            
            <?php echo $form->dropDownListControlGroup($model,'id_app',$appsArray, array('id'=>'dd0',/*"disabled"=>"disabled",*/ 'empty' => '--- Choose a app ---','onchange'=>'Hab()')); ?>

            <?php 
            
            echo $form->dropDownListControlGroup($model,
                                      'ID_PLATFORM',
                                      $platformsArray,
                                      array('id'=>'dd1','empty'=>'--- Choose a platform ---'/*,'onchange'=>'Hab2()'*/,
                                        'ajax'=>array(
                                            'type'=>'POST',
                                            'url'=>CController::createUrl('testContext/listDevices'),
                                            'update'=>'#dd2',
                                            'data'=>array('categoryid'=>'js:this.value'),
                                         ),
                                      ));  
                            ?>

            <?php echo $form->dropDownListControlGroup($model,'ID_DEVICE',$devicesArray,array('id'=>'dd2','empty'=>'--- Choose a device ---')); ?>
            
            

         

        <br/>

    
    <script type="text/javascript">
      desableAll();
    </script>

    <?php if($tag=="update"):?>
      <script type="text/javascript">
        desableInUpdate();
      </script>
    <?php endif; ?>
    
   </div>
    <?php $_SESSION['flag-test-context-form']="1";?>
    <?php $this->endWidget(); ?>

</div><!-- form -->