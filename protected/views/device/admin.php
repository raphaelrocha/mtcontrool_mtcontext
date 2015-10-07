

<?php
/* @var $this DeviceController */
/* @var $model Device */


?>


<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Devices</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
	'Manage Devices',
    ),
)); 
?>
<br/>

<div class="well-button">

	<?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
		'id'=>'b1',
		'title'=>'Back',
		'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		'size'=>TbHtml::BUTTON_SIZE_SMALL,
		'style'=>'color: green;',

		)  ); 
	?>
</div>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'device-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'id_brand',
		array(
			'header'=>'Model',
			//'filter'=>Brand::model()->forList(),
			'name'=>'description',
			//'value'=>'$data->iDBRAND->brand_name'
		),
		array(
			'header'=>'Brand',
			'filter'=>CHtml::listData(Brand::model()->findAll(),'brand_name', 'brand_name'),
			'name'=>'id_brand',
			'value'=>'$data->iDBRAND->brand_name'
		),
		array(
			'header'=>'Platform',
			'filter'=>CHtml::listData(Platforms::model()->findAll(),'name', 'name'),
			'name'=>'id_platform',
			'value'=>'$data->iDPLATFORM->name'
		),
		
		//'description',
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