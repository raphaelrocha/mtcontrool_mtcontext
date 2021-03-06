

<?php
/* @var $this BrandController */
/* @var $model Brand */


/*$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Manage',
);*/

/*$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Create Brand', 'url'=>array('create')),
);*/


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#brand-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Brands</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >
 


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       //'Site'=>array('site/index'),
	'Manage Brands',
    ),
)); ?>

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


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'brand-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		'brand_name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{delete}',
			'buttons'=>array(
                'update'=>array(
                'icon'=>'fa fa-pencil',
                ),
                'delete'=>array(
                   'icon'=>'fa fa-trash-o', 
                ),
            ),
		),
	),
)); ?>