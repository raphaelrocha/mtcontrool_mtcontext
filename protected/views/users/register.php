<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<div class="infoblock shadow"><h1 style="color:#20B2AA;">
        <img src="../../images/user.png" height="70" width="70">
        New User</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />

<?php 

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Users'=>array(''),
	'New Users',
    ),
)); ?>


<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $this->renderPartial('_register', array('model'=>$model)); ?>


