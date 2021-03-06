<?php
/* @var $this ProjectStatusController */
/* @var $model ProjectStatus */

$this->breadcrumbs=array(
	//Yii::t('site','Project Statuses')=>array('index'),
	Yii::t('site','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('site','Create ProjectStatus'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#project-status-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('site','Manage ProjectStatus')?></h1>

<p>
<?=Yii::t('site','You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.')?>
</p>

<?php echo CHtml::link(Yii::t('site','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-status-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
