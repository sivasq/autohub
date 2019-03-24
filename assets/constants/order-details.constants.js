'use strict';
var tableName = '#m12ainTable';
var baseUrl = window.location.origin + '/autohubb/index.php/order/get-details/order-id/' + orderId;
var updateUrl = window.location.origin + '/autohubb/index.php/order-items/price';
var updateStatusUrl = window.location.origin + '/autohubb/index.php/order/status/update';
var data_id = 'orderDetailsId';
var dataColumns = [
    {"data": "productType"},
    {"data": "itemName"},
    {"data": "productCategory"},
    {"data": "vehicleInfo"},
    {"data": "currentMileage"},
    {
        "data": "itemPrice", render: function (dataField) {
            return '<input type="text" value="' + dataField + '" onchange="calculateTotal(this);">';
        }
    }
];

function calculateTotal(elm) {
    var total = 0;
    total = total + elm.value;
    alert(total);
}