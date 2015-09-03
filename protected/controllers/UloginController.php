<?php

class UloginController extends Controller
{

    public function actionLogin($role = 'Customer') {
        if (isset($_POST['token'])) {
            $ulogin = new UloginModel();
            $ulogin->setAttributes($_POST);
            $ulogin->getAuthData();
            if ($ulogin->validate() && $ulogin->login($role)) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
            else {

                $this->render('error');
            }
        }
        else {

            $this->redirect(Yii::app()->homeUrl, true);
        }
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}