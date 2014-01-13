<?php
/* @var $this PlacementController */
/* @var $model Placement */

$this->breadcrumbs=array(
	'Placements'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Placement', 'url'=>array('index')),
	array('label'=>'Create Placement', 'url'=>array('create')),
	array('label'=>'Update Placement', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Placement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Placement', 'url'=>array('admin')),
);
?>

<h1>View Placement #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
