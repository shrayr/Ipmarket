<h2 style="text-align: center">IP Marketing</h2>
<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/jquery-1.10.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxcore.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxchart.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdata.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxbuttons.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdatetimeinput.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxcalendar.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxtooltip.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/globalization/globalize.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxscrollbar.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxmenu.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxcheckbox.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxlistbox.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxradiobutton.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdropdownlist.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.sort.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.pager.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.edit.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxnumberinput.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxdata.export.js');
$cs->registerScriptFile($baseUrl . '/js/jqwidgets/jqxgrid.export.js');
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
    var currentDate = new Date();
    var theme = getDemoTheme();
    // prepare the data
    var data = {};
    var productData = {};
    /*
     * get sites from db
     * */

//////////// Global variables ///////////////////////

    $("#StartDate").jqxDateTimeInput({width: '200px', height: '25px'});
    var defaultDate = $('#StartDate').jqxDateTimeInput('value');
    $('#StartDate').on('valuechanged', function (event)
    {
        defaultDate = event.args.date;

        var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
        for (var i = 0; i < rowscount; i++)
        {
            $("#jqxgrid").jqxGrid('setcellvalue', i, 'start', defaultDate);
        }
    });


    var source =
    {
        datatype: "json",
        datafields: [
            { name: 'name' }
        ],
        url: 'index.php?r=client/GetClients',
        async: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    // Create a jqxDropDownList
    $("#ClientList").jqxDropDownList({
        selectedIndex: null, source: dataAdapter, displayMember: "name", width: 200, height: 25
    });

    var source =
    {
        datatype: "json",
        datafields: [
            { name: 'name' }
        ],
        url: 'index.php?r=agency/GetAgency',
        async: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    console.log(dataAdapter);
    // Create a jqxDropDownList
    $("#AgencyList").jqxDropDownList({
        selectedIndex: null, source: dataAdapter, displayMember: "name", width: 200, height: 25
    });

    $("#VATjqxRadioButton1").jqxRadioButton({ groupName: '1', width: 200, height: 25, checked: true});
    $("#VATjqxRadioButton2").jqxRadioButton({ groupName: '1', width: 200, height: 25 });

    var currency = ['AMD','RUR','USD'];
    var source =
    {
        localdata: currency,
        datatype: "array"
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $('#currency').jqxDropDownList({ selectedIndex: 0,  source: dataAdapter, displayMember: "", valueMember: "notes", itemHeight: 70, height: 25, width: 270
    });


    ///////////////////////// END GLOBAL var ///////////




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
     * get products from db
     * */
    var productsSource =
    {
        datatype: "json",
        datafields: [
            { name: 'id' },
            { name: 'name' },
            { name: 'price' },
            { name: 'cost_price' }
        ],
        url: 'index.php?r=site/GetProducts',
        async: false
    };
    var productsAdapter = new $.jqx.dataAdapter(productsSource);
    $("#allProducts").jqxDropDownList({
        selectedIndex: 0, source: productsAdapter, displayMember: "name", valueMember: "id", width: 200, height: 25, theme: theme
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
            { name: 'photo' },
            { name: 'pageview' }
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
                    { name: 'ctr' },
                    { name: 'pageview' }
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
        console.log(currentBanner);
        row['website_type'] = currentSite.type;
        row['website'] = currentSite.name;
        row['banner'] = currentBanner.name + ', ' + currentBanner.type +', ' + currentBanner.placement + ', ' + currentBanner.size;
        row['visits'] = currentSite.visits;
        row['ad_type'] = currentBanner.type;
        row['placement'] = currentBanner.placement;
        row['placement_type'] = currentBanner.placement_type;
        row['price'] = currentBanner.price_amd;   // + '/' + currentBanner.duration;
        row['start'] = defaultDate;
        row['duration'] = '1';
        row['discount'] = 0;
        row['total'] = (row['price']-(row['price']*row['discount']/100)) * row['duration'];
        row['total_vat'] = parseInt(row['total']*1.2);
        row['view'] = currentBanner.pageview;
        row['cpm'] = (row['total'] / row['view']) * 1000;
        row['ctr'] = 0.08;
        row['clicks'] = parseInt((row['view'] * row['ctr']));
        row['cpc'] = row['total'] / row['clicks'];
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
         //   { name: 'ad_type', type: 'string' },
       //     { name: 'placement', type: 'string' },
            { name: 'placement_type', type: 'string' },
            { name: 'visits', type: 'number' },
            { name: 'price', type: 'string' },
            { name: 'view', type: 'number' },
            { name: 'start', type: 'date'},
            { name: 'duration', type: 'number' },
            { name: 'discount', type: 'number' },
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
            columns: [
                { text: 'Website Type', datafield: 'website_type', width: 100, editable:false},
                { text: 'Website', datafield: 'website', width: 100, editable:false},
                { text: 'Banner, Ad type, Placement, Size', datafield: 'banner', width: 250},
              //  { text: 'Ad Type', datafield: 'ad_type', width: 100},
              //  { text: 'Placement', datafield: 'placement', width: 100},
                { text: 'Placement Type', datafield: 'placement_type', width: 100},
                { text: 'Visits per month', datafield: 'visits', cellsformat: 'n2', width: 100},
                { text: 'Price', datafield: 'price', cellsformat: 'n2', width: 100},
                { text: 'View forecast', datafield: 'view', cellsformat: 'n2', width: 130, aggregates: ['sum']},
                { text: 'Start', datafield: 'start', columntype: 'datetimeinput', editable: true, filterable: false, width: 110, align: 'right', cellsalign: 'right', cellsformat: 'dd/MM/yyyy'},
                { text: 'Duration', datafield: 'duration', width: 80, cellsformat: 'n2' },
                { text: 'Discount', datafield: 'discount', width: 80, cellsformat: 'n2' },
                { text: 'Total', datafield: 'total', width: 100,  cellsformat: 'n2', aggregates: ['sum'], editable:false},
                { text: 'Total incl. VAT', datafield: 'total_vat', cellsformat: 'n2', width: 100, aggregates: ['sum'], editable:false},
                { text: 'CPM', datafield: 'cpm', width: 125, editable:false, cellsformat: 'f2', aggregates: [
                    { 'Total': function (aggregatedValue, currentValue, column, record) {
                        var totalPrice = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'total', ['sum']).sum;
                        var totalView = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'view', ['sum']).sum;
                        overallCPM = parseFloat(totalPrice / totalView * 1000).toFixed(2);
                        return overallCPM;
                    }
                    }
                ]

                }, //total/view*1000
                { text: 'CTR', datafield: 'ctr', width: 125, aggregates: ['avg']},
                { text: 'Clicks', datafield: 'clicks', width: 125, cellsformat: 'n2', editable:false, aggregates: ['sum']},
                { text: 'CPC', datafield: 'cpc', width: 125, cellsformat: 'f2', editable:false, aggregates: [
                    { 'Total': function (aggregatedValue, currentValue, column, record) {
                        var totalPrice = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'total', ['sum']).sum;
                        var totalClicks = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'clicks', ['sum']).sum;
                        overallCPC = parseFloat(totalPrice / totalClicks).toFixed(2);
                        return overallCPC;
                    }
                    }
                ]}
            ]
        });



    $("#jqxgrid").bind('cellendedit', function (event) {
        var args = event.args;
        var rowIndex = args.rowindex;

        $("#jqxgrid").jqxGrid('setcellvalue', rowIndex, args.datafield, args.value);

        var discount = $("#jqxgrid").jqxGrid('getcellvalue', rowIndex, 'discount');
        var view = $("#jqxgrid").jqxGrid('getcellvalue', rowIndex, 'view');
        var price = $("#jqxgrid").jqxGrid('getcellvalue', rowIndex, 'price');
        var duration = $("#jqxgrid").jqxGrid('getcellvalue', rowIndex, 'duration');
        var ctr = $("#jqxgrid").jqxGrid('getcellvalue', rowIndex, 'ctr');
        var clicks = $("#jqxgrid").jqxGrid('getcellvalue', rowIndex, 'clicks');

        var total = duration*(price- discount*price/100);

        $("#jqxgrid").jqxGrid('setcellvalue', rowIndex, 'total', total);
        $("#jqxgrid").jqxGrid('setcellvalue', rowIndex, 'total_vat', total*1.2);
        $("#jqxgrid").jqxGrid('setcellvalue', rowIndex, 'cpm', (total/view)*1000);
        $("#jqxgrid").jqxGrid('setcellvalue', rowIndex, 'clicks', view*ctr);
        $("#jqxgrid").jqxGrid('setcellvalue', rowIndex, 'cpc', total/clicks);

        generatecharts();
        overalls();

    });


    /////////////////////////////////// EKAMUT  /////////////////////////////////////////

    $("#ekamut").jqxGrid(
        {
            width: 800,
            showstatusbar: true,
            statusbarheight: 50,
            autoheight: true,
            editable: true,
            theme: theme,
            showaggregates: true,
            columns: [
                { text: 'Website Type', datafield: 'website_type', width: 140, editable:false},
                { text: 'Website', datafield: 'website', width: 140, editable:false},

                { text: 'Total', datafield: 'total', width: 140,  cellsformat: 'n2', aggregates: ['sum'], editable:false},
                { text: 'Total incl. VAT', datafield: 'total_vat', cellsformat: 'n2', width: 100, aggregates: ['sum'], editable:false},
                { text: 'CPM', datafield: 'cpm', width: 140, editable:false, cellsformat: 'f2', aggregates: [
                    { 'Total': function (aggregatedValue, currentValue, column, record) {
                        var totalPrice = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'total', ['sum']).sum;
                        var totalView = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'view', ['sum']).sum;
                        overallCPM = parseFloat(totalPrice / totalView * 1000).toFixed(2);
                        return overallCPM;
                    }
                    }
                ]

                }, //total/view*1000

                { text: 'CPC', datafield: 'cpc', width: 140, cellsformat: 'f2', editable:false, aggregates: [
                    { 'Total': function (aggregatedValue, currentValue, column, record) {
                        var totalPrice = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'total', ['sum']).sum;
                        var totalClicks = $('#jqxgrid').jqxGrid('getcolumnaggregateddata', 'clicks', ['sum']).sum;
                        overallCPC = parseFloat(totalPrice / totalClicks).toFixed(2);
                        return overallCPC;
                    }
                    }
                ]}
            ]
        });

    //////////////////////////////////////////////////////////////////////////////////////


    var productAdapter = new $.jqx.dataAdapter();

    var generateProduct = function (i) {
        var row = {};
        var currentProduct = $("#allProducts").jqxDropDownList('getSelectedItem').originalItem;
        row['id'] = currentProduct.id;
        row['name'] = currentProduct.name;
        row['price'] = currentProduct.price;
        row['cost_price'] = currentProduct.cost_price;
        return row;
    }
    var row = generateProduct(0);
    productData[0] = row;

    var source =
    {
        localdata: productAdapter,
        datatype: "local",
        datafields: [
            { name: 'id', type: 'number' },
            { name: 'name', type: 'string' },
            { name: 'price', type: 'string' },
            { name: 'cost_price', type: 'string' }
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
    $("#products").jqxGrid(
        {
            width: 1600,
            showstatusbar: true,
            statusbarheight: 50,
            autoheight: true,
            editable: true,
            theme: theme,
            showaggregates: true,
            columns: [
                { text: 'Name', datafield: 'name'},
                { text: 'Price', datafield: 'price',aggregates:['sum']},
                { text: 'Cost price', datafield: 'cost_price',aggregates:['sum']}
            ]
        });

    // Add new product
    $("#addnewproduct").on('click', function () {
        var datarow = generateProduct();
        var commit = $("#products").jqxGrid('addrow', null, datarow);
    });
    // Delete selected product
    $("#deletenewproduct").on('click', function () {
        var selectedrowindex = $("#products").jqxGrid('getselectedrowindex');
        var rowscount = $("#products").jqxGrid('getdatainformation').rowscount;
        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
            var id = $("#products").jqxGrid('getrowid', selectedrowindex);
            console.log(id);

            var commit = $("#products").jqxGrid('deleterow', id);
        }
    });

    $("#addrowbutton").jqxButton({ theme: theme });
    $("#deleterowbutton").jqxButton({ theme: theme });
    $("#addnewproduct").jqxButton({ theme: theme });
    $("#deletenewproduct").jqxButton({ theme: theme });
    $("#importFromCsv").jqxButton({ theme: theme });
    $("#pngButton").jqxButton({ theme: theme });
    $("#htmlExport").jqxButton({ theme: theme });
    $("#print").jqxButton({ theme: theme });
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
        var commit = $("#ekamut").jqxGrid('addrow', null, datarow);

        generatecharts();
        overalls();

    });

    // delete row.
    $("#deleterowbutton").on('click', function () {
        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
        var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
            var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
            var commit = $("#jqxgrid").jqxGrid('deleterow', id);
        }

        generatecharts();
        overalls();

    });

    var overalls = function (){
        // overalls
        $('#CPC-1').text(overallCPC);
        $('#CPM-1').text(overallCPM);
        $('#clicks-1').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'clicks', ['sum'], true).sum);
        $('#overallBudget').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'total', ['sum'], true).sum);
        $('#overallBudgetVat').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'total_vat', ['sum'], true).sum);
        $('#overallBudgetAgency').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'total', ['sum'], true).sum);
        $('#viewForecast-1').text($("#jqxgrid").jqxGrid('getcolumnaggregateddata', 'view', ['sum'], true).sum);
    }

    var generatecharts = function (){
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
                }
            ]
        };
        // setup the chart
        $('#cpmChart').jqxChart(settings);

        // export grid, charts
        $("#htmlExport").click(function () {
            $("#jqxgrid").jqxGrid('exportdata', 'csv', 'jqxGrid');
        });
        $("#pngButton").click(function () {
            // call the export server to create a PNG image
            $('#clicksChart').jqxChart('saveAsPNG', 'myChart.png');
        });
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


        $("#print").click(function () {
            alert(1);
            var gridContent = $("#jqxgrid").jqxGrid('exportdata', 'html');
            var productsContent = $("#products").jqxGrid('exportdata', 'html');
            var clicksChart = $('#clicksChart')[0].outerHTML;
            var viewsChart = $('#viewsChart')[0].outerHTML;
            var cpmChart = $('#cpmChart')[0].outerHTML;
            var cpcChart = $('#cpcChart')[0].outerHTML;
            var overallPrint = window.document.getElementById('overallPrint').innerHTML;
            var newWindow = window.open('', '', 'width=800, height=500'),
                document = newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>jQWidgets Grid</title>\n' +
                        '</head>\n' +
                        '<body>\n' + overallPrint+'\n'+gridContent + productsContent+clicksChart+viewsChart+cpmChart+cpcChart+'\n</body>\n</html>';
            document.write(pageContent);
            document.close();
            newWindow.print();
        });



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


    }



});
</script>

<div id="GlobalVar" style="float: right; width: ">
    <p><strong>Global variables:    </strong></p>
    <p >Start Date :  <span style='margin-left: 30px;display: inline-block;vertical-align: middle;' id='StartDate'></span></p>
    <p>Clients :  <span style='margin-left: 30px;display: inline-block;vertical-align: middle;' id='ClientList'></span></p>
    <p>Agency : <span style='margin-left: 30px;display: inline-block;vertical-align: middle;' id="AgencyList"></span></p>
    <p>VAT: <span style='margin-left: 30px;display: inline-block;vertical-align: middle;' id='VATjqxRadioButton1'>Calculate with VAT</span>
    <span style='display: inline-block;vertical-align: middle;' id='VATjqxRadioButton2'>Calculate without VAT</span></p>
    <p>Currency:    <span style='display: inline-block;vertical-align: middle;' id="currency"></span></p>
</div>

<div id="overallPrint">
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
    <div class="form-group">
        <input type="button" value="Export to CSV" id='htmlExport' />
    </div>
    <div class="form-group">
        <input id="importFromCsv" type="button" value="Import from CSV"/>
    </div>
    <div class="form-group">
        <input type="button" value="Print" id='print' />
    </div>
</div>
<br/>

<div style="overflow-y: scroll;">
    <div style="float: left;" id="ekamut">
    </div>
</div>

<br/>

<div style="overflow-y: scroll;">
    <div style="float: left;" id="products">
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        <div id='allProducts'>
        </div>
    </div>

    <div class="form-group">
        <input id="addnewproduct" type="button" value="Add New Product"/>
    </div>
    <div class="form-group">
        <input id="deletenewproduct" type="button" value="Delete Selected Product"/>
    </div>
    <div class="form-group">
        <input type="button" value="Export Clicks Chart" id='pngButton' />
    </div>
</div>


<!--  ekamut-->
<div style="overflow-y: scroll;">
    <div style="float: left;" id="ekamut">
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
