

<?php
/* @var $this TestContextController */
/* @var $model TestContext */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#test-context-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage TestContext</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

	<style type="text/css">
	
	.mtc_geral{
		display: table;
		width: 100%;
		background-color: #00CC99;
		border-radius: 3px;
	}

	.TbBreadcrumb{
		float: left;
		width: 90%;
	}

	.label_mtc{
		float: left;
		width: 10%;
		height: 36px;
		text-align: center;
		bottom: 0;

	}

	.label_txt{
		margin-top: 7px;
		font-weight: bold;
		color: white;
		display: block;
    	margin-left: auto;
	}

	div{
		*border-style: solid;
	}

	</style>
 
<div class="mtc_geral">
	<div class="TbBreadcrumb">
	<?php

	$this->widget('bootstrap.widgets.TbBreadcrumb', array(
	    'links' => array(
		'Manage TestContext',
	     
	    ), 
	));

	?>
	</div>
	<div class="label_mtc">
	<p class="label_txt">MTContext</p>
	</div>
</div>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>


</div><!-- search-form -->
<br>
<div class="well-button">

<?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
	'id'=>'b1',
	'title'=>'Back',
	'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
	'size'=>TbHtml::BUTTON_SIZE_SMALL,
	'style'=>'color: green;',
)); ?>
            
        </div>
<div class="group-div">


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'test-context-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		array(
			'header'=>'App',
			'filter'=>CHtml::listData(App::model()->findAll(),'name', 'name'),
			'name'=>'id_app',
			'value'=>'$data->iDAPP->name'
		),
		array(
			'header'=>'Platform',
			'filter'=>CHtml::listData(Platforms::model()->findAll(),'name', 'name'),
			'name'=>'id_platform',
			'value'=>'$data->iDPLATFORM->name'
		),
		array(
			'header'=>'Device',
			'filter'=>CHtml::listData(Device::model()->findAll(),'description', 'description'),
			'name'=>'id_device',
			'value'=>'$data->iDDEVICE->description'
		),
		array(
			'header'=>'User',
			'filter'=>CHtml::listData(Users::model()->findAll(),'name', 'name'),
			'name'=>'id_user',
			'value'=>'$data->iDUSER->name'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{Resume}&nbsp&nbsp{delete}',
			'buttons'=>array
		    (
		        'Resume' => array
		        (
		        	'icon'=>'icon-list',
		            'url'=>'Yii::app()->createUrl("testContext/resume", array("idTestContext"=>$data->id))',
		        ),
		        'delete'=>array(
                   	'icon'=>'fa fa-trash-o', 
                ),
		    ),
		),
	),
)); ?>