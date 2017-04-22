<?php

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('createItem','updateItem','createJob','updateJob','createThread','updateThread','createauction','updateauction','items','jobs',
								'threads','auctions','uploadImage','updateImage','deleteFoto'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = new Post;
		$foto = $model->getphoto($id);
		$modelload = $this->loadModel($id);
		if ($modelload->post_type=="item") {
			$viewnya ="viewitem";
		}else if ($modelload->post_type=="job") {
			$viewnya ="viewjob";
		}else if ($modelload->post_type=="thread") {
			$viewnya ="viewthread";
		}else{
			$viewnya ="viewauction";
		}
		$this->render($viewnya,array(
			'model'=>$this->loadModel($id),
			'foto'=>$foto,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionDeleteFoto($id){
		$model = new Post;
		$model_find=Post::model()->findByPk($_GET['id_post']);
		$model->delete_foto($id,$_GET['id_post']);

       $this->redirect(array('update'.$model_find->post_type,'id'=>$_GET['id_post']));
	}
	public function actionUploadImage(){
		$model = new Post;
		$uploadedFile=CUploadedFile::getInstanceByName('foto');
		$model_find=Post::model()->findByPk($_POST['id_post']);
		$fileNameThumb = $uploadedFile;
		if(!empty($uploadedFile)) {
			  			$uploadedFile->saveAs(Yii::app()->basePath.'/../../assets/uploads/'.$fileNameThumb);
                       	$namaimg = Yii::app()->basePath.'/../../assets/uploads/'.$fileNameThumb;
                        $image = Yii::app()->image->load($namaimg);
                    }
                        $tinggi=$image->__get('height');
                              $lebar=$image->__get('width');
                              if($tinggi>$lebar)
                              {
                              $image->resize(100, 100)->rotate(0);
                              }
                              else
                              {
                              $image->resize(100, 100);
                              }
                              /* end- utk memutar jika file ori portrait */

                              $image->save(Yii::app()->basePath.'/../../assets/uploads/thumb_'.$fileNameThumb);
          	$model->insert_foto($_POST['id_post'],
				 				"assets/uploads/".$fileNameThumb,
				 				$_POST['deskripsi'],
				 				"assets/uploads/thumb_".$fileNameThumb
				 				);

          		$this->redirect(array('update'.$model_find->post_type,'id'=>$_POST['id_post']));
	}


	public function actionUpdateImage(){
		$model = new Post;
		$model_find=Post::model()->findByPk($_POST['id_post']);
		$model_foto=Photo::model()->findByPk($_POST['id_image']);
		$uploadedFile=CUploadedFile::getInstanceByName('foto');
		$fileNameThumb = $uploadedFile;
		if(!empty($uploadedFile)) {
			  			$uploadedFile->saveAs(Yii::app()->basePath.'/../../assets/uploads/'.$fileNameThumb);
                       	$namaimg = Yii::app()->basePath.'/../../assets/uploads/'.$fileNameThumb;
                        $image = Yii::app()->image->load($namaimg);
                    
                        $tinggi=$image->__get('height');
                              $lebar=$image->__get('width');
                              if($tinggi>$lebar)
                              {
                              $image->resize(100, 100)->rotate(0);
                              }
                              else
                              {
                              $image->resize(100, 100);
                              }
                              /* end- utk memutar jika file ori portrait */

                              $image->save(Yii::app()->basePath.'/../../assets/uploads/thumb_'.$fileNameThumb);
         	$model->update_foto($_POST['id_image'],
				 				"assets/uploads/".$fileNameThumb,
				 				$_POST['deskripsi'],
				 				"assets/uploads/thumb_".$fileNameThumb
				 				);
          }
          else{

          		$model->update_foto($_POST['id_image'],
				 				$model_foto->path,
				 				$_POST['deskripsi'],
				 				$model_foto->thumbnail_path
				 				);
          }

          		$this->redirect(array('update'.$model_find->post_type,'id'=>$_POST['id_post']));
	}

	public function actionCreatejob()
	{
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['Post']))
		{
			$replace = str_replace(" ","-",$_POST['Post']['title']);
			$model->attributes=$_POST['Post'];
			$model->url_post=$replace;
			$model->post_type="job";
			$model->time_open = strtotime($_POST['Post']['time_open']);
            $model->time_close = strtotime($_POST['Post']['time_close']);
			$model->post_time = strtotime($_POST['Post']['post_time']);
			if($model->save()){

			for ($i=0; $i <=$_POST['jum_foto'] ; $i++) { 
				${'uploadedFile2'.$i}=CUploadedFile::getInstanceByName('foto'.$i);
				${'fileNameThumb'.$i} = ${'uploadedFile2'.$i};
				if(!empty(${'uploadedFile2'.$i})) {
               		   ${'uploadedFile2'.$i}->saveAs(Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i});
                       ${'namaimg'.$i} = Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i};
                         ${'image'.$i} = Yii::app()->image->load( ${'namaimg'.$i});
               		  }
               		  ${'tinggi'.$i}=${'image'.$i}->__get('height');
                              ${"lebar".$i}=${'image'.$i}->__get('width');
                              if(${"tinggi".$i}>${"lebar".$i})
                              {
                              ${'image'.$i}->resize(100, 100)->rotate(0);
                              }
                              else
                              {
                              ${'image'.$i}->resize(100, 100);
                              }
                              /* end- utk memutar jika file ori portrait */

                              ${'image'.$i}->save(Yii::app()->basePath.'/../../assets/uploads/thumb_'.${'fileNameThumb'.$i});
                              $model->insert_foto(
				$model->id_post,
				 "assets/uploads/".${'fileNameThumb'.$i},
				 $_POST['deskripsi'][$i],
				 "assets/uploads/thumb_".${'fileNameThumb'.$i});
			}
            
				$this->redirect(array('view','id'=>$model->id_post));
			
		}




			}

		

		$this->render('createjob',array(
			'model'=>$model,
		));
	}

	public function actionCreatethread()
	{
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['Post']))
		{
			$replace = str_replace(" ","-",$_POST['Post']['title']);
			$model->attributes=$_POST['Post'];
			$model->url_post=$replace;
			$model->post_type="thread";
			$model->post_time = strtotime($_POST['Post']['post_time']);
			if($model->save()){

			for ($i=0; $i <=$_POST['jum_foto'] ; $i++) { 
				${'uploadedFile2'.$i}=CUploadedFile::getInstanceByName('foto'.$i);
				${'fileNameThumb'.$i} = ${'uploadedFile2'.$i};
				if(!empty(${'uploadedFile2'.$i})) {
               		   ${'uploadedFile2'.$i}->saveAs(Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i});
                       ${'namaimg'.$i} = Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i};
                         ${'image'.$i} = Yii::app()->image->load( ${'namaimg'.$i});
               		  }
               		  ${'tinggi'.$i}=${'image'.$i}->__get('height');
                              ${"lebar".$i}=${'image'.$i}->__get('width');
                              if(${"tinggi".$i}>${"lebar".$i})
                              {
                              ${'image'.$i}->resize(100, 100)->rotate(0);
                              }
                              else
                              {
                              ${'image'.$i}->resize(100, 100);
                              }
                              /* end- utk memutar jika file ori portrait */

                              ${'image'.$i}->save(Yii::app()->basePath.'/../../assets/uploads/thumb_'.${'fileNameThumb'.$i});
                              $model->insert_foto(
				$model->id_post,
				 "assets/uploads/".${'fileNameThumb'.$i},
				 $_POST['deskripsi'][$i],
				 "assets/uploads/thumb_".${'fileNameThumb'.$i});
			}
            
				$this->redirect(array('view','id'=>$model->id_post));
			
		}




			}

		

		$this->render('createthread',array(
			'model'=>$model,
		));
	}

	public function actionCreateItem()
	{
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['Post']))
		{
			$replace = str_replace(" ","-",$_POST['Post']['title']);
			$model->attributes=$_POST['Post'];
			$model->url_post=$replace;
			$model->post_type="item";
			$model->post_time = strtotime($_POST['Post']['post_time']);
			if($model->save()){

			for ($i=0; $i <=$_POST['jum_foto'] ; $i++) { 
				${'uploadedFile2'.$i}=CUploadedFile::getInstanceByName('foto'.$i);
				${'fileNameThumb'.$i} = ${'uploadedFile2'.$i};
				if(!empty(${'uploadedFile2'.$i})) {
               		   ${'uploadedFile2'.$i}->saveAs(Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i});
                       ${'namaimg'.$i} = Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i};
                         ${'image'.$i} = Yii::app()->image->load( ${'namaimg'.$i});
               		  }
               		  ${'tinggi'.$i}=${'image'.$i}->__get('height');
                              ${"lebar".$i}=${'image'.$i}->__get('width');
                              if(${"tinggi".$i}>${"lebar".$i})
                              {
                              ${'image'.$i}->resize(100, 100)->rotate(0);
                              }
                              else
                              {
                              ${'image'.$i}->resize(100, 100);
                              }
                              /* end- utk memutar jika file ori portrait */

                              ${'image'.$i}->save(Yii::app()->basePath.'/../../assets/uploads/thumb_'.${'fileNameThumb'.$i});
                              $model->insert_foto(
				$model->id_post,
				 "assets/uploads/".${'fileNameThumb'.$i},
				 $_POST['deskripsi'][$i],
				 "assets/uploads/thumb_".${'fileNameThumb'.$i});
			}
            
				$this->redirect(array('view','id'=>$model->id_post));
			
		}




			}

		

		$this->render('createitem',array(
			'model'=>$model,
		));
	}

	public function actionCreateAuction()
	{
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['Post']))
		{
			$replace = str_replace(" ","-",$_POST['Post']['title']);
			$model->attributes=$_POST['Post'];
			$model->url_post=$replace;
			$model->post_type="auction";
			$model->post_time = strtotime($_POST['Post']['post_time']);
			if($model->save()){

			for ($i=0; $i <=$_POST['jum_foto'] ; $i++) { 
				${'uploadedFile2'.$i}=CUploadedFile::getInstanceByName('foto'.$i);
				${'fileNameThumb'.$i} = ${'uploadedFile2'.$i};
				if(!empty(${'uploadedFile2'.$i})) {
               		   ${'uploadedFile2'.$i}->saveAs(Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i});
                       ${'namaimg'.$i} = Yii::app()->basePath.'/../../assets/uploads/'.${'fileNameThumb'.$i};
                         ${'image'.$i} = Yii::app()->image->load( ${'namaimg'.$i});
               		  }
               		  ${'tinggi'.$i}=${'image'.$i}->__get('height');
                              ${"lebar".$i}=${'image'.$i}->__get('width');
                              if(${"tinggi".$i}>${"lebar".$i})
                              {
                              ${'image'.$i}->resize(100, 100)->rotate(0);
                              }
                              else
                              {
                              ${'image'.$i}->resize(100, 100);
                              }
                              /* end- utk memutar jika file ori portrait */

                              ${'image'.$i}->save(Yii::app()->basePath.'/../../assets/uploads/thumb_'.${'fileNameThumb'.$i});
                              $model->insert_foto(
				$model->id_post,
				 "assets/uploads/".${'fileNameThumb'.$i},
				 $_POST['deskripsi'][$i],
				 "assets/uploads/thumb_".${'fileNameThumb'.$i});
			}
            
				$this->redirect(array('view','id'=>$model->id_post));
			
		}




			}

		

		$this->render('createauction',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateitem($id)
	{
		$model=$this->loadModel($id);
		$model2 = new Post;
		$foto = $model2->getphoto($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->post_update_time = time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_post));
		}

		$this->render('updateitem',array(
			'model'=>$model,
			'foto' =>$foto,

		));
	}

		public function actionUpdateauction($id)
	{
		$model=$this->loadModel($id);
		$model2 = new Post;
		$foto = $model2->getphoto($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->post_update_time = time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_post));
		}

		$this->render('updateauction',array(
			'model'=>$model,
			'foto' =>$foto,

		));
	}

	public function actionUpdatethread($id)
	{
		$model=$this->loadModel($id);
		$model2 = new Post;
		$foto = $model2->getphoto($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->post_update_time = time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_post));
		}

		$this->render('updatethread',array(
			'model'=>$model,
			'foto' =>$foto,

		));
	}

	public function actionUpdatejob($id)
	{
		$model=$this->loadModel($id);
		$model2 = new Post;
		$foto = $model2->getphoto($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->post_update_time = time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_post));
		}

		$this->render('updatejob',array(
			'model'=>$model,
			'foto' =>$foto,

		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Post');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

		public function actionItems()
	{
		$model=new Post('items');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('items',array(
			'model'=>$model,
		));
	}

			public function actionAuctions()
	{
		$model=new Post('auctions');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('auctions',array(
			'model'=>$model,
		));
	}

	public function actionJobs()
	{
		$model=new Post('jobs');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('jobs',array(
			'model'=>$model,
		));
	}

	public function actionThreads()
	{
		$model=new Post('jobs');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('threads',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Post the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Post $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
