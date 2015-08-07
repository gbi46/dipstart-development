<?php //Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<div class="row white-block">
<?php
/* @var $this CategoriesController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	Yii::t('site','Catalog'),
//);

$this->menu=array(
	array('label'=>Yii::t('site','Catalog'), 'url'=>array('create')),
	array('label'=>Yii::t('site','Manage Catalog'), 'url'=>array('admin')),
);
?>

<h1><?echo Yii::t('site','Catalog');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>