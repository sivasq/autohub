'use strict';
var tableName = '#type_datatable';
var baseUrl = window.location.origin + '/autohub/index.php/shipping-method';
var data_id = 'id';
var dataColumns = [
    {"data": "id"},
    {"data": "name"},
    {"data": "description"},
    {"data": "price"},
    {
        data: null,
        className: "actions",
        defaultContent: '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a> <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a> <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>  <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
    }
];