'use strict';
var tableName = '#quotereq_datatable';
var baseUrl = window.location.origin + '/autohub/index.php/quotes/req';
var viewUrl = window.location.origin + '/autohub/index.php/quotes';
var data_id = 'quotReqId';
// orderBy = [[5, "desc"]];
var dataColumns = [
    {
        "data": "quotReqId",
        render: function (dataField, type, row) {
            var dataField = (dataField != null) ? dataField : ".......";
            var url = viewUrl + '/reqsviewdata/item-id/' + row.quotReqId;
            return '<a href="' + url + '">' + dataField + '</a>';
        }
    },
    { "data": "userName" },
    { "data": "productName" },
    { "data": "quantity" },
    { "data": "comment" },
    { "data": "createdAt" },
];