<?php

/**
 * This is the model class for table "test_context_seq".
 *
 * The followings are the available columns in table 'test_context_seq':
 * @property integer $ID
 * @property integer $ID_TEST_CONTEXT
 * @property integer $SEQUENCE_ORDER
 * @property string $VARIATION
 * @property string $BEHAVIOR
 * @property string $BEHAVIOR_SCREEN
 * @property string $DATE_TIME
 *
 * The followings are the available model relations:
 * @property TestContext $iDTESTCONTEXT
 */
class TestContextSeq extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test_context_seq';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TEST_CONTEXT', 'required'),
			array('ID_TEST_CONTEXT, SEQUENCE_ORDER', 'numerical', 'integerOnly'=>true),
			array('VARIATION, BEHAVIOR', 'length', 'max'=>10000),
			array('BEHAVIOR_SCREEN', 'length', 'max'=>300),
			//array('BEHAVIOR_SCREEN', 'file', 'types' => 'jpg, png, jpeg', 'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, ID_TEST_CONTEXT, SEQUENCE_ORDER, VARIATION, BEHAVIOR, BEHAVIOR_SCREEN', 'safe', 'on'=>'search'),
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
			'iDTESTCONTEXT' => array(self::BELONGS_TO, 'TestContext', 'ID_TEST_CONTEXT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'ID_TEST_CONTEXT' => 'Id Test Context',
			'SEQUENCE_ORDER' => 'Sequence Order',
			'VARIATION' => 'Variation',
			'BEHAVIOR' => 'Behavior',
			'BEHAVIOR_SCREEN' => 'Behavior Screen',
			'DATE_TIME' => 'Date Time',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ID_TEST_CONTEXT',$this->ID_TEST_CONTEXT);
		$criteria->compare('SEQUENCE_ORDER',$this->SEQUENCE_ORDER);
		$criteria->compare('VARIATION',$this->VARIATION,true);
		$criteria->compare('BEHAVIOR',$this->BEHAVIOR,true);
		$criteria->compare('BEHAVIOR_SCREEN',$this->BEHAVIOR_SCREEN,true);
		$criteria->compare('DATE_TIME',$this->DATE_TIME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestContextSeq the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
