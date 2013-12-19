<?php

/**
 * This is the model class for table "track".
 *
 * The followings are the available columns in table 'track':
 * @property integer $id
 * @property string $album_id
 * @property string $name
 * @property string $artist_override
 * @property string $playtime
 * @property string $lyrics
 *
 * The followings are the available model relations:
 * @property Album $album
 */
class Track extends CActiveRecord
{




	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'track';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('album_id', 'length', 'max'=>11),
			array('name', 'length', 'max'=>128),
            array('artist_override', 'length', 'max'=>50),
            array('playtime', 'length', 'max'=>5),
			array('lyrics', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, album_id, name, artist_override, playtime, lyrics', 'safe', 'on'=>'search'),
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
			'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'album_id' => 'Album',
			'name' => 'Name',
			'artist_override' => 'Artist Override',
			'playtime' => 'Playtime',
			'lyrics' => 'Lyrics',
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
		$criteria->compare('album_id',$this->album_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('artist_override',$this->artist_override,true);
		$criteria->compare('playtime',$this->playtime,true);
		$criteria->compare('lyrics',$this->lyrics,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Track the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
