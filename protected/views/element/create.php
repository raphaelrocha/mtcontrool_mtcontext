

<?php
/* @var $this ElementController */
/* @var $model Element */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">New Element</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Element'=>array('admin'),
	'New Element',
    ),
)); ?>

<?php $_SESSION['form-element'] = "p1";?>

<!--
<?php //$this->menu=array(
	//array('label'=>'List Element', 'url'=>array('index')),
	//array('label'=>'Manage Element', 'url'=>array('admin')),
//);
?>-->

<?php $this->renderPartial('_form', array('model'=>$model,
										  'platformsArray'=>$platformsArray,
										  'devicesArray'=>$devicesArray,
										  )); ?>