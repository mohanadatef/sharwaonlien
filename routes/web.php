<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
/*---------------Home-------*/
Route::get('/admin','admin\HomeController@index');
/*---------------log-------*/
Route::get('/admin/log','admin\LogController@indexlog')->middleware('permission:log-show');
/*---------------brand-------*/
Route::get('/admin/brand','admin\BrandController@indexbrand')->middleware('permission:brand-show');
Route::get('/admin/brand/create','admin\BrandController@createbrandget')->middleware('permission:brand-create');
Route::post('/admin/brand/create','admin\BrandController@createbrandpost')->middleware('permission:brand-create');
Route::get('/admin/brand/edit/{id}','admin\BrandController@editbrandget')->middleware('permission:brand-edit');
Route::post('/admin/brand/edit/{id}','admin\BrandController@editbrandpost')->middleware('permission:brand-edit');
/*---------------supplier-------*/
Route::get('/admin/supplier','admin\SupplierController@indexsupplier')->middleware('permission:supplier-show');
Route::get('/admin/supplier/create','admin\SupplierController@createsupplierget')->middleware('permission:supplier-create');
Route::post('/admin/supplier/create','admin\SupplierController@createsupplierpost')->middleware('permission:supplier-create');
Route::get('/admin/supplier/edit/{id}','admin\SupplierController@editsupplierget')->middleware('permission:supplier-edit');
Route::post('/admin/supplier/edit/{id}','admin\SupplierController@editsupplierpost')->middleware('permission:supplier-edit');
Route::get('/admin/supplier/{id}','admin\SupplierController@showsupplier')->middleware('permission:supplier-show-details');
Route::get('/admin/supplier/statues/{id}','admin\SupplierController@editstatues')->middleware('permission:supplier-statues');
/*---------------gender-------*/
/*Route::get('/admin/gender','admin\GenderController@indexgender')->middleware('permission:gender-show');
Route::get('/admin/gender/create','admin\GenderController@creategenderget')->middleware('permission:gender-create');
Route::post('/admin/gender/create','admin\GenderController@creategenderpost')->middleware('permission:gender-create');
Route::get('/admin/gender/edit/{id}','admin\GenderController@editgenderget')->middleware('permission:gender-edit');
Route::post('/admin/gender/edit/{id}','admin\GenderController@editgenderpost')->middleware('permission:gender-edit');*/
/*---------------color-------*/
Route::get('/admin/color','admin\ColorController@indexcolor')->middleware('permission:color-show');
Route::get('/admin/color/create','admin\ColorController@createcolorget')->middleware('permission:color-create');
Route::post('/admin/color/create','admin\ColorController@createcolorpost')->middleware('permission:color-create');
Route::get('/admin/color/edit/{id}','admin\ColorController@editcolorget')->middleware('permission:color-edit');
Route::post('/admin/color/edit/{id}','admin\ColorController@editcolorpost')->middleware('permission:color-edit');
/*---------------size-------*/
Route::get('/admin/size','admin\SizeController@indexsize')->middleware('permission:size-show');
Route::get('/admin/size/create','admin\SizeController@createsizeget')->middleware('permission:size-create');
Route::post('/admin/size/create','admin\SizeController@createsizepost')->middleware('permission:size-create');
Route::get('/admin/size/edit/{id}','admin\SizeController@editsizeget')->middleware('permission:size-edit');
Route::patch('/admin/size/edit/{id}','admin\SizeController@editsizepost')->middleware('permission:size-edit');
/*---------------bag-------*/
Route::get('/admin/bag','admin\BagController@indexbag')->middleware('permission:bag-show');
Route::get('/admin/bag/create','admin\BagController@createbagget')->middleware('permission:bag-create');
Route::post('/admin/bag/create','admin\BagController@createbagpost')->middleware('permission:bag-create');
Route::get('/admin/bag/edit/{id}','admin\BagController@editbagget')->middleware('permission:bag-edit');
Route::patch('/admin/bag/edit/{id}','admin\BagController@editbagpost')->middleware('permission:bag-edit');
Route::get('/admin/bag/statues/{id}','admin\BagController@editstatues')->middleware('permission:bag-statues');
/*Route::get('/admin/bag/complete/{id}','admin\BagController@editcomplete')->middleware('permission:bag-complete');
Route::get('/admin/manage_bag','admin\BagController@indexmanagebag')->middleware('permission:bag-manage-show');
Route::get('/admin/manage_bag/edit/{id}','admin\BagController@editmanagebagget')->middleware('permission:bag-manage-edit');
Route::post('/admin/manage_bag/edit/{id}','admin\BagController@editmanagebagpost')->middleware('permission:bag-manage-edit');
Route::get('/admin/manage_bag/prices','admin\BagController@pricesmanagebag')->middleware('permission:bag-manage-prices');
Route::get('/admin/bag/complete','admin\BagController@indexbagcomplete')->middleware('permission:bag-show-complete');*/
/*---------------city-------*/
Route::get('/admin/city','admin\CityController@indexcity')->middleware('permission:city-show');
Route::get('/admin/city/create','admin\CityController@createcityget')->middleware('permission:city-create');
Route::post('/admin/city/create','admin\CityController@createcitypost')->middleware('permission:city-create');
Route::get('/admin/city/edit/{id}','admin\CityController@editcityget')->middleware('permission:city-edit');
Route::post('/admin/city/edit/{id}','admin\CityController@editcitypost')->middleware('permission:city-edit');
/*---------------location-------*/
Route::get('/admin/location','admin\LocationController@indexlocation')->middleware('permission:location-show');
Route::get('/admin/location/create','admin\LocationController@createlocationget')->middleware('permission:location-create');
Route::post('/admin/location/create','admin\LocationController@createlocationpost')->middleware('permission:location-create');
Route::get('/admin/location/edit/{id}','admin\LocationController@editlocationget')->middleware('permission:location-edit');
Route::post('/admin/location/edit/{id}','admin\LocationController@editlocationpost')->middleware('permission:location-edit');
/*---------------area-------*/
Route::get('/admin/area','admin\AreaController@indexarea')->middleware('permission:area-show');
Route::get('/admin/area/create','admin\AreaController@createareaget')->middleware('permission:area-create');
Route::post('/admin/area/create','admin\AreaController@createareapost')->middleware('permission:area-create');
Route::get('/admin/area/edit/{id}','admin\AreaController@editareaget')->middleware('permission:area-edit');
Route::post('/admin/area/edit/{id}','admin\AreaController@editareapost')->middleware('permission:area-edit');
/*---------------description-------*/
Route::get('/admin/description','admin\CategoryTypeController@indexcategorytype')->middleware('permission:category-type-show');
Route::get('/admin/description/create','admin\CategoryTypeController@createcategorytypeget')->middleware('permission:category-type-create');
Route::post('/admin/description/create','admin\CategoryTypeController@createcategorytypepost')->middleware('permission:category-type-create');
Route::get('/admin/description/edit/{id}','admin\CategoryTypeController@editcategorytypeget')->middleware('permission:category-type-edit');
Route::post('/admin/description/edit/{id}','admin\CategoryTypeController@editcategorytypepost')->middleware('permission:category-type-edit');
/*---------------type-------*/
Route::get('/admin/type','admin\TypeController@indextype')->middleware('permission:type-show');
Route::get('/admin/type/create','admin\TypeController@createtypeget')->middleware('permission:type-create');
Route::post('/admin/type/create','admin\TypeController@createtypepost')->middleware('permission:type-create');
Route::get('/admin/type/edit/{id}','admin\TypeController@edittypeget')->middleware('permission:type-edit');
Route::post('/admin/type/edit/{id}','admin\TypeController@edittypepost')->middleware('permission:type-edit');
/*---------------User-------*/
Route::get('/admin/user','admin\UserController@indexuser')->middleware('permission:user-show');
Route::get('/admin/user/create','admin\UserController@createuserget')->middleware('permission:user-create');
Route::post('/admin/user/create','admin\UserController@createuserpost')->middleware('permission:user-create');
Route::get('/admin/user/edit/{id}','admin\UserController@edituserget')->middleware('permission:user-edit');
Route::post('/admin/user/edit/{id}','admin\UserController@edituserpost')->middleware('permission:user-edit');
Route::get('/admin/user/reset/{id}','admin\UserController@resetpassworduserget')->middleware('permission:user-password');
Route::Post('/admin/user/reset/{id}','admin\UserController@resetpassworduserpost')->middleware('permission:user-password');
Route::get('/admin/user/statues/{id}','admin\UserController@editstatues')->middleware('permission:user-statues');
Route::get('/admin/user/statues/all','admin\UserController@editallstatues')->middleware('permission:user-statues');
/*---------------role-------*/
Route::get('/admin/role','admin\RoleController@indexrole')->middleware('permission:role-show');
Route::get('/admin/role/create','admin\RoleController@createroleget')->middleware('permission:role-create');
Route::post('/admin/role/create','admin\RoleController@createrolepost')->middleware('permission:role-create');
Route::get('/admin/role/edit/{id}','admin\RoleController@editroleget')->middleware('permission:role-edit');
Route::post('/admin/role/edit/{id}','admin\RoleController@editrolepost')->middleware('permission:role-edit');
/*---------------permission-------*/
Route::get('/admin/permission','admin\PermissionController@indexpermission')->middleware('permission:permission-show');
Route::get('/admin/permission/create','admin\PermissionController@createpermissionget')->middleware('permission:permission-create');
Route::post('/admin/permission/create','admin\PermissionController@createpermissionpost')->middleware('permission:permission-create');
Route::get('/admin/permission/edit/{id}','admin\PermissionController@editpermissionget')->middleware('permission:permission-edit');
Route::post('/admin/permission/edit/{id}','admin\PermissionController@editpermissionpost')->middleware('permission:permission-edit');
/*---------------company_delivery-------*/
Route::get('/admin/company_delivery','admin\CompanyDeliveryController@indexcompanydelivery')->middleware('permission:company-delivery-show');
Route::get('/admin/company_delivery/create','admin\CompanyDeliveryController@createcompanydeliveryget')->middleware('permission:company-delivery-create');
Route::post('/admin/company_delivery/create','admin\CompanyDeliveryController@createcompanydeliverypost')->middleware('permission:company-delivery-create');
Route::get('/admin/company_delivery/edit/{id}','admin\CompanyDeliveryController@editcompanydeliveryget')->middleware('permission:company-delivery-edit');
Route::post('/admin/company_delivery/edit/{id}','admin\CompanyDeliveryController@editcompanydeliverypost')->middleware('permission:company-delivery-edit');
Route::get('/admin/company_delivery/{id}','admin\CompanyDeliveryController@showcompanydelivery')->middleware('permission:company-delivery-show-details');
Route::get('/admin/company_delivery/statues/{id}','admin\CompanyDeliveryController@editstatues')->middleware('permission:company-delivery-statues');
/*---------------user_delivery-------*/
Route::get('/admin/user_delivery','admin\UserDeliveryController@indexuserdelivery')->middleware('permission:user-delivery-show');
Route::get('/admin/user_delivery/create','admin\UserDeliveryController@createuserdeliveryget')->middleware('permission:user-delivery-create');
Route::post('/admin/user_delivery/create','admin\UserDeliveryController@createuserdeliverypost')->middleware('permission:user-delivery-create');
Route::get('/admin/user_delivery/delete/{id}','admin\UserDeliveryController@deleteuserdelivery')->middleware('permission:user-delivery-delete');
Route::get('/admin/user_delivery/edit/{id}','admin\UserDeliveryController@edituserdeliveryget')->middleware('permission:user-delivery-edit');
Route::post('/admin/user_delivery/edit/{id}','admin\UserDeliveryController@edituserdeliverypost')->middleware('permission:user-delivery-edit');
/*---------------prices_delivery-------*/
Route::get('/admin/prices_delivery','admin\PricesDeliveryController@indexpricesdelivery')->middleware('permission:prices-delivery-show');
Route::get('/admin/prices_delivery/create','admin\PricesDeliveryController@createpricesdeliveryget')->middleware('permission:prices-delivery-create');
Route::post('/admin/prices_delivery/create','admin\PricesDeliveryController@createpricesdeliverypost')->middleware('permission:prices-delivery-create');
Route::get('/admin/prices_delivery/delete/{id}','admin\PricesDeliveryController@deletepricesdelivery')->middleware('permission:prices-delivery-delete');
Route::get('/admin/prices_delivery/edit/{id}','admin\PricesDeliveryController@editpricesdeliveryget')->middleware('permission:prices-delivery-edit');
Route::post('/admin/prices_delivery/edit/{id}','admin\PricesDeliveryController@editpricesdeliverypost')->middleware('permission:prices-delivery-edit');
Route::get('/admin/prices_delivery/search','admin\PricesDeliveryController@searchpricesdeliveryget')->middleware('permission:prices-delivery-search');
Route::get('get-Area-list','admin\PricesDeliveryController@getAreaList');
Route::get('filter','admin\PricesDeliveryController@searchpricesdeliverypost');
/*---------------item-------*/
Route::get('get-cost-bag','admin\ItemController@getCostbag');
Route::get('/admin/item','admin\ItemController@indexitem')->middleware('permission:item-show');
Route::get('/admin/item/location/{id}','admin\ItemController@locationitem')->middleware('permission:location-insert');
Route::get('/admin/item/storeinsert','admin\ItemController@storeinsertitem')->middleware('permission:item-store-insert');
Route::get('/admin/item/store','admin\ItemController@storeitem')->middleware('permission:item-store');
Route::get('/admin/item/create','admin\ItemController@createitemget')->middleware('permission:item-create');
Route::post('/admin/item/create','admin\ItemController@createitempost')->middleware('permission:item-create');
Route::get('/admin/item/edit/{id}','admin\ItemController@edititemget')->middleware('permission:item-edit');
Route::post('/admin/item/edit/{id}','admin\ItemController@edititempost')->middleware('permission:item-edit');
Route::get('/admin/item/cost','admin\ItemController@costitem')->middleware('permission:item-cost');
Route::get('/admin/item/insert/{id}/{id1}','admin\ItemController@insertitem')->middleware('permission:item-insert');
Route::get('/admin/item/statues/active','admin\ItemController@statuesactiveitem')->middleware('permission:item-statues-active');
Route::get('/admin/item/statues/dactive','admin\ItemController@statuesdactiveitem')->middleware('permission:item-statues-dactive');
Route::get('/admin/item/statues/all','admin\ItemController@editallstatues')->middleware('permission:item-statues-change');
Route::get('/admin/item/search','admin\ItemController@searchitemget')->middleware('permission:item-search');
Route::post('/admin/item/search/index','admin\ItemController@searchitempost')->middleware('permission:item-search-index');
Route::get('/admin/item/{id}','admin\ItemController@showitem')->middleware('permission:item-show-details');
Route::get('/admin/item/cost/create/{id}','admin\ItemController@costitemcreateget')->middleware('permission:item-cost-create');
Route::post('/admin/item/cost/create/{id}','admin\ItemController@costitemcreatepost')->middleware('permission:item-cost-create');
Route::get('/admin/item/statues/{id}','admin\ItemController@editstatues')->middleware('permission:item-statues-change');
Route::get('/admin/item/scraped/{id}','admin\ItemController@scraped')->middleware('permission:scraped-item');
Route::post('admin/item/statues/discount/{id}','admin\itemController@discount')->middleware('permission:item-discount');
/*---------------cart_item-------*/
Route::get('/admin/cart_item/cancellation/{id}','admin\CartItemController@cancellationselectitem')->middleware('permission:cart-item-cancellation');
Route::get('/admin/cart_item/finish_order/{id}','admin\CartItemController@finishorder')->middleware('permission:finish-order');
Route::get('/admin/cart_item/finish_direct/{id}','admin\CartItemController@finishorderdirect')->middleware('permission:finish-order-direct');
Route::get('/admin/cart_item/select/{id}','admin\CartItemController@selectitem')->middleware('permission:cart-item-select');
Route::get('/admin/cart_item/make_order','admin\CartItemController@searchitemget')->middleware('permission:make-order');
Route::get('/admin/cart_item/make_order/index','admin\CartItemController@searchitempost')->middleware('permission:make-order-index');
Route::get('/admin/cart_item','admin\CartItemController@indexcartitem')->middleware('permission:cart-item');
/*---------------order-------*/
Route::get('/admin/order/order_make_ready','admin\OrderController@ordermakereadyget')->middleware('permission:make-order-ready');
Route::get('/admin/order/show_make_ready/{id}','admin\OrderController@showmakereadyorder')->middleware('permission:show-make-ready-order');
Route::get('/admin/order/show_ready/{id}','admin\OrderController@showreadyorder')->middleware('permission:show-ready-order');
Route::post('/admin/order/{id}','admin\OrderController@doneorderpost')->middleware('permission:order-edit');
Route::get('/admin/order/statues_item/{id}','admin\OrderController@statuesitem');
Route::get('/admin/order/statues/{id}','admin\OrderController@statuesorder')->middleware('permission:order-ready');
Route::get('/admin/order/order_ready','admin\OrderController@orderreadyindex')->middleware('permission:show-order-ready');
Route::get('/admin/order/order_ready_change/{id}','admin\OrderController@orderchangeready')->middleware('permission:change-order-ready');
Route::get('/admin/order','admin\OrderController@orderindex')->middleware('permission:show-all-order');
Route::get('/admin/order/bills','admin\OrderController@bills')->middleware('permission:show-bills-order');
Route::get('/admin/order/your','admin\OrderController@yourorderindex')->middleware('permission:show-your-order');
Route::get('/admin/order/{id}/select','admin\OrderController@selectcompany');
Route::get('/admin/order/{id}/select/{id1}/{prices}','admin\OrderController@selectcompanypost');
Route::get('/admin/order/{id}/order_receipt_company','admin\OrderController@orderreceiptcompany');
Route::get('/admin/order/{id}/print','admin\OrderController@orderprint');
Route::post('/admin/order/item/discount/{id}','admin\OrderController@discount')->middleware('permission:item-discount');
Route::get('/admin/order/order_information/{id}','admin\OrderController@orderinformation');
Route::get('/admin/order/order_out/{id}','admin\OrderController@orderout');
Route::get('/admin/order/order_search','admin\OrderController@ordersearchget')->middleware('permission:order-search');
Route::get('/admin/order/order_search/index','admin\OrderController@ordersearchpost')->middleware('permission:order-search-index');
Route::get('/admin/order/order_search_discarded','admin\OrderController@ordersearchdiscardedget')->middleware('permission:order-search-discarded');
Route::get('/admin/order/discarded/{id}','admin\OrderController@orderdiscarded')->middleware('permission:order-discarded');
Route::get('/admin/order/pay/{id}','admin\OrderController@orderpay')->middleware('permission:pay-order');
Route::get('/admin/order/pay/','admin\OrderController@indexpay')->middleware('permission:order-index-pay');
Route::post('/admin/order/order_search_discarded/index','admin\OrderController@ordersearchdiscardedpost')->middleware('permission:order-search-discarded-index');
Route::get('/admin/order/with','admin\OrderController@indexorderwithyou')->middleware('permission:order-with');
Route::get('/admin/order/show_with/{id}','admin\OrderController@showorderwith')->middleware('permission:order-show-with');
Route::get('/admin/order/show_you/{id}','admin\OrderController@showyourorder')->middleware('permission:order-show-your');
Route::get('/admin/order/edit/{id}','admin\OrderController@editorder')->middleware('permission:order-edit');
Route::get('/admin/order/edit/{id}/{id1}','admin\OrderController@editorderpost')->middleware('permission:order-edit');
Route::get('/admin/order/cansal/{id}','admin\OrderController@cansalorder')->middleware('permission:order-cansal');
Route::get('/admin/order/change','admin\OrderController@orderchangeget')->middleware('permission:order-change');
Route::get('/admin/order/show_change/{id}','admin\OrderController@showchangeorder')->middleware('permission:show-change-order');
/*---------------Import_area-------*/
Route::get('/admin/import/area','admin\TempletAreaController@importareaget')->middleware('permission:import-area-create');
Route::Post('/admin/import/area','admin\TempletAreaController@importareapost')->middleware('permission:import-area-create');
Route::get('/admin/import/index/area','admin\TempletAreaController@indextempletarea')->middleware('permission:import-area-create');
Route::get('/admin/import/error/area','admin\TempletAreaController@unmatchedAreaGrouped')->middleware('permission:import-area-create');
Route::get('/admin/import/save/area','admin\TempletAreaController@SaveAreaGrouped')->middleware('permission:import-area-create');
/*---------------Import_bag-------*/
Route::get('/admin/import/bag','admin\TempletBagController@importbagget')->middleware('permission:import-bag-create');
Route::Post('/admin/import/bag','admin\TempletBagController@importbagpost')->middleware('permission:import-bag-create');
Route::get('/admin/import/index/bag','admin\TempletBagController@indextempletbag')->middleware('permission:import-bag-create');
Route::get('/admin/import/error/bag','admin\TempletBagController@unmatchedBagGrouped')->middleware('permission:import-bag-create');
Route::get('/admin/import/save/bag','admin\TempletBagController@SaveBagGrouped')->middleware('permission:import-bag-create');
/*---------------Import_brand-------*/
Route::get('/admin/import/brand','admin\TempletBrandController@importbrandget')->middleware('permission:import-brand-create');
Route::Post('/admin/import/brand','admin\TempletBrandController@importbrandpost')->middleware('permission:import-brand-create');
Route::get('/admin/import/index/brand','admin\TempletBrandController@indextempletbrand')->middleware('permission:import-brand-create');
Route::get('/admin/import/error/brand','admin\TempletBrandController@unmatchedBrandGrouped')->middleware('permission:import-brand-create');
Route::get('/admin/import/save/brand','admin\TempletBrandController@SaveBrandGrouped')->middleware('permission:import-brand-create');
/*---------------Import_city-------*/
Route::get('/admin/import/city','admin\TempletCityController@importcityget')->middleware('permission:import-city-create');
Route::Post('/admin/import/city','admin\TempletCityController@importcitypost')->middleware('permission:import-city-create');
Route::get('/admin/import/index/city','admin\TempletCityController@indextempletcity')->middleware('permission:import-city-create');
Route::get('/admin/import/error/city','admin\TempletCityController@unmatchedCityGrouped')->middleware('permission:import-city-create');
Route::get('/admin/import/save/city','admin\TempletCityController@SaveCityGrouped')->middleware('permission:import-city-create');
/*---------------Import_color-------*/
Route::get('/admin/import/color','admin\TempletColorController@importcolorget')->middleware('permission:import-color-create');
Route::Post('/admin/import/color','admin\TempletColorController@importcolorpost')->middleware('permission:import-color-create');
Route::get('/admin/import/index/color','admin\TempletColorController@indextempletcolor')->middleware('permission:import-color-create');
Route::get('/admin/import/error/color','admin\TempletColorController@unmatchedColorGrouped')->middleware('permission:import-color-create');
Route::get('/admin/import/save/color','admin\TempletColorController@SaveColorGrouped')->middleware('permission:import-color-create');
/*---------------Import_gender-------*/
/*Route::get('/admin/import/gender','admin\TempletGenderController@importgenderget')->middleware('permission:import-gender-create');
Route::Post('/admin/import/gender','admin\TempletGenderController@importgenderpost')->middleware('permission:import-gender-create');
Route::get('/admin/import/index/gender','admin\TempletGenderController@indextempletgender')->middleware('permission:import-gender-create');
Route::get('/admin/import/error/gender','admin\TempletGenderController@unmatchedGenderGrouped')->middleware('permission:import-gender-create');
Route::get('/admin/import/save/gender','admin\TempletGenderController@SaveGenderGrouped')->middleware('permission:import-gender-create');*/
/*---------------Import_item-------*/
Route::get('/admin/import/item','admin\TempletItemController@importitemget')->middleware('permission:import-item-create');
Route::Post('/admin/import/item','admin\TempletItemController@importitempost')->middleware('permission:import-item-create');
Route::get('/admin/import/index/item','admin\TempletItemController@indextempletitem')->middleware('permission:import-item-create');
Route::get('/admin/import/error/item','admin\TempletItemController@unmatchedItemGrouped')->middleware('permission:import-item-create');
Route::get('/admin/import/save/item','admin\TempletItemController@SaveItemGrouped')->middleware('permission:import-item-create');
Route::get('/admin/import/image/item','admin\ItemController@ImageItem')->middleware('permission:import-item-image');
Route::Post('/admin/import/image/item/save','admin\ItemController@Imagesave')->middleware('permission:import-item-image');
/*---------------Import_size-------*/
Route::get('/admin/import/size','admin\TempletSizeController@importsizeget')->middleware('permission:import-size-create');
Route::Post('/admin/import/size','admin\TempletSizeController@importsizepost')->middleware('permission:import-size-create');
Route::get('/admin/import/index/size','admin\TempletSizeController@indextempletsize')->middleware('permission:import-size-create');
Route::get('/admin/import/error/size','admin\TempletSizeController@unmatchedSizeGrouped')->middleware('permission:import-size-create');
Route::get('/admin/import/save/size','admin\TempletSizeController@SaveSizeGrouped')->middleware('permission:import-size-create');
/*---------------Import_supplier-------*/
Route::get('/admin/import/supplier','admin\TempletSupplierController@importsupplierget')->middleware('permission:import-supplier-create');
Route::Post('/admin/import/supplier','admin\TempletSupplierController@importsupplierpost')->middleware('permission:import-supplier-create');
Route::get('/admin/import/index/supplier','admin\TempletSupplierController@indextempletsupplier')->middleware('permission:import-supplier-create');
Route::get('/admin/import/error/supplier','admin\TempletSupplierController@unmatchedSupplierGrouped')->middleware('permission:import-supplier-create');
Route::get('/admin/import/save/supplier','admin\TempletSupplierController@SaveSupplierGrouped')->middleware('permission:import-supplier-create');
/*---------------Import_type-------*/
Route::get('/admin/import/type','admin\TempletTypeController@importtypeget')->middleware('permission:import-type-create');
Route::Post('/admin/import/type','admin\TempletTypeController@importtypepost')->middleware('permission:import-type-create');
Route::get('/admin/import/index/type','admin\TempletTypeController@indextemplettype')->middleware('permission:import-type-create');
Route::get('/admin/import/error/type','admin\TempletTypeController@unmatchedTypeGrouped')->middleware('permission:import-type-create');
Route::get('/admin/import/save/type','admin\TempletTypeController@SaveTypeGrouped')->middleware('permission:import-type-create');
/*---------------Import_description-------*/
Route::get('/admin/import/description','admin\TempletCategoryTypeController@importcategorytypeget')->middleware('permission:import-category-type-create');
Route::Post('/admin/import/description','admin\TempletCategoryTypeController@importcategorytypepost')->middleware('permission:import-category-type-create');
Route::get('/admin/import/index/description','admin\TempletCategoryTypeController@indextempletcategorytype')->middleware('permission:import-category-type-create');
Route::get('/admin/import/error/description','admin\TempletCategoryTypeController@unmatchedCategoryTypeGrouped')->middleware('permission:import-category-type-create');
Route::get('/admin/import/save/description','admin\TempletCategoryTypeController@SaveCategoryTypeGrouped')->middleware('permission:import-category-type-create');
/*---------------Import_company_delivery-------*/
Route::get('/admin/import/company_delivery','admin\TempletCompanyDeliveryController@importcompanydeliveryget')->middleware('permission:import-company-delivery-create');
Route::Post('/admin/import/company_delivery','admin\TempletCompanyDeliveryController@importcompanydeliverypost')->middleware('permission:import-company-delivery-create');
Route::get('/admin/import/index/company_delivery','admin\TempletCompanyDeliveryController@indextempletcompanydelivery')->middleware('permission:import-company-delivery-create');
Route::get('/admin/import/error/company_delivery','admin\TempletCompanyDeliveryController@unmatchedCompanyDeliveryGrouped')->middleware('permission:import-company-delivery-create');
Route::get('/admin/import/save/company_delivery','admin\TempletCompanyDeliveryController@SaveCompanyDeliveryGrouped')->middleware('permission:import-company-delivery-create');
/*---------------Import_user_delivery-------*/
Route::get('/admin/import/user_delivery','admin\TempletUserDeliveryController@importuserdeliveryget')->middleware('permission:import-user-delivery-create');
Route::Post('/admin/import/user_delivery','admin\TempletUserDeliveryController@importuserdeliverypost')->middleware('permission:import-user-delivery-create');
Route::get('/admin/import/index/user_delivery','admin\TempletUserDeliveryController@indextempletuserdelivery')->middleware('permission:import-user-delivery-create');
Route::get('/admin/import/error/user_delivery','admin\TempletUserDeliveryController@unmatchedUserDeliveryGrouped')->middleware('permission:import-user-delivery-create');
Route::get('/admin/import/save/user_delivery','admin\TempletUserDeliveryController@SaveUserDeliveryGrouped')->middleware('permission:import-user-delivery-create');
/*---------------Import_prices_delivery-------*/
Route::get('/admin/import/prices_delivery','admin\TempletPricesDeliveryController@importpricesdeliveryget')->middleware('permission:import-prices-delivery-create');
Route::Post('/admin/import/prices_delivery','admin\TempletPricesDeliveryController@importpricesdeliverypost')->middleware('permission:import-prices-delivery-create');
Route::get('/admin/import/index/prices_delivery','admin\TempletPricesDeliveryController@indextempletpricesdelivery')->middleware('permission:import-prices-delivery-create');
Route::get('/admin/import/error/prices_delivery','admin\TempletPricesDeliveryController@unmatchedPricesDeliveryGrouped')->middleware('permission:import-prices-delivery-create');
Route::get('/admin/import/save/prices_delivery','admin\TempletPricesDeliveryController@SavePricesDeliveryGrouped')->middleware('permission:import-prices-delivery-create');
/*---------------Home_Slider-------*/
Route::get('/admin/home_slider', 'admin\HomeSliderController@indexhomeslider')->middleware('permission:home-slider-show');
Route::get('/admin/home_slider/create', 'admin\HomeSliderController@createhomesliderget')->middleware('permission:home-slider-create');
Route::post('/admin/home_slider/create', 'admin\HomeSliderController@createhomesliderpost')->middleware('permission:home-slider-create');
Route::get('/admin/home_slider/delete/{id}', 'admin\HomeSliderController@deletehomeslider')->middleware('permission:home-slider-delete');
Route::get('/admin/home_slider/edit/{id}', 'admin\HomeSliderController@edithomesliderget')->middleware('permission:home-slider-edit');
Route::post('/admin/home_slider/edit/{id}', 'admin\HomeSliderController@edithomesliderpost')->middleware('permission:home-slider-edit');
/*---------------Contact_Us-------*/
Route::get('/admin/contact_us','admin\ContactUsController@indexcontactus')->middleware('permission:contact-us-show');
Route::get('/admin/contact_us/create','admin\ContactUsController@createcontactusget')->middleware('permission:contact-us-create');
Route::post('/admin/contact_us/create','admin\ContactUsController@createcontactuspost')->middleware('permission:contact-us-create');
Route::get('/admin/contact_us/edit/{id}','admin\ContactUsController@editcontactusget')->middleware('permission:contact-us-edit');
Route::patch('/admin/contact_us/edit/{id}','admin\ContactUsController@editcontactuspost')->middleware('permission:contact-us-edit');
/*---------------About_Us-------*/
Route::get('/admin/about_us', 'admin\AboutUsController@indexaboutus')->middleware('permission:about-us-show');
Route::get('/admin/about_us/create', 'admin\AboutUsController@createaboutusget')->middleware('permission:about-us-create');
Route::post('/admin/about_us/create', 'admin\AboutUsController@createaboutuspost')->middleware('permission:about-us-create');
Route::get('/admin/about_us/edit/{id}', 'admin\AboutUsController@editaboutusget')->middleware('permission:about-us-edit');
Route::post('/admin/about_us/edit/{id}', 'admin\AboutUsController@editaboutuspost')->middleware('permission:about-us-edit');
/*---------------Setting-------*/
Route::get('/admin/setting','admin\SettingController@indexsetting')->middleware('permission:setting-show');
Route::get('/admin/setting/create','admin\SettingController@createsettingget')->middleware('permission:setting-create');
Route::post('/admin/setting/create','admin\SettingController@createsettingpost')->middleware('permission:setting-create');
Route::get('/admin/setting/edit/{id}','admin\SettingController@editsettingget')->middleware('permission:setting-edit');
Route::post('/admin/setting/edit/{id}','admin\SettingController@editsettingpost')->middleware('permission:setting-edit');
/*---------------Report-------*/
Route::get('/admin/report/index_order_discarded','admin\ReportController@indexorderdiscarded')->middleware('permission:report-order-discarded');
Route::get('/admin/report/order_discarded_show/{id}','admin\ReportController@showorderdiscarded')->middleware('permission:show-discarded-order');
Route::get('/admin/report/select_time','admin\ReportController@selecttimesales')->middleware('permission:report-time-sales-show');
Route::get('/admin/report/select_time/sales','admin\ReportController@indexsales')->middleware('permission:report-time-sales-index');
Route::get('/admin/report/select_time/export','admin\ReportController@selecttimeexport')->middleware('permission:report-time-data-show');
Route::get('/admin/report/select_time/export_data','admin\ReportController@export');
Route::get('/admin/report/sales','admin\ReportController@report_sales_all')->middleware('permission:report-sales-index-all');
Route::get('/admin/report/store','admin\ReportController@report_store_all')->middleware('permission:report-store-all');
/*---------------call_us-------*/
Route::get('/admin/call_us/', 'admin\CallUsController@indexcallus')->middleware('permission:call-us-show');
Route::get('/admin/call_us/delete/{id}', 'admin\CallUsController@deletecallus')->middleware('permission:call-us-delete');
/*---------------Job-------*/
Route::get('/admin/job','admin\JobController@indexjob')->middleware('permission:job-show');
Route::get('/admin/job/create','admin\JobController@createjobget')->middleware('permission:job-create');
Route::post('/admin/job/create','admin\JobController@createjobpost')->middleware('permission:job-create');
Route::get('/admin/job/delete/{id}','admin\JobController@deletejob')->middleware('permission:job-delete');
Route::get('/admin/job/edit/{id}','admin\JobController@editjobget')->middleware('permission:job-edit');
Route::patch('/admin/job/edit/{id}','admin\JobController@editjobpost')->middleware('permission:job-edit');
/*---------------customer-------*/
Route::get('/admin/customer','admin\CustomerController@indexcustomer')->middleware('permission:customer-show');
/*---------------job_request-------*/
Route::get('/admin/job_request','admin\JobRequestController@indexjobrequest')->middleware('permission:job-request-show');
Route::get('/admin/job_request/delete/{id}','admin\JobRequestController@deletejobrequest')->middleware('permission:job-request-delete');
/*----------------------------------------------------------frontend--------------------*/
Route::get('/', 'frontend\HomeController@home');
Route::post('/item1', 'frontend\HomeController@item1');
Route::get('/discount', 'frontend\HomeController@discount_item');
Route::get('/item/{name}', 'frontend\HomeController@item');
Route::get('/about_us', 'frontend\HomeController@about_us');
Route::get('/contact_us', 'frontend\HomeController@contact_us');
Route::post('/call_us', 'frontend\HomeController@call_us');
Route::get('/job','frontend\HomeController@job');
Route::post('/job','frontend\HomeController@requestjob');
Route::get('/sign_up', 'frontend\HomeController@sign_up');
Route::get('/register', 'frontend\HomeController@register');
Route::post('/register/create', 'frontend\HomeController@create');
Route::get('/finish', 'frontend\HomeController@finish');
Route::post('/finish/create', 'frontend\HomeController@finishcreate');
Route::get('/profile', 'frontend\HomeController@profile')->middleware('permission:profile');
Route::patch('/profile/edit', 'frontend\HomeController@profileedit')->middleware('permission:profile');
Route::get('/cart', 'frontend\HomeController@cart');
/*Route::get('/select/{id}', 'frontend\HomeController@select');*/
Route::post('/set_cart', 'frontend\HomeController@set_cart');
Route::post('/canasel', 'frontend\HomeController@canasel');
Route::get('/your_history', 'frontend\HomeController@your_history')->middleware('permission:your-history');
Route::get('get-item-filter','frontend\HomeController@filter');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return view('/');
});