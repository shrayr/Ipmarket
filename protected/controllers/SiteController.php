<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
 /*       $inputFileType = 'Excel2007';
        $inputFileName = Yii::app()->basePath.'/../YiiExcel1.xlsx';
////var_dump($inputFileName); exit;
//        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
//        $objPHPExcel = $objReader->load($inputFileName);
//
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
//        $objWriter->save('php://output');

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($inputFileName);
        //      $objWorksheet = $objPHPExcel->setActiveSheetIndex(1);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $a='<table class="table-bordered">' . "\n";
        foreach ($objWorksheet->getRowIterator() as $row) {
            $a.='<tr>' . "\n";
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            // even if it is not set.
            // By default, only cells
            // that are set will be
            // iterated.
            foreach ($cellIterator as $cell) {
                $a.='<td>' . $cell->getValue() . '</td>' . "\n";
            }
            $a.= '</tr>' . "\n";
        }
        $a.='</table>' . "\n";*/
        $this->render('index');
    }

    public function actionMedia()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('media');
	}

    public function actionGetSites()
	{
        header('Content-Type: application/json; charset="UTF-8"');
        $model= new Sites();

        echo CJSON::encode($model->findAll());
	}

    public function actionGetBanners()
	{
        $id=$_GET['id'];
        header('Content-Type: application/json; charset="UTF-8"');
        $model= new Banner();
        $criteria = new CDbCriteria;
        $criteria->condition = '`site_id` ='.$id;
        echo CJSON::encode($model->findAll($criteria));
	}

    public function actionGetProducts()
	{
        header('Content-Type: application/json; charset="UTF-8"');
        $model= new Product();

        echo CJSON::encode($model->findAll());
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}