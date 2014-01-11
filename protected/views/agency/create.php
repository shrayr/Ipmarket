<?php
/* @var $this AgencyController */
/* @var $model Agency */

$this->breadcrumbs=array(
	'Agencies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Agency', 'url'=>array('index')),
	array('label'=>'Manage Agency', 'url'=>array('admin')),
);
?>

<h1>Create Agency</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>