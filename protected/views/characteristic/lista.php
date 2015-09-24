
<?php
/* @var $this CharacteristicController */
/* @var $model Characteristic */







Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#characteristic-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        
<div class="infoblock shadow"><h1 style="color:#20B2AA; ">
          <?php echo CHtml::image(Yii::app()->request->baseUrl."/images/quest.png","rodada",array( 'width'=>'80px','height'=>'80px')); ?> 
        Quest - <?php echo $nomePlat->name; ?></h1></div>
<HR WIDTH=1180 ALIGN=LEFT >



<div class="form">
    
    
     <?php
				$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
						'id' => 'lista-form',
						
						// Please note: When you enable ajax validation, make sure the corresponding
						// controller action is handling ajax validation correctly.
						// There is a call to performAjaxValidation() commented in generated controller code.
						// See class documentation of CActiveForm for details on this.
						'enableAjaxValidation' => false 
				) );
				?>
    
    

<?php echo $form->errorSummary($model); ?>

    <div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool/runs/create"',
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
            
    <?php echo TbHtml::submitButton('<i class="fa fa-check fa-lg"></i> Next', array('class'=>'btn btn-success btn-small pull-right',
         'name'=>'confirm',
        'style'=>'color: white; margin-left: 4px;',
         'title'=>'Next',
             'confirm'=>'Are you sure?',
             )); ?> 
    
            
          
                        <?php echo TbHtml::button('<i class="fa fa-times fa-lg"></i> Cancel', array('onclick' => 'js:document.location.href="/mtcontrool"',
                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                        'title'=>'Cancel',
                            'class' => 'btn pull-right',
                             'style'=>'color: white;',
                )); ?>
            
                
        </div>
    
<div class="group-div">
<?php $this->widget('bootstrap.widgets.BootGroupGridView',array(
	'id'=>'characteristic-quest',
	'dataProvider'=>$model->searchPlat($idPlat),
        'selectableRows'=>'500',
        'summaryText'=>'Choose',
	'extraRowColumns' => array('id_criteria'),
        'extraRowExpression' => '"<b style=\"font-size: 1.0em; color: #696969; aling: center;\">".$data->idCriteria->name."</b>"',
	
        'columns'=>array(
               
             array(
                    'id'=>'selectedIds',
                    'class'=>'CCheckBoxColumn',
                    'value'=>'$data->id',
                    'header' => 'foddo',
               //     'checked'=>true,
                    //'selectableRows' => null,
       
                 
                ),
		//'id',
               array(
                  'name'=>'All Characteristics',
                  'value'=>'$data->name',
               ),
		
		
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update} {delete}',
		),*/
	),
        )); ?>

    

</div>

   <?php $this->endWidget(); ?>
</div>

