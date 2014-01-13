<?php
/* @var $this MediaTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Media Types',
);

$this->menu=array(
	array('label'=>'Create MediaType', 'url'=>array('create')),
	array('label'=>'Manage MediaType', 'url'=>array('admin')),
);
?>

<h1>Media Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
