<?php

/**
 * This is the model class for table "test_context".
 *
 * The followings are the available columns in table 'test_context':
 * @property integer $ID
 * @property integer $ID_USER
 * @property integer $ID_APP
 * @property integer $ID_PLATFORM
 * @property integer $ID_DEVICE
 * @property string $DESCRIPTION
 *
 * The followings are the available model relations:
 * @property ElementInst[] $elementInsts
 * @property Users $iDUSER
 * @property App $iDAPP
 * @property Platforms $iDPLATFORM
 * @property Device $iDDEVICE
 */
class TestContext extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test_context';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, id_user, id_app, id_platform, id_device', 'required'),
			array('id_user, id_app, id_platform, id_device', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>50),
			// the following rule is used by search().
			// @todo please remove those attributes that should not be searched.
			array('id, id_user, id_app, id_platform, id_device, description, iduser.name, idapp.name, idplatform.name, iddevice.description, elementinsts.id_test_context', 'safe', 'on'=>'search'),
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
			'elementInsts' => array(self::HAS_MANY, 'ElementInst', 'id_test_context'),
			'iDUSER' => array(self::BELONGS_TO, 'Users', 'id_user'),
			'iDAPP' => array(self::BELONGS_TO, 'App', 'id_app'),
			'iDPLATFORM' => array(self::BELONGS_TO, 'Platforms', 'id_platform'),
			'iDDEVICE' => array(self::BELONGS_TO, 'Device', 'id_device'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_app' => 'App',
			'id_platform' => 'Platform',
			'id_device' => 'Device',
			'description' => 'Name',
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
		$criteria->compare('description',$this->description,true);


		$criteria->with=array('iDUSER','iDAPP','iDPLATFORM','iDDEVICE','elementInsts');
		//$criteria->with=array('iDBRAND');
		$criteria->compare('iDUSER.name',$this->id_user, true);
		$criteria->compare('iDAPP.name',$this->id_app, true);
		$criteria->compare('iDPLATFORM.name',$this->id_platform, true);
		$criteria->compare('iDDEVICE.description',$this->id_device, true);
		$criteria->compare('elementInsts.id_test_context',$this->id, true);

		return new CActiveDataProvider($this, array(
			'pagination' => array(
             'pageSize' => 1000,
        	),
			'criteria'=>$criteria,
		));
	}

	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestContext the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
