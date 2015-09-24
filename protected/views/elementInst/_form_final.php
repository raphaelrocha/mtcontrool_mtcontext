<?php
/* @var $this ElementInstController */
/* @var $model ElementInst */
/* @var $form TbActiveForm */
?>



    <script language="javascript">
    
    function remove(list){
        var array = JSON.parse(list);
        for (var i=0;i<array.length;i++){
            console.log(array[i]);
            var item = document.getElementById("item_list"+array[i]);
            item.style.display = "none";    
        }
    }

    function removeUm(i){
        
        console.log(i);
        var item = document.getElementById("item_list"+i);
        item.style.display = "none";    
        
    }

    function exibir(i){
        //alert(i+1);
        //var acc =  document.getElementById("collapse"+i);
        //acc.className = "accordion-body in collapse";
        var newItemPos = i+1;
        var item = document.getElementById("item_list"+newItemPos);
        item.style.display = "block";

        var accNew =  document.getElementById("collapse"+newItemPos);
        accNew.className = "accordion-body open in collapse";

        var bt = document.getElementById("buttonAdd"+i);
        bt.style.display = "none";
    }

    function open(list){
        //alert(list);
        var array = JSON.parse(list);
        for (var i=0;i<array.length;i++){
            var acc =  document.getElementById("collapse"+array[i]);
            acc.className = "accordion-body open in collapse";

            var act = document.getElementById("accordion-toggle"+array[i]);
            act.style.color = "#808080";
        }
    }
    
    function Hab(i){
        //alert("hab");
        if(document.getElementById("type_field"+i).value=="nominal"){
            document.getElementById("description_field"+i).disabled=false;
            //document.getElementById("start_field"+i).disabled=true;
            document.getElementById("end_field"+i).disabled=true;
            document.getElementById("start_field"+i).value='';
            document.getElementById("end_field"+i).value='';
            document.getElementById("xmlbtn").disabled=false;
            document.getElementById("behavior_field"+i).disabled=false;
            document.getElementById("behavior_scr_field"+i).disabled=false;
        }else if(document.getElementById("type_field"+i).value=="interval"){
            document.getElementById("description_field"+i).disabled=false;
            //document.getElementById("start_field"+i).disabled=false;
            document.getElementById("end_field"+i).disabled=false;
            document.getElementById("xmlbtn").disabled=false;
            document.getElementById("behavior_field"+i).disabled=false;
            document.getElementById("behavior_scr_field"+i).disabled=false;
        }else{
            document.getElementById("description_field"+i).disabled=true;
           //document.getElementById("start_field"+i).disabled=true;
            document.getElementById("end_field"+i).disabled=true;
            document.getElementById("start_field"+i).value="";
            document.getElementById("end_field"+i).value="";
            document.getElementById("xmlbtn").disabled=true;
            document.getElementById("behavior_field"+i).disabled=true;
            document.getElementById("behavior_scr_field"+i).disabled=true;
        }
    }

    function valida(element){
        $.each(element, function(key, value){
            //alert(""+value.children[2].children[0].children[1].children[0].id+"");
            if(value.children[0].children[0].checked == true){
                document.getElementById(""+value.children[2].children[0].children[1].children[0].id+"").disabled=false;
                document.getElementById(""+value.children[3].children[0].children[1].children[0].id+"").disabled=false;
                document.getElementById(""+value.children[4].children[0].children[1].children[0].id+"").disabled=false;
                if(document.getElementById(""+value.children[2].children[0].children[1].children[0].id+"").value=="interval"){
                    //alert("nominal");
                    //document.getElementById(""+value.children[4].children[0].children[1].children[0].id+"").disabled=false;
                    document.getElementById(""+value.children[5].children[0].children[1].children[0].id+"").disabled=false;
                    document.getElementById(""+value.children[6].children[0].children[1].children[0].id+"").disabled=false;
                    document.getElementById(""+value.children[7].children[0].children[1].children[0].id+"").disabled=false;
                }
                if (document.getElementById(""+value.children[2].children[0].children[1].children[0].id+"").selectedIndex==false){
                    document.getElementById(""+value.children[3].children[0].children[1].children[0].id+"").disabled=true;
                    document.getElementById(""+value.children[4].children[0].children[1].children[0].id+"").disabled=true;
                    document.getElementById(""+value.children[5].children[0].children[1].children[0].id+"").disabled=true;
                    document.getElementById(""+value.children[6].children[0].children[1].children[0].id+"").disabled=true;
                    document.getElementById(""+value.children[7].children[0].children[1].children[0].id+"").disabled=true;
                }
            } else {
                document.getElementById(""+value.children[2].children[0].children[1].children[0].id+"").disabled=true;
                document.getElementById(""+value.children[3].children[0].children[1].children[0].id+"").disabled=true;
                document.getElementById(""+value.children[4].children[0].children[1].children[0].id+"").disabled=true;
                document.getElementById(""+value.children[5].children[0].children[1].children[0].id+"").disabled=true;
                document.getElementById(""+value.children[6].children[0].children[1].children[0].id+"").disabled=true;
                document.getElementById(""+value.children[7].children[0].children[1].children[0].id+"").disabled=true;

            }

        });
    }
    function desableAll(i){
        //alert("desableAll");
        if(document.getElementById("type_field"+i).value=="nominal"){
            //alert("eh nominal");
            document.getElementById("description_field"+i).disabled=false;
            //document.getElementById("start_field"+i).disabled=true;
            //document.getElementById("end_field"+i).disabled=true;
            //document.getElementById("start_field"+i).value='';
            //document.getElementById("end_field"+i).value='';
            document.getElementById("xmlbtn").disabled=false;
            //document.getElementById("behavior_field"+i).disabled=false;
            //document.getElementById("behavior_scr_field"+i).disabled=false;
        }else if(document.getElementById("type_field"+i).value=="interval"){
            //alert("eh interval");
            document.getElementById("description_field"+i).disabled=false;
            //document.getElementById("start_field"+i).disabled=false;
            //document.getElementById("end_field"+i).disabled=false;
            document.getElementById("xmlbtn").disabled=false;
            //document.getElementById("behavior_field"+i).disabled=false;
            //ocument.getElementById("behavior_scr_field"+i).disabled=false;
        }else{
            //alert("nobody");
            document.getElementById("description_field"+i).disabled=true;
            //document.getElementById("start_field"+i).disabled=true;
            //document.getElementById("end_field"+i).disabled=true;
            //document.getElementById("start_field"+i).value="";
            //document.getElementById("end_field"+i).value="";
            document.getElementById("xmlbtn").disabled=true;
            //document.getElementById("behavior_field"+i).disabled=true;
            //document.getElementById("behavior_scr_field"+i).disabled=true;
        }


        /*function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            //if (charCode > 31 && (charCode < 48 || charCode > 57))
            if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
                return false;
            return true;
        }*/
    }

</script>

<style type="text/css">

.table_do_capiroto {
    padding: 10px 10px 10px 10px;
    border-collapse: collapse;
}
.testContextUpImage
{
    *border: 4px solid black;
    text-align: center;
    box-shadow:         inset 0 0 10px #000000;
    -moz-border-radius:7px;
    -webkit-border-radius:7px;
    border-radius: 7px;
    max-width:135px;
    max-height:135px;
    width: auto;
    height: auto; 
}
.testContextUpImageDef{
    text-align: center;
    opacity: 0.2;
}
.tdImageUp{
    text-align: center;
    *border: 2px solid black;
    width:135px;
    height:135px;
}
.btns  {
    text-align: center; 
    *background: #DCDCDC;
    
}

.trFinal{
    background: #DCDCDC;
}

.labelCapiroto{
    font-size: 150%;
    font-style: oblique;
    font-weight: bold;
}

.card{
    border: 2px solid black;
}
td{
    *height:48px;
    *border: 2px solid black;
}

.tdInsert{
    vertical-align: top;
}

.tdDelete{
    vertical-align: bottom;
}

.fileFild{
    text-align: right;
    *display: inline-block;
}

.btn-file {
    position: relative;
    overflow: hidden;
}

.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

hr.style-four {
    height: 12px;
    border: 0;
    box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
}

hr.style-seven {
    height: 30px;
    border-style: solid;
    border-color: black;
    border-width: 1px 0 0 0;
    border-radius: 20px;
}

hr.style-seven:before { /* Not really supposed to work, but does */
    display: block;
    content: "";
    height: 30px;
    margin-top: -31px;
    border-style: solid;
    border-color: black;
    border-width: 0 0 1px 0;
    border-radius: 20px;
}

.btnInsert  {
    font-size: 300%;
    font-weight: bold;
    border: none;
    width:48px;
    height:48px;
    min-width: 48px;
    min-height: 48px;
    opacity: 0.2;
    outline: none;
    *background: transparent url('/mtcontrool/images/rsz_plus.png') no-repeat center center;
    background-position: ; 
    text-align: center;
    background-repeat: no-repeat;
    cursor: pointer; 
    cursor: hand;
}

.btnDelete {
    font-size: 450%;
    font-weight: bold;
    border: none;
    margin: 0;
    width:48px;
    height:48px;
    min-width: 48px;
    min-height: 48px;
    opacity: 0.2;
    outline: none;
    *background: url('/mtcontrool/images/rsz_minus.png') no-repeat center center;
    background-repeat: no-repeat;
    text-align: center;
    cursor: pointer; 
    cursor: hand;

}

.btnDelete:hover{
  border-width: 20px;
}

.accordion-inner{
    display: table;
    width: 100%;
    border-radius: 5px;
    *border-style: solid;

}

.description{
    float: left; 
    width: 25%;
}

.start_param{
    float: left; 
    width: 10%;
    margin-left: 10px;
}

.end_param{
    float: left; 
    width: 10%;
    margin-left: 10px;
}
.info_ico { 
    float: left;
    padding: 2px;
    margin-top: 8px;
    margin-left: 10px;    
}

.info_ico_var { 
    float: left;
    padding: 2px;  
    margin-right: 4px     
}

.info_params{
    float: left; 
    width:  22%;
    margin-top: 8px;
}

.info_var_table{
    margin-left: 10px
    width: 32%;
    float: left;
    display: table;
    *margin-right: 1px;
}
.info_var{
    float: left;
    *margin-right: 100px;
}

.delete{
    *border-style: solid;
    float: right; 
    *width: 15%;
    *margin-left: 10px;
    margin-right: 20px;
}

div{
    *border-style: solid;
    
    *border-color: #ff0000 #0000ff;
}

.botoes{
    padding: 10px;
    float: right;
}

.labels{
    display: table;
    width: 100%;
    margin-bottom: 20px;
}

.add-field{
    *float: left; 
    *width: 3%;
    *padding: 10px;
}
.label-name{
    float: left; 
    width: 80%;
}

.add-field{
    float: right; 
    *width: 10%;
    margin-left: 80px;
    margin-right: 20px;

}

.accordion-toggle{
    text-decoration: underline;
    color: green;
    *color: #808080; 
    font-weight: bold; 
}

.accordion-heading {
     *background-color: red;
}
.bt_delete{
    float: right;  
    margin-right: 20px;   
}

.accordion-group{
    border-style: solid;
    margin-top: -15px;
}

.accordion-inner { background-color: white; }


</style>

<script type="text/javascript">
    function hab(i){
        //alert("teste"+i);
        var acc =  document.getElementById("collapse"+i);
        acc.className = "accordion-body open in collapse";

        var act = document.getElementById("accordion-toggle"+i);
        act.style.color = "#808080";

        //acc.accordion( "option", "active", parseInt(i,10) );
        //alert(acc);
    }
</script>
 
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'element-inst-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    )); ?>

<div class="well-button" align="right">
        <?php echo TbHtml::submitButton("#" ? '<i class="fa fa-floppy-o"></i> Save' : '<i class="fa fa-floppy-o"></i> Save',array(
        'name' => 'buttonSaveOnly',
        'color'=>TbHtml::BUTTON_COLOR_INFO,
        'size'=>TbHtml::BUTTON_SIZE_SMALL,
        )); ?>

        <?php echo TbHtml::submitButton('<i class="fa fa-times fa-lg"></i> Cancel',array(
            'name' => 'buttonCancel',
            'color'=>TbHtml::BUTTON_COLOR_DANGER,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
        )); ?>

        <?php echo TbHtml::submitButton('Next <i class="fa fa-step-forward"></i>',array(
            'name' => 'buttonXML',
            'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'id'=>'xmlbtn'
        )); ?>
    </div>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <div class="items_table"><!--div table-->
    
        <?php 
        $tamanho=sizeof($arrayModels);
        $anterior="";
        $proximo=""?>
        <?php $acc_id=0; ?>
        <?php $contaLinha=1;?>
        <?php $open=0; ?>
        <?php $listRemove=array(); ?>
        <?php $listOpen=array(); ?>
        <?php foreach ($arrayModels as $key=>$model): ?>
            <input type="hidden" name="ElementInst<?= $acc_id ?>">
            <?php $name = Element::model()->findByPK($model->ID_ELEMENT); ?>
            <?php if($name->DESCRIPTION!=$anterior): ?>
                <div class="labels">
                    <?php if ($key>0): ?>
                        <br>
                        <?php $contaLinha=1; ?>
                    <?php endif;?>

                    <div class="label-name">
                        <p class="labelCapiroto"><?php echo  $name->DESCRIPTION."  (".$model->ELEMENT_TYPE.")";?></p>
                    </div>
                    <?php $open=0; ?>
                    
                </div>
                

            <?php endif; ?>
                <!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
                <div class="item_list<?= $acc_id ?>" id="item_list<?= $acc_id ?>" >
                <div class="accordion" id="accordion2" >
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            
                            <a title="Click to add informations."  class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"  href="#collapse<?= $acc_id ?>" id="accordion-toggle<?= $acc_id ?>">
                                Instance <?= $contaLinha; ?>
                                <?php $contaLinha++; ?>
                                <span class="pull-right" style="color: #BCD2EE;">
                                        <i class="fa fa-chevron-down"></i>
                                </span>
                            </a>
                           
                        </div>
                    </div>
                    <div id="collapse<?= $acc_id ?>" class="accordion-body collapse" >
                        <div class="accordion-inner">
                        
                        <?php echo $form->errorSummary($model); ?>

                        <div class="description">
                            <?php echo $form->textFieldControlGroup($model,"[$acc_id]DESCRIPTION",array('name'=>'DESCRIPTION'.$acc_id,'id'=>"description_field".$acc_id,'span'=>5,'size'=>2,'style'=>'width:250px;')); ?>
                        </div>
                        
                        <?php if($model->ELEMENT_TYPE=="interval"): ?>
                            <div class="start_param">
                                <?php echo $form->textFieldControlGroup($model,"[$acc_id]START_PARAM",array('title'=>'Accepts only numbers and the following symbols: "-" and ".".
E.g.: 1.75 or -1.75',
                                                                                                                        'class'=>'params',/*'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57',*/'name'=>'START_PARAM'.$acc_id,'id'=>"start_field".$acc_id,'size'=>2,'style'=>'width:100px;'/*,'span'=>5*/)); ?>
                               
                            </div>
                            <div class="end_param">
                                <?php echo $form->textFieldControlGroup($model,"[$acc_id]END_PARAM",array('title'=>'Accepts only numbers and the following symbols: "-" and ".".
E.g.: 1.75 or -1.75',
                                                                                                                    'class'=>'params','name'=>'END_PARAM'.$acc_id,'id'=>"end_field".$acc_id,'style'=>'width:100px;'/*,'size'=>2,'span'=>5*/)); ?>
                            </div>
                            <!--div class="info_ico">
                                <i class="fa fa-info-circle"></i>
                            </div>
                            <div class="info_params">
                                <p>The fields "Start" and "End" accepts only numbers and the following symbols: "-" and ".".</p>                            
                            </div-->

                        <?php endif; ?>
                        <!--div class="info_var_table">
                            <div class="info_ico_var">
                                <i class="fa fa-info-circle"></i>
                            </div>
                            <div class="info_var">
                                <p><b>Variations:</b> It is the values that can be assigned to an element.
                                    <br>
                                    <b>E.g.:</b> Nominal Element: Connection - Variation "wi-fi";
                                    <br>
                                    <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;->
                                    Interval Element: Localization - Variation "nearby" Start 1 End 10</p>
                            </div>
                        </div-->
                        

                        <!--div class="delete"-->
                            <?php if($model->DESCRIPTION!=''):?>
                            <div class="bt_delete">
                            <?php if($tag=="create"): ?>
                                <?php 
                                    echo TbHtml::submitButton(
                                    '<i class="fa fa-times"></i>',array(
                                    'id'=>"btnDelete_$acc_id",
                                    'confirm'=>'Are you sure to delete this?',
                                    //'submit'=>array('/elementInst/delete?a='.$a.'&id='.$model->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice."&form=create"),
                                    'name' => 'del',
                                    'value'=>$model->ID,
                                    //'class'=>'btnDelete',
                                    'title'=>"Delete this instance",
                                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    //'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    )); ?>
                            <?php elseif($tag=="update"): ?>
                                <?php 
                                    echo TbHtml::submitButton(
                                    '<i class="fa fa-times"></i>',array(
                                    'id'=>"btnDelete_$acc_id",
                                    'confirm'=>'Are you sure to delete this?',
                                    //'submit'=>array('/elementInst/delete?id='.$model->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice."&form=update"),
                                    'name' => 'del',
                                    'value'=>$model->ID,
                                    //'class'=>'btnDelete',
                                    'title'=>"Delete this instance",
                                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    //'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    )); ?>
                            <?php endif;?>
                            </div>
                        <?php else: ?>
                             <div class="info_var_table">
                                <div class="info_ico_var">
                                    <i class="fa fa-info-circle"></i>
                                </div>
                                <div class="info_var">
                                    <p><b>Variations:</b> It is the values that can be assigned to an element.
                                        <br>
                                        <b>E.g.:</b> Nominal Element: Connection - Variation "wi-fi";
                                        <br>
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        Interval Element: Localization - Variation "nearby" Start 1 End 10</p>
                                </div>
                            </div>
                            <div class="add-field" id="add-field<?= $acc_id ?>">
                                <!--?php echo TbHtml::submitButton("#" ? '<i class="fa fa-plus"></i>' : '<i class="fa fa-plus"></i>',array(
                                    'name' => 'buttonSaveOnly',
                                    'value'=>$model->ID_ELEMENT.";".$model->ELEMENT_TYPE.";".$key,
                                    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                                    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    'title'=>"Add more element"
                                    )); ?-->
                                <?php echo TbHtml::Button('<i class="fa fa-plus"></i>',array(
                                    'name' => 'buttonAdd',
                                    'id'=>'buttonAdd'.$acc_id,
                                    'onClick'=>"exibir($acc_id);",
                                    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                                    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    'title'=>"Add more element"
                                    )); ?>
                            </div>
                            <br>
                            <!--input type="button" onClick="exibir(<?= $acc_id?>);">add</input-->
                                
                        <?php endif;?> 
                        </div>
                        <?php echo $form->hiddenField($model,"[$acc_id]ELEMENT_TYPE",array('name'=>'ELEMENT_TYPE'.$acc_id,'id'=>"type_field".$acc_id,'disabled'=>'disabled','type'=>'hidden'/*,'span'=>5,'maxlength'=>10*/,'onchange'=>"Hab($key)",'style'=>'width:150px;')); ?>
                                <?php $anterior = $name->DESCRIPTION  ?>

                        </div><!--accordion-inner-->
                    <!--/div--><!--accordion-body collaps-->
                <!--/div--><!--delete-->
                </div>
            </div>
                <!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
            <?php if($model->DESCRIPTION==""): ?>
                <?php if($open==0): ?>
                    <!--?php array_push($listOpen, $acc_id) ?-->
                    <script type="text/javascript">
                        hab("<?php echo $acc_id; ?>");

                    </script>
                    <?php $open=1; ?>
                <?php else: ?>
                    <!--?php array_push($listRemove, $acc_id) ?-->
                    
                    <script type="text/javascript">
                        removeUm("<?php echo $acc_id; ?>");
                    </script>
                <?php endif; ?>            
            <?php endif; ?>
            

            <script type="text/javascript">
                <?php  echo "var i_ = ". $key . ";\n"; ?>
                desableAll(i_);
            </script>
            <?php $acc_id++; ?>
        <?php endforeach; ?>
        <?php //endfor; ?>
    </div><!--div table-->
    

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
var javascript_array = "<?php echo json_encode($listRemove); ?>";
var javascript_array_open = "<?php echo json_encode($listOpen); ?>";
    //remove(javascript_array);
    //open(javascript_array_open);
</script>


<script type="text/javascript">
    
// JQUERY ".Class" SELECTOR.
    $(document).ready(function() {
        console.log("doc ready");
        $('.params').keypress(function (event) {
            return isNumber(event, this)
        }); 
        
        $('.accordion-body').each(function(){
            if ($(this).hasClass('in')) {
                $(this).collapse('toggle');
                
            }
        });   
    });
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }  

</script>

