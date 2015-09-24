<?php

?>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
    
        <div class="infoblock shadow"><h1 style="color:#20B2AA; ">
                <?php echo CHtml::image(Yii::app()->request->baseUrl."/images/manage-char-plat.png","manage",array( 'width'=>'70px','height'=>'70px')); ?> 
    
        Manage Characteristics's - <?php echo $nomePlat ?> </h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

<?php

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Apps'=>array('index'),
	'Manage Platforms'=>array(),
            'Manage Characteristc´s',
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
             
<div class="container">
    <div class="tabela">
                            <div class="row-fluid">
		<div class="span12">
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
			<div class="row-fluid">
				     
                                        
                            <div class="span6">
                                    <div class="row-fluid">  
                                     
              <div class="well-teste2"> 
                  
                  
                  
                  <div class="well-cinza">
                      <b>Delete a characteristic</b>
                  </div>
              
  
   <?php     $this->widget('bootstrap.widgets.TbGridView',array(
    'type' => TbHtml::GRID_TYPE_HOVER,
	'id'=>'appusers-grid',
       //'dataProvider'=>$emp,
	'dataProvider'=>$model->searchP($id_plat),
	'filter'=>$model,
        //'rowHtmlOptionsExpression' => 'array("id"=>$data->id)',
    //'htmlOptions' => array('style'=>'width:5px'),
        'columns'=>array(
                 
		//'id',
               /* array(
                    
                    'name'=>'id_app',
                    'value'=>'$data->idApp->name',
                ),*/
		//'id_app',
		array(
                    
                    'name'=>'id_characteristic',
                    'value'=>'$data->idCharacteristic->name',
                   'filter'=> $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                'model'=>$model,
                                'attribute'=>'id_characteristic',
                                'source'=>$this->createUrl('characteristicPlatforms/platAutoComplete'),
                                // additional javascript options for the autocomplete plugin
                                'options' => array(
                                        'showAnim'=>'fold',
                                ),
                                'htmlOptions' => array(
                                ),
                        ),true),
                ),
           /* array(
                    'name'=>'id_characteristic',
                    'value'=>'Characteristic::Model()->FindByPk($data->id_characteristic)->name',
                    'filter' => CHtml::listData(Characteristic::model()->findAll(), 'id', 'name'),
                ),*/
		//'category',
		
            
            array('class' => 'bootstrap.widgets.TbButtonColumn',
                'header' => 'Delete',
                'template'=>'  {delete}',
                //'htmlOptions' => array('style'=>'width:5px'),
                'buttons' => array(
                    
                   /* 'view'=>array(
                        'icon'=>'fa fa-eye',
                    ),
                    'update'=>array(
             'icon'=>'fa fa-pencil',
             
         ),*/
         'delete'=>array(
            'icon'=>'fa fa-times', 
          //  'confirm'=>'Are you sure ?',
          
         ),
              
                    
                    
                )),
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
));


?>

               </div></div>
                                      
              
                    
                    </div>
                            
                            <div class="span6">
                                    <div class="well-teste">
                                    <div class="row-fluid">
                                        
                                        

   
	
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

		
	
<?php $this->endWidget(); ?>

</div><!-- form -->
                                        
                                        
                                         
                                    </div></div>
                                </div> 
                    </div>    </div></div></div></div>          
									
									
    
 
                        
                        <br/><br/>
              
              
                        

            

