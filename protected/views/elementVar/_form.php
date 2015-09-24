<?php
/* @var $this ElementVarController */
/* @var $model ElementVar */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'element-var-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>




<table>
<?php $j=0; ?>
<?php foreach($arrayModels as $i=>$model): ?>

    <?php echo $form->errorSummary($model); ?>
            <tr>
            <!--<td><input class="input" type="checkbox" name="option" value="estado" unchecked onchange="valida()" id='chk<?php //echo "[$i]";?>' /> </td>-->
            
            
           
            <td><?php echo $form->textFieldControlGroup($model,"[$i]DESCRIPTION",array('id'=>"description_field[$i]",'span'=>5,'maxlength'=>50)); ?></td>

            
            
            
            <td><?php echo CHtml::link('add','#',array('submit'=>array('/elementVar/update?idElement='.$model->ID_ELEMENT))); ?></td>
            <!--<td><a href="javascript:{}" onclick="document.getElementById('element-var-form').submit(); return false;">add</a></td>-->
            
            <?php if($flag=='update'):?>

                <?php if($model->DESCRIPTION!=''):?>
                <td>
                    <b><?php echo CHtml::link('delete','#',array('submit'=>array('/elementVar/delete?id='.$model->ID.'&idElement='.$model->ID_ELEMENT),'confirm'=>'Are you sure to delete this?')); ?></b>
                 </td>

                <?php endif;?>
            <?php endif;?>
            
            
            <tr>
            <tr>
            	<td colspan="7">
            		<div style="width: 100%; height: 7px; background: #C0C0C0; overflow: hidden;">
            	</td>
        	</tr>

            <?php $j=$j+1; ?>
<?php endforeach; ?>
</table>


        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Save' : 'Save',array(
        'name' => 'buttonSave',
        'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
        'size'=>TbHtml::BUTTON_SIZE_LARGE,
	    )); ?>

	    <?php echo TbHtml::submitButton('Cancel',array(
	        'name' => 'buttonCancel',
	        'color'=>TbHtml::BUTTON_COLOR_DANGER,
	        'size'=>TbHtml::BUTTON_SIZE_LARGE,
	    )); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->