<?php
/* @var $this ElementController */
/* @var $model Element */
/* @var $form TbActiveForm */
?>

	
	<link href="/mtcontrool/bootstrap-switch/docs/css/highlight.css" rel="stylesheet">
	<link href="/mtcontrool/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
	

	<script src="/mtcontrool/bootstrap-switch/docs/js/jquery.min.js"></script>
    <script src="/mtcontrool/bootstrap-switch/docs/js/highlight.js"></script>
    <script src="/mtcontrool/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
    <script src="/mtcontrool/bootstrap-switch/docs/js/main.js"></script>

    <style type="text/css">

    div{
    	*border-style: solid;
    }

    .div_btns{
    	float: right;
    }

    .checkboxes{
    	width: 100%;
    	display: table; 

    }

    .table_list_devices{
    	display: table;
    	width: 30%;
    	float: left;
    	padding: 10px; 
    }

    .label_platform{
    	font-weight: bold;
    	font-size: 150%;
    	*text-align: center;
    }
    .platform_logo{
    	float: left;
    	width: 10%;
    	padding: 5px;
    }

    .platform_name{
    	float: left;
    	width: 70%;
    	padding: 5px;
    }
    </style>

 	
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'element-form-p2',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>-->

    <?php echo $form->errorSummary($model); ?>

    <div class="well-button" align="right">
    	<?php echo TbHtml::submitButton('<i class="fa fa-times fa-lg"></i> Cancel',array(
			'name' => 'buttonCancel',
		    'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
		)); ?>

    	<?php echo TbHtml::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o"></i> Save' : '<i class="fa fa-floppy-o"></i> Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
		)); ?>
    </div>

    <?php
            //array que ir� receber as plataformas selecionadas
			$selected_devices = array ();
			//para cada plataforma, insere os id_plataforma escolhidos no array
			//var_dump($model->platforms);
			foreach ( $model->devices as $device )

			array_push ($selected_devices, $device->ID);
			?>
	<div class="well">
	    <div class="checkboxes">
		    <?php $anterior="";?>
		    <?php $count=0; ?>
		    <?php foreach ($devicesObjectsArray as $key => $modelDevice):?>
		    	<?php if($modelDevice->ID_PLATFORM != $anterior): ?>
		    		<div class="table_list_devices" id="table_list_devices<?= $modelDevice->ID_PLATFORM; ?>">

			    		<?php $anterior = $modelDevice->ID_PLATFORM?>
			    		<?php $nomePlataforma = Platforms::model ()->findByPk ($modelDevice->ID_PLATFORM); ?>
			    		<div class="platform_logo">
			    			<?php echo CHtml::image(Yii::app()->request->baseUrl."/fotos/".$nomePlataforma->image."","kd",array( 'width'=>'40px','height'=>'40px', 'align'=>'center')); ?> 
			    		</div>
			    		<div class="platform_name">
			    			<p class="label_platform"><?php echo $modelDevice->iDPLATFORM->name; ?></p>
			    		</div>
			    		
			    		
			    		
		    		<br>
		    	<?php endif; ?>
		    	<!--AQUI VÃOS OS CHECKBOX-->
		    		<?php if(in_array($modelDevice->ID,$selected_devices)): ?>
		    			<?php echo $form->checkBox($modelDevice,"[$count]selected", array('checked'=>'checked', 'name'=>$modelDevice->ID)); ?>
		    		<?php else: ?>
		    			<?php echo $form->checkBox($modelDevice,"[$count]selected", array('name'=>$modelDevice->ID) ); ?>
		    		<?php endif; ?>
		    		
		    		<?php echo $modelDevice->DESCRIPTION; ?>
		    	<!--AQUI VÃOS OS CHECKBOX FIM -->
		    	<br>
		    	<?php if(isset($devicesObjectsArray[$key+1])): ?>
		    		<?php if($devicesObjectsArray[$key+1]->ID_PLATFORM != $modelDevice->ID_PLATFORM): ?>
		    		</div><!--fim div table_list_devices-->
		    		<?php endif; ?>
		    	<?php else: ?>
		    		</div><!--fim div table_list_devices-->
		    	<?php endif; ?>
		    	<?php $count++; ?>
			<?php endforeach; ?>
	    </div>
    </div>


			


			
			
			<div>
				<?php //echo TbHtml::label($model->getAttributeLabel('devices'),'Device'); ?>
				
				<div class="portlet-content" id="divprincipal">
				<!--?php echo TbHtml::CheckBoxList('Devices',/*'',$devicesArray,*/
												$selected_devices , 
												$devicesArray,
												//CHtml::listData(Device::model()->findAll(),'ID','DESCRIPTION'),
												
												array('template'=>'{input} {label}')
												); ?-->
				<!--?php echo $form->error($model,'device'); ?-->
				</div>
			</div>
    </br>




	<?php //echo $form->dropDownListControlGroup($model,'ID_PLATFORM',$platformsArray, array('span'=>5, 'empty' => '--- Escolha uma plataforma ---')); ?>


            

        
    
	

    <?php $this->endWidget(); ?>



</div><!-- form -->