

<?php
/* @var $this BrandController */
/* @var $model Brand */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">MCreate Brand</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Brand'=>array('admin'),
	'Create Brand',
    ),
)); ?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>