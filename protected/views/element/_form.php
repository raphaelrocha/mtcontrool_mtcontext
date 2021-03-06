<?php
/* @var $this ElementController */
/* @var $model Element */
/* @var $form TbActiveForm */
?>

	
	<link href="/mtcontrool/mtcontrool/bootstrap-switch/docs/css/highlight.css" rel="stylesheet">
	<link href="/mtcontrool/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
	

	<script src="/mtcontrool/bootstrap-switch/docs/js/jquery.min.js"></script>
    <script src="/mtcontrool/bootstrap-switch/docs/js/highlight.js"></script>
    <script src="/mtcontrool/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
    <script src="/mtcontrool/bootstrap-switch/docs/js/main.js"></script>

    <style type="text/css">
    	.div_btns{
    		float: right;
    	}
    </style>

    <script type = "text/javascript">
		
	</script>

    <script>
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-43092768-1']);
      _gaq.push(['_trackPageview']);
      (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();


    </script>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'element-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    

    <div class="well-button" align="right">
    	<?php echo TbHtml::submitButton('<i class="fa fa-times fa-lg"></i> Cancel',array(
			'name' => 'buttonCancel',
		    'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
		)); ?>
    	<?php echo TbHtml::submitButton($model->isNewRecord ? 'Next <i class="fa fa-step-forward"></i>' : "Next <i class='fa fa-step-forward'></i>",array(
	    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
	    'size'=>TbHtml::BUTTON_SIZE_SMALL,
		)); ?>

		
    </div>

    <?php echo $form->errorSummary($model); ?>

    <div class="well">
    	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
            
            <?php echo $form->textFieldControlGroup($model,'description',array('span'=>5,'maxlength'=>50)); ?>

            
            <?php
            //array que ir� receber as plataformas selecionadas
			$selected_platforms = array ();
			//para cada plataforma, insere os id_plataforma escolhidos no array
			//var_dump($model->platforms);
			foreach ( $model->platforms as $platform )

			array_push ($selected_platforms, $platform->id);
			?>
			
			
			<div>
				<?php echo TbHtml::label($model->getAttributeLabel('platforms'),'Platforms'); ?>
				
				<div class="portlet-content">
				<!--echo TbHtml::inlineCheckBoxList('Platforms',/*'', $platformsArray,*/-->
				<?php echo TbHtml::CheckBoxList('Platforms',/*'', $platformsArray,*/
													  $selected_platforms,
													  CHtml::listData(Platforms::model()->findAll(),'id','name'),
													  array('id'=>'item','template'=>'{input} {label}',  'onchange'=>'verificaChecks()'/*,'onchange'=>'javascript:clickedVal();'*/)
													  ); ?>
				<?php echo $form->error($model,'platforms'); ?>
				</div>
			</div>


    </br>


	</div>
    <?php $this->endWidget(); ?>

    <script type="text/javascript">
				novaLinha();
			</script>

</div><!-- form -->