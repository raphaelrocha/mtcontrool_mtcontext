<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Elements</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       //'Site'=>array('site/index'),
	'Manage Elements',
    ),
)); ?>
<br/>

<div class="well-button">

<?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
	'id'=>'b1',
	'title'=>'Back',
	'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
	'size'=>TbHtml::BUTTON_SIZE_SMALL,
	'style'=>'color: green;',
	));
?>
            
             
                
        </div>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'element-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'description',
		array(
			'header'=>'Platforms',
			'filter'=>CHtml::listData(Platforms::model()->findAll(),'id', 'name'),
			'name'=>'id_plat',
			'value'=>'$data->platform_list($data->id)'
		),
		array(
			'header'=>'Devices',
			'filter'=>CHtml::listData(Device::model()->findAll(),'id', 'description'),
			'name'=>'id_dev',
			'value'=>'$data->device_list($data->id)'
		),
		
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