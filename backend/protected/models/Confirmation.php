<?php

/**
 * This is the model class for table "tb_confirmation".
 *
 * The followings are the available columns in table 'tb_confirmation':
 * @property integer $id_confirmation
 * @property integer $id_user
 * @property integer $id_post
 * @property integer $id_bank
 * @property integer $amount
 * @property string $note
 * @property string $file_confirm
 * @property integer $created_at
 */
class Confirmation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_confirmation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_post, id_bank, amount, note, file_confirm, created_at', 'required'),
			array('id_user, id_post, id_bank, amount, created_at', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_confirmation, id_user, id_post, id_bank, amount, note, file_confirm, created_at', 'safe', 'on'=>'search'),
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
			'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
			'idPost' 	 => array(self::BELONGS_TO, 'Post', 'id_post'),
			'idBank' 	 => array(self::BELONGS_TO, 'Bank', 'id_bank'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_confirmation' => 'Id Confirmation',
			'id_user' => 'Id User',
			'id_post' => 'Id Post',
			'id_bank' => 'Id Bank',
			'amount' => 'Amount',
			'note' => 'Note',
			'file_confirm' => 'File Confirm',
			'created_at' => 'Created At',
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

		$criteria->compare('id_confirmation',$this->id_confirmation);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('id_bank',$this->id_bank);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('file_confirm',$this->file_confirm,true);
		$criteria->compare('created_at',$this->created_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Confirmation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
