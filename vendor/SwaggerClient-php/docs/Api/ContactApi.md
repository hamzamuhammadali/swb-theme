# Swagger\Client\ContactApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**contactCustomerNumberAvailabilityCheck**](ContactApi.md#contactcustomernumberavailabilitycheck) | **GET** /Contact/Mapper/checkCustomerNumberAvailability | Check if a customer number is available
[**createContact**](ContactApi.md#createcontact) | **POST** /Contact | Create a new contact
[**deleteContact**](ContactApi.md#deletecontact) | **DELETE** /Contact/{contactId} | Deletes a contact
[**findContactsByCustomFieldValue**](ContactApi.md#findcontactsbycustomfieldvalue) | **GET** /Contact/Factory/findContactsByCustomFieldValue | Find contacts by custom field value
[**getContactById**](ContactApi.md#getcontactbyid) | **GET** /Contact/{contactId} | Find contact by ID
[**getContactTabsItemCountById**](ContactApi.md#getcontacttabsitemcountbyid) | **GET** /Contact/{contactId}/getTabsItemCount | Get number of all items
[**getContacts**](ContactApi.md#getcontacts) | **GET** /Contact | Retrieve contacts
[**getNextCustomerNumber**](ContactApi.md#getnextcustomernumber) | **GET** /Contact/Factory/getNextCustomerNumber | Get next free customer number
[**updateContact**](ContactApi.md#updatecontact) | **PUT** /Contact/{contactId} | Update a existing contact

# **contactCustomerNumberAvailabilityCheck**
> \Swagger\Client\Model\InlineResponse2006 contactCustomerNumberAvailabilityCheck($customer_number)

Check if a customer number is available

Checks if a given customer number is available or already used.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$customer_number = "customer_number_example"; // string | The customer number to be checked.

try {
    $result = $apiInstance->contactCustomerNumberAvailabilityCheck($customer_number);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->contactCustomerNumberAvailabilityCheck: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **customer_number** | **string**| The customer number to be checked. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2006**](../Model/InlineResponse2006.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createContact**
> \Swagger\Client\Model\ModelContactResponse createContact($body)

Create a new contact

Creates a new contact.<br>       For adding addresses and communication ways, you will need to use the ContactAddress and CommunicationWay endpoints.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelContact(); // \Swagger\Client\Model\ModelContact | Creation data

try {
    $result = $apiInstance->createContact($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->createContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelContact**](../Model/ModelContact.md)| Creation data | [optional]

### Return type

[**\Swagger\Client\Model\ModelContactResponse**](../Model/ModelContactResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteContact**
> \Swagger\Client\Model\InlineResponse2001 deleteContact($contact_id)

Deletes a contact

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_id = 56; // int | Id of contact resource to delete

try {
    $result = $apiInstance->deleteContact($contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->deleteContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **int**| Id of contact resource to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **findContactsByCustomFieldValue**
> \Swagger\Client\Model\InlineResponse2005 findContactsByCustomFieldValue($value, $custom_field_name, $custom_field_setting_id, $custom_field_setting_object_name)

Find contacts by custom field value

Returns an array of contacts having a certain custom field value set.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$value = "value_example"; // string | The value to be checked.
$custom_field_name = "custom_field_name_example"; // string | The ContactCustomFieldSetting name, if no ContactCustomFieldSetting is provided.
$custom_field_setting_id = "custom_field_setting_id_example"; // string | ID of ContactCustomFieldSetting for which the value has to be checked.
$custom_field_setting_object_name = "custom_field_setting_object_name_example"; // string | Object name. Only needed if you also defined the ID of a ContactCustomFieldSetting.

try {
    $result = $apiInstance->findContactsByCustomFieldValue($value, $custom_field_name, $custom_field_setting_id, $custom_field_setting_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->findContactsByCustomFieldValue: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **value** | **string**| The value to be checked. |
 **custom_field_name** | **string**| The ContactCustomFieldSetting name, if no ContactCustomFieldSetting is provided. |
 **custom_field_setting_id** | **string**| ID of ContactCustomFieldSetting for which the value has to be checked. | [optional]
 **custom_field_setting_object_name** | **string**| Object name. Only needed if you also defined the ID of a ContactCustomFieldSetting. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2005**](../Model/InlineResponse2005.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContactById**
> \Swagger\Client\Model\InlineResponse2005 getContactById($contact_id)

Find contact by ID

Returns a single contact

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_id = 56; // int | ID of contact to return

try {
    $result = $apiInstance->getContactById($contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->getContactById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **int**| ID of contact to return |

### Return type

[**\Swagger\Client\Model\InlineResponse2005**](../Model/InlineResponse2005.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContactTabsItemCountById**
> \Swagger\Client\Model\InlineResponse2007 getContactTabsItemCountById($contact_id)

Get number of all items

Get number of all invoices, orders, etc. of a specified contact

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_id = 56; // int | ID of contact to return

try {
    $result = $apiInstance->getContactTabsItemCountById($contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->getContactTabsItemCountById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **int**| ID of contact to return |

### Return type

[**\Swagger\Client\Model\InlineResponse2007**](../Model/InlineResponse2007.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContacts**
> \Swagger\Client\Model\InlineResponse2005 getContacts($depth, $customer_number)

Retrieve contacts

There are a multitude of parameter which can be used to filter.<br>       A few of them are attached but       for a complete list please check out <a href='https://api.sevdesk.de/#section/How-to-filter-for-certain-contacts'>this</a> list

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$depth = "depth_example"; // string | Defines if both organizations <b>and</b> persons should be returned.<br>       '0' -> only organizations, '1' -> organizations and persons
$customer_number = "customer_number_example"; // string | Retrieve all contacts with this customer number

try {
    $result = $apiInstance->getContacts($depth, $customer_number);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->getContacts: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **depth** | **string**| Defines if both organizations &lt;b&gt;and&lt;/b&gt; persons should be returned.&lt;br&gt;       &#x27;0&#x27; -&gt; only organizations, &#x27;1&#x27; -&gt; organizations and persons | [optional]
 **customer_number** | **string**| Retrieve all contacts with this customer number | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2005**](../Model/InlineResponse2005.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getNextCustomerNumber**
> \Swagger\Client\Model\InlineResponse2004 getNextCustomerNumber()

Get next free customer number

Retrieves the next available customer number. Avoids duplicates.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getNextCustomerNumber();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->getNextCustomerNumber: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse2004**](../Model/InlineResponse2004.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateContact**
> \Swagger\Client\Model\ModelContactResponse updateContact($contact_id, $body)

Update a existing contact

Update a contact

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_id = 56; // int | ID of contact to update
$body = new \Swagger\Client\Model\ModelContactUpdate(); // \Swagger\Client\Model\ModelContactUpdate | Update data

try {
    $result = $apiInstance->updateContact($contact_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactApi->updateContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **int**| ID of contact to update |
 **body** | [**\Swagger\Client\Model\ModelContactUpdate**](../Model/ModelContactUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelContactResponse**](../Model/ModelContactResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

