<?php
/* @var $this SitesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sites',
);

$this->menu=array(
	array('label'=>'Create Sites', 'url'=>array('create')),
	array('label'=>'Manage Sites', 'url'=>array('admin')),
);
?>

<h1>Sites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
