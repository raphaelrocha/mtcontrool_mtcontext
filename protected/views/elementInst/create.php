

<?php
/* @var $this ElementInstController */
/* @var $model ElementInst */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Test Context - New Instances</h1></div>
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
	'Create Instances',
    ),
)); ?>
    </div>
    <div class="label_mtc">
    <p class="label_txt">MTContext</p>
    </div>
</div>


<?php $this->renderPartial('_form_final', array(
						   'arrayModels'=>$arrayModels,
						   'tag'=>'create',
						   'idTestContext'=>$idTestContext,
						   'idDevice'=>$idDevice,
						   'a'=>$a
						   )); ?>