

    <?php
				
$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
						'id' => 'share-form',
						
						// Please note: When you enable ajax validation, make sure the corresponding
						// controller action is handling ajax validation correctly.
						// There is a call to performAjaxValidation() commented in generated controller code.
						// See class documentation of CActiveForm for details on this.
						'enableAjaxValidation' => false 
				) );
				?>
    <?php echo $form->errorSummary($model); ?>

    <div class="well">
        <div class="well-cinza">
                      <b>Share a app</b>
                  </div>
                                         <p class="help-block">If you want share the app, choose a user:</p>
                                        
<?php $this->widget('application.extensions..myAutoComplete', array(
    'model'=>$model,
 
    'attribute'=>'id_users',
    'name'=>'user_autocomplete',
    'source'=>$this->createUrl('appUsers/usersAutoComplete'),  // Controller/Action path for action we created in step 4.
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'0',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
    ),    ));   ?> 
                                        
    </div>                      
                                   <br/>
                   
                                        <div class="well-button">

              <?php echo TbHtml::Button($model->isNewRecord ? '<i class="fa fa-arrow-left"></i> Back' :Share, array('submit' => CHttpRequest::getUrlReferrer(),
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
    
                                    <?php $this->endWidget(); ?>
                                
