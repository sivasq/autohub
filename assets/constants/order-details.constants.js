'use strict';
var tableName = '';
var baseUrl = window.location.origin + '/autohub/index.php/order/get-details/order-id/' + orderId;
var updateUrl = window.location.origin + '/autohub/index.php/order-items/price';
var updateOrderStatusUrl = window.location.origin + '/autohub/index.php/order/status/update';
var updatePaymentStatusUrl = window.location.origin + '/autohub/index.php/order/payment/update';
var data_id = 'orderDetailsId';
var dataColumns = [
    // {"data": "productType"},
    // {"data": "itemName"},
    // {"data": "productCategory"},
    // {"data": "vehicleInfo"},
    // {"data": "currentMileage"},
    // {
    //     "data": "itemPrice", render: function (dataField) {
    //         return '<input type="text" value="' + dataField + '" onchange="calculateTotal(this);">';
    //     }
    // }
];

// function calculateTotal(elm) {
//     var total = 0;
//     total = total + elm.value;
//     alert(total);
// }