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

<?php
$columns = array(
    array(
        'header'=>CHtml::encode('Site'),
        'name'=>'site.name',
    ),array(
        'header'=>CHtml::encode('Name'),
        'name'=>'name',
    ),array(
        'header'=>CHtml::encode('Price AMD'),
        'name'=>'price_amd',
    ),array(
        'header'=>CHtml::encode('Price RU'),
        'name'=>'price_rur',
    ),
    array(
        'header'=>CHtml::encode('Page view'),
        'name'=>'pageview',
    ),
);

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'columns'=>$columns,

)); ?>
