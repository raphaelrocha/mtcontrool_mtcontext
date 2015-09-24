
<?php
/* @var $this TestContextSeqController */
/* @var $model TestContextSeq */
/* @var $form TbActiveForm */
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<style type="text/css">
@import url(//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css);
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

.imagePreview {
    width: 320px;
    height: 180px;
    background: url("/mtcontrool/images/screenshot1.png") no-repeat center;
    *background-position: no-repeat;
    *background-size: cover;
    background-size: contain;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}

.btns{
    float: right;
}

/*body { margin: 30px; } 
h1 { font-size: 1.5em; }
label { font-size: 24px; }*/
container { 
  width: 175px; 
  margin-left: 20px;
  padding: 100px;
  *border-style: solid;
}

input[type=radio].with-font,
input[type=checkbox].with-font {
    border: 0;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}
    
input[type=radio].with-font ~ label:before,
input[type=checkbox].with-font ~ label:before {
    font-family: FontAwesome;
    display: inline-block;
    content: "\f1db";
    letter-spacing: 10px;
    font-size: 1em;
    color: #535353;
    width: 1em;
}

input[type=radio].with-font:checked ~ label:before,
input[type=checkbox].with-font:checked ~ label:before  {
    content: "\f00c";
    font-size: 1em;
    color: darkgreen;
    letter-spacing: 5px;
}
input[type=checkbox].with-font ~ label:before {        
    content: "\f096";
}
input[type=checkbox].with-font:checked ~ label:before {
    content: "\f046";        
    color: darkgreen;
}
input[type=radio].with-font:focus ~ label:before,
input[type=checkbox].with-font:focus ~ label:before,
input[type=radio].with-font:focus ~ label,
input[type=checkbox].with-font:focus ~ label
{                
    color: green;
}


.head{
    width: 20%;
}

div{
    *border-style: solid;
    *border-color: #ff0000 #0000ff;
}

.select_all{
    *border-style: solid;
    margin-bottom: 20px;
}
.all_acc{
    *border-style: solid;
    background-color: white;
    padding: 15px;
    border-radius: 8px;
}

.accordion-group{
    margin-top: -10px;
}

.variation_field{
    font-weight: bold;
}

</style>



<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'test-context-seq-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="well-button" align="right">
    <?php echo TbHtml::submitButton("#" ? '<i class="fa fa-times fa-lg"></i> Cancel' : '<i class="fa fa-times fa-lg"></i> Cancel',array(
        'name'=>'buttonCancel',
        'color'=>TbHtml::BUTTON_COLOR_DANGER,
        'size'=>TbHtml::BUTTON_SIZE_SMALL,
    '')); ?>
        <?php echo TbHtml::submitButton("#" ? 'Save <i class="fa fa-floppy-o"></i>' : 'Save <i class="fa fa-floppy-o"></i>',array(
        'color'=>TbHtml::BUTTON_COLOR_INFO,
        'size'=>TbHtml::BUTTON_SIZE_SMALL,
    '')); ?>
</div>
<input type="hidden" value="TestContextSeq", name="TestContextSeq">    
<?php $acc_id=0; ?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
    <div class="all_acc">
        <!--input type="checkbox" id="ui-accordian-accordian-header-0"/> <font size="4">ALL</font> </input-->

        <div class=".container">
            <div class="select_all">
                <input id="ui-accordian-accordian-header-0" type="checkbox" class="with-font" />
                <label for="ui-accordian-accordian-header-0">Select All
                </label>
            <!--/div-->
            </div>
        </div>
    
    <?php $cont=0; ?>
    <?php foreach ($models as $model): ?> 
        <?php echo $form->errorSummary($model); ?>
        <!--/////////////////////////////////////////////////-->
        <!--div class="panel-dashboard"-->
            <div class="accordion" id="accordion2" >
                <div class="accordion-group">
                    <div class="accordion-heading">
                      <div class="table-down">
                            <a title="Click to add more informations." class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" style="color: #808080; font-weight: bold; " href="#collapse<?= $acc_id ?>">
                                
                                <!--input type="checkbox" id="chk<?= $acc_id ?>" class="cchk" name="chk<?= $acc_id ?>" /-->
                                <span class="pull-right" style="color: #BCD2EE;">
                                                                            <i class="fa fa-chevron-down"></i>
                                </span>
                                <div class="head">
                                    <input id="chk<?= $acc_id ?>" type="checkbox" class="with-font" name="chk<?= $acc_id ?>" />
                                    <label for="chk<?= $acc_id ?>" class="with-font">
                                        Sequence <?php echo $model->SEQUENCE_ORDER;  ?>
                                    </label>
                                </div>
                               
                              </a>

                              <!--div><span class="pull-right" style="color: #BCD2EE;">
                                                                            <i class="fa fa-chevron-down"></i>
                                                                    </span>
                              </div-->  
                        </div>
                    </div>
                </div>
                <div id="collapse<?= $acc_id ?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <td><b>VARIATION</b></td>
                                        <td><b>BEHAVIOR</b></td>
                                        <td><b>SCREENSHOT</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $form->textArea($model,'VARIATION',array('class'=>'variation_field','readonly'=>'readonly',/*,'disabled'=>'disabled'*/'name'=>'variation'.$acc_id,'span'=>5,'maxlength'=>10000, 'rows' => 10)); ?></td>
                                        <td><?php echo $form->textArea($model,'BEHAVIOR',array('name'=>'behavior'.$acc_id,'span'=>5,'maxlength'=>10000, 'rows' => 10)); ?></td>
                                        <td><?php //echo $form->fileField($model,"[1]BEHAVIOR_SCREEN","");?>
                                        <!--span class="btn btn-default btn-file">
                                                Browse <input type="file">
                                        </span-->
                                        <div id="imagePreview<?= $acc_id ?>" class="imagePreview"></div>
                                        
                                        <!--input id="uploadFile<?= $acc_id ?>" type="file" name="image" class="img" onClick="getVar(<?= $acc_id ?>)"/-->
                                        <?php 
                                             echo $form->fileField($model,"BEHAVIOR_SCREEN",
                                                array('label'=>'',
                                                      'id'=>"uploadFile".$acc_id,
                                                      'name'=>"uploadFile".$acc_id,
                                                      'span'=>5,
                                                      'maxlength'=>50,
                                                      'onClick'=>"getVar(".$acc_id.")",
                                                      'class'=>"img"
                                                      ));
                                             ?>
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!--accordion-inner-->
                </div><!--accordion-body collaps-->
            </div>
        <!--/div--><!--panel-dashboard-->
        <!--/////////////////////////////////////////////////-->
        <?php $cont++; ?>
        <?php $acc_id++; ?>

    <?php endforeach; ?>
    <input type="hidden" value="<?= $acc_id ?>", name="total_forms">

    </div>
   <?php $this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
  
    $("#accordion li div").click(function(){
    $(this).next().slideToggle(300);
    });
    //$(".cchk").click(function(event){
    $(".with-font").click(function(event){
        event.stopPropagation();
    });
    $('#accordion ul:eq(0)').show();

    $("#ui-accordian-accordian-header-0").change(function() {
    var id = $(this).attr("id");
    //var items = $(".cchk");
    var items = $(".with-font");
    

    this.checked ? items.prop("checked", true) : items.prop("checked", false);
    });

    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    });

    var idChange
    function getVar(id){
        idChange = id;
    }

    $(function() {

        $('.img').on("change", function()
        {
            //alert("#imagePreview"+idChange);
            var imagePreview = "#imagePreview"+idChange;
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
     
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
     
                reader.onloadend = function(){ // set image data as background of div
                    $(imagePreview).css("background-image", "url("+this.result+")");
                }
            }
        });
    });

</script>