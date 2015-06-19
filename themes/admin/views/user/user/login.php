<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');?>
<div class="col-xs-offset-3 col-xs-6 login-form-bg">
<h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<!-- form begin-->
<form method="post" role="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="form-group">
        <?php echo CHtml::activeLabelEx($model,'username'); ?> <br />
		<?php echo CHtml::activeTextField($model,'username') ?>
	</div>
	
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($model,'password'); ?> <br />
		<?php echo CHtml::activePasswordField($model,'password') ?>
	</div>
	
	<div>
		<p class="hint">
		<?php echo UserModule::t("Register")
                   .'&nbsp;('. CHtml::link(UserModule::t("Customer"), array('/user/registration','role' => 'Customer'))
                   .'&nbsp;'. CHtml::link(UserModule::t("Author"), array("/user/registration","role" => "Author")) . ')<br />'; ?>
                   <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
	<div class="rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="nova-btn">
		<?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'btn btn-primary')); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div>
</form>
<!-- form end-->

<?php /*
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
*/?>
</div>