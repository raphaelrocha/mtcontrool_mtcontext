<?php

/**
 * This is the model class for table "element_var".
 *
 * The followings are the available columns in table 'element_var':
 * @property integer $ID
 * @property integer $ID_ELEMENT
 * @property string $DESCRIPTION
 *
 * The followings are the available model relations:
 * @property Element $iDELEMENT
 */
class ElementVar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'element_var';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_element, description', 'required'),
			array('id_element', 'numerical', 'integeronly'=>true),
			array('description', 'length', 'max'=>50),
			// the following rule is used by search().
			// @todo please remove those attributes that should not be searched.
			array('id, id_element, description', 'safe', 'on'=>'search'),
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
			'iDELEMENT' => array(self::BELONGS_TO, 'Element', 'id_element'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_element' => 'Id Element',
			'description' => 'Description',
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
		$criteria->compare('id_element',$this->id_element);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ElementVar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
