<?php

/**
 * This is the model class for table "tb_user".
 *
 * The followings are the available columns in table 'tb_user':
 * @property integer $id_user
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property integer $birth_date
 * @property string $about_me
 * @property string $facebook_id
 * @property string $social_type
 * @property string $level
 * @property string $twitter_id
 * @property string $instagram_id
 * @property integer $id_location
 * @property string $avatar
 * @property string $alert_me
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 public $repeat_password;
 
    //will hold the encrypted password for update actions.
    public $initialPassword;
	public function tableName()
	{
		return 'tb_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name,last_name,level, username, password, id_location, repeat_password', 'required'),
			array('birth_date, id_location', 'numerical', 'integerOnly'=>true),
			array('username, password, first_name, last_name, twitter_id, instagram_id', 'length', 'max'=>32),
			array('email', 'length', 'max'=>64),
			array('phone, level', 'length', 'max'=>16),
			array('facebook_id', 'length', 'max'=>255),
			array('social_type, alert_me', 'length', 'max'=>8),
			array('about_me', 'safe'),
			array('password, repeat_password', 'length', 'min'=>6, 'max'=>40),
            array('password', 'compare', 'compareAttribute'=>'repeat_password'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, username, email, password, first_name, last_name, phone, birth_date, about_me, facebook_id, social_type, level, twitter_id, instagram_id, id_location, avatar, alert_me', 'safe', 'on'=>'search'),
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
			'idLocation' => array(self::BELONGS_TO, 'Location', 'id_location'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'phone' => 'Phone',
			'birth_date' => 'Birth Date',
			'about_me' => 'About Me',
			'facebook_id' => 'Facebook',
			'social_type' => 'Social Type',
			'level' => 'Level',
			'twitter_id' => 'Twitter',
			'instagram_id' => 'Instagram',
			'id_location' => 'Id Location',
			'avatar' => 'Avatar',
			'alert_me' => 'Alert Me',
			'repeat_password' => 'repeat_password',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('birth_date',$this->birth_date);
		$criteria->compare('about_me',$this->about_me,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('social_type',$this->social_type,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('twitter_id',$this->twitter_id,true);
		$criteria->compare('instagram_id',$this->instagram_id,true);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('alert_me',$this->alert_me,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
    {
        // in this case, we will use the old hashed password.
        if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword))
            $this->password=$this->repeat_password=$this->initialPassword;
 
        return parent::beforeSave();
    }
 
    public function afterFind()
    {
        //reset the password to null because we don't want the hash to be shown.
        $this->initialPassword = $this->password;
        $this->password = null;
 
        parent::afterFind();
    }
 
    public function saveModel($data=array())
    {
            //because the hashes needs to match
            if(!empty($data['password']) && !empty($data['repeat_password']))
            {
                $data['password'] = Yii::app()->user->hashPassword($data['password']);
                $data['repeat_password'] = Yii::app()->user->hashPassword($data['repeat_password']);
            }
 
            $this->attributes=$data;
 
            if(!$this->save())
                return CHtml::errorSummary($this);
 
         return true;
    }

    public function getLocation()
        {
            $connection=Yii::app()->db;
            $sql="SELECT id_location, name_location FROM tb_location ORDER BY name_location";
            $menu=$connection->createCommand($sql)->query();
            $menu->bindColumn(1,$option_value);
            $menu->bindColumn(2,$option_name);
            $balik['']="- Chose location -";
            while($menu->read()!==false)
            {
                $balik[$option_value]=$option_name;
            }
            return $balik;
        }
}
