<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Banner', 'url'=>array('index')),
	array('label'=>'Create Banner', 'url'=>array('create')),
	array('label'=>'Update Banner', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Banner', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Banner', 'url'=>array('admin')),
);
?>

<h1>View Banner #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'site_id',
		'name',
		'size',
		'photo',
		'price_amd',
		'price_us',
		'price_rur',
		'duration',
		'placement',
		'type',
	),
)); ?>
