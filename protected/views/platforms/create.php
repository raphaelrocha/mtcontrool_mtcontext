<?php
/* @var $this PlatformsController */
/* @var $model Platforms */
?>






<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        
<div class="infoblock shadow"><h1 style="color:#20B2AA;">
        <img src="../../images/platforms.png" height="70" width="70">
        New Platform</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

<?php 

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       
	'Platforms'=>array(''),
        'New Platform',
    ),
)); ?>

<?php 
 $this->widget('bootstrap.widgets.TbAlert');  ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>