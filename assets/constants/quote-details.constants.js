'use strict';
// var tableName = '#m12ainTable';
var tableName ='';
var baseUrl = window.location.origin + '/autohub/index.php/quote/get-details/quote-id/' + quoteId;
var updateUrl = window.location.origin + '/autohub/index.php/quote-items/price';
var updateStatusUrl = window.location.origin + '/autohub/index.php/quote/status/update';
var updatePaymentStatusUrl = window.location.origin + '/autohub/index.php/quote/payment/update';
var convertorder = window.location.origin + '/autohub/index.php/quote/convertToOrder/quote-id/' + quoteId;
var data_id = 'itemId';
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