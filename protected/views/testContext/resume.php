<style type="text/css">
.bt-generate{
    float: right;
    padding: 10px;
}

.all{
    *margin-top: 40px;
}

.table_body{
    width: 100%;
    table-layout: fixed;
    text-align: center;
}

.table_head{
    font-size: 15px;
    font-weight: bold;
}

.element_name{
    font-weight: bold;
}

td{
    height: 20px;
    *border-style: solid;
}

.body_lines{
    background-color: white;
    font-weight: bold;
}


.no_vars{
    color: red;
}




    
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

    .line_number{
        width: 10%;
    }
    #b1{
        float: left;
    }

    </style>

<link rel="stylesheet" type="text/css"
    href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />


<div class="infoblock shadow"><h1 style="color:#20B2AA;">Test Context - Resume</h1></div>
<HR WIDTH=1180 ALIGN=LEFT >

 
<div class="mtc_geral">
    <div class="TbBreadcrumb">
    <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Test Context'=>array('admin'),
    'Resume Test Context',
    ),
    )); ?>
    </div>
    <div class="label_mtc">
    <p class="label_txt">MTContext</p>
    </div>
</div>





<?php $textBtn="Generate Test Sequences"; ?>
<?php if($notEdit=="true"){
    $textBtn = "Dashboard";

} ?>
<br>
<div class="well-button" align="right">
    <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('onclick' => 'js:document.location.href="/mtcontrool/index.php/testContext/admin"',
        'id'=>'b1',
        'title'=>'Back',
        'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
        'size'=>TbHtml::BUTTON_SIZE_SMALL,
        'style'=>'color: green;',)  );
    ?>
    <?php if($notEdit!="true"):?>
        <?php echo TbHtml::Button(
            '<i class="fa fa-pencil-square-o"></i> Edit',array(
            //'confirm'=>'You asked the generation of XML. To save, use the options of your web-browser. To return to the system, use the back of your Web-browser button.',
            'submit'=>array('/testContext/update/'.$idTestContext),
            'name' => 'update',
            'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
        )); ?>
    <?php endif; ?>
    
    <?php echo TbHtml::Button(
        $textBtn.' <i class="fa fa-play"></i>',array(
        //'confirm'=>'You asked the generation of XML. To save, use the options of your web-browser. To return to the system, use the back of your Web-browser button.',
        'submit'=>array('/testContext/mef?idTestContext='.$idTestContext),
        'name' => 'del',
        'color'=>TbHtml::BUTTON_COLOR_INFO,
		'size'=>TbHtml::BUTTON_SIZE_SMALL,
    )); ?>
</div>


<div class="all">

    <div class="round">
        <b>Round of Testing</b>
        <?php 
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'users-grid',

            'dataProvider'=>$dataProvider,
            'summaryText' => '',
            'columns'=>array(

                //'ID',
                'DESCRIPTION',
               
                array(
                    'header'=>'App',
                    'filter'=>CHtml::listData(App::model()->findAll(),'name', 'name'),
                    'name'=>'ID_APP',
                    'value'=>'$data->iDAPP->name'
                ),
                array(
                    'header'=>'Platform',
                    'filter'=>CHtml::listData(Platforms::model()->findAll(),'name', 'name'),
                    'name'=>'ID_PLATFORM',
                    'value'=>'$data->iDPLATFORM->name'
                ),

                array(
                    'header'=>'Device',
                    'filter'=>CHtml::listData(Device::model()->findAll(),'DESCRIPTION', 'DESCRIPTION'),
                    'name'=>'ID_DEVICE',
                    'value'=>'$data->iDDEVICE->DESCRIPTION'
                ),

                array(
                    'header'=>'User',
                    'name'=>'ID_USER',
                    'value'=>'$data->iDUSER->name'
                ),
                /*array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}',
                    ),*/
                
             ),
        ));
         ?>
    </div>
    
    <!--div class="variations">
        <b>Variations in the round</b-->
        <!--?php 

        $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'users-grid',

            'dataProvider'=>$dataProviderInst,
            //'enablePagination' => false,
            'summaryText' => '',
            'columns'=>array(
                array(
                    'header'=>'Element',
                    'value'=>'$data->iDELEMENT->DESCRIPTION'
                ),
                'DESCRIPTION',
                //'BEHAVIOR',
                'ELEMENT_TYPE',
                'START_PARAM',
                'END_PARAM',
                /*array(
                    'name'=>'BEHAVIOR_SCREEN',
                    'type'=>'raw',
                    'value'=> 'CHtml::linkButton($data->BEHAVIOR_SCREEN, array(
                        "href"=>"/mtcontrool/upload_testcontext/".$data->BEHAVIOR_SCREEN,
                        "target"=>"_blank",
                        //"submit"=>array("arquivo/mostrarArquivo&url=".$data->BEHAVIOR_SCREEN, $_GET),
                    ))',
                ),*/
               
                
                
             ),
        ));

        ?-->
    <!--/div-->

    <div class="variations">
        <b>Variations in the Round of Testing</b>
        <br/>
        <br/>
        <?php $anterior=""; ?>
        <?php $inicio="sim"; ?>
        <?php $count_var=1; ?>
        <?php if(sizeof($arrayModels)>0): ?>
            <div class="table_vars">
                <?php foreach ($arrayModels as $model): ?>
                    <table class="table_body">
                    <?php  if($model->iDELEMENT->DESCRIPTION!=$anterior):?>
                        <?php if($inicio!="sim"): ?>
                            <br/>
                        <?php endif; ?>
                        <?php $inicio="nao"; ?>
                            <p class="element_name">
                                <?php echo $model->iDELEMENT->DESCRIPTION; ?> (<?php echo $model->ELEMENT_TYPE; ?>)
                                <?php $count_var=1; ?>
                            </p>
                         <?php $anterior = $model->iDELEMENT->DESCRIPTION?>
                         <thead class="table_head">
                            <tr>
                                <td class="line_number">Nº</td>
                                <td>Variation</td>
                                <!--td>Type</td-->
                                <?php if($model->ELEMENT_TYPE=="interval"): ?>
                                    <td>Start</td>
                                    <td>End</td>
                                <?php endif; ?>
                            </tr>
                        </thead>
                    <?php endif; ?> 
                        <tbody class="body_lines">
                            <tr>
                                <td class="line_number"><?php echo $count_var; ?></td>
                                <td><?php echo $model->DESCRIPTION ?></td>
                                <!--td><?php echo $model->ELEMENT_TYPE ?></td-->
                                <?php if($model->ELEMENT_TYPE=="interval"): ?>
                                    <td><?php echo $model->START_PARAM ?></td>
                                    <td><?php echo $model->END_PARAM ?></td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                    <?php $count_var++; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no_vars"><b>There are no variations registered for this round.</b></p>
        <?php endif; ?>
        
    </div>
</div>
<br><br><br><br><br><br>




