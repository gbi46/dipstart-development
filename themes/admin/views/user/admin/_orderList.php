<div class="orders">
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'order-grid',
		'dataProvider'=>new CArrayDataProvider($model->zakaz),
		'columns'=>array(
			array(
				'name' => 'id',
				'type'=>'raw',
				'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
			),
			array(
				'name' => 'title',
				'type'=>'raw',
				'value' => 'CHtml::link(UHtml::markSearch($data,"title"),array("admin/update","id"=>$data->id))',
			),
			array(
				'name'=>'status',
				'type'=>'raw',
				'value' => 'CHtml::link(UHtml::markSearch($data,"status"),array("admin/update","id"=>$data->id))',
			),
		),
	)); ?>
</div>