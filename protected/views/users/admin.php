<?php
/* @var $this UsersController */
/* @var $model Users */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        

<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Users</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >



<?php 
 

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'User'=>array('index'),
	'Manage Users',
    ),
)); ?>

<br/>
<div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool"',
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
            
          
                    
            
                
        </div>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="group-div">
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'user_name',
                array(
                    'name'=>'country',
                    'value'=>'Country::Model()->FindByPk($data->country)->name',
                    'filter' => CHtml::listData(Country::model()->findAll(), 'id', 'name'),
                ),
		//'country',
		'business',
		//'level',
               /* array(
                    'name' => 'level',
                    'value'=>'Users::getAccessLevelList($data->level)',
                  
                ),*/
           
                array(
                        'name'=>'level',
                        'type'=>'HTML',
                        'filter'=>array('0'=>'Tester', '1'=>'Administrator'),
                        'value'=>'Users::getLabel($data->level)', 'sortable'=>TRUE,
                ),
		
		'email',
		//'password',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                     'template'=>'{update} {delete}',
                     'buttons' => array(
                               
                  
         ),
		),
	),
        )); ?></div><br/>