<?php
/* @var $this MediaTypeController */
/* @var $model MediaType */

$this->breadcrumbs=array(
	'Media Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MediaType', 'url'=>array('index')),
	array('label'=>'Create MediaType', 'url'=>array('create')),
	array('label'=>'Update MediaType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MediaType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MediaType', 'url'=>array('admin')),
);
?>

<h1>View MediaType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
