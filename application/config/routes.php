<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Admin/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Auth Routes
$route[ 'auth/emailValidate'] = 'auth/email_validate';
$route[ 'auth/register'] = 'auth/user_registration';
$route[ 'auth/sendOtp'] = 'auth/send_otp';
$route[ 'auth/verifyOtp'] = 'auth/otp_verify';
$route[ 'auth/login'] = 'auth/user_login_auth';
$route[ 'auth/logout'] = 'auth/logout';


// Shipping Address
$route['user/create-shipping-address'] = 'user/create_shipping_address_by_user_id';
$route['user/update-shipping-address/shipping-address-id/(:num)'] = 'user/update_shipping_address_by_shipping_id';
$route['user/list-shipping-address/user-id/(:num)']['get'] = 'user/get_shipping_address_by_user_id';
$route['user/get-shipping-address/shipping-address-id/(:num)']['get'] = 'user/get_shipping_address_by_shipping_id';
$route['user/delete-shipping-address/shipping-address-id/(:num)'] = 'user/delete_shipping_address_by_shipping_id';


//Vehicles Routes
$route['vehicle/create'] = 'vehicle/create_vehicle';
$route['vehicle/update/vehicle-id/(:num)'] = 'vehicle/update_vehicle';
$route['vehicle/list/user-id/(:num)'] = 'vehicle/list_user_vehicles';
$route['vehicle/delete/(:num)'] = 'vehicle/delete_vehicle';

$route['vehicle/create-company'] = "vehicle/create_vehicle_company";
$route['vehicle/update-company/company-id/(:num)'] = "vehicle/update_vehicle_company";
$route['vehicle/list-company/user-id/(:num)'] = "vehicle/get_all_user_companies";

$route['vehicle/create-driver'] = "vehicle/create_vehicle_driver";
$route['vehicle/update-driver/driver-id/(:num)'] = "vehicle/update_vehicle_driver";
$route['vehicle/list-driver/company-id/(:num)'] = "vehicle/get_all_user_drivers";

$route['vehicle/list-business-types'] = "vehicle/list_business_types";
$route['vehicle/list-vehicle-types'] = "vehicle/list_vehicle_types";


//Product Routes
$route['product/conditions'] = 'product/list_product_conditions';
$route['product/vehicle-parts'] = 'product/list_vehicle_parts';
$route['product/service-packs'] = 'product/list_service_packs';


//Cart
$route['cart/add-item/user-id/(:num)'] = 'cart/add_item';
$route['cart/list-items/user-id/(:num)'] = 'cart/list_items';
$route['cart/delete-items/user-id/(:num)'] = 'cart/delete_items';
$route['cart/delete/cart-id/(:num)'] = 'cart/delete';


//Order Routes
$route['order/create'] = 'order/create_order';
$route['order/get/id/(:num)']['get'] = 'order/get_order';
$route['order/list/user-id/(:num)'] = 'order/list_all_user_order';

$route['order/update/id/(:num)'] = 'order/update_order';
$route['order/delete/id/(:num)'] = 'order/delete_order';
$route['order/create-message'] = 'order/create_order_message';
$route['order/list-message/order-id/(:num)'] = 'order/list_order_message';
$route['order/list-shipping-methods'] = 'order/get_all_shipping_methods';

#$route['order/status/orderId/(:num)'] = 'order/update_order_status';


//Payment
$route['payment/create-bank'] = 'payment/create_payment_bank';
$route['payment/list-bank'] = 'payment/list_payment_bank';
$route['payment/create'] = 'payment/create_order_payment';


//DataTable Routes
//product
$route['product/index/getdata'] = 'product/get_products';
$route['product/category/getdata'] = 'product/get_categories';
$route['product/condition/getdata'] = 'product/get_conditions';
$route['product/type/getdata'] = 'product/get_type';
$route['product/index/sub-item/getdata'] = 'product/get_products_sub_items';
$route['product/index/service-pack/getdata'] = 'product/get_products_service_pack';


//Payment
$route['payment/bank/getdata'] = 'payment/list_payment_bank';
$route['payment/method/getdata'] = 'payment/list_payment_method';


//Order
$route['order/getdata'] = 'order/get_orders';
$route['order/get-details/order-id/(:num)/getdata'] = 'order/get_orders_by_orderId';


//Vehicle
$route['vehicles/getdata'] = 'vehicle/get_vehicles';
$route['vehicles/get-details/vehicle-id/(:num)/getdata'] = 'order/get_vehicles_by_vehicle_id';


//---------Notifications------------//
$route['notification/list'] = 'notification/list_all';
$route['notification/list/user-id/(:num)'] = 'notification/list_by_userid';

//---------ShippingMethod------------//
$route['shipping-method/getdata'] = 'ShippingMethod/get_all_shipping_methods';


//----->Front End Routes<------------///

//---------Product------------//
$route['product/category'] = 'frontend/product/category';
$route['product/condition'] = 'frontend/product/condition';
$route['product/type'] = 'frontend/product/type';
$route['product/index'] = 'frontend/product/index';

//create
$route['product/category/create'] = 'frontend/product/category_create';
$route['product/type/create'] = 'frontend/product/type_create';
$route['product/create'] = 'frontend/product/product_create';
$route['product/condition/create'] = 'frontend/product/condition_create';

//delete
$route['product/category/delete'] = 'frontend/product/category_delete';
$route['product/type/delete'] = 'frontend/product/type_delete';
$route['product/index/delete'] = 'frontend/product/product_delete';
$route['product/condition/delete'] = 'frontend/product/condition_delete';

$route['product/index/sub-items'] = 'frontend/product/get_subItems';

//---------Vehicle------------//
$route['vehicle/index'] = 'frontend/vehicle/index';
$route['vehicle/viewdata/vehicle-id/(:any)'] = 'frontend/vehicle/detail_view';

//---------Vehicle Type------------//
$route['vehicle/type'] = 'frontend/VehicleType/index';
$route['vehicle/type/create'] = 'frontend/VehicleType/create';
$route['vehicle/type/delete'] = 'frontend/VehicleType/delete';
$route['vehicle/type/getdata'] = 'Vehicle/list_vehicle_types';

//---------Payment------------//
$route['payment/bank'] = 'frontend/payment/banks';
$route['payment/method'] = 'frontend/payment/methods';

//create
$route['payment/bank/create'] = 'frontend/payment/banks_create';
$route['payment/method/create'] = 'frontend/payment/methods_create';

//delete
$route['payment/bank/delete'] = 'frontend/payment/banks_delete';
$route['payment/method/delete'] = 'frontend/payment/methods_delete';

//---------Orders------------//
$route['orders/index'] = 'frontend/orders/index';
$route['orders/viewdata/order-id/(:any)'] = 'frontend/orders/detail_view';
$route['order-items/price/update'] = 'order/update_items_price';
$route['order/status/update'] = 'order/update_status';

//---------Shipping Method------------//
$route['shipping-method'] = 'frontend/ShippingMethod/index';
$route['shipping-method/create'] = 'frontend/ShippingMethod/create';
$route['shipping-method/delete'] = 'frontend/ShippingMethod/delete';




