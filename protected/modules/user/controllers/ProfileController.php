<?php

class ProfileController extends Controller
{
	public $defaultAction = 'profile';
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		$model = $this->loadUser();
	    $this->redirect('/');
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$model = $this->loadUser();
		$profile=$model->profile;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
                //Yii::app()->user->updateSession();
				Yii::app()->user->setFlash('profileMessage',UserModule::t("Changes is saved."));
				$this->redirect(array('/user/profile'));
			} else $profile->validate();
		}

		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
	
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = UserModule::encrypting($model->password);
						$new_password->activkey=UserModule::encrypting(microtime().$model->password);
						$new_password->save();
						Yii::app()->user->setFlash('profileMessage',UserModule::t("New password is saved."));
						$this->redirect(array("profile"));
					}
			}
			$this->render('changepassword',array('model'=>$model));
	    }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
    
    /*
     * отображение денежных средств
     * отображаем только для автора\заказчика
     */
    public function actionAccount()
    {
        
        if (User::model()->isCustomer()) {
            
            $sql = 'SELECT SUM(project_price) AS project_price, SUM(to_receive) AS to_receive, SUM(received) AS received FROM `ProjectPayments` WHERE order_id IN (SELECT id FROM Projects WHERE user_id = :user_id)';
            
            $columns = [
                'project_price',
                'to_receive',
                'received'
            ];
            
        } elseif (User::model()->isAuthor()) {
            
            $sql = 'SELECT SUM(work_price) AS work_price, SUM(to_pay) AS to_pay FROM `ProjectPayments` WHERE order_id IN (SELECT id FROM Projects WHERE executor = :user_id)';
            
            $columns = [
                'work_price',
                'to_pay'
            ];
            
        } else {
            throw new CHttpException(500);
        }
        
        $command = Yii::app()->db->createCommand($sql);
        $command->params = [':user_id'=>Yii::app()->user->id];
        $result = $command->queryRow();
        
        foreach ($columns as $column) {
            $params[$column] = (int)$result[$column];
        }
        
        $this->render('account', $params);
    }
}