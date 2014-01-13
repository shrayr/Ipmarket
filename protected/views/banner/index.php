<?php
/* @var $this BannerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Banners',
);

$this->menu=array(
	array('label'=>'Create Banner', 'url'=>array('create')),
	array('label'=>'Manage Banner', 'url'=>array('admin')),
);
?>

<h1>Banners</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'enableSorting'=>1,
    'sortableAttributes'=>array(
        'site_id',
    ),
)); ?>
