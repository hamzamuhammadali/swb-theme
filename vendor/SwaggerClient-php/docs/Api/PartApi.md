# Swagger\Client\PartApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createPart**](PartApi.md#createpart) | **POST** /Part | Create a new part
[**getPartById**](PartApi.md#getpartbyid) | **GET** /Part/{partId} | Find part by ID
[**getParts**](PartApi.md#getparts) | **GET** /Part | Retrieve parts
[**partGetStock**](PartApi.md#partgetstock) | **GET** /Part/{partId}/getStock | Get stock of a part
[**updatePart**](PartApi.md#updatepart) | **PUT** /Part/{partId} | Update an existing part

# **createPart**
> \Swagger\Client\Model\ModelPart createPart($body)

Create a new part

Creates a part in your sevDesk inventory.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\PartApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelPart(); // \Swagger\Client\Model\ModelPart | Creation data. Please be aware, that you need to provide at least all required parameter
    of the part model!

try {
    $result = $apiInstance->createPart($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartApi->createPart: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelPart**](../Model/ModelPart.md)| Creation data. Please be aware, that you need to provide at least all required parameter
    of the part model! | [optional]

### Return type

[**\Swagger\Client\Model\ModelPart**](../Model/ModelPart.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPartById**
> \Swagger\Client\Model\InlineResponse20028 getPartById($part_id)

Find part by ID

Returns a single part

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\PartApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$part_id = 56; // int | ID of part to return

try {
    $result = $apiInstance->getPartById($part_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartApi->getPartById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **part_id** | **int**| ID of part to return |

### Return type

[**\Swagger\Client\Model\InlineResponse20028**](../Model/InlineResponse20028.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getParts**
> \Swagger\Client\Model\InlineResponse20028 getParts($part_number, $name)

Retrieve parts

Retrieve all parts in your sevDesk inventory according to the applied filters.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\PartApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$part_number = "part_number_example"; // string | Retrieve all parts with this part number
$name = "name_example"; // string | Retrieve all parts with this name

try {
    $result = $apiInstance->getParts($part_number, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartApi->getParts: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **part_number** | **string**| Retrieve all parts with this part number | [optional]
 **name** | **string**| Retrieve all parts with this name | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20028**](../Model/InlineResponse20028.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **partGetStock**
> \Swagger\Client\Model\InlineResponse20029 partGetStock($part_id)

Get stock of a part

Returns the current stock amount of the given part.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\PartApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$part_id = 56; // int | ID of part for which you want the current stock.

try {
    $result = $apiInstance->partGetStock($part_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartApi->partGetStock: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **part_id** | **int**| ID of part for which you want the current stock. |

### Return type

[**\Swagger\Client\Model\InlineResponse20029**](../Model/InlineResponse20029.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updatePart**
> \Swagger\Client\Model\ModelPart updatePart($part_id, $body)

Update an existing part

Update a part

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\PartApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$part_id = 56; // int | ID of part to update
$body = new \Swagger\Client\Model\ModelPartUpdate(); // \Swagger\Client\Model\ModelPartUpdate | Update data

try {
    $result = $apiInstance->updatePart($part_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartApi->updatePart: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **part_id** | **int**| ID of part to update |
 **body** | [**\Swagger\Client\Model\ModelPartUpdate**](../Model/ModelPartUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelPart**](../Model/ModelPart.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

