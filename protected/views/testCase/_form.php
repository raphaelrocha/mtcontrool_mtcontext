<?php
/* @var $this TestCaseController */
/* @var $model TestCase */
/* @var $form TbActiveForm */

?>



<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'test-case-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'clientOptions' => array(
        'validateOnSubmit'=>true,
    ),
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
            
             <?php echo TbHtml::submitButton ( '<i class="fa fa-check fa-lg"></i> Create', array ('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'size'=>TbHtml::BUTTON_SIZE_SMALL,
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
     
                <?php
              
                
                echo $form->dropDownListControlGroup($model,'id_criteria',CHtml::listData(Criteria::model()->findAll(),'id', 'name'),
                        array(
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('TestCase/Selectdos'),
                                    //'TestCase' => 'TESTE',
                                    'update' => '#'.CHtml::activeId($model,'id_characteristic'),
                                ),'prompt'=>'Select'
                                
                            )
                        ); ?>
    
    
    </br>
    <div class="littlehelp">
        
            <p class="soc-block"> <span class=" icon-arrow-right" aria-hidden="true"></span> If you wouldn't choose a characteristic, the test case'll be considered default (obrigatory).</p>
    </div>
    </br>
    
     <!-- echo $form->dropDownListControlGroup($model,'id_characteristic',CHtml::listData(Characteristic::model()->findAll(), 'id', 'name'),
                    array(
                        'prompt'=>'Selected',
                    ));-->
     
     <?php echo $form->dropDownListControlGroup($model,'id_characteristic',array(),
                        array(
                            'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('TestCase/Selectdos1'),
                                    //'TestCase' => 'TESTE',
                                    'update' => '#'.CHtml::activeId($model,'id_platform'),
                                ),'prompt'=>'Select')
                        ); ?>
    
 <!-- echo $form->dropDownListControlGroup($model,'id_characteristic',array(),
                        array(
                            'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('TestCase/Selectdos1'),
                                    //'TestCase' => 'TESTE',
                                    'update' => '#'.CHtml::activeId($model,'id_platform'),
                                ),'prompt'=>'Select')
                        ); -->
 

    </br>
            <?php
            //array que ir� receber as plataformas selecionadas
			$selected_platforms = array ();
			//para cada plataforma, insere os id_plataforma escolhidos no array
			foreach ( $model->platforms as $platform )
			array_push ($selected_platforms, $platform->id);
			?>
			
			<div>
				<?php echo TbHtml::label($model->getAttributeLabel('platforms'),'Platforms'); ?>
				
				<div class="portlet-content">
				<?php echo TbHtml::inlineCheckBoxList('Platforms', $selected_platforms , CHtml::listData(Platforms::model()->findAll(),'id','name'),array('template'=>'{input} {label}')); ?>
				<?php echo $form->error($model,'platforms'); ?>
				</div>
			</div>
    </br>
    </br>
           
    
    
    
            <?php echo $form->textFieldControlGroup($model,'num',array('span'=>5,'maxlength'=>10)); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textFieldControlGroup($model,'required',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textAreaControlGroup($model,'notes',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textAreaControlGroup($model,'steps',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textAreaControlGroup($model,'result',array('rows'=>6,'span'=>8)); ?>

    
</div>
    
   
    
    <?php $this->endWidget(); ?>

</div><!-- form -->