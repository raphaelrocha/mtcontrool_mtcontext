<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<?php
/* @var $this ElementVarController */
/* @var $model ElementVar */
?>

<div class="infoblock shadow"><h1 style="color:#20B2AA; font-family: Arial">Element Variations</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Element'=>array("/element/admin"),
	'New Element Variations',
    ),
)); ?>


<?php $this->renderPartial('_form', array(
	                       //'model'=>$model,
	                       'arrayModels'=>$arrayModels,
	                       'flag'=>'update',
	                       )); ?>