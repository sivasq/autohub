'use strict';
var tableName = '#order_datatable';
var baseUrl = window.location.origin + '/autohubb/index.php/order';
var viewUrl = window.location.origin + '/autohubb/index.php/orders';
var data_id = 'pcaId';
orderBy = [[ 6, "desc" ]];
var dataColumns = [
    {
        "data": "orderId", render: function (dataField, type, row) {
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
            if (dataField == 'order placed') {
                return '<span class="label label-default">' + dataField + '</span>';
            }
            if (dataField == 'price added') {
                return '<span class="label label-info">' + dataField + '</span>';
            }
            if (dataField == 'payment made') {
                return '<span class="label label-warning">' + dataField + '</span>';
            }
            if (dataField == 'shipped') {
                return '<span class="label label-pink">' + dataField + '</span>';
            }
            if (dataField == 'delivered') {
                return '<span class="label label-success">' + dataField + '</span>';
            }
            if (dataField == 'cancelled') {
                return '<span class="label label-danger">' + dataField + '</span>';
            }
        }
    },
    {"data": "createdAt"},
];