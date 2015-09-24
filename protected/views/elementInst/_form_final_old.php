<?php
/* @var $this ElementInstController */
/* @var $model ElementInst */
/* @var $form TbActiveForm */
?>

    <script language="javascript">
    
    
    function Hab(i){
        //alert("hab");
        if(document.getElementById("type_field["+i+"]").value=="nominal"){
            document.getElementById("description_field["+i+"]").disabled=false;
            document.getElementById("start_field["+i+"]").disabled=true;
            document.getElementById("end_field["+i+"]").disabled=true;
            document.getElementById("start_field["+i+"]").value='';
            document.getElementById("end_field["+i+"]").value='';
            document.getElementById("xmlbtn").disabled=false;
            document.getElementById("behavior_field["+i+"]").disabled=false;
            document.getElementById("behavior_scr_field["+i+"]").disabled=false;
        }else if(document.getElementById("type_field["+i+"]").value=="interval"){
            document.getElementById("description_field["+i+"]").disabled=false;
            document.getElementById("start_field["+i+"]").disabled=false;
            document.getElementById("end_field["+i+"]").disabled=false;
            document.getElementById("xmlbtn").disabled=false;
            document.getElementById("behavior_field["+i+"]").disabled=false;
            document.getElementById("behavior_scr_field["+i+"]").disabled=false;
        }else{
            document.getElementById("description_field["+i+"]").disabled=true;
            document.getElementById("start_field["+i+"]").disabled=true;
            document.getElementById("end_field["+i+"]").disabled=true;
            document.getElementById("start_field["+i+"]").value="";
            document.getElementById("end_field["+i+"]").value="";
            document.getElementById("xmlbtn").disabled=true;
            document.getElementById("behavior_field["+i+"]").disabled=true;
            document.getElementById("behavior_scr_field["+i+"]").disabled=true;
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
        if(document.getElementById("type_field["+i+"]").value=="nominal"){
            //alert("eh nominal");
            document.getElementById("description_field["+i+"]").disabled=false;
            document.getElementById("start_field["+i+"]").disabled=true;
            document.getElementById("end_field["+i+"]").disabled=true;
            document.getElementById("start_field["+i+"]").value='';
            document.getElementById("end_field["+i+"]").value='';
            document.getElementById("xmlbtn").disabled=false;
            document.getElementById("behavior_field["+i+"]").disabled=false;
            document.getElementById("behavior_scr_field["+i+"]").disabled=false;
        }else if(document.getElementById("type_field["+i+"]").value=="interval"){
            //alert("eh interval");
            document.getElementById("description_field["+i+"]").disabled=false;
            document.getElementById("start_field["+i+"]").disabled=false;
            document.getElementById("end_field["+i+"]").disabled=false;
            document.getElementById("xmlbtn").disabled=false;
            document.getElementById("behavior_field["+i+"]").disabled=false;
            document.getElementById("behavior_scr_field["+i+"]").disabled=false;
        }else{
            //alert("nobody");
            document.getElementById("description_field["+i+"]").disabled=true;
            document.getElementById("start_field["+i+"]").disabled=true;
            document.getElementById("end_field["+i+"]").disabled=true;
            document.getElementById("start_field["+i+"]").value="";
            document.getElementById("end_field["+i+"]").value="";
            document.getElementById("xmlbtn").disabled=true;
            document.getElementById("behavior_field["+i+"]").disabled=true;
            document.getElementById("behavior_scr_field["+i+"]").disabled=true;
        }
        /*
        //$(document).ready(function() {
        //valida campos checkbox das bebidas 
        var todos_inputs = document.getElementsByTagName('input');
        var j=0;   
        var oneLineSelected=0; 
        document.getElementById("xmlbtn").disabled=true;
        for (var i=0; i<=todos_inputs.length; i++){
            if(document.getElementById("type_field["+i+"]").selectedIndex==false){
                //document.getElementsByTagName('input').checked=false;
                //document.getElementById("type_field["+i+"]").disabled=true;
                document.getElementById("chk["+i+"]").checked=false;
                //document.getElementById("type_field["+i+"]").disabled=true;
                document.getElementById("description_field["+i+"]").disabled=true;
                document.getElementById("start_field["+i+"]").disabled=true;
                document.getElementById("end_field["+i+"]").disabled=true;
                document.getElementById("behavior_field["+i+"]").disabled=true;
                document.getElementById("behavior_scr_field["+i+"]").disabled=true;
                //document.getElementById("addLink["+i+"]").disabled=true;
                //document.getElementById("xmlbtn").disabled=true;
            }
            else if(document.getElementById("type_field["+i+"]").value=="nominal"){
                //document.getElementsByTagName('input').checked=true;
                //document.getElementById("type_field["+i+"]").disabled=true;
                document.getElementById("chk["+i+"]").checked=true;
                //document.getElementById("type_field["+i+"]").disabled=false;
                document.getElementById("description_field["+i+"]").disabled=false;
                document.getElementById("start_field["+i+"]").disabled=true;
                document.getElementById("end_field["+i+"]").disabled=true;
                document.getElementById("behavior_field["+i+"]").disabled=false;
                document.getElementById("behavior_scr_field["+i+"]").disabled=false;
                //document.getElementById("addLink["+i+"]").disabled=false;

                oneLineSelected=1;
                //document.getElementById("xmlbtn").disabled=false;
            }else{
                document.getElementById("chk["+i+"]").checked=true;
                //document.getElementById("addLink["+i+"]").disabled=false;
                oneLineSelected=1;
                //document.getElementById("xmlbtn").disabled=false;
            }
            j=j+1;
            if(oneLineSelected>0){
                document.getElementById("xmlbtn").disabled=false;
            }
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

</style>
 
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

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <div>
        
        <?php $j=0;
        $tamanho=sizeof($arrayModels);
        $anterior="";
        $proximo=""?>
        <?php for($i=0;$i<$tamanho;$i++): ?>
            <?php $name = Element::model()->findByPK($arrayModels[$i]->ID_ELEMENT); ?>
            <?php if($name->DESCRIPTION!=$anterior): ?>
                <p class="labelCapiroto"><?php echo  $name->DESCRIPTION."  (".$arrayModels[$i]->ELEMENT_TYPE.")";?></p>

                <table class="table_do_capiroto">
            <?php endif; ?>
                    <?php echo $form->errorSummary($arrayModels[$i]); ?>
                    
                    <tr>
                        <td>
                            <?php echo $form->textFieldControlGroup($arrayModels[$i],"[$i]DESCRIPTION",array('id'=>"description_field[$i]",'span'=>5,'size'=>2,'style'=>'width:250px;')); ?>
                        </td>
                        <td>
                            <?php echo $form->textFieldControlGroup($arrayModels[$i],"[$i]BEHAVIOR",array('id'=>"behavior_field[$i]",'span'=>5,'maxlength'=>50,'style'=>'width:250px;')); ?>
                        </td>
                        <td>
                            <?php echo $form->textFieldControlGroup($arrayModels[$i],"[$i]START_PARAM",array('id'=>"start_field[$i]",'size'=>2,'style'=>'width:100px;'/*,'span'=>5*/)); ?>
                        </td>
                        <td>
                            <?php echo $form->textFieldControlGroup($arrayModels[$i],"[$i]END_PARAM",array('id'=>"end_field[$i]",'style'=>'width:100px;'/*,'size'=>2,'span'=>5*/)); ?>
                        </td>
                         <td rowspan="2" class="tdImageUp">
                                <?php if($arrayModels[$i]->sent!=""): ?>
                                    <a href='<?php echo Yii::app()->baseUrl ."/upload_testcontext/".$arrayModels[$i]->sent?>'
                                        target="_blank">
                                        <img class="testContextUpImage" src='<?php echo Yii::app()->baseUrl ."/upload_testcontext/".$arrayModels[$i]->sent?>'>
                                    </a>
                                <?php else: ?>
                                    <!--img class="testContextUpImageDef" src='/mtcontrool/images/rsz_11screenshot.png'  -->
                                <?php endif; ?>
                        </td>
                        <td class="tdInsert">
                            <?php 
                            echo TbHtml::submitButton($arrayModels[$i]->isNewRecord ? '+' : '+',array(
                            'name' => 'add',
                            'id'=>"btnInsert_$i",
                            'class'=>'btnInsert',
                            'title'=>"Save",
                            //'class'=>'hvr-wobble-to-bottom-right',
                            //'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                            //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                            )); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="btns">
                            <!--<?php 
                            echo TbHtml::submitButton($arrayModels[$i]->isNewRecord ? 'Insert' : 'Insert',array(
                            'name' => 'add',
                            'id'=>"btnInsert_$i",
                            'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                            'size'=>TbHtml::BUTTON_SIZE_SMALL,
                            )); ?>
                        
                        <?php if($arrayModels[$i]->DESCRIPTION!=''):?>
                            <?php if($tag=="create"): ?>
                                <?php 
                                    echo TbHtml::submitButton(
                                    'Delete',array(
                                    'id'=>"btnDelete_$i",
                                    'confirm'=>'Are you sure to delete this?',
                                    'submit'=>array('/elementInst/delete?a='.$a.'&id='.$arrayModels[$i]->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice."&form=create"),
                                    'name' => 'del',
                                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    )); ?>
                            <?php elseif($tag=="update"): ?>
                                <?php 
                                    echo TbHtml::submitButton(
                                    'Delete',array(
                                    'confirm'=>'Are you sure to delete this?',
                                    'submit'=>array('/elementInst/delete?id='.$arrayModels[$i]->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice."&form=update"),
                                    'name' => 'del',
                                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    )); ?>
                            <?php endif;?>
                                <?php 
                                /*echo CHtml::ajaxLink('delete',
                                Yii::app()->createUrl('/elementinst/delete?id='.$model->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice),
                                array(
                                    'type'=>'post',
                                    'data' => array('id' =>$model->ID,'type'=>'delete'),
                                    'update'=>'message',
                                    'success' => 'function(response) {
                                    $(".message").html(response);
                                    $(".elementinst_'.$model->ID.'").remove();
                                    }',
                                    ),
                                    array( 'confirm'=>'Are you sure to delete this question',)
                                );*/
                                ?>
                            
                        <?php endif;?>
                        -->
                        </td>
                        <td class="fileFild" colspan="3">
                            <?php echo $form->hiddenField($arrayModels[$i],"[$i]ELEMENT_TYPE",array('id'=>"type_field[$i]",'disabled'=>'disabled','type'=>'hidden'/*,'span'=>5,'maxlength'=>10*/,'onchange'=>"Hab($i)",'style'=>'width:150px;')); ?>
                                <?php $anterior = $name->DESCRIPTION  ?>
                            <?php 
                             /*echo $form->fileFieldControlGroup($arrayModels[$i],"[$i]BEHAVIOR_SCREEN",
                                array('label'=>'',
                                      'id'=>"behavior_scr_field[$i]",
                                      'labelOptions'=>array('style'=>'display:inline'),
                                      'span'=>5,
                                      'maxlength'=>50,
                                      'class'=>"btn btn-default btn-file"
                                      ));*/
                             ?>
                        </td>
                        <td class="tdDelete">
                           <?php if($arrayModels[$i]->DESCRIPTION!=''):?>
                            <?php if($tag=="create"): ?>
                                <?php 
                                    echo TbHtml::submitButton(
                                    '-',array(
                                    'id'=>"btnDelete_$i",
                                    'confirm'=>'Are you sure to delete this?',
                                    'submit'=>array('/elementInst/delete?a='.$a.'&id='.$arrayModels[$i]->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice."&form=create"),
                                    'name' => 'del',
                                    'class'=>'btnDelete',
                                    'title'=>"Delete",
                                    //'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    )); ?>
                            <?php elseif($tag=="update"): ?>
                                <?php 
                                    echo TbHtml::submitButton(
                                    '-',array(
                                    'id'=>"btnDelete_$i",
                                    'confirm'=>'Are you sure to delete this?',
                                    'submit'=>array('/elementInst/delete?id='.$arrayModels[$i]->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice."&form=update"),
                                    'name' => 'del',
                                    'class'=>'btnDelete',
                                    'title'=>"Delete",
                                    //'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                    )); ?>
                            <?php endif;?>
                                <?php 
                                /*echo CHtml::ajaxLink('delete',
                                Yii::app()->createUrl('/elementinst/delete?id='.$model->ID."&idTestContext=".$idTestContext."&idDevice=".$idDevice),
                                array(
                                    'type'=>'post',
                                    'data' => array('id' =>$model->ID,'type'=>'delete'),
                                    'update'=>'message',
                                    'success' => 'function(response) {
                                    $(".message").html(response);
                                    $(".elementinst_'.$model->ID.'").remove();
                                    }',
                                    ),
                                    array( 'confirm'=>'Are you sure to delete this question',)
                                );*/
                                ?>
                            
                        <?php endif;?> 
                        </td>
                    </tr>

                    <?php if(isset($arrayModels[$i+1])): ?>
                        <?php if($arrayModels[$i]->ID_ELEMENT==$arrayModels[$i+1]->ID_ELEMENT): ?>
                            <tr class="trFinal">
                                <td colspan="6">
                                    <hr class="style-fou">
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr class="trFinal">
                                <td colspan="6">
                                    <br>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php if(isset($arrayModels[$i+1])): ?>
                    <?php if($arrayModels[$i]->ID_ELEMENT!=$arrayModels[$i+1]->ID_ELEMENT): ?>  
                        </table>
                        <br>
                    <?php endif; ?>
                <?php else: ?>
                    </table>
                    <br>
                <?php endif; ?>
  
            <?php $j=$j+1;?>
            <script type="text/javascript">
                <?php  echo "var i_ = ". $i . ";\n"; ?>
                desableAll(i_);
            </script>
        <?php endfor; ?>
        
    </div><!--div table-->
    <br/>
    <br/>
    <?php echo TbHtml::submitButton("#" ? 'Save' : 'Save',array(

    'name' => 'buttonSaveOnly',
    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
    'size'=>TbHtml::BUTTON_SIZE_LARGE,
    )); ?>

    <?php echo TbHtml::submitButton('Cancel',array(
        'name' => 'buttonCancel',
        'color'=>TbHtml::BUTTON_COLOR_DANGER,
        'size'=>TbHtml::BUTTON_SIZE_LARGE,
    )); ?>

    <?php echo TbHtml::submitButton('Next',array(
        'name' => 'buttonXML',
        'color'=>TbHtml::BUTTON_COLOR_INFO,
        'size'=>TbHtml::BUTTON_SIZE_LARGE,
        'id'=>'xmlbtn'
    )); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->

