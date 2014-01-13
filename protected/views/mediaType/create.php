<?php
/* @var $this MediaTypeController */
/* @var $model MediaType */

$this->breadcrumbs=array(
	'Media Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MediaType', 'url'=>array('index')),
	array('label'=>'Manage MediaType', 'url'=>array('admin')),
);
?>

<h1>Create MediaType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>