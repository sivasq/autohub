'use strict';

/* this is temp */
var tableName='';
var baseUrl = '';
var dataColumns = [];
/* this is temp */

var proTableName = '#products_datatable';
var proBaseUrl = window.location.origin + '/autohub/index.php/product/index';
var pro_data_id = 'prdId';
var rowGroup = null;
var proDataColumns = [
    {"data": "prdId"},
    {"data": "prdName"},
    {"data": "prdDescription"},
    {"data": "productType"},
    {"data": "productCategory"},
    {"data": "prdImage"},
    {"data": "prdCreatedAt"},
    {
        data: null,
        className: "actions",
        defaultContent: '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a> <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a> <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>  <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
    }
];