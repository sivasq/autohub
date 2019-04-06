'use strict';
var tableName = '#quote_datatable';
var baseUrl = window.location.origin + '/autohub/index.php/quote';
var viewUrl = window.location.origin + '/autohub/index.php/quotes';
var data_id = 'pcaId';
orderBy = [[ 6, "desc" ]];
var dataColumns = [
    {
        "data": "quoteId",
        render: function (dataField, type, row) {
            var dataField = (dataField != null) ? dataField : ".......";
            var url = viewUrl + '/viewdata/quote-id/' + row.id;
            return '<a href="' + url + '">' + dataField + '</a>';
        }
    },
    {"data": "userName"},
    {"data": "itemTotal"},
    {"data": "shippingTotal"},
    {"data": "grandTotal"},
    {
        "data": "status",
        render: function (dataField) {
            if (dataField === 'Placed') {
                return '<span class="label label-default">' + dataField + '</span>';
            }
            if (dataField === 'Price Quoted') {
                return '<span class="label label-info">' + dataField + '</span>';
            }
            if (dataField === 'Accepted') {
                return '<span class="label label-info">' + dataField + '</span>';
            }
            if (dataField === 'Declined') {
                return '<span class="label label-warning">' + dataField + '</span>';
            }
            if (dataField === 'Paid') {
                return '<span class="label label-pink">' + dataField + '</span>';
            }
            if (dataField === 'Closed') {
                return '<span class="label label-danger">' + dataField + '</span>';
            }
        }
    },
    {"data": "quotCreatedAt"},
];