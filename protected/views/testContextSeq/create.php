<?php
/* @var $this TestContextSeqController */
/* @var $model TestContextSeq */
?>

<link rel="stylesheet" type="text/css"
    href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />



<div class="infoblock shadow"><h1 style="color:#20B2AA;">Test Context - Select Sequences</div>
<HR WIDTH=1180 ALIGN=LEFT >


<style type="text/css">
    .mtc_geral{
        display: table;
        width: 100%;
        background-color: #00CC99;
        border-radius: 3px;
    }

    .TbBreadcrumb{
        float: left;
        width: 90%;
    }

    .label_mtc{
        float: left;
        width: 10%;
        height: 36px;
        text-align: center;
        bottom: 0;

    }

    .label_txt{
        margin-top: 7px;
        font-weight: bold;
        color: white;
        display: block;
        margin-left: auto;
    }

    div{
        *border-style: solid;
    }

    .tabela{
      border-style: solid;
    }
</style>



<div class="mtc_geral">
    <div class="TbBreadcrumb">
    <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Test Contexts'=>array('testContext/admin'),
	'Select Sequences',
    ),
)); ?>
    </div>
    <div class="label_mtc">
    <p class="label_txt">MTContext</p>
    </div>
</div>

<?php
$this->menu=array(
	array('label'=>'List TestContextSeq', 'url'=>array('index')),
	array('label'=>'Manage TestContextSeq', 'url'=>array('admin')),
);
?>

<?php if(Yii::app()->user->hasFlash('alert-seq')): ?>
	<div class="flash-error" align="center">
	<font color="red"><b><?php echo Yii::app()->user->getFlash('alert-seq'); ?></b></font>
		<script type="text/javascript">
			console.log("Nenhuma sequencia selecionada.");
		</script>
	</div>
<?php endif; ?>

<?php $this->renderPartial('_form', array('models'=>$models,'id_test_context'=>$id_test_context)); ?>