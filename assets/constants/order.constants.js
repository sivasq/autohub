'use strict';
var tableName = '#order_datatable';
var baseUrl = window.location.origin + '/autohub/index.php/order';
var viewUrl = window.location.origin + '/autohub/index.php/orders';
var data_id = 'pcaId';
orderBy = [[ 6, "desc" ]];
var dataColumns = [
    {
        "data": "orderId",
        render: function (dataField, type, row) {
            var dataField = (dataField != null) ? dataField : ".......";
            var url = viewUrl + '/viewdata/order-id/' + row.id;
            return '<a href="' + url + '">' + dataField + '</a>';
        }
    },
    {"data": "userName"},
    {"data": "itemTotal"},
    {"data": "shippingTotal"},
    {"data": "grandTotal"},
    {
        "data": "status", render: function (dataField) {
            if (dataField === 'Placed') {
                return '<span class="label label-default">' + dataField + '</span>';
            }
            if (dataField === 'Shipped') {
                return '<span class="label label-pink">' + dataField + '</span>';
            }
            if (dataField === 'Delivered') {
                return '<span class="label label-success">' + dataField + '</span>';
            }
        }
    },
    {"data": "createdAt"},
];