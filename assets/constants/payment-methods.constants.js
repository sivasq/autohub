'use strict';
var tableName = '#method_datatable';
var baseUrl = window.location.origin + '/autohubbapi/index.php/payment/method';
var data_id = 'ptyId';
var dataColumns = [
    {"data": "id"},
    {"data": "name"},
    {"data": "description"},
    {
        data: null,
        className: "actions",
        defaultContent: '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a> <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a> <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>  <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
    }
];