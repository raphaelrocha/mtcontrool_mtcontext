

<?php
/* @var $this ElementController */
/* @var $model Element */
?>


<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />




<div class="infoblock shadow"><h1 style="color:#20B2AA;">New Element - Select Devices</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Element'=>array('admin'),
	'New Element',
    ),
)); ?>

<?php $_SESSION['form-element'] = "p2";?>

<?php 
$this->renderPartial('_form_p2', array('model'=>$model,
										  'platformsArray'=>$platformsArray,
										  'devicesArray'=>$devicesArray,
										  'devicesObjectsArray'=>$devicesObjectsArray,));

