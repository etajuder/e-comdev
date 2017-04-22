<?php

/**
 * This is the model class for table "tb_detail_bank".
 *
 * The followings are the available columns in table 'tb_detail_bank':
 * @property integer $id_detailbank
 * @property integer $id_user
 * @property integer $id_bank
 * @property string $name_account
 * @property string $number_bank
 * @property string $location_bank
 * @property integer $status
 */
class DetailBank extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_detail_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_bank, name_account, number_bank, location_bank, status', 'required'),
			array('id_user, id_bank, status', 'numerical', 'integerOnly'=>true),
			array('name_account, number_bank', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_detailbank, id_user, id_bank, name_account, number_bank, location_bank, status', 'safe', 'on'=>'search'),
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
			'idBank' => array(self::BELONGS_TO, 'Bank', 'id_bank'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_detailbank' => 'Id Detailbank',
			'id_user' => 'Id User',
			'id_bank' => 'Id Bank',
			'name_account' => 'Name Account',
			'number_bank' => 'Number Bank',
			'location_bank' => 'Location Bank',
			'status' => 'Status',
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
	public function search($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_detailbank',$this->id_detailbank);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_bank',$this->id_bank);
		$criteria->compare('name_account',$this->name_account,true);
		$criteria->compare('number_bank',$this->number_bank,true);
		$criteria->compare('location_bank',$this->location_bank,true);
		$criteria->compare('status',$this->status);
		$criteria->addCondition(array('id_user='.$id.'' ));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetailBank the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
		public function getbank()
        {
            $connection=Yii::app()->db;
            $sql="SELECT id_bank, name_bank FROM tb_bank ORDER BY name_bank";
            $menu=$connection->createCommand($sql)->query();
            $menu->bindColumn(1,$option_value);
            $menu->bindColumn(2,$option_name);
            $balik['']="- Choose Bank -";
            while($menu->read()!==false)
            {
                $balik[$option_value]=$option_name;
            }
            return $balik;
        }
}
