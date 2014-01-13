<?php
/* @var $this MediaTypeController */
/* @var $model MediaType */

$this->breadcrumbs=array(
	'Media Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MediaType', 'url'=>array('index')),
	array('label'=>'Create MediaType', 'url'=>array('create')),
	array('label'=>'View MediaType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MediaType', 'url'=>array('admin')),
);
?>

<h1>Update MediaType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>