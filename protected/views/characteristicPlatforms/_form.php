

    <?php
				
$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
						'id' => 'characteristic-platforms-form',
						
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
                      <b>Add a Characteristic</b>
                  </div>
                                         <p class="help-block" >If you want add a new characteristic in this platform, choose the characteristic on the list:</p>
        
            <br/>
                                         <div style="overflow:scroll; height: 400px">
        
<?php 
        $type_list=CHtml::listData(Characteristic::model()->findAllbySql(
                        'SELECT id, CONCAT(name) as name FROM characteristic
                        WHERE id NOT IN
                            (SELECT id_characteristic
                             FROM characteristic_platforms
                             WHERE id_platform ='.$id_plat.')'), 'id', 'name');
        
        echo $form->radioButtonList($model,'id_characteristic',$type_list,array(
            'labelOptions'=>array(
                'style'=>'font-size:14px',

        )
        ));

?>
            
            
            


        </div>                            
        
</div>

		
	
                       <br/>
                        <div class="well-button">

              <?php echo TbHtml::Button($model->isNewRecord ? '<i class="fa fa-arrow-left"></i>' :Share, array('submit' => CHttpRequest::getUrlReferrer(),
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