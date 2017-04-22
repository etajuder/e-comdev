<?php

/**
 * This is the model class for table "tb_photo".
 *
 * The followings are the available columns in table 'tb_photo':
 * @property integer $id_photo
 * @property string $path
 * @property integer $time_upload
 * @property string $description
 * @property integer $id_post
 * @property string $thumbnail_path
 */
class Photo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('thumbnail_path', 'required'),
			array('time_upload, id_post', 'numerical', 'integerOnly'=>true),
			array('path, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_photo, path, time_upload, description, id_post, thumbnail_path', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_photo' => 'Id Photo',
			'path' => 'Path',
			'time_upload' => 'Time Upload',
			'description' => 'Description',
			'id_post' => 'Id Post',
			'thumbnail_path' => 'Thumbnail Path',
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

		$criteria->compare('id_photo',$this->id_photo);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('time_upload',$this->time_upload);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('thumbnail_path',$this->thumbnail_path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Photo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
