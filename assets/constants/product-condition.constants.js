'use strict';
var tableName = '#condition_datatable';
var baseUrl = window.location.origin + '/autohubb/index.php/product/condition';
var data_id = 'pcoId';
var dataColumns = [
    {"data": "pcoId"},
    {"data": "pcoName"},
    {"data": "pcoDescription"},
    {
        data: null,
        className: "actions",
        defaultContent: '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a> <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a> <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>  <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
    }
];