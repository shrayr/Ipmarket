<?php
/* @var $this AgencyController */
/* @var $model Agency */

$this->breadcrumbs=array(
	'Agencies'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Agency', 'url'=>array('index')),
	array('label'=>'Create Agency', 'url'=>array('create')),
	array('label'=>'Update Agency', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Agency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Agency', 'url'=>array('admin')),
);
?>

<h1>View Agency #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'discount',
	),
)); ?>
