<?php
/* @var $this LanguagesController */
/* @var $model Languages */
?>


<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        

<div class="infoblock shadow"><h1 style="color:#20B2AA;">
        <img src="../../images/language.png" height="70" width="70">
        New Language</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php 

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Language'=>array(''),
	'New Language',
    ),
)); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>