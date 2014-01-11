<?php
/* @var $this SitesController */
/* @var $model Sites */

$this->breadcrumbs=array(
	'Sites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sites', 'url'=>array('index')),
	array('label'=>'Manage Sites', 'url'=>array('admin')),
);
?>

<h1>Create Sites</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>