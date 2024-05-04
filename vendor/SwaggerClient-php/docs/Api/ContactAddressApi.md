# Swagger\Client\ContactAddressApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**contactAddressId**](ContactAddressApi.md#contactaddressid) | **GET** /ContactAddress/{contactAddressId} | Find contact address by ID
[**createContactAddress**](ContactAddressApi.md#createcontactaddress) | **POST** /ContactAddress | Create a new contact address
[**deleteContactAddress**](ContactAddressApi.md#deletecontactaddress) | **DELETE** /ContactAddress/{contactAddressId} | Deletes a contact address
[**getContactAddresses**](ContactAddressApi.md#getcontactaddresses) | **GET** /ContactAddress | Retrieve contact addresses
[**updateContactAddress**](ContactAddressApi.md#updatecontactaddress) | **PUT** /ContactAddress/{contactAddressId} | update a existing contact address

# **contactAddressId**
> \Swagger\Client\Model\InlineResponse2008 contactAddressId($contact_address_id)

Find contact address by ID

Returns a single contact address

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactAddressApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_address_id = 56; // int | ID of contact address to return

try {
    $result = $apiInstance->contactAddressId($contact_address_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactAddressApi->contactAddressId: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_address_id** | **int**| ID of contact address to return |

### Return type

[**\Swagger\Client\Model\InlineResponse2008**](../Model/InlineResponse2008.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createContactAddress**
> \Swagger\Client\Model\ModelContactAddressResponse createContactAddress($body)

Create a new contact address

Creates a new contact address.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactAddressApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelContactAddress(); // \Swagger\Client\Model\ModelContactAddress | Creation data

try {
    $result = $apiInstance->createContactAddress($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactAddressApi->createContactAddress: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelContactAddress**](../Model/ModelContactAddress.md)| Creation data | [optional]

### Return type

[**\Swagger\Client\Model\ModelContactAddressResponse**](../Model/ModelContactAddressResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteContactAddress**
> \Swagger\Client\Model\InlineResponse2001 deleteContactAddress($contact_address_id)

Deletes a contact address

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactAddressApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_address_id = 56; // int | Id of contact address resource to delete

try {
    $result = $apiInstance->deleteContactAddress($contact_address_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactAddressApi->deleteContactAddress: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_address_id** | **int**| Id of contact address resource to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContactAddresses**
> \Swagger\Client\Model\InlineResponse2008 getContactAddresses()

Retrieve contact addresses

Retrieve all contact addresses

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactAddressApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getContactAddresses();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactAddressApi->getContactAddresses: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse2008**](../Model/InlineResponse2008.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateContactAddress**
> \Swagger\Client\Model\ModelContactAddressResponse updateContactAddress($contact_address_id, $body)

update a existing contact address

update a existing contact address.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactAddressApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_address_id = 56; // int | ID of contact address to return
$body = new \Swagger\Client\Model\ModelContactAddressUpdate(); // \Swagger\Client\Model\ModelContactAddressUpdate | Creation data

try {
    $result = $apiInstance->updateContactAddress($contact_address_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactAddressApi->updateContactAddress: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_address_id** | **int**| ID of contact address to return |
 **body** | [**\Swagger\Client\Model\ModelContactAddressUpdate**](../Model/ModelContactAddressUpdate.md)| Creation data | [optional]

### Return type

[**\Swagger\Client\Model\ModelContactAddressResponse**](../Model/ModelContactAddressResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

