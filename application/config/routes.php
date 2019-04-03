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
$route['default_controller'] = 'apiv1/Admin/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Auth Routes
$route[ 'auth/emailValidate'] = 'apiv1/auth/email_validate';
$route[ 'auth/register'] = 'apiv1/auth/user_registration';
$route[ 'auth/sendOtp'] = 'apiv1/auth/send_otp';
$route[ 'auth/verifyOtp'] = 'apiv1/auth/otp_verify';
$route[ 'auth/login'] = 'apiv1/auth/user_login_auth';
$route[ 'auth/changePassword'] = 'apiv1/auth/change_password';
$route[ 'auth/logout'] = 'apiv1/auth/logout';


// Shipping Address
$route['user/create-shipping-address'] = 'apiv1/user/create_shipping_address_by_user_id';
$route['user/update-shipping-address/shipping-address-id/(:num)'] = 'apiv1/user/update_shipping_address_by_shipping_id';
$route['user/list-shipping-address/user-id/(:num)'] = 'apiv1/user/get_shipping_address_by_user_id';
$route['user/get-shipping-address/shipping-address-id/(:num)'] = 'apiv1/user/get_shipping_address_by_shipping_id';
$route['user/delete-shipping-address/shipping-address-id/(:num)'] = 'apiv1/user/delete_shipping_address_by_shipping_id';


//Vehicles Routes
$route['vehicle/create'] = 'apiv1/vehicle/create_vehicle';
$route['vehicle/update/vehicle-id/(:num)'] = 'apiv1/vehicle/update_vehicle';
$route['vehicle/list/user-id/(:num)'] = 'apiv1/vehicle/list_user_vehicles';
$route['vehicle/delete/(:num)'] = 'apiv1/vehicle/delete_vehicle';

$route['vehicle/create-company'] = "apiv1/vehicle/create_vehicle_company";
$route['vehicle/update-company/company-id/(:num)'] = "apiv1/vehicle/update_vehicle_company";
$route['vehicle/list-company/user-id/(:num)'] = "apiv1/vehicle/get_all_user_companies";

$route['vehicle/create-driver'] = "apiv1/vehicle/create_vehicle_driver";
$route['vehicle/update-driver/driver-id/(:num)'] = "apiv1/vehicle/update_vehicle_driver";
$route['vehicle/list-driver/company-id/(:num)'] = "apiv1/vehicle/get_all_user_drivers";

$route['vehicle/list-business-types'] = "apiv1/vehicle/list_business_types";
$route['vehicle/list-vehicle-types'] = "apiv1/vehicle/list_vehicle_types";


//Product Routes
$route['product/conditions'] = 'apiv1/product/list_product_conditions';
$route['product/vehicle-parts'] = 'apiv1/product/list_vehicle_parts';
$route['product/service-packs'] = 'apiv1/product/list_service_packs';


//Cart
$route['cart/add-item/user-id/(:num)'] = 'apiv1/cart/add_item';
$route['cart/list-items/user-id/(:num)'] = 'apiv1/cart/list_items';
$route['cart/delete-items/user-id/(:num)'] = 'apiv1/cart/delete_items';
$route['cart/delete/cart-id/(:num)'] = 'apiv1/cart/delete';


//Quot Req
$route['quotreq/add-item/user-id/(:num)'] = 'apiv1/quotreq/add_item';
$route['quotreq/list-items/user-id/(:num)'] = 'apiv1/quotreq/list_items';
$route['quotreq/delete-items/user-id/(:num)'] = 'apiv1/quotreq/delete_items';
$route['quotreq/delete/quotreq-id/(:num)'] = 'apiv1/quotreq/delete';


//Quote Routes
$route['quote/create'] = 'apiv1/quote/create_quote';
$route['quote/listQuotes/user-id/(:num)'] = 'apiv1/quote/list_user_quotes';
$route['quote/getQuote/quote-id/(:num)'] = 'apiv1/quote/get_quote_by_id';
$route['quote/addItem'] = 'apiv1/quote/add_item_to_quote';
$route['quote/removeItem'] = 'apiv1/quote/remove_item_from_quote';
$route['quote/updatePrice'] = 'apiv1/quote/update_price_for_quote_item';
$route['quote/status/quote-id/(:num)'] = 'apiv1/quote/update_quote_status';
$route['quote/accept/quote-id/(:num)'] = 'apiv1/quote/update_quote_shipping';
$route['quote/convertToOrder/quote-id/(:num)'] = 'apiv1/quote/convert_to_order';


//Order Routes
$route['order/create'] = 'apiv1/order/create_order';
$route['order/get/id/(:num)']['get'] = 'apiv1/order/get_order';
$route['order/list/user-id/(:num)'] = 'apiv1/order/list_all_user_order';

$route['order/update/id/(:num)'] = 'apiv1/order/update_order';
$route['order/delete/id/(:num)'] = 'apiv1/order/delete_order';
$route['order/create-message'] = 'apiv1/order/create_order_message';
$route['order/list-message/order-id/(:num)'] = 'apiv1/order/list_order_message';
$route['order/list-shipping-methods'] = 'apiv1/order/get_all_shipping_methods';
#$route['order/status/orderId/(:num)'] = 'order/update_order_status';


//Payment
$route['payment/create-bank'] = 'apiv1/payment/create_payment_bank';
$route['payment/list-bank'] = 'apiv1/payment/list_payment_bank';
$route['payment/create'] = 'apiv1/payment/create_order_payment';


//DataTable Routes
//product
$route['product/index/getdata'] = 'apiv1/product/get_products';
$route['product/category/getdata'] = 'apiv1/product/get_categories';
$route['product/condition/getdata'] = 'apiv1/product/get_conditions';
$route['product/type/getdata'] = 'apiv1/product/get_type';
$route['product/index/sub-item/getdata'] = 'apiv1/product/get_products_sub_items';
$route['product/index/service-pack/getdata'] = 'apiv1/product/get_products_service_pack';


//Payment
$route['payment/bank/getdata'] = 'apiv1/payment/list_payment_bank';
$route['payment/method/getdata'] = 'apiv1/payment/list_payment_method';


//Order
$route['order/getdata'] = 'apiv1/order/get_orders';
$route['order/get-details/order-id/(:num)/getdata'] = 'apiv1/order/get_orders_by_orderId';

//Quote
$route['quote/getdata'] = 'apiv1/quote/get_quotes';
$route['quotes/req/getdata'] = 'apiv1/quotReq/get_reqs';
$route['quote/get-details/quote-id/(:num)/getdata'] = 'apiv1/order/get_orders_by_orderId';

//Vehicle
$route['vehicles/getdata'] = 'apiv1/vehicle/get_vehicles';
$route['vehicles/get-details/vehicle-id/(:num)/getdata'] = 'apiv1/order/get_vehicles_by_vehicle_id';


//---------Notifications------------//
$route['notification/list'] = 'apiv1/notification/list_all';
$route['notification/list/user-id/(:num)'] = 'apiv1/notification/list_by_userid';

//---------ShippingMethod------------//
$route['shipping-method/getdata'] = 'apiv1/ShippingMethod/get_all_shipping_methods';


//----->Front End Routes<------------//
$route['admin/auth'] = 'apiv1/AdminAuth/index';
$route['admin/auth/fp'] = 'apiv1/AdminAuth/forgot_password';
$route['admin/auth/fp/resetLink'] = 'apiv1/AdminAuth/password_reset_link';
$route['admin/auth/fp/confirmEmail'] = 'apiv1/AdminAuth/email_confirm';
$route['admin/auth/fp/validate_reset'] = 'apiv1/AdminAuth/validate_reset';
$route['admin/auth/fp/reset_process'] = 'apiv1/AdminAuth/reset_process';


$route['admin/auth/login'] = 'apiv1/AdminAuth/login_auth';
$route['admin/auth/logout'] = 'apiv1/AdminAuth/logout';
$route['admin/dashboard'] = 'apiv1/Admin/index';

//---------Product------------//
$route['product/category'] = 'apiv1/frontend/product/category';
$route['product/condition'] = 'apiv1/frontend/product/condition';
$route['product/type'] = 'apiv1/frontend/product/type';
$route['product/index'] = 'apiv1/frontend/product/index';

//create
$route['product/category/create'] = 'apiv1/frontend/product/category_create';
$route['product/type/create'] = 'apiv1/frontend/product/type_create';
$route['product/create'] = 'apiv1/frontend/product/product_create';
$route['product/condition/create'] = 'apiv1/frontend/product/condition_create';

//delete
$route['product/category/delete'] = 'apiv1/frontend/product/category_delete';
$route['product/type/delete'] = 'apiv1/frontend/product/type_delete';
$route['product/index/delete'] = 'apiv1/frontend/product/product_delete';
$route['product/condition/delete'] = 'apiv1/frontend/product/condition_delete';

$route['product/index/sub-items'] = 'apiv1/frontend/product/get_subItems';

//---------Vehicle------------//
$route['vehicle/index'] = 'apiv1/frontend/vehicle/index';
$route['vehicle/viewdata/vehicle-id/(:any)'] = 'apiv1/frontend/vehicle/detail_view';

//---------Vehicle Type------------//
$route['vehicle/type'] = 'apiv1/frontend/VehicleType/index';
$route['vehicle/type/create'] = 'apiv1/frontend/VehicleType/create';
$route['vehicle/type/delete'] = 'apiv1/frontend/VehicleType/delete';
$route['vehicle/type/getdata'] = 'apiv1/Vehicle/list_vehicle_types';

//---------Payment------------//
$route['payment/bank'] = 'apiv1/frontend/payment/banks';
$route['payment/method'] = 'apiv1/frontend/payment/methods';

//create
$route['payment/bank/create'] = 'apiv1/frontend/payment/banks_create';
$route['payment/method/create'] = 'apiv1/frontend/payment/methods_create';

//delete
$route['payment/bank/delete'] = 'apiv1/frontend/payment/banks_delete';
$route['payment/method/delete'] = 'apiv1/frontend/payment/methods_delete';


//---------Orders------------//
$route['orders/index'] = 'apiv1/frontend/orders/index';
$route['orders/viewdata/order-id/(:any)'] = 'apiv1/frontend/orders/detail_view';
$route['order-items/price/update'] = 'apiv1/order/update_items_price';
$route['order/status/update'] = 'apiv1/order/update_status';


//---------Quotes------------//
$route['quotes/index'] = 'apiv1/frontend/quotes/index';
$route['quotes/viewdata/quote-id/(:any)'] = 'apiv1/frontend/quotes/detail_view';

$route['quotes/reqs'] = 'apiv1/frontend/quotes/reqs';
$route['quotes/reqsviewdata/item-id/(:any)'] = 'apiv1/frontend/quotes/req_detail_view';

$route['quote-items/price/update'] = 'apiv1/quote/update_items_price';
$route['quote/status/update'] = 'apiv1/quote/update_status';

//---------Shipping Method------------//
$route['shipping-method'] = 'apiv1/frontend/ShippingMethod/index';
$route['shipping-method/create'] = 'apiv1/frontend/ShippingMethod/create';
$route['shipping-method/delete'] = 'apiv1/frontend/ShippingMethod/delete';

//Image Manage
$route['imagemanage/upload'] = 'apiv1/imagemanage/upload';
