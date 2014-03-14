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
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/scripts/jquery-1.10.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxcore.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdata.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxbuttons.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxscrollbar.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdatatable.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxtreegrid.js');
$cs->registerScriptFile($baseUrl . '/js/scripts/demos.js');

?>
<link rel="stylesheet" href="../../js/jqwidgets/styles/jqx.base.css" type="text/css"/>
<style>
    .jqx-tree-grid-icon, .jqx-tree-grid-icon-size {
        height: 16px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        var data = '<?php echo $allBanners; ?>'
        // prepare the data
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'site_name' },
                { name: 'name' },
                { name: 'size' },
                { name: 'price_amd' },
                { name: 'price_us' },
                { name: 'price_rur' },
                { name: 'duration' },
                { name: 'placement' },
                { name: 'placement_type' },
                { name: 'type' },
                { name: 'price_type' },
                { name: 'photo' },
                { name: 'pageview' }
            ],
            hierarchy:
            {
                groupingDataFields:
                    [
                        {
                            name: "site_name"
                        }
                    ]
            },
            localData: data

        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        console.log(dataAdapter);
        // create data adapter.
        // perform Data Binding.
        dataAdapter.dataBind();
        // get the tree items. The first parameter is the item's id. The second parameter is the parent item's id. The 'items' parameter represents
        // the sub items collection name. Each jqxTree item has a 'label' property, but in the JSON data, we have a 'text' field. The last parameter
        // specifies the mapping between the 'text' and 'label' fields.
        $("#treeGrid").jqxTreeGrid(
            {
                width: 680,
                source: dataAdapter,
                pageable: true,
                columnsResize: true,
                altRows: true,
                ready: function () {
                    $("#treeGrid").jqxTreeGrid('expandRow', "0");
                },
                columns: [
                    { text: 'Site name', dataField: 'site_name', width: 150 },
                    { text: 'Banner name', dataField: 'name', width: 120 },
                    { text: 'Type', dataField: 'type', width: 160 },
                    { text: 'Photo', editable:false, dataField: 'photo', cellsRenderer: function (row, column, value) {
                        return "<a href='../images/banners/"+value+"' target='_blank'>Logo</a>";
                    } },
                    { text: 'Duration', dataField: 'duration', cellsFormat: 'd', width: 120 }
                ]
            });
    });
</script>

<div id='treeGrid'>
</div>
