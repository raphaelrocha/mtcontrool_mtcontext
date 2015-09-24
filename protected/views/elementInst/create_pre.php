

<?php
/* @var $this ElementInstController */
/* @var $model ElementInst */
?>


<?php if(Yii::app()->user->hasFlash('naoSelecionouElemento')): ?>
<div class="flash-error" align="center">
	<?php echo Yii::app()->user->getFlash('naoSelecionouElemento'); ?>
	<script type="text/javascript">
		alert("Selecione ao menos um elemento.");
		console.log("foi");
	</script>
	
	
</div>
<?php endif; ?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Test Context - Choose Elements</h1></div>
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
       'Test Context'=>array('testContext/admin'),
	'Choose Elements',
    ),
)); ?>
    </div>
    <div class="label_mtc">
    <p class="label_txt">MTContext</p>
    </div>
</div>

<?php if(Yii::app()->user->hasFlash('noType')): ?>
	<div class="flash-error" align="center">
	<font color="red"><b><?php echo Yii::app()->user->getFlash('noType'); ?></b></font>
	<script type="text/javascript">
		console.log("not type element selected");
	</script>
</div>
<?php elseif(Yii::app()->user->hasFlash('noSelection')): ?>
	<div class="flash-error" align="center">
	<font color="red"><b><?php echo Yii::app()->user->getFlash('noSelection'); ?></b></font>
	<script type="text/javascript">
		console.log("not element selected");
	</script>
</div>
<?php endif; ?>


<?php $this->renderPartial('_admin_pre_create', array(
						   'listElements'=>$listElements,
						   'models'=>$models,
						   'dataProvider'=>$dataProvider,
						   'arrayExcluded'=>$arrayExcluded,
						   'idTestContext'=>$idTestContext,
						   )); ?>

