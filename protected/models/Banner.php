<?php

/**
 * This is the model class for table "banner".
 *
 * The followings are the available columns in table 'banner':
 * @property integer $id
 * @property integer $site_id
 * @property string $name
 * @property string $size
 * @property string $photo
 * @property double $price_amd
 * @property double $price_us
 * @property double $price_rur
 * @property string $duration
 * @property string $placement
 * @property string $placement_type
 * @property string $type
 * @property string $price_type
 * @property double $ctr
 * @property integer $cost_price
 *
 * The followings are the available model relations:
 * @property Sites $site
 */
class Banner extends CActiveRecord
{
    public $site_name;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cost_price', 'numerical', 'integerOnly'=>true),
			array('price_amd, price_us, price_rur, ctr, pageview', 'numerical'),
			array('name, photo', 'length', 'max'=>255),
			array('size, duration, placement, placement_type, type, price_type', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, site_name, name, size, photo, price_amd, price_us, price_rur, duration, placement, pageview, placement_type, type, price_type, ctr, cost_price', 'safe', 'on'=>'search'),
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
			'site' => array(self::BELONGS_TO, 'Sites', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'site.name' => 'Site',
			'name' => 'Name',
			'size' => 'Size',
			'photo' => 'Photo',
			'price_amd' => 'Price AMD',
			'price_us' => 'Price USD',
			'price_rur' => 'Price RUR',
			'duration' => 'Price for:',
			'placement' => 'Placement',
			'placement_type' => 'Placement Type',
			'type' => 'Type',
			'price_type' => 'Price Type',
			'ctr' => 'CTR',
			'cost_price' => 'Cost Price',
            'pageview' => 'Page view'
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
        $criteria->with = 'site';
		$criteria->compare('id',$this->id);
		$criteria->compare('site.name',$this->site_name,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('price_amd',$this->price_amd);
		$criteria->compare('price_us',$this->price_us);
		$criteria->compare('price_rur',$this->price_rur);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('placement',$this->placement,true);
		$criteria->compare('placement_type',$this->placement_type,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('price_type',$this->price_type,true);
		$criteria->compare('ctr',$this->ctr);
		$criteria->compare('cost_price',$this->cost_price);
		$criteria->compare('pageview',$this->pageview);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'site_name'=>array('asc'=>'site.name', 'desc'=>'site.name DESC'),
                    '*',
                ),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
