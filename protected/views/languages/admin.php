<?php
/* @var $this LanguagesController */
/* @var $model Languages */





Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#languages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        

<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Languages</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

<?php 

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Language'=>array('index'),
	'Manage Languages',
    ),
)); ?>

</br>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
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
	'id'=>'languages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                      'template'=>'{update} {delete}',
		),
	),
        )); ?></div><br/>
       <br/>