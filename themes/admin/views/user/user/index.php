<?php
$this->breadcrumbs=array(
	UserModule::t("Users"),
);
if(UserModule::isAdmin()) {
	$this->menu=array(
		array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
		array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
		array('label'=>UserModule::t('List Author User'), 'url'=>array('/user/default/index/s/Author')),
		array('label'=>UserModule::t('List Customer User'), 'url'=>array('/user/default/index/s/Customer')),
	);
}elseif( true ) {
	$this->menu=array(
		array('label'=>UserModule::t('List Author User'), 'url'=>array('/user/default/index/s/Author')),
		array('label'=>UserModule::t('List Customer User'), 'url'=>array('/user/default/index/s/Customer')),
	);
}
$this->widget('zii.widgets.CMenu', array(
	'items'=>$this->menu,
	'htmlOptions'=>array('class'=>'operations'),
));

echo '<h1>'.UserModule::t("List User").'</h1>';
switch ($_GET['s']) {
	case 'Author':
		echo '<h2>'.UserModule::t("List Author User").'</h2>';
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'itemGrid',
			'dataProvider'=>$dataProvider,
			'columns'=>array(
				'id',
				array(
					'name' => UserModule::t("username"),
					'type'=>'raw',
					'value' => 'CHtml::link(CHtml::encode($data["username"]),array("admin/view","id"=>$data["id"]))',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("Full name"),
					'value'=>'$data["full_name"]',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("E-mail"),
					'value'=>'CHtml::link(CHtml::encode($data["email"]),array("admin/view","id"=>$data["id"]))',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("Phone"),
					'value'=>'$data["phone_number"]',
				),
				/*array(
					'type'=>'raw',
					'name'=>UserModule::t("Cat name"),
					'value'=>'$data["cat_name"]',
				),*/
			),
		));
		break;
	default:
		echo '<h2>'.UserModule::t("List Customer User").'</h2>';
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'columns'=>array(
				array(
					'type'=>'raw',
					'header'=>UserModule::t("Full name"),
					'name'=>'full_name',
					'value'=>'$data->full_name',
				),
				array(
					'header' => UserModule::t("username"),
					'name' => 'username',
					'type'=>'raw',
					'value' => 'CHtml::link(CHtml::encode($data->username),array("admin/view","id"=>$data->id))',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("E-mail"),
					'value'=>'CHtml::link(CHtml::encode($data["email"]),array("admin/view","id"=>$data["id"]))',
				),
				array(
					'type'=>'raw',
					'header'=>UserModule::t("Phone"),
					'name'=>'phone_number',
					'value'=>'$data->phone_number',
				),
			),
		));
		break;
}
