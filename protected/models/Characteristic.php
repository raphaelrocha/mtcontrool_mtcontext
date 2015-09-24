<?php

/**
 * This is the model class for table "characteristic".
 *
 * The followings are the available columns in table 'characteristic':
 * @property integer $id
 * @property string $name
 * @property integer $id_criteria
 *
 * The followings are the available model relations:
 * @property Criteria $idCriteria
 * @property CharacteristicPlatforms[] $characteristicPlatforms
 * @property TestCase[] $testCases
 */
class Characteristic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'characteristic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, id_criteria', 'required'),
			array('id_criteria', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>400),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, id_criteria', 'safe', 'on'=>'search'),
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
			'idCriteria' => array(self::BELONGS_TO, 'Criteria', 'id_criteria'),
			'characteristicPlatforms' => array(self::HAS_MANY, 'CharacteristicPlatforms', 'id_characteristic'),
			'testCases' => array(self::HAS_MANY, 'TestCase', 'id_characteristic'),
		);
	}
        
        public function behaviors(){
		return array(
				'CSaveRelationsBehavior' => array('class' => 'application.components.CSaveRelationsBehavior'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name:',
			'id_criteria' => 'Criteria:',
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
		$criteria->compare('id_criteria',$this->id_criteria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchPlat($idPlat)
	{
		
                
                
		$criteria=new CDbCriteria;
               //$criteria->select = "id";
                //   $criteria->alias = "t";
                $criteria->mergeWith(array(
                    'join'=>'LEFT JOIN characteristic_platforms as cp
                            ON t.id = cp.id_characteristic',
                    'condition'=>'cp.id_platform = '.$idPlat,
                ));
                Characteristic::model()->findAll($criteria);

               // $criteria->addCondition(array("condtion"=>"id_app = $id_ap"));
                
                
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_criteria',$this->id_criteria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                  'pagination'=>false,   
                        

                       
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Characteristic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public static function platAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= 'SELECT id ,name AS label FROM characteristic WHERE name LIKE :name';
        $name = $name.'%';
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':name'=>$name));
 
        // Not Recommended: Simple Way for those who can't understand the above way.
    // Uncomment the below and comment out above 3 lines 
    /*
    $sql= "SELECT id ,title AS label FROM users WHERE title LIKE '$name%'";
        return Yii::app()->db->createCommand($sql)->queryAll();
    */
 
    }
    

}
