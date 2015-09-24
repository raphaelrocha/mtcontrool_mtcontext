<?php
/* @var $this AcademiaController */
/* @var $model Academia */
/* @var $form CActiveForm */
/* @var $dataProvider Academia*/
?>
<style type="text/css">

.tablePreCreate1  {
	*border-style: solid;
	width: 100%;
    *background: #DCDCDC;
}

td{
	*border: 3px solid black;
}

.td1, .td2, .td5, .td6{

	text-align: center;
	font-weight: bold;
	font-size: 15px;
	padding: 10px 10px 10px 10px;
}

.td1{
	width: 400px;
}

.td3{
	font-weight: bold;
	font-size: 15px;
	padding: 10px 30px 10px 0px;	
}

.td4, .td7, .td8{
	text-align: center;
	font-weight: bold;
	font-size: 15px;
	padding: 10px 30px 10px 30px;
}
.labelsTables{
    font-size: 150%;
    font-style: oblique;
    font-weight: bold;
}



.up { display: table; }

.table1 { 

	float: left;
	 width: 60%;
	 margin-right: 10px; }

.info_new_element { 
	background-color: white;
	padding: 10px;
	border-radius: 5px;
	margin-left: 60%;
	display: table;
	*border-style: solid;
}

.info_ico { float: left; width: 8%; }

.info_text { 
	margin-left: 8%;

}

.btns{
	float: right;
}

.tr_up{
	width: 900px;
}

td{
	*border-style: solid;
}



</style>
<script>
	function disableAll(i){
		document.getElementById("chk_"+i).checked=false;
		document.getElementById("dd_"+i).disabled=true;
	}
	function set(i){
		if(document.getElementById("chk_"+i).checked==false){
			document.getElementById("dd_"+i).disabled=true;
		}else{
			document.getElementById("dd_"+i).disabled=false;
		}
	}
</script>

	<link href="/mtcontrool/bootstrap-switch/docs/css/highlight.css" rel="stylesheet">
	<link href="/mtcontrool/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
	

	<script src="/mtcontrool/bootstrap-switch/docs/js/jquery.min.js"></script>
    <script src="/mtcontrool/bootstrap-switch/docs/js/highlight.js"></script>
    <script src="/mtcontrool/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
    <script src="/mtcontrool/bootstrap-switch/docs/js/main.js"></script>

<?php echo CHtml::beginForm(); ?>

<div class="well-button" align="right">
	<?php echo TbHtml::submitButton('<i class="fa fa-times fa-lg"></i> Cancel',array(
            'name' => 'buttonCancel',
            'color'=>TbHtml::BUTTON_COLOR_DANGER,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
        )); 
        ?>												
	<?php echo TbHtml::submitButton('Next <i class="fa fa-step-forward"></i>',array(
        //echo TbHtml::submitButton('Next',array(
        'name' => 'confirm',
        //'value'=>$i,
        'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
        'size'=>TbHtml::BUTTON_SIZE_SMALL,
        )); ?>

        
</div>

<?php 
	/*$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
	'selectableRows' => 100,
	'columns' => array(
		
		array(
			'id' => 'selectedIds',
			'class' => 'CCheckBoxColumn',
			'value'=>'$row.";".$data->ID'
		),

		'DESCRIPTION',
		array('type'=>'raw',
            'name'=>'Type',
            'value'=> ' CHtml::dropDownList(\'someName\'.$row,$data->DESCRIPTION,
             array(
             	\'empty\'=>\'---- Choose ----\',
             	\'interval\'=>\'Interval\',
                \'nominal\'=>\'Nominal\',)
              )',  
     	),
	),
));*/
?>


<p class="help-block">Select at least one element and its type.</p>
<br>
<div class="divTables">
	<div class="up">
	<p class="labelsTables">Available</p>
		<div class="table1">
			<table class="tablePreCreate1">
			<?php $i=0; ?>
			<tr class="tr_up">
				<td class="td1">
					Element
				</td>
				<td class="td2">
					Type
				</td>
			</tr>
			<?php foreach ($models as $model): ?>
			<tr>
				<td class="td3">
					<div>
						<?php echo TbHtml::CheckBox("ID_$i",'#', 
									array('class'=>'class="with-font','label' => $model->DESCRIPTION,'id'=>"chk_$i","value"=>$model->ID,'onchange'=>"set($i)")); ?>
					</div>
				</td>
				<td class="td4">
					<div>
						<?php echo TbHtml::dropDownList("type_$i",'#',
									array('interval'=>'Interval','nominal'=>'Nominal'), 
									array('id'=>"dd_$i", 'empty' => '--- Choose ---')); ?>
					</div>
				</td>
			</tr>
			<script type="text/javascript">
	            <?php  echo "var j = ". $i . ";\n"; ?>
	            disableAll(j);
	        </script>
			<?php $i=$i+1; ?>	
			<?php endforeach;?>
		</table>
		</div>

		<div class="info_new_element">
			<div class="info_ico">
				<i class="fa fa-info-circle fa-2x "></i>
			</div>
	    	<div class="info_text">
	    		<p>
		    		<b>Nominal:</b>  When the element can be described without being enter a range. E. g.: The app activates the alarm when the connection change the connection to WIFI.
		    		<br><br>
					<b>Interval:</b> When the element is within a range: E. g.: The app activates the alarm Between 7 and 7:10 pm.
		    	</p>
	    	</div>

	    </div>
	</div>
	<hr>
	<div class="down">
		<?php if(sizeof($arrayExcluded)>0): ?>
			<p class="labelsTables">Activated</p>
			<table class="tablePreCreate">
				<tr>
					<td class="td5">
						Element
					</td>
					<td  class="td6">
						Type
					</td>
				</tr>
				<?php foreach ($arrayExcluded as $value): ?>
				
				<tr>
					<td class="td7">
						<div>
							<?php echo $value->DESCRIPTION; ?>
						</div>
					</td>
					<td class="td8">
						<?php 
						$sql='select ELEMENT_TYPE from 
									element_inst join element on (element_inst.id_element = element.id)
									where element_inst.ID_TEST_CONTEXT = '.$idTestContext.'
									 AND element_inst.ID_ELEMENT = '.$value->ID.'
									GROUP BY ELEMENT_TYPE;';
						$connection=Yii::app()->db; 
						$command=$connection->createCommand($sql);
						$query=$command->query(); 
						foreach($query as $item){
						    echo $item['ELEMENT_TYPE'];
						}
						?>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
			<hr>
		<?php endif ?>
	</div>
</div>
<br>
<input type="hidden" value="<?= $i; ?>" name="total_elements">


<?php echo CHtml::endForm(); ?>