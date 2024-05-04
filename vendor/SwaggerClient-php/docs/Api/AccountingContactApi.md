# Swagger\Client\AccountingContactApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createAccountingContact**](AccountingContactApi.md#createaccountingcontact) | **POST** /AccountingContact | Create a new accounting contact
[**deleteAccountingContact**](AccountingContactApi.md#deleteaccountingcontact) | **DELETE** /AccountingContact/{accountingContactId} | Deletes an accounting contact
[**getAccountingContact**](AccountingContactApi.md#getaccountingcontact) | **GET** /AccountingContact | Retrieve accounting contact
[**getAccountingContactById**](AccountingContactApi.md#getaccountingcontactbyid) | **GET** /AccountingContact/{accountingContactId} | Find accounting contact by ID
[**updateAccountingContact**](AccountingContactApi.md#updateaccountingcontact) | **PUT** /AccountingContact/{accountingContactId} | Update an existing accounting contact

# **createAccountingContact**
> \Swagger\Client\Model\ModelAccountingContactResponse createAccountingContact($body)

Create a new accounting contact

Creates a new accounting contact.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelAccountingContact(); // \Swagger\Client\Model\ModelAccountingContact | Creation data

try {
    $result = $apiInstance->createAccountingContact($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->createAccountingContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelAccountingContact**](../Model/ModelAccountingContact.md)| Creation data | [optional]

### Return type

[**\Swagger\Client\Model\ModelAccountingContactResponse**](../Model/ModelAccountingContactResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteAccountingContact**
> \Swagger\Client\Model\InlineResponse2001 deleteAccountingContact($accounting_contact_id)

Deletes an accounting contact

Attention, deleting an existing AccountingContact can lead to **booking errors**, especially in the **DATEV export**. Compatibility of sevDesk with DATEV is no longer guaranteed.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$accounting_contact_id = 56; // int | Id of accounting contact resource to delete

try {
    $result = $apiInstance->deleteAccountingContact($accounting_contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->deleteAccountingContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **accounting_contact_id** | **int**| Id of accounting contact resource to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAccountingContact**
> \Swagger\Client\Model\InlineResponse20011 getAccountingContact($contact_id, $contact_object_name)

Retrieve accounting contact

Returns all accounting contact which have been added up until now. Filters can be added.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_id = "contact_id_example"; // string | ID of contact for which you want the accounting contact.
$contact_object_name = "contact_object_name_example"; // string | Object name. Only needed if you also defined the ID of a contact.

try {
    $result = $apiInstance->getAccountingContact($contact_id, $contact_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->getAccountingContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **string**| ID of contact for which you want the accounting contact. | [optional]
 **contact_object_name** | **string**| Object name. Only needed if you also defined the ID of a contact. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20011**](../Model/InlineResponse20011.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAccountingContactById**
> \Swagger\Client\Model\InlineResponse20011 getAccountingContactById($accounting_contact_id)

Find accounting contact by ID

Returns a single accounting contac

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$accounting_contact_id = 56; // int | ID of accounting contact to return

try {
    $result = $apiInstance->getAccountingContactById($accounting_contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->getAccountingContactById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **accounting_contact_id** | **int**| ID of accounting contact to return |

### Return type

[**\Swagger\Client\Model\InlineResponse20011**](../Model/InlineResponse20011.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateAccountingContact**
> \Swagger\Client\Model\ModelAccountingContactResponse updateAccountingContact($accounting_contact_id, $body)

Update an existing accounting contact

Attention, updating an existing AccountingContact can lead to **booking errors**, especially in the **DATEV export**. Compatibility of sevDesk with DATEV is no longer guaranteed.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$accounting_contact_id = 56; // int | ID of accounting contact to update
$body = new \Swagger\Client\Model\ModelAccountingContactUpdate(); // \Swagger\Client\Model\ModelAccountingContactUpdate | Update data

try {
    $result = $apiInstance->updateAccountingContact($accounting_contact_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->updateAccountingContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **accounting_contact_id** | **int**| ID of accounting contact to update |
 **body** | [**\Swagger\Client\Model\ModelAccountingContactUpdate**](../Model/ModelAccountingContactUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelAccountingContactResponse**](../Model/ModelAccountingContactResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

