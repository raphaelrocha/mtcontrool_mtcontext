<?php

/**
 * This is the model class for table "element_inst".
 *
 * The followings are the available columns in table 'element_inst':
 * @property integer $ID
 * @property integer $ID_ELEMENT
 * @property integer $ID_TEST_CONTEXT
 * @property string $ELEMENT_TYPE
 * @property string $DESCRIPTION
 * @property integer $START_PARAM
 * @property integer $END_PARAM
 *
 * The followings are the available model relations:
 * @property Element $iDELEMENT
 * @property TestContext $iDTESTCONTEXT
 */
class ElementInst extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $BEHAVIOR_SCREEN;
	public $sent;
	public function tableName()
	{
		return 'element_inst';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_element, id_test_context, element_type, description', 'required'),
			array('id_element, id_test_context', 'numerical', 'integerOnly'=>true),
			//array('start_param, end_param', 'numerical', 'integeronly'=>true),
			array('element_type', 'length', 'max'=>10),
			array('description', 'length', 'max'=>50),
			array('behavior', 'length', 'max'=>50),
			array('sent', 'length', 'max'=>500),
			array('behavior_screen', 'file', 'types' => 'jpg, png, jpeg, pdf', 'allowEmpty'=>true),
			// the following rule is used by search().
			// @todo please remove those attributes that should not be searched.
			array('id, id_element, sent, id_test_context, element_type, behavior, behavior_screen, description, start_param, end_param', 'safe', 'on'=>'search'),
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
			'iDTESTCONTEXT' => array(self::BELONGS_TO, 'TestContext', 'id_test_context'),
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
			'id_test_context' => 'Id Test Context',
			'element_type' => 'Type',
			'description' => 'Variation',
			'behavior' => 'Behavior',
			'behavior_screen' => 'Screenshot',
			'upload' => 'Behavior Screenshot',
			'start_param' => 'Start',
			'end_param' => 'End',
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
		$criteria->compare('id_test_context',$this->id_test_context);
		$criteria->compare('element_type',$this->element_type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_param',$this->start_param);
		$criteria->compare('end_param',$this->end_param);

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
	 * @return ElementInst the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
