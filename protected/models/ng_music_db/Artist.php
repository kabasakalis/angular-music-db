<?php

/**
 * This is the model class for table "artist".
 *
 * The followings are the available columns in table 'artist':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $country
 * @property string $year_formed
 * @property integer $genre_id
 *
 * The followings are the available model relations:
 * @property Genre $genre
 * @property Album[] $albums
 */
class Artist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

    public static  function PROTECTED_ARTISTS()
    {
        return array(
            44,//King Diamond
            45,//Agent Steel
            46,//Katy Perry
            47,//Missy Elliot
            49,//Yelawolf
            50,//Justin Timberlake
            52,//AC/DC
        );
    }

	public function tableName()
	{
		return 'artist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
            array('name', 'length', 'max' => 50, 'min' =>3),
            array('year_formed', 'numerical', 'integerOnly' => true),
            array('year_formed', 'length', 'max'=>4),
			array('genre_id', 'numerical', 'integerOnly'=>true),
			array('description', 'safe'),
            array('description', 'length', 'max' => 1024, 'min' => 10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, country, year_formed, genre_id', 'safe', 'on'=>'search'),
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
			'genre' => array(self::BELONGS_TO, 'Genre', 'genre_id'),
			'albums' => array(self::MANY_MANY, 'Album', 'artist_album(artist_id, album_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'country' => 'Country',
			'year_formed' => 'Year Formed',
			'genre_id' => 'Genre',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('year_formed',$this->year_formed,true);
		$criteria->compare('genre_id',$this->genre_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Artist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
