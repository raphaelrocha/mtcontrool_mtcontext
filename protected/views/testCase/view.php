<?php
/* @var $this TestCaseController */
/* @var $model TestCase */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">View Test Case - <?php echo $model->name; ?></h1></div>
<HR WIDTH=1180 ALIGN=LEFT >
<?php 

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       
	'Test Cases'=>array(''),
	$model->name,
    ),
)); ?>
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
     </div>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
		'num',
		'name',
		'description',
		'required',
		'notes',
		'steps',
		'result',
		'id_characteristic',
		//'id_criteria',
	),
)); ?>