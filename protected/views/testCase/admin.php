<?php
/* @var $this TestCaseController */
/* @var $model TestCase */






Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#test-case-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        
<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Test Cases</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php 


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Test Cases'=>array('index'),
	'Manage',
    ),
)); ?>



<div class="jumbotron">
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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'test-case-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'num',
		'name',
		'description',
		'required',
		'notes',
		
		'steps',
		'result',
		/*'id_characteristic',*/
                array(
                    'name'=>'id_criteria',
                    'value'=>'Criteria::Model()->FindByPk($data->id_criteria)->name',
                    'filter' => CHtml::listData(Criteria::model()->findAll(), 'id', 'name'),
                ),
		/*array(
                    'name'=>'id_criteria',
                    'value'=>'$data->idCriteria->name',
                   
                ),*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	)
)); ?>
</div>
<br/>