<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
	<?php if(Yii::app()->user->hasFlash('companySuccessMessage'))
		echo '<p class="success">'.Yii::app()->user->getFlash('companySuccessMessage').'</p>';
	if(Yii::app()->user->hasFlash('companyErrorMessage'))
		echo $form->errorSummary($model);
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'domains'); ?>
		<?php echo $form->textField($model,'domains',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'domains'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php //echo $form->textField($model,'language',array('size'=>10,'maxlength'=>2)); ?>
		<?php echo $form->dropDownList($model, 'language', array('en'=>'en','ru'=>'ru'), array('selected'=>$model->language /*,'empty' => ProjectModule::t('Select a language')*/,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'supportEmail'); ?>
		<?php echo $form->textField($model,'supportEmail',array('size'=>60,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'supportEmail'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'PaymentCash'); ?>
		<?php echo $form->checkBox($model,'PaymentCash'); ?>
		<?php echo $form->error($model,'PaymentCash'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Payment2Chekout'); ?>
		<?php echo $form->textField($model,'Payment2Chekout',array('size'=>60,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'Payment2Chekout'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Payment2ChekoutHash'); ?>
		<?php echo $form->textField($model,'Payment2ChekoutHash',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Payment2ChekoutHash'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'FrontPage'); ?>
		<?php echo $form->textField($model,'FrontPage',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'FrontPage'); ?>
	</div>
	<div class="row">
		<?php echo CHtml::image(Yii::app()->getBaseUrl(/*true*/) . '/' . $model->getFilesPath() . '/' . $model->logo, 'logo'); ?><br />
		<?php echo CHtml::label(ProjectModule::t('Attach file'), 'fileupload'); ?>
		<?php echo CHtml::fileField('Campaign[fileupload]', '', array('class' => 'col-xs-12 btn btn-user')); ?>
		<?php echo $form->error($model,'fileupload'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'header'); ?>
		<?php echo $form->textArea($model,'header',array('rows'=>12, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'header'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'WebmasterFirstOrderRate'); ?>
		<?php echo $form->textField($model,'WebmasterFirstOrderRate',array('size'=>60,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'WebmasterFirstOrderRate'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'WebmasterSecondOrderRate'); ?>
		<?php echo $form->textField($model,'WebmasterSecondOrderRate',array('size'=>60,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'WebmasterSecondOrderRate'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton(UserModule::t('Save')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->