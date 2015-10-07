<?php

/**
 * This is the model class for table "device".
 *
 * The followings are the available columns in table 'device':
 * @property integer $ID
 * @property integer $ID_BRAND
 * @property string $DESCRIPTION
 *
 * The followings are the available model relations:
 * @property Brand $iDBRAND
 */
class Device extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	var $selected;

	public function tableName()
	{
		return 'device';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_brand, description, id_platform', 'required'),
			array('id_brand', 'numerical', 'integeronly'=>true),
			array('description', 'length', 'max'=>50),
			// the following rule is used by search().
			// @todo please remove those attributes that should not be searched.
			array('id, id_brand, description, id_platform, idbrand.brand_name, idplatform.name', 'safe', 'on'=>'search'),
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
			'iDBRAND' => array(self::BELONGS_TO, 'Brand', 'id_brand'),
			'iDPLATFORM' => array(self::BELONGS_TO, 'Platforms', 'id_platform'),
			//'DEVICE_BRAND_NAME' => array(self::BELONGS_TO, 'Brand', 'brand_name'),
		);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_brand' => 'Brand',
			'id_platform' => 'Platform',
			'description' => 'Model',
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
		//$criteria->compare('id_brand',$this->id_brand);
		$criteria->compare('description',$this->description,true);

		$criteria->with=array('iDBRAND','iDPLATFORM');
		//$criteria->with=array('iDBRAND');
		$criteria->compare('iDPLATFORM.name',$this->id_platform, true);
		$criteria->compare('iDBRAND.brand_name',$this->id_brand, true);

		
		$criteria->together=true;

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
	 * @return Device the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
