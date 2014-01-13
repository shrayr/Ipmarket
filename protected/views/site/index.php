<h2 style="text-align: center">Ip Marketing</h2>
<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/jquery-1.10.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxcore.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxchart.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdata.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxbuttons.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxscrollbar.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxmenu.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxcheckbox.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxlistbox.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdropdownlist.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.sort.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.pager.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.edit.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.selection.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.aggregates.js');
$cs->registerScriptFile($baseUrl . '/js/gettheme.js');
$cs->registerCssFile($baseUrl . '/js/jqwidgets/styles/jqx.base.css');?>
<script type="text/javascript">
$(document).ready(function () {
    var overallBudget;
    var overallBudgetAgency;
    var overallBudgetVat;
    var overallviewForecast;
    var overallCPM;
    var overallClicks;
    var overallCPC;
    var overallAgencyFee;

    var theme = getDemoTheme();
    // prepare the data
    var data = {};
    /*
     * get sites from db
     * */
    var sitesSource =
    {
        datatype: "json",
        datafields: [
            { name: 'id' },
            { name: 'name' },
            { name: 'url' },
            { name: 'visits' },
            { name: 'type' }
        ],
        url: 'index.php?r=site/GetSites',
        async: false
    };
    var sitesAdapter = new $.jqx.dataAdapter(sitesSource);
    $("#allSites").jqxDropDownList({
        selectedIndex: 0, source: sitesAdapter, displayMember: "name", valueMember: "id", width: 200, height: 25, theme: theme
    });

    var currentSiteId = $('#allSites').jqxDropDownList('getSelectedItem');
    /*
     *  get current site banners from db
     * */
    var bannersSource =
    {
        datatype: "json",
        datafields: [
            { name: 'id' },
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
            { name: 'photo' }
        ],
        url: 'index.php?r=site/GetBanners&id=' + currentSiteId.value,
        async: false
    };
    var bannersAdapter = new $.jqx.dataAdapter(bannersSource);
    $("#siteBanners").jqxDropDownList({
        selectedIndex: 0, source: bannersAdapter, displayMember: "name", valueMember: "id", width: 200, height: 25, theme: theme
    });

    /*
     * Change banners
     * */
    $('#allSites').on('change', function (event) {
        var args = event.args;
        if (args) {
            var bannersSource =
            {
                datatype: "json",
                datafields: [
                    { name: 'id' },
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
                    { name: 'ctr' }
                ],
                url: 'index.php?r=site/GetBanners&id=' + args.item.value,
                async: false
            };
            var bannersAdapter = new $.jqx.dataAdapter(bannersSource);
            $("#siteBanners").jqxDropDownList({
                selectedIndex: 0, source: bannersAdapter, displayMember: "name", valueMember: "id", width: 200, height: 25, theme: theme
            });
        }
    });


    var dataAdapter = new $.jqx.dataAdapter();

    var generaterow = function (i) {
        var row = {};
        var currentSite = $("#allSites").jqxDropDownList('getSelectedItem').originalItem;
        var currentBanner = $("#siteBanners").jqxDropDownList('getSelectedItem').originalItem;
        row['website_type'] = currentSite.type;
        row['website'] = currentSite.name;
        row['visits'] = currentSite.visits;
        row['ad_type'] = currentBanner.type;
        row['placement'] = currentBanner.placement;
        row['placement_type'] = currentBanner.placement_type;
        row['price'] = currentBanner.price_amd + '/' + currentBanner.duration;
        row['duration'] = '1';
        row['total'] = currentBanner.price_amd;
        row['total_vat'] = parseInt(currentBanner.price_amd) + parseInt(currentBanner.price_amd * 20 / 100);
        row['view'] = parseInt(parseInt(currentSite.visits) * 80 / 100);
        row['cpm'] = row['total'] / row['view'] * 1000;
        row['ctr'] = 0.08;
        row['clicks'] = row['view'] * row['ctr'];
        row['cpc'] = row['total'] * row['clicks'];
        return row;
    }
    var row = generaterow(0);
    data[0] = row;

    var source =
    {
        localdata: dataAdapter,
        datatype: "local",
        datafields: [
            { name: 'website_type', type: 'string' },
            { name: 'website', type: 'string' },
            { name: 'ad_type', type: 'string' },
            { name: 'placement', type: 'string' },
            { name: 'placement_type', type: 'string' },
            { name: 'visits', type: 'number' },
            { name: 'price', type: 'string' },
            { name: 'view', type: 'number' },
            { name: 'duration', type: 'number' },
            { name: 'total', type: 'number' },
            { name: 'total_vat', type: 'number' },
            { name: 'cpm', type: 'number' },
            { name: 'ctr', type: 'number' },
            { name: 'clicks', type: 'number' },
            { name: 'cpc', type: 'number' }
        ],
        addrow: function (rowid, rowdata, position, commit) {
            // synchronize with the server - send insert command
            // call commit with parameter true if the synchronization with the server is successful
            //and with parameter false if the synchronization failed.
            // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
            commit(true);
        },
        deleterow: function (rowid, commit) {
            // synchronize with the server - send delete command
            // call commit with parameter true if the synchronization with the server is successful
            //and with parameter false if the synchronization failed.
            commit(true);
        },
        updaterow: function (rowid, newdata, commit) {
            // synchronize with the server - send update command
            // call commit with parameter true if the synchronization with the server is successful
            // and with parameter false if the synchronization failed.
            commit(true);
        }
    };
    // initialize jqxGrid
    $("#jqxgrid").jqxGrid(
        {
            width: 1600,
            showstatusbar: true,
            statusbarheight: 50,
            autoheight: true,
            editable: true,
            theme: theme,
            showaggregates: true,
            selectionmode: 'singlecell',
            columns: [
                { text: 'Website Type', datafield: 'website_type', width: 100},
                { text: 'Website', datafield: 'website', width: 100},
                { text: 'Ad Type', datafield: 'ad_type', width: 100},
                { text: 'Placement', datafield: 'placement', width: 100},
                { text: 'Placement Type', datafield: 'placement_type', width: 100},
                { text: 'Visits per month', datafield: 'visits', width: 100},
                { text: 'Price', datafield: 'price', width: 100},
                { text: 'View forecast', datafield: 'view', width: 100, aggregates: ['sum']},
                { text: 'Duration', datafield: 'duration', width: 100},
                { text: 'Total', datafield: 'total', width: 100, aggregates: ['sum']},
                { text: 'Total incl. VAT', datafield: 'total_vat', width: 100, aggregates: ['sum']},
                { text: 'CPM', datafield: 'cpm', width: 125, aggregates: [
                    { 'Total': function (aggregatedValue, currentValue, column, record) {
                        var totalPrice = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'total', ['sum']).sum;
                        var totalView = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'view', ['sum']).sum;
                        overallCPM = totalPrice / totalView * 1000;
                        return overallCPM;
                    }
                    }
                ]
                }, //total/view*1000
                { text: 'CTR', datafield: 'ctr', width: 125, aggregates: ['avg']},
                { text: 'Clicks', datafield: 'clicks', width: 125, aggregates: ['sum']},
                { text: 'CPC', datafield: 'cpc', width: 125, aggregates: [
                    { 'Total': function (aggregatedValue, currentValue, column, record) {
                        var totalPrice = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'total', ['sum']).sum;
                        var totalView = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'view', ['sum']).sum;
                        overallCPC = totalPrice / (totalPrice / totalView * 1000);
                        return overallCPC;
                    }
                    }
                ]}
            ]
        });

    $("#addrowbutton").jqxButton({ theme: theme });
    $("#deleterowbutton").jqxButton({ theme: theme });
    // update row.
    $("#updaterowbutton").on('click', function () {
        var datarow = generaterow();
        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
        var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
            var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
            var commit = $("#jqxgrid").jqxGrid('updaterow', id, datarow);
            $("#jqxgrid").jqxGrid('ensurerowvisible', selectedrowindex);
        }
    });
    // create new row.
    $("#addrowbutton").on('click', function () {
        var datarow = generaterow();
        var commit = $("#jqxgrid").jqxGrid('addrow', null, datarow);

        /* create clicks forecast chart */
        var rows = $('#jqxgrid').jqxGrid('getrows', 'clicks');
        var result = {};
        var data = new Array();
        var totalClicks = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'clicks', ['sum']).sum;
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            result['name'] = row.website;
            result['value'] = (row.clicks * 100) / totalClicks;
            data[i] = result;
            result = {};
        }

        var dataAdapter4 = new $.jqx.dataAdapter(data, { async: false, autoBind: true });
        var settings = {
            title: "Clicks, forecast",
            enableAnimations: true,
            showLegend: true,
            legendPosition: { left: 140, top: 140, width: 100, height: 100 },
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: dataAdapter4,
            colorScheme: 'scheme02',
            showBorderLine: 'false',
            seriesGroups: [
                {
                    type: 'pie',
                    showLabels: true,
                    series: [
                        {
                            dataField: 'value',
                            displayText: 'name',
                            labelRadius: 100,
                            initialAngle: 15,
                            radius: 130,
                            centerOffset: 0,
                            formatSettings: { sufix: '%', decimalPlaces: 1 }
                        }
                    ]
                }
            ]
        };
        // setup the chart
        $('#clicksChart').jqxChart(settings);


        /* create view forecast chart */
        var rows = $('#jqxgrid').jqxGrid('getrows', 'view');
        var result = {};
        var data = new Array();
        var totalViews = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'view', ['sum']).sum;
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            result['name'] = row.website;
            result['value'] = (row.view * 100) / totalViews;
            data[i] = result;
            result = {};
        }

        var dataAdapter5 = new $.jqx.dataAdapter(data, { async: false, autoBind: true });
        var settings = {
            title: "View forecast",
            enableAnimations: true,
            showLegend: true,
            legendPosition: { left: 140, top: 140, width: 100, height: 100 },
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: dataAdapter5,
            colorScheme: 'scheme01',
            showBorderLine: 'false',
            seriesGroups: [
                {
                    type: 'pie',
                    showLabels: true,
                    series: [
                        {
                            dataField: 'value',
                            displayText: 'name',
                            labelRadius: 100,
                            initialAngle: 15,
                            radius: 130,
                            centerOffset: 0,
                            formatSettings: { sufix: '%', decimalPlaces: 1 }
                        }
                    ]
                }
            ]
        };
        // setup the chart
        $('#viewsChart').jqxChart(settings);


        /* create CPM chart */
        var rows = $('#jqxgrid').jqxGrid('getrows', 'view');
        var result = {};
        var data = new Array();
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            result['name'] = row.website;
            result['value'] = row.cpm;
            data[i] = result;
            result = {};
        }

        var dataAdapter6 = new $.jqx.dataAdapter(data, { async: false, autoBind: true });
        var settings = {
            title: "CPM",
            enableAnimations: true,
            showLegend: true,
            legendPosition: { left: 140, top: 140, width: 100, height: 100 },
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: dataAdapter6,
            colorScheme: 'scheme01',
            showBorderLine: 'false',
            categoryAxis:
            {
                dataField: 'name',
                showGridLines: true,
                flip: false
            },
            seriesGroups: [
                {
                    type: 'column',
                    columnsGapPercent: 100,
                    valueAxis:
                    {
                        unitInterval: 0.01,
                        maxValue:0.05,
                        displayValueAxis: true,
                        description: 'CPM'
                    },
                    series: [
                        { dataField: 'value', displayText: 'CPM'}
                    ]
                },
            ]
        };
        // setup the chart
        $('#cpmChart').jqxChart(settings);


        /* create CPC chart */
        var rows = $('#jqxgrid').jqxGrid('getrows', 'view');
        var result = {};
        var data = new Array();
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            result['name'] = row.website;
            result['value'] = row.cpc;
            data[i] = result;
            result = {};
        }

        var dataAdapter7 = new $.jqx.dataAdapter(data, { async: false, autoBind: true });
        var settings = {
            title: "CPC,forecast AMD",
            enableAnimations: true,
            showLegend: true,
            legendPosition: { left: 140, top: 140, width: 100, height: 100 },
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: dataAdapter7,
            colorScheme: 'scheme01',
            showBorderLine: 'false',
            categoryAxis:
            {
                dataField: 'name',
                showGridLines: true,
                flip: false
            },
            seriesGroups: [
                {
                    type: 'column',
                    columnsGapPercent: 100,
                    valueAxis:
                    {
                        unitInterval: 1000,
                        maxValue:10000,
                        displayValueAxis: true,
                        description: 'CPC, forecast AMD'
                    },
                    series: [
                        { dataField: 'value', displayText: 'CPC, forecast AMD'}
                    ]
                },
            ]
        };
        // setup the chart
        $('#cpcChart').jqxChart(settings);


        // overalls
        $('#CPC-1').text(overallCPC);
        $('#CPM-1').text(overallCPM);
        $('#clicks-1').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'clicks', ['sum'], true).sum);
        $('#overallBudget').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'total', ['sum'], true).sum);
        $('#overallBudgetVat').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'total_vat', ['sum'], true).sum);
        $('#overallBudgetAgency').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'total', ['sum'], true).sum);
        $('#viewForecast-1').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'view', ['sum'], true).sum);
    });

    // delete row.
    $("#deleterowbutton").on('click', function () {
        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
        var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
            var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
            var commit = $("#jqxgrid").jqxGrid('deleterow', id);
        }
    });
});
</script>
<div>
    <p><strong>Campaign overall statistics:</strong></p>
    <p>Campaign overall budjet (without VAT):	<span id="overallBudget"></span></p>
    <p>Campaign overall budjet including agency fee (without VAT):	<span id="overallBudgetAgency"></span></p>
    <p>Campaign overall budjet including agency fee (with VAT):	<span id="overallBudgetVat"></span></p>
    <p><strong>Campaign media statistics:</strong></p>
    <p>Contacts forecast:	<span id="viewForecast-1"></span></p>
    <p>Average cost of 1000 views (CPM):	<span id="CPM-1"></span></p>
    <p>Forecast of number of clicks:	<span id="clicks-1"></span></p>
    <p>Forecast of cost per click (CPC):	<span id="CPC-1"></span></p>
    <p>Agency fee:	<span id="agencyFee"></span></p>
</div>
<div style="overflow-y: scroll;">
    <div style="float: left;" id="jqxgrid">
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        <div id='allSites'>
        </div>
    </div>
    <div class="form-group">
        <div id='siteBanners'>
        </div>
    </div>
    <div class="form-group">
        <input id="addrowbutton" type="button" value="Add New Row"/>
    </div>
    <div class="form-group">
        <input id="deleterowbutton" type="button" value="Delete Selected Row"/>
    </div>
</div>
<div id="charts">
    <div id='clicksChart' style="float:left;width: 420px; height: 400px; position: relative; left: 0px;top: 0px;">
    </div>
    <div id='viewsChart' style="float:right;width: 420px; height: 400px; position: relative; left: 0px;top: 0px;">
    </div>
    <div id='cpmChart' style="float:left;width: 420px; height: 400px; position: relative; left: 0px;top: 0px;">
    </div>
    <div id='cpcChart' style="float:right;width: 420px; height: 400px; position: relative; left: 0px;top: 0px;">
    </div>
</div>
