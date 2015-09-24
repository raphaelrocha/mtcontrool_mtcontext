<?php

class AppUsersController extends Controller
{
    
    public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('share','index','usersAutocomplete'),
				'users'=>array('@'),
			),
			
		);
	}
    
	public function actionIndex($id_ap)
	{
           
		$model = new AppUsers();
            
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
               // echo "fora post";
              //  var_dump($_POST);
		if (isset($_POST['AppUsers'])) {
                   echo "post";
			$model->attributes=$_POST['AppUsers'];
                        $nome =  $_POST['AppUsers']['id_users'];
                        
                        $model->setAttribute('id_users',$nome);
                      $model->setAttribute('id_app',$id_ap); 
                        
              
		
			if ($model->save()) {
                            
                          Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,
    '<strong>Fine!</strong> Sharing saved with sucess!');
                         
			Yii::app()->controller->refresh();	
                           // $this->redirect('/mtcontrool/index/appUsers/index.php');
                                //$this->refresh;
                        }
                } 
            
                      
		

                      $nomeApp = App::model ()->findByPk ($id_ap) ;
		$this->render('index',array(
                        'id_ap' => $id_ap,
			'model'=>$model, //'DadosLista'=>$value,
                        'nomeApp' => $nomeApp->name,
                  //  'emp' => new CActiveDataProvider('appUsers'), // add this line
                        ));
	}
                
        //         $Lista = AppUsers::model()->findBySql("SELECT id_users FROM app_users WHERE id_app =".$id);
                 
                 
                // $Lista = $Lista->id_users;
               //  $Lista = AppUsers::model()->findAll();
                 
      //  $dadosLista = array();
        
                 
      /* foreach($Lista as $lista){
            $dadosLista[$lista->id_users] = $lista->id_users;
        }*/
                
                 
                /*$connection=Yii::app()->db;
                $MY = "SELECT id_users FROM app_users WHERE id_app =".$id;
                $commando=$connection->createCommand($MY);
                $tentativa=$commando->query();*/
                
                /*$connection=Yii::app()->db;
                $MY = "SELECT users.id, users.name FROM users LEFT JOIN app_users ON users.id = app_users.id_users WHERE app_users.id_app = ".$id_ap;
                $commando=$connection->createCommand($MY);
                $tentativa=$commando->query();

                    

                foreach ($tentativa as $vamo){
                    $value[] = $vamo['name'];
                }*/
                
             
         
        
        public function actionUsersAutocomplete() {
        $term = trim($_GET['term']) ;
 
        if($term !='') {
            // Note: Users::usersAutoComplete is the function you created in Step 2
      $users =  Users::usersAutoComplete($term);
            echo CJSON::encode($users);
            Yii::app()->end();
    }
  }
        
     
           
		//if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			//$this->loadModel($id)->delete();
                        //$this->attribute($id_app)->();
			//$this->redirect("/mtcontrool/index.php");
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			/*if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				//$this->redirect("/mtcontrool/index.php/elementinst/update?idTestContext=".$idTextContext."&idDevice=".$idDevice);				
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}*/
	
        //            $sql = 'DELETE FROM app_users WHERE id_app ='.$id .'AND id_users='.$Dados;
          //          $cmd = Yii::app()->db->createCommand($sql);
            //        $cmd->execute();

                   /* $this->render('index',array(
                                            'model'=>$model
                                            )); */
   
         public function actionShare($id){
                    $model = new AppUsers();
                    
                    
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['AppUsers'])) {
			$model->attributes=$_POST['AppUsers'];
			//$model->setAttribute('id_users', Yii::app()->user->id);
                        $model->setAttribute('id_app',$id);
                       
			//salvando a relacao com a tabela Platforms
			
                        
			if ($model->save()) {
				//$this->redirect(array('view','id'=>$model->id));
                                $this->redirect('/mtcontrool');
			}
		}

		
                    
                      
                    $this->render('share',array(
			'model'=>$model
         )); }
        
                     //   $model->attributes=$_POST['AppUsers'];
			
			
			//salvando a relacao com a tabela share
                        //$model->setRelationRecords('appUsers',  is_array($_POST['AppUsers']) ? $_POST['AppUsers'] : array());
                        
                   /* $model->setAttribute('id_users', $id);
                    if (isset($_POST['App'])) {
			$model->attributes=$_POST['App'];
               
                 //$model->setRelationRecords('share',  is_array($_POST['Search']) ? $_POST['Sarch'] : array());
			if ($model->save()) {
				$this->redirect(array('share','id'=>$model->id));
			}
		}
                    */
                  
                    
                public function actionDelete($id)
    {
                    try{
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
 
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        } 
        
        }catch (Exception $e){
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    '<strong>Ops!</strong> ERROR!');
                         
			Yii::app()->controller->refresh();
                    }
    }

	

         
          
        public function actionPegar($id){
           
            //$id_cri = $_POST['TestCase']['id_criteria'];
           // echo $id;
            $id_cri = $_POST['AppUsers']['id_users'];
            
           // $lista = Users::model()->findAll('id_app  = :id_cri',  array(':id_cri'=>$id));
            //$lista = CHtml::listData($lista,'id_users','name');
            //var_dump($lista);
            
           $connection = Yii::app ()->db;
           $command = $connection->createCommand ( 'SELECT name from users WHERE id_app ='.$id );
           $lista = $command->execute ();
            
            echo CHtml::tag('option',array('value' => ''), 'Select', TRUE);
            
            foreach($lista as $valor => $name){
                echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($name),true);
            }
            
            
        }
 public function actionCheckboxUpdate() {
  if(Yii::app()->request->isPostRequest)
  {
    if(isset($_POST['my_checkbox']))
    {

    }
  }
  else
    throw new CHttpException(400,
      Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
}
         

public function actionAdmin() {
		$model = new AppUsers ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['AppUsers'] )) {
			$model->attributes = $_GET ['AppUsers'];
		}

		$this->render ( 'admin', array (
				'model' => $model
		) );
	}
         
             
        public function loadModel($id) {
		$model = AppUsers::model ()->findByPk ( $id );

		if ($model === null) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		return $model;
	}
        
        
        
                }