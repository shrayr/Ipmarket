<?php
/* @var $this SitesController */
/* @var $model Sites */

$this->breadcrumbs=array(
	'Sites'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Sites', 'url'=>array('index')),
	array('label'=>'Create Sites', 'url'=>array('create')),
	array('label'=>'Update Sites', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sites', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sites', 'url'=>array('admin')),
);
?>

<h1>View Sites #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'type',
		'visits',
		'circle_link',
		'cost_price_type',
		'cost_price_value',
	),
)); ?>
