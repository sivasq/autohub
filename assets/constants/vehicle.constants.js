'use strict';
var tableName = '#vehicle_datatable';
var groupColumn = 1;
var groupTableName = tableName
var baseUrl = window.location.origin + '/autohub/index.php/vehicles';
var viewUrl = window.location.origin + '/autohub/index.php/vehicle';
var data_id = 'pcaId';
var dataColumns = [
    {
        "data": "id", render: function (dataField, type, row) {
            var dataField = (dataField != null) ? dataField : ".......";
            var url = viewUrl + '/viewdata/vehicle-id/' + row.id;
            return '<a href="' + url + '">' + dataField + '</a>';
        }
    },
    {"data": "user"},
    {"data": "vehicleInfo"},
    {"data": "businessType"},
    {"data": "vehicleType"},
    {"data": "createdAt"},
];