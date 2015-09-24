<?php
/* @var $this RunsController */
/* @var $model Runs */
?>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/users.css" />
  <div class="jumbotron">      
<?php
$this->breadcrumbs = array (
		'Runs' => array (
				'index' 
		),
		$model->id 
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
						'id' => $model->id 
				) 
		),
		array (
				'label' => 'Delete Runs',
				'url' => '#',
				'linkOptions' => array (
						'submit' => array (
								'delete',
								'id' => $model->id 
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
        Dashboard - <?php echo $nomeApp; ?></h1>
</div>
<br/>

<?php 

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
       'Dashboard'=>array(),
	
        
        $nomeApp,
        '/ Runs ',
        $model->id_order ,
    ),
)); ?>

<br/>

</br>

<div class="container">
    <div class="tabela">
        <div class="well-button">

              <?php echo TbHtml::Button('<i class="fa fa-arrow-left"></i> Back', array('submit' => CHttpRequest::getUrlReferrer(),
                      'id'=>'b1',
                      'title'=>'Back',
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                   
                  //  'htmlButton'=>'style'=>'color: red',
                     'style'=>'color: green;',
                  
                
              )  ); ?>
          
        </div>
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span6">
                                    <div class="row-fluid">
                                        
                                    <div class="span3">
                                        <div class="tabela-dash-prim">
                                            <div class="panel panel-primary">
                                               <div class="panel-heading" text-size="20"><i class="fa fa-play-circle-o fa-lg"></i> Completed Tests</div>
                                                    <div class="panel-body" >
                                                        
                                                       
                                                       
                                                        <div class="text-right">
									
										<h1><?php echo floor((($quantidadePass + $quantidadeFail)/($quantidadeTotal == 0 ? 1 : $quantidadeTotal))*100)?>%</h1>
									
										<p><?php echo ($quantidadePass + $quantidadeFail)?>/<?php echo $quantidadeTotal?> completed tests</p>
									
                                                        </div>
							
                                                    </div></div></div></div>
                                                    <div class="span3">
                                    <div class="tabela-dash-danger">
					 <div class="panel panel-danger">
                                               <div class="panel-heading"><i class="fa fa-thumbs-down fa-lg"></i>  Tests Failed</div>
                                                    <div class="panel-body" >
								
								<div class="col-md-1 text-right">
									<div>
										<h1><?php echo ($quantidadeFail)?> Failed</h1>
									</div>
									<div>
										<p><?php echo $quantidadePass?> passed | <?php echo $quantidadePending?> pending</p>
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
                                                    </div></div>
                                 </div></div>
                                                <div class="span3">
                                                    <div class="tabela-dash-warning">
						<div class="panel panel-warning">
                                               <div class="panel-heading"><i class="fa fa-mobile fa-lg"></i>  App Version</div>
                                                    <div class="panel-body" >
							
								
								<div class="col-md-1 text-right">
									<div>
										<h1><?php echo $model->version?></h1>
									</div>
									<div>
										<p><?php echo $model->changelog?></p>
									</div>
								</div>
							
						</div>
					</div>
                                                    </div></div></div>
                                    </div></div>
                                
                                </div></div></div></div></div>
<br />



<div class="panel-dashboard">
<div class="accordion" id="accordion2" >
   <?php 
   $acc_id = 0;
   foreach($dadosLista as $dL){
       $acc_id ++;
    ?>
    <div class="accordion-group">
     
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" style="color: #808080; font-weight: bold; " href="#collapse<?= $acc_id ?>">
          
        <?php echo $dL['CRITERIA'];?>
           
          <span class="pull-right" style="color: #BCD2EE;"><i class="fa fa-chevron-down"></i></span>
      </a>
    </div>
    <div id="collapse<?= $acc_id ?>" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table table-striped">
		<thead>
			<tr>
				
				<td><b><?php echo 'Code'; ?></b></td>
				<td><b><?php echo 'Test Case'; ?></b></td>
				<td><b><?php echo 'Status'; ?></b></td>
				<td><b><?php echo 'Operations'; ?></b></td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($dados as $dp){
                    
                    if($dp['NomeCriterio'] == $dL['CRITERIA']){
                    ?>
                   
		<tr>
                    
				
				<td><?php echo $dp['NumeroTeste'];?></td>
				<td><?php echo $dp['NomeTeste']?></td>
				<td><?php if($dp['Status'] == 0){echo TbHtml::labelTb('Pending', array('color' => TbHtml::LABEL_COLOR_WARNING));} else if($dp['Status'] == 1){echo TbHtml::labelTb('Passed', array('color' => TbHtml::LABEL_COLOR_SUCCESS));} else echo TbHtml::labelTb('Failed', array('color' => TbHtml::LABEL_COLOR_IMPORTANT));?></td>

				<td><a href="#modalOcorrencia<?php echo $dp['IDTestRun']?>"
					role="button" class="btn" data-toggle="modal"><i
						class="fa fa-eye"></i></a></td>
			</tr>

			<!-- Informa��es detalhadas das ocorr�ncias -->
			<div id="modalOcorrencia<?php echo $dp['IDTestRun']?>"
				class="modal hide fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-header">
					<h3 id="myModalLabel"><?php CHtml::encode("Test Description")?></h3>
				</div>

				<div class="modal-body">
					<div class="form-horizontal">
						<fieldset>
							<legend>Criteria</legend>
							<p>
								<strong>Name: </strong><?php echo $dp['NomeCriterio'];?></p>
						</fieldset>

						<fieldset>
							<legend>Test Information</legend>
							<p>
								<strong>Code: </strong><?php echo $dp['NumeroTeste'];?></p>
							<p>
								<strong>Name: </strong><?php echo $dp['NomeTeste'];?></p>
							<p>
								<strong>Description: </strong><?php echo $dp['Descricao'];?></p>
						</fieldset>

						<fieldset>
							<legend>Proceedings</legend>
							<p>
								<strong>Notes: </strong><?php echo $dp['Notas'];?></p>
							<p>
								<strong>Steps: </strong><?php echo $dp['Passos'];?></p>
							<p>
								<strong>Result: </strong><?php echo $dp['Resultado'];?></p>
						</fieldset>
					</div>
				</div>

				<div class="modal-footer">
					<?php echo TbHtml::link('Pass', array('runs/passTestRun', 'id'=> $dp['IDTestRun']), array('class'=>'btn btn-success'));?>
					<?php echo TbHtml::link('Fail', array('runs/failTestRun', 'id'=> $dp['IDTestRun']),array('class'=>'btn btn-danger')); ?>
					<?php echo TbHtml::button('Close', array('data-dismiss' => 'modal')); ?>
				</div>
			</div>
<!--</div>-->
                <?php } }?>
		</tbody>
	</table>
      </div>
    </div>
  </div>
 <?php } ?>
</div>
</div>

<br/>
</div>