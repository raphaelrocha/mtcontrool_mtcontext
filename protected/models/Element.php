<?php

/**
 * This is the model class for table "element".
 *
 * The followings are the available columns in table 'element':
 * @property integer $ID
 * @property string $DESCRIPTION
 *
 * The followings are the available model relations:
 * @property ElementInst[] $elementInsts
 * @property ElementPlatform[] $elementPlatforms
 * @property TestContext[] $testContexts
 */
class Element extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	//private $idCache;
	public $ID_PLAT;
	public $ID_DEV;
	public $DROPDOWN;

	public function tableName()
	{
		return 'element';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'required'),
			array('description', 'length', 'max'=>50),
			// the following rule is used by search().
			// @todo please remove those attributes that should not be searched.
			array('id, description, elementplatforms.id_platform, elementdevices.id_device, id_plat, id_dev', 'safe', 'on'=>'search'),
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
			//'elementInsts' => array(self::HAS_MANY, 'ElementInst', 'id_element'),
			'elementInst' => array(self::HAS_MANY, 'ElementInst', 'id_element'),
			'elementPlatforms' => array(self::HAS_MANY, 'ElementPlatform', 'id_element'),
			'elementDevices' => array(self::HAS_MANY, 'ElementDevice', 'id_elemenT'),
			'testContexts' => array(self::HAS_MANY, 'TestContext', 'id_element'),
			'platforms' => array(self::MANY_MANY, 'Platforms', 'element_platform(id_element, id_platform)'),
			'devices' => array(self::MANY_MANY, 'Device', 'element_device(id_element, id_device)'),

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
			'description' => 'Description',
		);
	}

	public function platform_list($id){

		$testModel=$this->findAllBySql('SELECT * FROM element WHERE id ='.$id);


		$cont=0;

		$return='';
		foreach($testModel as $value ){

			while( array_key_exists($cont, $value->elementPlatforms)){
				if($return==''){
					$return =  $value->elementPlatforms[$cont]->iDPLATFORM->name;
				}else{
					$return =  $return." / ".$value->elementPlatforms[$cont]->iDPLATFORM->name;
				}
				
		 		$cont++;
			}
		 
		 $cont=0;
		}
		return $return;
	}

	public function device_list($id){
		$testModel=$this->findAllBySql('SELECT * FROM element WHERE id ='.$id);


		$cont=0;

		$return='';
		foreach($testModel as $value ){

			while( array_key_exists($cont, $value->elementDevices)){
				if($return==''){
					$return =  $value->elementDevices[$cont]->iDDEVICE->description;
				}else{
					$return =  $return." / ".$value->elementDevices[$cont]->iDDEVICE->description;
				}
				
		 		$cont++;
			}
		 
		 $cont=0;
		}
		return $return;
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
		$criteria->order = 'description asc';

		$criteria->with=array('elementPlatforms','elementDevices');
		//$criteria->with=array('elementPlatforms');
		$criteria->compare('elementPlatforms.id_platform',$this->ID_PLAT, true);
		$criteria->compare('elementDevices.id_device',$this->ID_DEV, true);
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
	 * @return Element the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

    /*public function beforeDelete()
    {
        $this->idCache = $this->id;

        return parent::beforeDelete();
    }

    public function afterDelete()
    {
        $criteria = new CDbCriteria(array(
                'condition' => 'parent_id=:parentId',
                'params' => array(
                    ':parentId' => $this->idCache),
            ));

        $children = Child::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }

        parent::afterDelete();
    }*/


}
