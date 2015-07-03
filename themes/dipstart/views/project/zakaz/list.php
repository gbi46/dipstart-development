<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	ProjectModule::t('List'),
);

?>

<h1><?=ProjectModule::t('Zakazs')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'zakaz-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'id',
		'title',
		array(
           'name' => 'category_id',
           'type' => 'raw',
           'value' => 'isset($data->category) ? $data->category->cat_name : null'
        ),
		array(
           'name' => 'job_id',
           'type' => 'raw',
           'value' => 'isset($data->job) ? $data->job->job_name : null'
        ),
		[
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("чат", ["/project/chat", "orderId"=>$data->id])'
        ],
	),
    'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
    'selectionChanged'=>"js:function(sel_id){
        document.location.href='".Yii::app()->createUrl('/project/chat',array('orderId'=>''))."'+$('#'+sel_id).find('.selected').children().first().text();
    }",
)); ?>