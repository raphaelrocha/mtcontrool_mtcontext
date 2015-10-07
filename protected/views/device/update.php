
<?php
/* @var $this DeviceController */
/* @var $model Device */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA; ">Update Device *<?php echo $model->description; ?> </h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Device'=>array('admin'),
	'Update Device',
    ),
)); ?>


<?php $this->renderPartial('_form', array('model'=>$model,
	                                      'brandsArray'=>$brandsArray,
			                              'platformsArray'=>$platformsArray,)); ?>