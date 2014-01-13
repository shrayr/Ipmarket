<?php
/* @var $this PlacementController */
/* @var $model Placement */

$this->breadcrumbs=array(
	'Placements'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Placement', 'url'=>array('index')),
	array('label'=>'Create Placement', 'url'=>array('create')),
	array('label'=>'View Placement', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Placement', 'url'=>array('admin')),
);
?>

<h1>Update Placement <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>