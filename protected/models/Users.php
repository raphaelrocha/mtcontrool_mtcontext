<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $user_name
 * @property string $country
 * @property integer $phone
 * @property string $level
 * @property string $email
 * @property string $password
 * @property string $verification_code
 *
 * The followings are the available model relations:
 * @property App[] $apps
 */


class Users extends CActiveRecord
{
    
    public $old_password;
    public $new_password;
    public $repeat_password;
    public $password2;
  
    
     const TESTER=0, ADMIN=1;
	/**
         *
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
        
        
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, user_name, country,password, email, password2, business, level', 'required'),
		//	array('numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>70),
                        array('name', 'match' ,'pattern'=>'/^([+]?[A-Za-z ]+)$/u',
                        'message'=> 'Nome can contain only letters.'),

			array('user_name', 'length', 'max'=>60),
                        array('user_name', 'match' ,'pattern'=>'/^[A-Za-z0-9_-]+$/u',
                        'message'=> 'Username can contain only alphanumeric characters.'),
                        array('user_name','unique','message'=>"Username already exists!"),
                        

			array('country', 'length', 'max'=>100),
                        array('business', 'length', 'max'=>300),
			array('level', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
                       // array('password', 'required'),
			//array('password', 'length', 'max'=>120),
                        array('email', 'email','message'=>"The email isn't correct"),
                        array('email','unique','message'=>"Email already exists!"),
                       
                                    // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, user_name, country, phone, level, email, password', 'safe', 'on'=>'search'),
                        array('name, country, business, level', 'required', 'on' => 'update'),
                        array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
                        array('old_password', 'findPasswords', 'on' => 'changePwd'),
                        array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd'),
                        array('new_password, repeat_password','length', 'min'=>6, 'max'=>40, 'on'=>'changePwd'),
                   
                 
                    array('password2', 'required','message'=>'Repeat Password cannot be blank.'/*, 'on'=>'insert'*/,'on'=>'create'),
			//array('SENHA, SENHA_REPETE', 'length', 'min'=>3, 'max'=>32,'message'=>'A senha deve conter no máximo 10 caracteres.'),
			array('password', 'compare', 'compareAttribute'=>'password2','message'=>'Os campos Senha e Repita sua Senha, não conferem.', 'on'=>'create'),
                     array('password, password2', 'length', 'min'=>6, 'max'=>40),
                     
                          //  array('password2', 'compare', 'compareAttribute' => 'password', 'on'=>'create'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'apps' => array(self::HAS_MANY, 'App', 'id_users'),
                        'appUsers' => array(self::MANY_MANY, 'AppUsers', 'app_users(id_users, id_app)'),
                        'country' => array(self::HAS_MANY, 'country', 'country'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'user_name' => 'Username',
			'country' => 'Country',
			'business' => 'Business / University',
			'level' => 'Level',
			'email' => 'Email',
			'password' => 'Password',
                        'password2' => 'Repeat Password',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('business',$this->business);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        # Função para converter em md5 a variavel password 
        public function beforeSave() 
        { 
            $pass = md5($this->password).Yii::app()->params["salt"]; 
            $this->password = $pass; 
            return true; 
        } 
        
     
         public function findPasswords($attribute, $params)
        {
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if ($user->password != md5($this->old_password))
            $this->addError($attribute, 'Old password is incorrect.');
        }
        
         public function Getlevel($level){
            
     
          if($level === 1){
              $level = 'Tester';
          }else if($level === 0){
              $level = 'Admin';
          }
	 return $level;	
        }
          
        static function getAccessLevelList( $level ){
            
            $levelList=array(
             self::TESTER => 'Tester',
             self::ADMIN => 'Administrator'
            );
            
            if( $level === null){
                return $levelList;
            }elseif ($level != NULL) {
                return $levelList[ $level ];
             }
             
        }
        
        
        public static function getLabel( $level ){
          if($level == self::TESTER)
             return 'Tester';
          if($level == self::ADMIN)
             return 'Administrator';
          return false;
      }
        
        public static function usersAutoComplete($user_name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= 'SELECT id ,user_name AS label FROM users WHERE user_name LIKE :user_name';
        $user_name = $user_name.'%';
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':user_name'=>$user_name));
 
        // Not Recommended: Simple Way for those who can't understand the above way.
    // Uncomment the below and comment out above 3 lines 
    /*
    $sql= "SELECT id ,title AS label FROM users WHERE title LIKE '$name%'";
        return Yii::app()->db->createCommand($sql)->queryAll();
    */
 
    }
    
    public function uniqueEmail($attribute, $params)
    {
        if($user = Users::model()->exists('email=:email',array('email'=>$this->email)))
          $this->addError($attribute, 'Email already exists!');
    }
    
     
        
}
