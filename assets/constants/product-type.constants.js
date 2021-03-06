'use strict';
var tableName = '#type_datatable';
var baseUrl = window.location.origin + '/autohub/index.php/product/type';
var data_id = 'ptyId';
var dataColumns = [
    {"data": "ptyId"},
    {"data": "ptyName"},
    {"data": "ptyDescription"},
    {
        data: null,
        className: "actions",
        defaultContent: '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a> <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a> <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>  <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
    }
];