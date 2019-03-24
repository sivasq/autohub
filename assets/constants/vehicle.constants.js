'use strict';
var tableName = '#vehicle_datatable';
var groupColumn = 1;
var groupTableName = tableName
var baseUrl = window.location.origin + '/autohubb/index.php/vehicles';
var viewUrl = window.location.origin + '/autohubb/index.php/vehicle';
var data_id = 'pcaId';
var dataColumns = [
    {
        "data": "id", render: function (dataField, type, row) {
            var dataField = (dataField != null) ? dataField : ".......";
            var url = viewUrl + '/viewdata/vehicle-id/' + row.id;
            return '<a href="' + url + '">' + dataField + '</a>';
        }
    },
    {"data": "userId"},
    {"data": "vehicleInfo"},
    {"data": "businessType"},
    {"data": "vehicleType"},
    {"data": "createdAt"},
];