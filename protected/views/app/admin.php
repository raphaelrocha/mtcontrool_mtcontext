<?php
/* @var $this AppController */
/* @var $model App */





Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#app-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
        
<div class="infoblock shadow"><h1 style="color:#20B2AA;">Manage Apps</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >


<?php



$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Apps'=>array(''),
	'Manage Apps',
    ),
)); ?>

</br>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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

<div class="group-div">
<?php 
/*
                
$userId = Yii::app()->user->id;
//$sql = "SELECT level from users WHERE id_users =".$userId;
$sql = Users::model ()->findBySql ( 'SELECT level from users WHERE id ='.$userId );
/*
if($sql = '0'){
    
    $this->widget('bootstrap.widgets.TbGridView',array(
    'type' => TbHtml::GRID_TYPE_HOVER,
	'id'=>'app-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        
        'columns'=>array(
		//'id',
		'name',
		'description',
		'category',
		'developer',
		array(
                    'name'=>'id_users',
                    'value'=>'$data->idUsers->user_name',
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));
    
}else if($sql = '1'){
    
    $this->widget('bootstrap.widgets.TbGridView',array(
    'type' => TbHtml::GRID_TYPE_HOVER,
	'id'=>'app-grid',
	'dataProvider'=>$model->searchAdmin(),
	'filter'=>$model,
        
        'columns'=>array(
		//'id',
		'name',
		'description',
		'category',
		'developer',
		array(
                    'name'=>'id_users',
                    'value'=>'$data->idUsers->user_name',
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));
    
 */

   

 

$userId = Yii::app()->user->id;
                
//$sql =  'SELECT level from users WHERE id ='.$userId ;
$connection = Yii::app ()->db;
$command = $connection->createCommand ( 'SELECT level from users WHERE id ='.$userId );
$rowCount = $command->execute ();
//echo $rowCount;

$this->widget('bootstrap.widgets.TbGridView',array(
    'type' => TbHtml::GRID_TYPE_HOVER,
	'id'=>'app-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'rowHtmlOptionsExpression' => 'array("id"=>$data->id)',
    
        'columns'=>array(
                 
		//'id',
		'name',
		'description',
		//'category',
		'developer',
		/*array(
                    
                    'name'=>'id_users',
                    'value'=>'$data->idUsers->user_name',
                ),*/
            
            array('class' => 'bootstrap.widgets.TbButtonColumn',
              // 'header' => 'Operations',
                'template'=>'{Runs} {Share} {update} {delete}',
                'htmlOptions' => array('style'=>'width:80px'),
                'buttons' => array(
                    
                    'view'=>array(
                        'icon'=>'fa fa-eye',
                    ),
                    'delete'=>array(
            'icon'=>'fa fa-trash-o', 
         ),
                    'update'=>array(
             'icon'=>'fa fa-pencil',
             
         ),
         
                       
                    'Share' => array
                (
            
                'icon'=>'fa fa-share-alt',
                'url'=>'Yii::app()->createUrl("appUsers/index", array("id_ap"=>$data->id))',
                ),
                    'Runs'=>array(
                      'icon' => 'fa fa-refresh',
                     // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/re.png',
                      'url'=>'Yii::app()->createUrl("runs/rodada", array("id"=>$data->id))',
                       
                        
                    ),
                    
                    
                )),
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
));


?>
    
    

</div><br/>


<br/>