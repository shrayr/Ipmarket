<?php
/* @var $this SitesController */
/* @var $model Sites */

$this->breadcrumbs=array(
	'Sites'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sites', 'url'=>array('index')),
	array('label'=>'Create Sites', 'url'=>array('create')),
	array('label'=>'View Sites', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sites', 'url'=>array('admin')),
);
?>

<h1>Update Sites <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>