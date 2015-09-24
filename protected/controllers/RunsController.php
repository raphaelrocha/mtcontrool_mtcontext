<?php
class RunsController extends Controller {

	/**
	 * using two-column layout.
	 * See 'protected/views/layouts/column2.php'.
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 */
	 public $layout = '//layouts/main';

	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array (
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete'
		); // we only allow deletion via POST request

	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules() {
		return array (
                array (
                                'allow', // allow all users to perform 'index' and 'view' actions
                                'actions' => array ('index','view','passTestRun','failTestRun','quest',
                                                'saveAndroidQuest','saveIOSQuest','saveWPQuest','rodada','ListPlatforms','ListarPlataforma','Teste',
                                              'delete', 'adminRuns'
                                ),
                                'users' => array (
                                                '*'
                                )
                ),
                array (
                                'allow', // allow authenticated user to perform 'create' and 'update' actions
                                'actions' => array ('create','update'),
),
                   array('allow', // allow admin user to perform 'admin' and 'delete' actions
    'actions'=>array(),
    'users'=>array('@'),
                        ),
                array (
                                'allow', // allow admin user to perform 'admin' and 'delete' actions
                                'actions' => array ('admin'),
                                'expression'=>'$user->isAdmin()',


                ),
                array (
                                'deny', // deny all users
                                'users' => array (
                                                '*'
                                )
                        )
        );
}

	/**
	 * Displays a particular model.
	 *
	 * @param integer $id
	 *        	the ID of the model to be displayed
	 */



	public function actionView($id) {
		$model = $this->loadModel ( $id );

		$sql = "SELECT tr.id as IDTestRun, c.name as NomeCriterio, tc.num as NumeroTeste, tc.name as NomeTeste, tc.description as Descricao, tc.notes as Notas, tc.steps as Passos, tc.result as Resultado, tr.status as Status
    			FROM criteria as c, test_case as tc, test_run as tr
    			WHERE tr.id_test_case = tc.id AND tr.id_runs = '$id' AND c.id = tc.id_criteria";

		$rawData = Yii::app ()->db->createCommand ( $sql )->queryAll ();
                
                $listaCriterio = "SELECT DISTINCT(c.name) as CRITERIA FROM criteria as c, test_case as tc, test_run as tr
    			WHERE tr.id_test_case = tc.id AND tr.id_runs = '$id' AND c.id = tc.id_criteria";
                $dadosLista = Yii::app ()->db->createCommand ( $listaCriterio )->queryAll ();
		/*
		 * $dataProvider=new CArrayDataProvider($rawData, array(
		 * //'id'=>'user',
		 * 'sort'=>array(
		 * 'attributes'=>array(
		 * 'IDTestRun','NomeCriterio', 'NumeroTeste', 'NomeTeste', 'Descricao', 'Notas', 'Passos', 'Resultado', 'Status'
		 * ),quantidade
		 * ),
		 * ));
		 */

            //   $selectImage= "SELECT image FROM platforms WHERE id = '$id'";
              //  $Image = Yii::app ()->db->createCommand ( $selectImage )->queryAll ();
             
                
		$nomeApp = App::model ()->findByPk ( $model->id_app );
		$nomePlataforma = Platforms::model ()->findByPk ( $model->id_platform );
		$quantidadePass = count ( TestRun::model ()->findAllByAttributes ( array (
				'status' => 1,
				'id_runs' => $id
		) ) );

		$quantidadeFail = count ( TestRun::model ()->findAllByAttributes ( array (
				'status' => 2,
				'id_runs' => $id
		) ) );

		$quantidadePending = count ( TestRun::model ()->findAllByAttributes ( array (
				'status' => 0,
				'id_runs' => $id
		) ) );

		// recupera os testes de determinada rodada1
		$testRuns = TestRun::model ()->findAllByAttributes ( array (
				'id_runs' => $id
		) );

		$quantidadeTotal = count ( $testRuns );

		$this->render ( 'view', array (
				'model' => $model,
				'testRuns' => $testRuns,
				'nomeApp' => $nomeApp->name,
				'nomePlataforma' => $nomePlataforma->name,
				'dados' => $rawData,
				'quantidadePass' => $quantidadePass,
				'quantidadeFail' => $quantidadeFail,
				'quantidadePending' => $quantidadePending,
				'quantidadeTotal' => $quantidadeTotal,
                                'dadosLista'=>$dadosLista,
                                'Image'=> $nomePlataforma->image,
		)
		 );
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
            try{
		$model = new Runs ();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		// @todo refactoring
              //   $LISTP = array();
		if (isset ( $_POST ['Runs'] )) {


			$model->attributes = $_POST ['Runs'];

                        $id_cri = $_POST['Runs']['id_app'];

                        $value = 0;
                     
                      $connection=Yii::app()->db;
                       $sql1 = "SELECT id_order FROM runs WHERE id_app = " . $id_cri . " ORDER BY id DESC LIMIT 1";

                     //  $tenta = Yii::app ()->db->createCommand ( $sql )->queryAll ();
                        $command=$connection->createCommand($sql1);
                       $tenta=$command->query();
                       // $resultado = (integer)$tenta;

                       foreach($tenta AS $result){
                        $value = $result['id_order'];

                     }

                        $model->setAttribute('id_order',($value + 1));


                        $model->setAttribute('id_users', Yii::app()->user->id);

			if ($model->save ()) {
				// $this->redirect(array('view', 'id' => $model->id));
				$this->redirect ( array (
						'characteristic/lista',
						'id' => $model->id,
                                                'idPlat'=> $model->id_platform,
				) );
			}
		}
                 }catch (Exception $e){
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    '<strong>Ops!</strong> ERROR!');
                         
			Yii::app()->controller->refresh();
                    }

		$this->render ( 'create', array (
				'model' => $model,
                            //   'LISTP' => $LISTP,
		) );
                }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */

	public function actionUpdate($id) {
            try{
		$model = $this->loadModel ( $id );

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset ( $_POST ['Runs'] )) {
			$model->attributes = $_POST ['Runs'];
			if ($model->save ()) {
				Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,
    '<strong>Well!</strong> Updated with sucess!');
                   Yii::app()->controller->refresh();
			}
            }}catch (Exception $e){
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    '<strong>Ops!</strong> ERROR!');
                         
			Yii::app()->controller->refresh();
                    }
		

		$this->render ( 'update', array (
				'model' => $model
		) );
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be deleted
	 */
	public function actionDelete($id) {
           
		if (Yii::app ()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel ( $id )->delete ();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (! isset ( $_GET ['ajax'] )) {
				$this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array (
						'admin'
				) );
			}
		} 
	}

	/**
	 * Lists all models.
	 */


	public function actionIndex() {

            $model = new Runs ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Runs'] )) {
			$model->attributes = $_GET ['Runs'];
		}

                $criteria = new CDbCriteria();
                $userId = Yii::app()->user->id;



                if(isset($_GET['q']))
                    {

                    $q = $_GET['q'];

                    $modelApp = App::model()->findByAttributes(array('name'=>$q));

                    if($modelApp){
                        $id = $modelApp->id;
                    }

                    $criteria->compare('id_app', $id, true, 'OR');



                  //  $criteria->compare('id_order', $q, true, 'OR');
                    }


                $connection=Yii::app()->db;
                $MY = "SELECT id_app FROM app_users WHERE id_users =".$userId;
                $commando=$connection->createCommand($MY);
                $tentativa=$commando->query();



                foreach ($tentativa as $vamo){
                    $value = $vamo['id_app'];
                    $criteria->compare('id_app', $value, true, 'OR');

                   // $criteria->addCondition(array("condtion"=>"id_app = $value"));

                }

               // $criteria->condition = "$value = runs.id_app";

               // $criteria->compare('id_app', $value, true, 'OR');
                $criteria->addCondition(array("condtion"=>"id_users = $userId"));

                $dataProvider = new CActiveDataProvider ( 'Runs',array(
                'criteria' => $criteria,

                'sort'=>array(
                    'attributes'=>array(
                          'id_app',

                    ),
                'defaultOrder' => 'id_app',
                ),

                'pagination' => array(
                'pagesize' => 30,
                ),

                ) );


		$this->render ( 'index', array (
                                 'model' => $model,
				'dataProvider' => $dataProvider,

		)  );




	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Runs ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Runs'] )) {
			$model->attributes = $_GET ['Runs'];
		}

		$this->render ( 'admin', array (
				'model' => $model
		) );
	}

        public function actionRodada($id) {
		//$model = $this->loadModel ( $id );

               // echo $id;
                $model = new Runs ('rod');
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Runs'] )) {
			$model->attributes = $_GET ['Runs'];


		}
                $criteria = new CDbCriteria();
                $dataProvider = new CActiveDataProvider ( 'Runs',array(
                'criteria' => $criteria,

                ) );
                $criteria->addCondition(array("condtion"=>"id_app = $id"));


                
                $nomeApp = App::model ()->findByPk ( $id );
               // $criteria->compare('id_app', $id, true, 'OR');
		$this->render ( 'adminRuns', array (
                    'id'=>$id,
                    'nomeApp' => $nomeApp->name,
				'model' => $model,
                    'dataProvider' => $dataProvider,
		) );
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer $id
	 *        	the ID of the model to be loaded
	 * @return Runs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Runs::model ()->findByPk ( $id );

		if ($model === null) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 *
	 * @param Runs $model
	 *        	the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'runs-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}

	/**
	 * Updata a test run to aprooved.
	 *
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */
	public function actionPassTestRun($id) {
		$model = TestRun::model ()->findByPk ( $id );

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model->setAttribute ( 'status', 1 );

		if ($model->save ()) {
			$this->redirect ( array (
					'view',
					'id' => $model->id_runs
			) );
		}

		$dataProvider = new CActiveDataProvider ( 'Runs' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider
		) );
	}

	/**
	 * Updata a test run to reprooved.
	 *
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */
	public function actionFailTestRun($id) {
		$model = TestRun::model ()->findByPk ( $id );

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model->setAttribute ( 'status', 2 );

		if ($model->save ()) {
			$this->redirect ( array (
					'view',
					'id' => $model->id_runs
			) );
		}

		$dataProvider = new CActiveDataProvider ( 'Runs' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider
		) );
	}
	public function actionQuest($id) {

            // $this->layout = "//layouts/column2";
		$run = Runs::model ()->findByPk ( $id );
		$plataforma = Platforms::model ()->findByPk ( $run ['id_platform'] );

		if ($plataforma->name == "Android") {
			$this->render ( 'quest', array (
					'id' => $id,
					'plataforma' => 'Android'
			) );
		} else if ($plataforma->name == "iOS") {
			$this->render ( 'quest', array (
					'id' => $id,
					'plataforma' => 'iOS'
			) );
		} else if ($plataforma->name == "Windows Phone") {
			$this->render ( 'quest', array (
					'id' => $id,
					'plataforma' => 'Windows Phone'
			) );
		}
	}
        
        public function actionTeste($que, $test, $mara){
           echo 'qqqqqqqqqq <br/>';
           
            echo $mara. '<br/>';
     
           echo $que. '<br/>';
           
           echo $test. '<br/>';
           
           
          
        
        }
        
	public function actionSaveAndroidQuest($id) {
		$run = Runs::model ()->findByPk ( $id );
		$plataforma = Platforms::model ()->findByPk ( $run ['id_platform'] );

		// array com os testes default
		$defaultTestsKeys = array (
				'1.1',
				'1.2',
				'1.3',
				'1.4',
				'2.2',
				'2.3',
				'2.4',
				'5.3',
				'6.1',
				'6.2',
				'6.3',
				'7.1',
				'7.2',
				'7.3',
				'7.4',
				'7.5',
				'7.6',
				'7.7',
				'7.8',
				'7.9',
				'7.15',
				'7.16',
				'8.1',
				'8.3',
				'8.4',
				'9.1',
				'9.2',
				'9.3',
				'12.1',
				'12.2',
				'15.1',
				'15.2',
                                '21.1',
                                '21.2',
                                '21.3',
                                '21.4',
                                '21.5',
                                '21.6',
                                '21.7',
                                '21.8',
                                '22.1',
                                '22.2',
                                '22.3',
                                '22.4',
                                '22.5',
                                '22.6',
                                '22.7',
                                '23.1',
                                '23.2',
                                '23.3',
                                '23.4',
                                '23.5',
                                '23.6',
                                '23.7',
                                '24.1',
                                '24.2',
                                '24.3',
                                '24.4',
                                '24.5',
                                '24.6',
                                '24.8',
                                '24.9',
                                '24.10',
                                '24.12',
                                '25.1',
                                '25.2',
                                '25.3',
                                '25.4',
                                '25.5',
                                '25.6',
                                '25.7',
                                '26.1',
                                '26.2',
                                '26.3',
                                '26.4',
                                '26.5',
                                '26.6',
                                '26.9'
                                
		);

		// consertar essa gambiarra URGENTE
		foreach ( $defaultTestsKeys as $key ) {
			$testRuns = TestCase::model ()->findBySql ( "SELECT id FROM `test_case`AS tc, `test_platform` AS tp WHERE tc.num = '" . $key . "' AND tp.id_platform = " . $plataforma->id . " AND tp.id_test_case = tc.id" );
			// var_dump($testRuns);
			if ($testRuns ["id"] != "") {
				$id_testcase = $testRuns ["id"];
				// echo $testRuns["id"]."<br/>";
				$id_runs = $id;
				$connection = Yii::app ()->db;
				$command = $connection->createCommand ( "INSERT INTO `test_run`(`id_runs`, `id_test_case`, `status`) VALUES (" . $id_runs . "," . $testRuns ["id"] . ",0)" );
				$rowCount = $command->execute ();
			}
		}

		$this->redirect ( array (
				'view',
				'id' => $id
		) );
	}
	public function actionSaveIOSQuest($id) {
		$run = Runs::model ()->findByPk ( $id );
		$plataforma = Platforms::model ()->findByPk ( $run ['id_platform'] );
		// array com os testes default
		$defaultTestsKeys = array (
				1.1,
				1.2,
				1.4,
				1.5,
				5.3,
				6.3,
				7.1,
				7.2,
				7.3,
				7.4,
				7.5,
				7.6,
				7.7,
				7.8,
				7.9,
				7.15,
				7.16,
				8.1,
				8.3,
				8.4,
				9.1,
				9.2,
				9.3,
				11.2,
				12.1,
				12.2,
				14.1,
				14.2,
				15.1,
				15.2,
				19.1,
				20.1,
				22.1,
				22.2
		);

		// pegar os ID,s selecionados
		// verificar inde tem virgula
		// montar uma lista com todos os compostos
		// replicar esse codigo abaixo

		// consertar essa gambiarra URGENTE
		foreach ( $defaultTestsKeys as $key ) {
			$testRuns = TestCase::model ()->findBySql ( 'SELECT * FROM `test_case` where num = ' . $key );
			if ($testRuns ["id"] != "") {
				$id_testcase = $testRuns ["id"];
				// echo $testRuns["id"]."<br/>";
				$id_runs = $id;
				$connection = Yii::app ()->db;
				$command = $connection->createCommand ( "INSERT INTO `test_run`(`id_runs`, `id_test_case`, `status`) VALUES (" . $id_runs . "," . $testRuns ["id"] . ",0)" );
				$rowCount = $command->execute ();
			}
		}

		$this->redirect ( array (
				'view',
				'id' => $id
		) );
	}
	public function actionSaveWPQuest($id) {
		$run = Runs::model ()->findByPk ( $id );
		$plataforma = Platforms::model ()->findByPk ( $run ['id_platform'] );
		// array com os testes default
		$defaultTestsKeys = array (
				1.1,
				1.2,
				1.3,
				2.1,
				2.2,
				2.3,
				2.4,
				5.1,
				5.2,
				5.3,
				5.4,
				7.3,
				7.4,
				7.5,
				7.6,
				7.7,
				8.1,
				8.2,
				8.3,
				8.4,
				8.5
		);

		// pegar os ID,s selecionados
		// verificar inde tem virgula
		// montar uma lista com todos os compostos
		// replicar esse codigo abaixo

		// consertar essa gambiarra URGENTE
		foreach ( $defaultTestsKeys as $key ) {
			$testRuns = TestCase::model ()->findBySql ( 'SELECT * FROM `test_case` where num = ' . $key );
			if ($testRuns ["id"] != "") {
				$id_testcase = $testRuns ["id"];
				// echo $testRuns["id"]."<br/>";
				$id_runs = $id;
				$connection = Yii::app ()->db;
				$command = $connection->createCommand ( "INSERT INTO `test_run`(`id_runs`, `id_test_case`, `status`) VALUES (" . $id_runs . "," . $testRuns ["id"] . ",0)" );
				$rowCount = $command->execute ();
			}
		}

		$this->redirect ( array (
				'view',
				'id' => $id
		) );
	}


        
        public function actionListPlatforms(){
            
             if(isset($_POST['categoryid']) && $_POST['categoryid']!=''){
		        $categoryid=$_POST['categoryid'];
		        
                       /*   $MY1 = "SELECT DISTINCT p.id, p.name FROM platforms as p LEFT JOIN app_platform
                        ON p.id = app_platform.id_platform
                        WHERE app_platform.id_app = ;".$categoryid;
                        //                $commando1=$connection->createCommand($MY1);
                         //               $tentativa1=$commando1->query();
                        $command = Yii::app()->createCommand($MY1);
                        //  $command->bindValue(':id_cha', $_POST['Runs']['id_app'], PDO::PARAM_INT);
                          $data1 = $command->execute();*/
                          
                        $categoryid = 22;
                          $posts=  Platforms::model()->findAllBySql("SELECT DISTINCT p.id, p.name FROM platforms as p LEFT JOIN app_platform
                        ON p.id = app_platform.id_platform
                        WHERE app_platform.id_app =".$categoryid);
                              
                        
		        $data=CHtml::listData($posts,'id','name');
		        echo CHtml::tag('option',array('value' => ''),
		                           CHtml::encode('Choose a platform'),true);
		 
		        foreach($data as $id => $value)
		        {
		          echo CHtml::tag('option',array('value'=>$id),CHtml::encode($value),true);
		        }                
		   }else{
		   		echo CHtml::tag('option',array('value' => ''),
		                           CHtml::encode('Choose a platform'),true);
		   }
            
            
            }
            
            
            
            public function ListarPlataforma(){
                
                /* $id_ap = 22;
                 
                 $posts=  Platforms::model()->findAllBySql("SELECT DISTINCT p.id, p.name FROM platforms as p LEFT JOIN app_platform
                        ON p.id = app_platform.id_platform
                        WHERE app_platform.id_app =".$id_ap);
                 $data=CHtml::listData($posts,'id','name');
                 
                  echo CHtml::tag('option',array('value' => ''), 'Select', TRUE);
                  
                  foreach($data as $valor => $name){
                    echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($name),true);
                  }*/
                
                  $cat_id = $_POST['Runs']['id_app'];
            $data= AppPlatform::model()->findAll('id_app=:cat_id',
                    array(':cat_id'=> $cat_id));

           
            
            
            
            $data3=CHtml::listData($data3,'id','name');
            foreach($data3 as $value=>$name)  {
                echo CHtml::tag('option',
                   array('value'=>$value),CHtml::encode($name),true);
            }
            }
            
           
            //$id_cri = $_POST['TestCase']['id_criteria'];
        /*    $id_cha = (int)$_POST['Runs[id_app]'];
            
                //$connection=Yii::app()->db;
                $MY1 = "SELECT DISTINCT p.id, p.name FROM platforms as p LEFT JOIN app_platform
                        ON p.id = app_platform.id_platform
                        WHERE app_platform.id_app = ;".$id_cha;
//                $commando1=$connection->createCommand($MY1);
 //               $tentativa1=$commando1->query();
$command = Yii::app()->createCommand($MY1);
//  $command->bindValue(':id_cha', $_POST['Runs']['id_app'], PDO::PARAM_INT);
  $data = $command->execute();
              
                
                $data=CHtml::listData($data,'id','name');
                
                echo CHtml::tag('option',array('value' => ''), 'Selectqqqq', TRUE);
                foreach($data as $valor => $name){
                echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($name),true);
            }*/
                
        
               /* echo "<option value=''>Select a Sector</option>";
                foreach($data as $value=>$name){
                echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);*/
                
                
            /*    
                 $cat_id = $_POST['Runs']['id_app'];
            $data= AppPlatform::model()->findAll('id_app=:cat_id',
                    array(':cat_id'=> $cat_id));

            foreach($data as $d){
                $data2 = Platforms::model()->findAll('id_platform=:q',array(':q'=>$data['id_platform']));
            }
            
            
            $data3=CHtml::listData($data3,'id','name');
            foreach($data3 as $value=>$name)  {
                echo CHtml::tag('option',
                   array('value'=>$value),CHtml::encode($name),true);
            }*/
                
                
            
                
                
                /*foreach ($tentativa as $vamo){
                    $value[] = $vamo['name'];
                }*/
                
               // $data3 = CHtml::listData($tentativa1, 'id', 'name');
                
                
                // echo CHtml::tag('option',array('value' => ''), 'Select', TRUE);
            
          /*  foreach($tentativa1 as $valor => $name){
                echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($name),true);
            }*/
            
           
                
            //   return ($data3);
           
        
        
        
  
        

                }
