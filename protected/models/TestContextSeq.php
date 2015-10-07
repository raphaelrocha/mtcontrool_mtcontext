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
			array('id_test_context', 'required'),
			array('id_test_context, sequence_order', 'numerical', 'integerOnly'=>true),
			array('variation, behavior', 'length', 'max'=>10000),
			array('behavior_screen', 'length', 'max'=>300),
			//array('behavior_screen', 'file', 'types' => 'jpg, png, jpeg', 'allowempty'=>true),
			// the following rule is used by search().
			// @todo please remove those attributes that should not be searched.
			array('id, id_test_context, sequence_order, variation, behavior, behavior_screen', 'safe', 'on'=>'search'),
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
			'id_test_context' => 'Id Test Context',
			'sequence_order' => 'Sequence Order',
			'variation' => 'Variation',
			'behavior' => 'Behavior',
			'behavior_screen' => 'Behavior Screen',
			'date_time' => 'Date Time',
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
		$criteria->compare('id_test_context',$this->id_test_context);
		$criteria->compare('sequence_order',$this->sequence_order);
		$criteria->compare('variation',$this->variation,true);
		$criteria->compare('behavior',$this->behavior,true);
		$criteria->compare('behavior_screen',$this->behavior_screen,true);
		$criteria->compare('date_time',$this->date_time,true);

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
