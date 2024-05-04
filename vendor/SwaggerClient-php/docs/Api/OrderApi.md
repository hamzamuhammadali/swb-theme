# Swagger\Client\OrderApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createContractNoteFromOrder**](OrderApi.md#createcontractnotefromorder) | **POST** /Order/Factory/createContractNoteFromOrder | Create contract note from order
[**createOrder**](OrderApi.md#createorder) | **POST** /Order/Factory/saveOrder | Create a new order
[**createPackingListFromOrder**](OrderApi.md#createpackinglistfromorder) | **POST** /Order/Factory/createPackingListFromOrder | Create packing list from order
[**deleteOrder**](OrderApi.md#deleteorder) | **DELETE** /Order/{orderId} | Deletes an order
[**getDiscounts**](OrderApi.md#getdiscounts) | **GET** /Order/{orderId}/getDiscounts | Find order discounts
[**getOrderById**](OrderApi.md#getorderbyid) | **GET** /Order/{orderId} | Find order by ID
[**getOrderPositionsById**](OrderApi.md#getorderpositionsbyid) | **GET** /Order/{orderId}/getPositions | Find order positions
[**getOrders**](OrderApi.md#getorders) | **GET** /Order | Retrieve orders
[**getRelatedObjects**](OrderApi.md#getrelatedobjects) | **GET** /Order/{orderId}/getRelatedObjects | Find related objects
[**orderGetPdf**](OrderApi.md#ordergetpdf) | **GET** /Order/{orderId}/getPdf | Retrieve pdf document of an order
[**orderSendBy**](OrderApi.md#ordersendby) | **PUT** /Order/{orderId}/sendBy | Mark order as sent
[**sendorderViaEMail**](OrderApi.md#sendorderviaemail) | **POST** /Order/{orderId}/sendViaEmail | Send order via email
[**updateOrder**](OrderApi.md#updateorder) | **PUT** /Order/{orderId} | Update an existing order

# **createContractNoteFromOrder**
> \Swagger\Client\Model\ModelOrderResponse createContractNoteFromOrder($order_id, $order_object_name, $body)

Create contract note from order

Create contract note from order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | the id of the order
$order_object_name = "order_object_name_example"; // string | Model name, which is 'Order'
$body = new \Swagger\Client\Model\ModelCreatePackingListFromOrder(); // \Swagger\Client\Model\ModelCreatePackingListFromOrder | Create contract note

try {
    $result = $apiInstance->createContractNoteFromOrder($order_id, $order_object_name, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->createContractNoteFromOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| the id of the order |
 **order_object_name** | **string**| Model name, which is &#x27;Order&#x27; |
 **body** | [**\Swagger\Client\Model\ModelCreatePackingListFromOrder**](../Model/ModelCreatePackingListFromOrder.md)| Create contract note | [optional]

### Return type

[**\Swagger\Client\Model\ModelOrderResponse**](../Model/ModelOrderResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createOrder**
> \Swagger\Client\Model\SaveOrderResponse createOrder($body)

Create a new order

Creates an order to which positions can be added later.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\SaveOrder(); // \Swagger\Client\Model\SaveOrder | Creation data. Please be aware, that you need to provide at least all required parameter
    of the order model!

try {
    $result = $apiInstance->createOrder($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->createOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\SaveOrder**](../Model/SaveOrder.md)| Creation data. Please be aware, that you need to provide at least all required parameter
    of the order model! | [optional]

### Return type

[**\Swagger\Client\Model\SaveOrderResponse**](../Model/SaveOrderResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createPackingListFromOrder**
> \Swagger\Client\Model\ModelOrderResponse createPackingListFromOrder($order_id, $order_object_name, $body)

Create packing list from order

Create packing list from order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | the id of the order
$order_object_name = "order_object_name_example"; // string | Model name, which is 'Order'
$body = new \Swagger\Client\Model\ModelCreatePackingListFromOrder(); // \Swagger\Client\Model\ModelCreatePackingListFromOrder | Create packing list

try {
    $result = $apiInstance->createPackingListFromOrder($order_id, $order_object_name, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->createPackingListFromOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| the id of the order |
 **order_object_name** | **string**| Model name, which is &#x27;Order&#x27; |
 **body** | [**\Swagger\Client\Model\ModelCreatePackingListFromOrder**](../Model/ModelCreatePackingListFromOrder.md)| Create packing list | [optional]

### Return type

[**\Swagger\Client\Model\ModelOrderResponse**](../Model/ModelOrderResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteOrder**
> \Swagger\Client\Model\InlineResponse2001 deleteOrder($order_id)

Deletes an order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | Id of order resource to delete

try {
    $result = $apiInstance->deleteOrder($order_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->deleteOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| Id of order resource to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getDiscounts**
> \Swagger\Client\Model\InlineResponse20038 getDiscounts($order_id, $limit, $offset, $embed)

Find order discounts

Returns all discounts of an order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order to return the positions
$limit = 56; // int | limits the number of entries returned
$offset = 56; // int | set the index where the returned entries start
$embed = array("embed_example"); // string[] | Get some additional information. Embed can handle multiple values, they must be separated by comma.

try {
    $result = $apiInstance->getDiscounts($order_id, $limit, $offset, $embed);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->getDiscounts: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order to return the positions |
 **limit** | **int**| limits the number of entries returned | [optional]
 **offset** | **int**| set the index where the returned entries start | [optional]
 **embed** | [**string[]**](../Model/string.md)| Get some additional information. Embed can handle multiple values, they must be separated by comma. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20038**](../Model/InlineResponse20038.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrderById**
> \Swagger\Client\Model\InlineResponse20036 getOrderById($order_id)

Find order by ID

Returns a single order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order to return

try {
    $result = $apiInstance->getOrderById($order_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->getOrderById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order to return |

### Return type

[**\Swagger\Client\Model\InlineResponse20036**](../Model/InlineResponse20036.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrderPositionsById**
> \Swagger\Client\Model\InlineResponse20037 getOrderPositionsById($order_id, $limit, $offset, $embed)

Find order positions

Returns all positions of an order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order to return the positions
$limit = 56; // int | limits the number of entries returned
$offset = 56; // int | set the index where the returned entries start
$embed = array("embed_example"); // string[] | Get some additional information. Embed can handle multiple values, they must be separated by comma.

try {
    $result = $apiInstance->getOrderPositionsById($order_id, $limit, $offset, $embed);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->getOrderPositionsById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order to return the positions |
 **limit** | **int**| limits the number of entries returned | [optional]
 **offset** | **int**| set the index where the returned entries start | [optional]
 **embed** | [**string[]**](../Model/string.md)| Get some additional information. Embed can handle multiple values, they must be separated by comma. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20037**](../Model/InlineResponse20037.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrders**
> \Swagger\Client\Model\InlineResponse20036 getOrders($status, $order_number, $start_date, $end_date, $contact_id, $contact_object_name)

Retrieve orders

There are a multitude of parameter which can be used to filter. A few of them are attached but      for a complete list please check out <a href='https://api.sevdesk.de/#section/How-to-filter-for-certain-orders'>this</a> list

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$status = 56; // int | Status of the order
$order_number = "order_number_example"; // string | Retrieve all orders with this order number
$start_date = 56; // int | Retrieve all orders with a date equal or higher
$end_date = 56; // int | Retrieve all orders with a date equal or lower
$contact_id = 56; // int | Retrieve all orders with this contact. Must be provided with contact[objectName]
$contact_object_name = "contact_object_name_example"; // string | Only required if contact[id] was provided. 'Contact' should be used as value.

try {
    $result = $apiInstance->getOrders($status, $order_number, $start_date, $end_date, $contact_id, $contact_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->getOrders: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **status** | **int**| Status of the order | [optional]
 **order_number** | **string**| Retrieve all orders with this order number | [optional]
 **start_date** | **int**| Retrieve all orders with a date equal or higher | [optional]
 **end_date** | **int**| Retrieve all orders with a date equal or lower | [optional]
 **contact_id** | **int**| Retrieve all orders with this contact. Must be provided with contact[objectName] | [optional]
 **contact_object_name** | **string**| Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20036**](../Model/InlineResponse20036.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getRelatedObjects**
> \Swagger\Client\Model\InlineResponse20037 getRelatedObjects($order_id, $include_itself, $sort_by_type, $embed)

Find related objects

Get related objects of a specified order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order to return the positions
$include_itself = true; // bool | Define if the related objects include the order itself
$sort_by_type = true; // bool | Define if you want the related objects sorted by type
$embed = array("embed_example"); // string[] | Get some additional information. Embed can handle multiple values, they must be separated by comma.

try {
    $result = $apiInstance->getRelatedObjects($order_id, $include_itself, $sort_by_type, $embed);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->getRelatedObjects: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order to return the positions |
 **include_itself** | **bool**| Define if the related objects include the order itself | [optional]
 **sort_by_type** | **bool**| Define if you want the related objects sorted by type | [optional]
 **embed** | [**string[]**](../Model/string.md)| Get some additional information. Embed can handle multiple values, they must be separated by comma. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20037**](../Model/InlineResponse20037.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **orderGetPdf**
> \Swagger\Client\Model\InlineResponse20039 orderGetPdf($order_id, $download, $prevent_send_by)

Retrieve pdf document of an order

Retrieves the pdf document of an order with additional metadata and commit the order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order from which you want the pdf
$download = true; // bool | If u want to download the pdf of the order.
$prevent_send_by = true; // bool | Defines if u want to send the order.

try {
    $result = $apiInstance->orderGetPdf($order_id, $download, $prevent_send_by);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->orderGetPdf: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order from which you want the pdf |
 **download** | **bool**| If u want to download the pdf of the order. | [optional]
 **prevent_send_by** | **bool**| Defines if u want to send the order. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20039**](../Model/InlineResponse20039.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **orderSendBy**
> \Swagger\Client\Model\ModelOrderResponse orderSendBy($order_id, $body)

Mark order as sent

Marks an order as sent by a chosen send type.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order to mark as sent
$body = new \Swagger\Client\Model\OrderIdSendByBody(); // \Swagger\Client\Model\OrderIdSendByBody | Specify the send type

try {
    $result = $apiInstance->orderSendBy($order_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->orderSendBy: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order to mark as sent |
 **body** | [**\Swagger\Client\Model\OrderIdSendByBody**](../Model/OrderIdSendByBody.md)| Specify the send type | [optional]

### Return type

[**\Swagger\Client\Model\ModelOrderResponse**](../Model/ModelOrderResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **sendorderViaEMail**
> \Swagger\Client\Model\InlineResponse2013 sendorderViaEMail($order_id, $body)

Send order via email

This endpoint sends the specified order to a customer via email.<br>      This will automatically mark the order as sent.<br>      Please note, that in production an order is not allowed to be changed after this happened!

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order to be sent via email
$body = new \Swagger\Client\Model\OrderIdSendViaEmailBody(); // \Swagger\Client\Model\OrderIdSendViaEmailBody | Mail data

try {
    $result = $apiInstance->sendorderViaEMail($order_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->sendorderViaEMail: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order to be sent via email |
 **body** | [**\Swagger\Client\Model\OrderIdSendViaEmailBody**](../Model/OrderIdSendViaEmailBody.md)| Mail data | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2013**](../Model/InlineResponse2013.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateOrder**
> \Swagger\Client\Model\ModelOrderResponse updateOrder($order_id, $body)

Update an existing order

Update an order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of order to update
$body = new \Swagger\Client\Model\ModelOrderUpdate(); // \Swagger\Client\Model\ModelOrderUpdate | Update data

try {
    $result = $apiInstance->updateOrder($order_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->updateOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| ID of order to update |
 **body** | [**\Swagger\Client\Model\ModelOrderUpdate**](../Model/ModelOrderUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelOrderResponse**](../Model/ModelOrderResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

