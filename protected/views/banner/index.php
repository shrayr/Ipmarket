<?php
/* @var $this BannerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Banners',
);

$this->menu = array(
    array('label' => 'Create Banner', 'url' => array('create')),
    array('label' => 'Manage Banner', 'url' => array('admin')),
);
?>

<h1>Banners</h1>

<?php
$columns = array(
    array(
        'header' => CHtml::encode('Site'),
        'name' => 'site.name',
    ), array(
        'header' => CHtml::encode('Name'),
        'name' => 'name',
    ), array(
        'header' => CHtml::encode('Price AMD'),
        'name' => 'price_amd',
    ), array(
        'header' => CHtml::encode('Price RUR'),
        'name' => 'price_rur',
    ),
    array(
        'header' => CHtml::encode('Price USD'),
        'name' => 'price_us',
    ),
    array(
        'header' => CHtml::encode('Page view'),
        'name' => 'pageview',
    ),
);

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => $columns,
    'enableSorting' => false,
    'htmlOptions'=>array('style'=>'cursor: pointer;'),
    'enablePagination' => false,
)); ?>

<script>
    $(document).ready(function () {
        var cats = [];
        $('#yw0 .items tbody tr').each(function () {
            var text = $(this).find("td:first-child").text();
            if ($.inArray(text, cats) === -1) {
                cats.push(text);
            } else {
                $(this).hide()
            }
        });
    });

    $('tr').click(function () {
        $(this).addClass('selected');
        var current = $(this).find("td:first-child").text();
        $('#yw0 .items tbody tr').each(function (index) {
            var text = $(this).find("td:first-child").text();
            if (text == current) {
                if (this.style.display == 'none') {
                    $(this).show();
                } else if ($(this).attr('class')!=='odd selected' && $(this).attr('class')!=='even selected'){
                    $(this).hide();
                }
            }
        });
    });


</script>


