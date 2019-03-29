'use strict';
var tableName = '#m12ainTable';
var baseUrl = window.location.origin + '/autohubb/index.php/quote/get-details/quote-id/' + quoteId;
var updateUrl = window.location.origin + '/autohubb/index.php/quote-items/price';
var updateStatusUrl = window.location.origin + '/autohubb/index.php/quote/status/update';
var data_id = 'itemId';
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