<?php

/**
 * This is the model class for table "tb_post".
 *
 * The followings are the available columns in table 'tb_post':
 * @property integer $id_post
 * @property string $url_post
 * @property string $title
 * @property string $tags
 * @property string $content
 * @property string $post_type
 * @property integer $post_time
 * @property integer $author
 * @property string $post_status
 * @property double $amount
 * @property integer $time_open
 * @property integer $time_close
 * @property integer $viewer
 * @property integer $post_update_time
 * @property integer $id_location
 * @property integer $id_category
 * @property string $id_video
 * @property string $video_thumbnail
 * @property string $amount_label
 */
class Post extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,post_type,content,id_category', 'required'),
			array('author, viewer,id_location, id_category', 'numerical', 'integerOnly'=>true),
			array('amount,amount_bid', 'numerical'),
			array('url_post, title', 'length', 'max'=>128),
			array('post_type', 'length', 'max'=>7),
			array('post_status', 'length', 'max'=>8),
			array('id_video', 'length', 'max'=>16),
			array('amount_label', 'length', 'max'=>64),
			array('tags, content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_post, url_post, title, tags, content,amount_bid, post_type, post_time, author, post_status, amount, time_open, time_close, viewer, post_update_time, id_location, id_category, id_video, video_thumbnail, amount_label', 'safe', 'on'=>'search'),
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
			'idUser' 	 => array(self::BELONGS_TO, 'User', 'author'),
			'idItem' 	 => array(self::BELONGS_TO, 'Item', 'id_category'),
			'idJob' 	 => array(self::BELONGS_TO, 'Job', 'id_category'),
			'idThread' 	 => array(self::BELONGS_TO, 'Thread', 'id_category'),


		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_post' => 'Id Post',
			'url_post' => 'Url Post',
			'title' => 'Title',
			'tags' => 'Tags',
			'content' => 'Content',
			'post_type' => 'Post Type',
			'post_time' => 'Post Time',
			'author' => 'Author',
			'post_status' => 'Post Status',
			'amount' => 'Amount',
			'time_open' => 'Time Open',
			'time_close' => 'Time Close',
			'viewer' => 'Viewer',
			'post_update_time' => 'Post Update Time',
			'id_location' => 'Id Location',
			'id_category' => 'Id Category',
			'id_video' => 'Id Video',
			'video_thumbnail' => 'Video Thumbnail',
			'amount_label' => 'Amount Label',
			'amount_bid' => 'Amount Bid',
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

		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('url_post',$this->url_post,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('post_time',$this->post_time);
		$criteria->compare('author',$this->author);
		$criteria->compare('post_status',$this->post_status,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('time_open',$this->time_open);
		$criteria->compare('time_close',$this->time_close);
		$criteria->compare('viewer',$this->viewer);
		$criteria->compare('post_update_time',$this->post_update_time);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_video',$this->id_video,true);
		$criteria->compare('video_thumbnail',$this->video_thumbnail,true);
		$criteria->compare('amount_label',$this->amount_label,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function items()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('url_post',$this->url_post,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('post_time',$this->post_time);
		$criteria->compare('author',$this->author);
		$criteria->compare('post_status',$this->post_status,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('time_open',$this->time_open);
		$criteria->compare('time_close',$this->time_close);
		$criteria->compare('viewer',$this->viewer);
		$criteria->compare('post_update_time',$this->post_update_time);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_video',$this->id_video,true);
		$criteria->compare('video_thumbnail',$this->video_thumbnail,true);
		$criteria->compare('amount_label',$this->amount_label,true);
		$criteria->addCondition(array('post_type="item"' ));


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function jobs()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('url_post',$this->url_post,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('post_time',$this->post_time);
		$criteria->compare('author',$this->author);
		$criteria->compare('post_status',$this->post_status,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('time_open',$this->time_open);
		$criteria->compare('time_close',$this->time_close);
		$criteria->compare('viewer',$this->viewer);
		$criteria->compare('post_update_time',$this->post_update_time);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_video',$this->id_video,true);
		$criteria->compare('video_thumbnail',$this->video_thumbnail,true);
		$criteria->compare('amount_label',$this->amount_label,true);
		$criteria->addCondition(array('post_type="job"' ));


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function threads()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('url_post',$this->url_post,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('post_time',$this->post_time);
		$criteria->compare('author',$this->author);
		$criteria->compare('post_status',$this->post_status,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('time_open',$this->time_open);
		$criteria->compare('time_close',$this->time_close);
		$criteria->compare('viewer',$this->viewer);
		$criteria->compare('post_update_time',$this->post_update_time);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_video',$this->id_video,true);
		$criteria->compare('video_thumbnail',$this->video_thumbnail,true);
		$criteria->compare('amount_label',$this->amount_label,true);
		$criteria->addCondition(array('post_type="thread"' ));


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function auctions()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('url_post',$this->url_post,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('post_time',$this->post_time);
		$criteria->compare('author',$this->author);
		$criteria->compare('post_status',$this->post_status,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('time_open',$this->time_open);
		$criteria->compare('time_close',$this->time_close);
		$criteria->compare('viewer',$this->viewer);
		$criteria->compare('post_update_time',$this->post_update_time);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_video',$this->id_video,true);
		$criteria->compare('video_thumbnail',$this->video_thumbnail,true);
		$criteria->compare('amount_label',$this->amount_label,true);
		$criteria->compare('amount_bid',$this->amount_bid,true);
		$criteria->addCondition(array('post_type="auction"' ));


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getuser()
        {
            $connection=Yii::app()->db;
            $sql="SELECT id_user,first_name, last_name,email FROM tb_user ORDER BY first_name";
            $menu=$connection->createCommand($sql)->query();
            $menu->bindColumn(1,$option_value);
            $menu->bindColumn(2,$option_name);
            $menu->bindColumn(3,$option_name2);
            $menu->bindColumn(4,$option_email);
            $balik['']="- Choose User -";
            while($menu->read()!==false)
            {
                $balik[$option_value]=$option_name." ".$option_name2." | ".$option_email;
            }
            return $balik;
        }
    public function getlocation()
        {
            $connection=Yii::app()->db;
            $sql="SELECT id_location,name_location FROM tb_location ORDER BY name_location";
            $menu=$connection->createCommand($sql)->query();
            $menu->bindColumn(1,$option_value);
            $menu->bindColumn(2,$option_name);
            $balik['']="- Choose Location -";
            while($menu->read()!==false)
            {
                $balik[$option_value]=$option_name;
            }
            return $balik;
        }
    public function getItem()
        {
            $connection=Yii::app()->db;
            $sql="SELECT id_item,name_item FROM tb_item ORDER BY name_item";
            $menu=$connection->createCommand($sql)->query();
            $menu->bindColumn(1,$option_value);
            $menu->bindColumn(2,$option_name);
            $balik['']="- Choose Item -";
            while($menu->read()!==false)
            {
                $balik[$option_value]=$option_name;
            }
            return $balik;
        }
        public function getJob()
        {
            $connection=Yii::app()->db;
            $sql="SELECT id_job,name_job FROM tb_job ORDER BY name_job";
            $menu=$connection->createCommand($sql)->query();
            $menu->bindColumn(1,$option_value);
            $menu->bindColumn(2,$option_name);
            $balik['']="- Choose job -";
            while($menu->read()!==false)
            {
                $balik[$option_value]=$option_name;
            }
            return $balik;
        }

            public function getthread()
        {
            $connection=Yii::app()->db;
            $sql="SELECT id_thread,name_thread FROM tb_thread ORDER BY name_thread";
            $menu=$connection->createCommand($sql)->query();
            $menu->bindColumn(1,$option_value);
            $menu->bindColumn(2,$option_name);
            $balik['']="- Choose thread -";
            while($menu->read()!==false)
            {
                $balik[$option_value]=$option_name;
            }
            return $balik;
        }

         public function insert_foto($id,$nama,$deskripsi,$nama_thumb){
    	 $connection = Yii::app()->db;
        $sql = "insert into tb_photo (id_post,path,description,thumbnail_path,time_upload) values ('".$id."','".$nama."','".$deskripsi."','".$nama_thumb."','".time()."')";
        $menu = $connection->createCommand($sql)->execute();
        return $menu;
    }
             public function update_foto($id,$nama,$deskripsi,$nama_thumb){
    	 $connection = Yii::app()->db;
        $sql = "UPDATE `tb_photo` SET `path`='".$nama."',`time_upload`='".time()."',`description`='".$deskripsi."',`thumbnail_path`='".$nama_thumb."' WHERE id_photo='".$id."'";
        $menu = $connection->createCommand($sql)->execute();
        return $menu;
    }

    public function getphoto($id){
    	$connection = Yii::app()->db;
        $sql = "select * from tb_photo where id_post=".$id."";
        $menu = $connection->createCommand($sql)->query();
        return $menu;
    }

    public function delete_foto($id){
    	 $connection = Yii::app()->db;
        $sql = "DELETE FROM `tb_photo` WHERE id_photo=".$id."";
        $menu = $connection->createCommand($sql)->execute();
        return $menu;
    }
}
