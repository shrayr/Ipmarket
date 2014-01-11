<?php
/* @var $this AgencyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Agencies',
);

$this->menu=array(
	array('label'=>'Create Agency', 'url'=>array('create')),
	array('label'=>'Manage Agency', 'url'=>array('admin')),
);
?>

<h1>Agencies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
