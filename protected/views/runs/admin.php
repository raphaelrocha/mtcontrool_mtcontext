<?php
/* @var $this RunsController */
/* @var $model Runs */






Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#runs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Runs</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >
 

  
<?php

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Runs'=>array(''),
	'Manage Runs',
       
    ), 
));

?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<br/>
<div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
            
        </div>
<div class="group-div">
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'runs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
                    'name'=>'id_app',
                    'value'=>'$data->idApp->name',
                ),
             array(
                     'header'=>'Run',
                     'name'=>'id_order',
                     'filter'=>false,
                     
                    
                 ),
		array(
                    'name'=>'id_platform',
                    'value'=>'Platforms::Model()->FindByPk($data->id_platform)->name',
                    'filter' => CHtml::listData(Platforms::model()->findAll(), 'id', 'name'),
                    //'value'=>'$data->idPlatform->name',
                ),
		'version',
		'changelog',
                
            array(
                //'header' => t("test_runs", "id"),
                'header' => 'Passed',
                'value' => 'Runs::QuantidadePass($data->id)',
                 'htmlOptions'=>array('style'=>'text-align: center'),
                'headerHtmlOptions'=>array('style'=>'color: green; text-align: center'),
               ), 
            array(
                //'header' => t("test_runs", "id"),
                'header' => 'Failed',
               
                 'value' => 'Runs::QuantidadeFail($data->id)',
                'htmlOptions'=>array('style'=>'text-align: center'),
               'headerHtmlOptions'=>array('style'=>'color: red; text-align: center'),
               ),
            array(
                //'header' => t("test_runs", "id"),
                'header' => 'Completed (%)',
                'headerHtmlOptions'=>array('width'=>'100'),
                'value' => 'Runs::QuantidadeTotal($data->id)',
                'htmlOptions'=>array('style'=>'text-align: center'),
                'headerHtmlOptions'=>array('style'=>'text-align: center'),
               
                
               ),
                //'id_order',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'header'=>'Operations',
		),
	),
        )); ?></div><br/>