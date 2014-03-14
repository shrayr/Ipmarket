<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Banner', 'url'=>array('index')),
	array('label'=>'Create Banner', 'url'=>array('create')),
	array('label'=>'View Banner', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Banner', 'url'=>array('admin')),
);
?>

<h1>Update <?php echo $sitename." ".$model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>