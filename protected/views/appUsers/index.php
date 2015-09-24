<?php

?>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
    
        <div class="infoblock shadow"><h1 style="color:#20B2AA;">
                <?php echo CHtml::image(Yii::app()->request->baseUrl."/images/sha.png","rodada",array( 'width'=>'70px','height'=>'70px')); ?> 
    
        Manage Sharing - <?php echo $nomeApp;?></h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

<?php

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Apps'=>array('index'),
	'Manage Apps'=>array(),
            'Manage Sharing'
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
             
<div class="container">
    <div class="tabela">
                            <div class="row-fluid">
		<div class="span12">
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
                                    <div class="well-teste">
                                    <div class="row-fluid">
                                        
                                        

   

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
                                    <?php $this->endWidget(); ?>
                                
                                    </div></div>
                                </div>      
                                        
                            <div class="span6" >
                                    <div class="row-fluid">  
                                  
              <div class="well-teste2"> 
                  <div class="well-cinza">
                      <b>Unshare a app</b>
                  </div>
                   <p class="help-block">If you want unshare the <?php echo $nomeApp;?> app, delete a user:</p>
   <?php     $this->widget('bootstrap.widgets.TbGridView',array(
    'type' => TbHtml::GRID_TYPE_HOVER,
	'id'=>'appusers-grid',
       //'dataProvider'=>$emp,
	'dataProvider'=>$model->search($id_ap),
	//'filter'=>$model,
        //'rowHtmlOptionsExpression' => 'array("id"=>$data->id)',
    
        'columns'=>array(
                 
		//'id',
               /* array(
                    
                    'name'=>'id_app',
                    'value'=>'$data->idApp->name',
                ),*/
		//'id_app',
		array(
                    
                    'name'=>'id_users',
                    'value'=>'$data->idUsers->name',
                ),
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
                    </div>    </div></div></div></div>          
									
									
    
 
                        
                        <br/><br/>
              
              
                        

            

