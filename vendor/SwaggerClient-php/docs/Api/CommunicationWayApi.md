# Swagger\Client\CommunicationWayApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createCommunicationWay**](CommunicationWayApi.md#createcommunicationway) | **POST** /CommunicationWay | Create a new contact communication way
[**deleteCommunicationWay**](CommunicationWayApi.md#deletecommunicationway) | **DELETE** /CommunicationWay/{communicationWayId} | Deletes a communication way
[**getCommunicationWayById**](CommunicationWayApi.md#getcommunicationwaybyid) | **GET** /CommunicationWay/{communicationWayId} | Find communication way by ID
[**getCommunicationWayKeys**](CommunicationWayApi.md#getcommunicationwaykeys) | **GET** /CommunicationWayKey | Retrieve communication way keys
[**getCommunicationWays**](CommunicationWayApi.md#getcommunicationways) | **GET** /CommunicationWay | Retrieve communication ways
[**updateCommunicationWay**](CommunicationWayApi.md#updatecommunicationway) | **PUT** /CommunicationWay/{communicationWayId} | Update a existing communication way

# **createCommunicationWay**
> \Swagger\Client\Model\ModelCommunicationWayResponse createCommunicationWay($body)

Create a new contact communication way

Creates a new contact communication way.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CommunicationWayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelCommunicationWay(); // \Swagger\Client\Model\ModelCommunicationWay | Creation data

try {
    $result = $apiInstance->createCommunicationWay($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommunicationWayApi->createCommunicationWay: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelCommunicationWay**](../Model/ModelCommunicationWay.md)| Creation data | [optional]

### Return type

[**\Swagger\Client\Model\ModelCommunicationWayResponse**](../Model/ModelCommunicationWayResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteCommunicationWay**
> \Swagger\Client\Model\InlineResponse2001 deleteCommunicationWay($communication_way_id)

Deletes a communication way

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CommunicationWayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$communication_way_id = 56; // int | Id of communication way resource to delete

try {
    $result = $apiInstance->deleteCommunicationWay($communication_way_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommunicationWayApi->deleteCommunicationWay: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **communication_way_id** | **int**| Id of communication way resource to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCommunicationWayById**
> \Swagger\Client\Model\InlineResponse2009 getCommunicationWayById($communication_way_id)

Find communication way by ID

Returns a single communication way

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CommunicationWayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$communication_way_id = 56; // int | ID of communication way to return

try {
    $result = $apiInstance->getCommunicationWayById($communication_way_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommunicationWayApi->getCommunicationWayById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **communication_way_id** | **int**| ID of communication way to return |

### Return type

[**\Swagger\Client\Model\InlineResponse2009**](../Model/InlineResponse2009.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCommunicationWayKeys**
> \Swagger\Client\Model\InlineResponse20010 getCommunicationWayKeys()

Retrieve communication way keys

Returns all communication way keys.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CommunicationWayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getCommunicationWayKeys();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommunicationWayApi->getCommunicationWayKeys: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse20010**](../Model/InlineResponse20010.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCommunicationWays**
> \Swagger\Client\Model\InlineResponse2009 getCommunicationWays($contact_id, $contact_object_name, $type, $main)

Retrieve communication ways

Returns all communication ways which have been added up until now. Filters can be added.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CommunicationWayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_id = "contact_id_example"; // string | ID of contact for which you want the communication ways.
$contact_object_name = "contact_object_name_example"; // string | Object name. Only needed if you also defined the ID of a contact.
$type = "type_example"; // string | Type of the communication ways you want to get.
$main = "main_example"; // string | Define if you only want the main communication way.

try {
    $result = $apiInstance->getCommunicationWays($contact_id, $contact_object_name, $type, $main);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommunicationWayApi->getCommunicationWays: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **string**| ID of contact for which you want the communication ways. | [optional]
 **contact_object_name** | **string**| Object name. Only needed if you also defined the ID of a contact. | [optional]
 **type** | **string**| Type of the communication ways you want to get. | [optional]
 **main** | **string**| Define if you only want the main communication way. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2009**](../Model/InlineResponse2009.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateCommunicationWay**
> \Swagger\Client\Model\ModelCommunicationWayResponse updateCommunicationWay($communication_way_id, $body)

Update a existing communication way

Update a communication way

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CommunicationWayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$communication_way_id = 56; // int | ID of CommunicationWay to update
$body = new \Swagger\Client\Model\ModelCommunicationWayUpdate(); // \Swagger\Client\Model\ModelCommunicationWayUpdate | Update data

try {
    $result = $apiInstance->updateCommunicationWay($communication_way_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommunicationWayApi->updateCommunicationWay: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **communication_way_id** | **int**| ID of CommunicationWay to update |
 **body** | [**\Swagger\Client\Model\ModelCommunicationWayUpdate**](../Model/ModelCommunicationWayUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelCommunicationWayResponse**](../Model/ModelCommunicationWayResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

