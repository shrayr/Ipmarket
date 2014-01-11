<?php
/* @var $this AgencyController */
/* @var $model Agency */

$this->breadcrumbs=array(
	'Agencies'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Agency', 'url'=>array('index')),
	array('label'=>'Create Agency', 'url'=>array('create')),
	array('label'=>'View Agency', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Agency', 'url'=>array('admin')),
);
?>

<h1>Update Agency <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>