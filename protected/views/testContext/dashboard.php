<?php
/* @var $this RunsController */
/* @var $model Runs */
?>



<style type="text/css">

.table_result{
    *width: 60%;
    *border-collapse: collapse;
    width: 100%;
    *display: block;
    margin-left: auto;
    margin-right: auto;
    *text-align: center;

}

.table-header{
    text-align: center;
    font-weight:bold;
    font-size: 150%;

}

#header_field{
    padding: 10px;
}

.imagePreview {
    width: auto;
    height: 300px;
    background: url("/mtcontrool/images/screenshot1.png") no-repeat center;
    *background-position: no-repeat center;
    *background-size: cover;
    background-size: contain;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-left: auto;
   margin-right: auto;
   display: block;
}

#value_field{
    *text-align: center;
    padding: 5px;
}
#bt_print  {
    float: right;
}
td{
  *border-style: solid;
}

.print_scr{
  width: 500px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  *border-style: solid
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

    .tabela{
      border-style: solid;
    }

    .td_line{
      width: 10%;
      vertical-align: top;
    }

    .td_variations{
      width: 40%;
      *border-style: solid; 
      text-align: left;
      vertical-align: top;
    }

    .td_behaviors{
      width: 40%;
      text-align: left;
      vertical-align: top;
    }

    .td_views{
      width: 10%;
    }

    td{
      *border-style: solid; 
      text-align: center;
    }

    .span6{
      padding-left: 9px;
      *border-style: solid;
      width: 100%;
    }


</style>

<link rel="stylesheet" type="text/css"
href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
<div class="jumbotron">      
    <?php
    $this->breadcrumbs = array (
      'Runs' => array (
        'index' 
        ),
      $model->ID 
      );

    $this->menu = array (
      array (
        'label' => 'List Runs',
        'url' => array (
          'index' 
          ) 
        ),
      array (
        'label' => 'Create Runs',
        'url' => array (
          'create' 
          ) 
        ),
      array (
        'label' => 'Update Runs',
        'url' => array (
          'update',
          'id' => $model->ID 
          ) 
        ),
      array (
        'label' => 'Delete Runs',
        'url' => '#',
        'linkOptions' => array (
          'submit' => array (
            'delete',
            'id' => $model->ID 
            ),
          'confirm' => 'Are you sure you want to delete this item?' 
          ) 
        ),
      array (
        'label' => 'Manage Runs',
        'url' => array (
          'admin' 
          ) 
        ) 
      );
      ?>


      <div class="infoblock shadow">
        <h1 style="color: #20B2AA; ">
            <img src="../../images/dash-grande.png" height="70" width="70">
            <?php  echo $nome_teste; ?> - <?php echo $nomeApp; ?></h1>
        </div>
       
        <HR WIDTH=1180 ALIGN=LEFT >

<div class="mtc_geral">
    <div class="TbBreadcrumb">
    <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Test Context'=>array('admin'),
    'Dashboard',
    ),
    )); ?>
    </div>
    <div class="label_mtc">
    <p class="label_txt">MTContext</p>
    </div>
</div>

             <br/>

<!--div class="container"-->
  <!--div class="tabela"-->
      <div class="well-button">

        <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('submit' => CHttpRequest::getUrlReferrer(),
            'id'=>'b1',
            'title'=>'Back',
            'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,

        //  'htmlButton'=>'style'=>'color: red',
            'style'=>'color: green;',


            )  ); ?>
            
            <?php echo CHtml::link('<i class="fa fa-print"></i> Print ',"",
                               array(
                               'submit'=>array('/testContext/printMef'),
                               'params'=>array(
                                'method'=>'postDashboard',
                               'json' => $json,
                               'totalTests' => $totalTests,
                               'totalElements' => $totalElements,
                               'platform'=>$nomePlataforma,
                               'device'=>$device->DESCRIPTION,
                               'user'=>$user,
                               'app'=>$nomeApp),
                               'target'=>'_blank','id'=>'bt_print')); ?>


            
        </div>
        <div class="row-fluid">
            <!--div class="span12"-->
               <div class="row-fluid">
                  <div class="span6">
                      <div class="row-fluid">

                          <div class="span3">
                             <div class="tabela-dash-prim">
                                  <div class="panel panel-primary">
                                   <div class="panel-heading" text-size="20"><i class="fa fa-play-circle-o fa-lg"></i> 
                                      Generated Tests
                                   </div>
                                   <div class="panel-body" >
                                      <div class="text-right">
                                        <!--h1><?php //echo floor((($quantidadePass + $quantidadeFail)/($quantidadeTotal == 0 ? 1 : $quantidadeTotal))*100)?>%-</h1-->
                                      <h1><?php echo $totalTests; ?> <font size="6">Sequence(s)</font></h1>
                                        <!--p>Total Context Generated Tests
                                        </p-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                <div class="span3">
                                  
                                  <div class="tabela-dash-danger">
                                    <div class="panel panel-danger">
                                       <div class="panel-heading"><i class="fa fa-list-alt fa-lg"></i>  Context Awareness Elements</div>
                                       <div class="panel-body" >

                                          <div class="col-md-1 text-right">
                                             <div>
                                                  <H1><?php echo $totalElements; ?> <font size="6">Element(s)</font></H1>
                                                <!--h1><?php //echo ($quantidadeFail)?> Failed</h1-->
                                            </div>
                                            <div>
                                                <!--p>Total Varied Elements</p-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></div></div></div>
                            <div class="span6">
                              <div class="row-fluid">
                                  <div class="span3">
                                      <div class="tabela-dash-sucess">
                                         <div class="panel panel-success">
                                           <div class="panel-heading"><i class="fa fa-cloud fa-lg"></i>   Platform</div>
                                           <div class="panel-body" >
                                              <div class="col-md-1 text-right">
                                                 <div>
                                                  <?php echo CHtml::image(Yii::app()->request->baseUrl."/fotos/".$Image."","kd",array( 'width'=>'55px','height'=>'55px', 'align'=>'left')); ?> 
                                                  <h1><?php echo $nomePlataforma; ?></h1>
                                              </div>
                                              <div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                                 <div class="span3">
                                      <div class="tabela-dash-warning">
                                        <div class="panel panel-warning">
                                           <div class="panel-heading"><i class="fa fa-mobile fa-lg"></i>  Device</div>
                                           <div class="panel-body" >
                                              <div class="col-md-1 text-right">
                                                 <div>
                                                  <?php echo CHtml::image(Yii::app()->request->baseUrl."/images/smart2.png"."","kd",array( 'width'=>'55px','height'=>'55px', 'align'=>'left')); ?> 
                                                    <h1><?php echo $device->DESCRIPTION; ?>
                                                    </h1>
                                                </div>
                                                <div>
                                                    <p><?php //echo $model->changelog?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-
                            </div>
                        </div>   
                      </div>
                  </div>

                  <table class="table_result">
                      <tr class="table-header">
                          <td >
                              <p id="header_field">Sequences</p>
                          </td>
                          <td>
                              <p id="header_field">Variations</p>
                          </td>
                          <td>
                              <p id="header_field">Behaviors</p>
                          </td>
                          <td>
                              <p id="header_field">Views</p>
                          </td>
                      </tr>
                      <?php $line=1; ?>
                      <?php foreach ($dados as $value):  ?>
                          <tr>
                              <td class="td_line">
                                  <p id="value_field"><?php echo $line; ?></p> 
                              </td>
                              <td class="td_variations">
                                  <p id="value_field"><?php echo str_ireplace("\n", "<br>", $value[1]); ?></p> 
                              </td>
                              <td class="td_behaviors">
                                  <p id="value_field"><?php echo $value[2]; ?></p>
                              </td>
                              <td class="td_views">
                                  <!--p id="value_field"><?php echo $value[3]; ?></p-->
                                  <a href="#modalOcorrencia<?php echo $line ?>"
                                  role="button" class="btn" data-toggle="modal"><i
                                    class="fa fa-eye"></i></a>
                              </td>

                          </tr>
                          <tr>
                            <td colspan=4><hr></td>
                            
                          </tr>
                          <div id="modalOcorrencia<?php echo $line ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-header">
                                  <h3 id="myModalLabel">
                                      <?php  echo $nome_teste; ?> - <?php echo $nomeApp; ?>
                                  </h3>
                              </div>
                              <div class="modal-body">
                                  <div class="form-horizontal">
                                      <fieldset>
                                          <legend>
                                              Sequence <?php echo $line ?>
                                          </legend>
                                          
                                      </fieldset>
                                      <fieldset>
                                          <legend>
                                              Test Information
                                          </legend>
                                          <p>
                                              <strong>
                                                  Variation: <br>
                                              </strong>
                                              <?php echo str_ireplace("\n", "<br>", $value[1]); ?>

                                          </p>
                                          
                                          
                                          <p>
                                              <strong>
                                                  Behavior: <br>
                                              </strong>
                                              <?php echo $value[2]; ?>
                                          </p>
                                          
                                          <p>
                                          <strong>
                                              Screenshot: <br>
                                          </strong>
                                          <?php echo CHtml::Link('Download file',Yii::app()->request->baseUrl."/upload_testcontext/".$value[3], array('target'=>'_blank')); ?> 
                                            <!--?php var_dump($value[3]); ?>
                                            <br>
                                            <img src="<?php echo $value[3]; ?>">
                                            <br-->
                                            <br>
                                            
                                            <div class="print_scr">
                                              <?php //$imghtml=CHtml::image(Yii::app()->request->baseUrl."/upload_testcontext/".$value[3],"kd",array('class'=>'imagePreview', 'width'=>'200px','height'=>'200px', 'align'=>'center')); ?>
                                              <?php  //echo CHtml::link($imghtml, array('target'=>'_blank')); ?>
                                              <?php //echo CHtml::image(Yii::app()->request->baseUrl."/upload_testcontext/".$value[3],"kd",array('class'=>'imagePreview', 'width'=>'200px','height'=>'200px', 'align'=>'center')); ?> 
                                              <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/upload_testcontext/".$value[3],"Screenshot",array('class'=>'imagePreview', 'width'=>'200px','height'=>'200px', 'align'=>'center')), Yii::app()->request->baseUrl."/upload_testcontext/".$value[3], array('title'=>'Download file.','target'=>'_blank')); ?>
                                            </div>
                                            <br>
                                            <!--img class="img-responsive" src="/localhost/mtcontrool/upload_testcontext/185d4c9302424484b6ceb3083ebca963.png" alt="image" /-->
                                          </p>
                                      </fieldset>
                                      
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <?php //echo TbHtml::link('Pass', array('runs/passTestRun', 'id'=> $dp['IDTestRun']), array('class'=>'btn btn-success'));?>
                                  <?php //echo TbHtml::link('Fail', array('runs/failTestRun', 'id'=> $dp['IDTestRun']),array('class'=>'btn btn-danger')); ?>
                                  <?php echo TbHtml::button('Close', array('data-dismiss' => 'modal')); ?>
                              </div>
                          </div>
                          <?php $line=$line+1; ?>
                      <?php endforeach; ?>

                      
                  </table>
                  <br/><br /><br /><br /><br />
              <!--</div>-->
          </div>
      </div>
  <!--/div--> <!--fim tabela-->
<!--/div--><!--fim container-->






                                  