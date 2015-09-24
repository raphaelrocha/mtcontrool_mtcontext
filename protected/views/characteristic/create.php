<?php
/* @var $this CharacteristicController */
/* @var $model Characteristic */
?>


<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
     



<div class="infoblock shadow"><h1 style="color:#20B2AA; ">
         <img src="../../images/chara.png" height="70" width="70">
        New Characteristic</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

<?php 


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Characteristics'=>array(''),
	'New Characteristic',
    ),
)); ?>

<?php 
 $this->widget('bootstrap.widgets.TbAlert');  ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>