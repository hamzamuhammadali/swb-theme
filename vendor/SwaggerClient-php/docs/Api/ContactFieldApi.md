# Swagger\Client\ContactFieldApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createContactField**](ContactFieldApi.md#createcontactfield) | **POST** /ContactCustomField | Create contact field
[**createContactFieldSetting**](ContactFieldApi.md#createcontactfieldsetting) | **POST** /ContactCustomFieldSetting | Create contact field setting
[**deleteContactCustomFieldId**](ContactFieldApi.md#deletecontactcustomfieldid) | **DELETE** /ContactCustomField/{contactCustomFieldId} | delete a contact field
[**deleteContactFieldSetting**](ContactFieldApi.md#deletecontactfieldsetting) | **DELETE** /ContactCustomFieldSetting/{contactCustomFieldSettingId} | Deletes a contact field setting
[**getContactFieldSettingById**](ContactFieldApi.md#getcontactfieldsettingbyid) | **GET** /ContactCustomFieldSetting/{contactCustomFieldSettingId} | Find contact field setting by ID
[**getContactFieldSettings**](ContactFieldApi.md#getcontactfieldsettings) | **GET** /ContactCustomFieldSetting | Retrieve contact field settings
[**getContactFields**](ContactFieldApi.md#getcontactfields) | **GET** /ContactCustomField | Retrieve contact fields
[**getContactFieldsById**](ContactFieldApi.md#getcontactfieldsbyid) | **GET** /ContactCustomField/{contactCustomFieldId} | Retrieve contact fields
[**getPlaceholder**](ContactFieldApi.md#getplaceholder) | **GET** /Textparser/fetchDictionaryEntriesByType | Retrieve Placeholders
[**getReferenceCount**](ContactFieldApi.md#getreferencecount) | **GET** /ContactCustomFieldSetting/{contactCustomFieldSettingId}/getReferenceCount | Receive count reference
[**updateContactFieldSetting**](ContactFieldApi.md#updatecontactfieldsetting) | **PUT** /ContactCustomFieldSetting/{contactCustomFieldSettingId} | Update contact field setting
[**updateContactfield**](ContactFieldApi.md#updatecontactfield) | **PUT** /ContactCustomField/{contactCustomFieldId} | Update a contact field

# **createContactField**
> \Swagger\Client\Model\ModelContactCustomFieldResponse createContactField($body)

Create contact field

Create contact field

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelContactCustomField(); // \Swagger\Client\Model\ModelContactCustomField | 

try {
    $result = $apiInstance->createContactField($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->createContactField: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelContactCustomField**](../Model/ModelContactCustomField.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\ModelContactCustomFieldResponse**](../Model/ModelContactCustomFieldResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createContactFieldSetting**
> \Swagger\Client\Model\InlineResponse20014 createContactFieldSetting($body)

Create contact field setting

Create contact field setting

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelContactCustomFieldSetting(); // \Swagger\Client\Model\ModelContactCustomFieldSetting | 

try {
    $result = $apiInstance->createContactFieldSetting($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->createContactFieldSetting: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelContactCustomFieldSetting**](../Model/ModelContactCustomFieldSetting.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20014**](../Model/InlineResponse20014.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteContactCustomFieldId**
> \Swagger\Client\Model\InlineResponse2001 deleteContactCustomFieldId($contact_custom_field_id)

delete a contact field

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_custom_field_id = 56; // int | Id of contact field

try {
    $result = $apiInstance->deleteContactCustomFieldId($contact_custom_field_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->deleteContactCustomFieldId: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_custom_field_id** | **int**| Id of contact field |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteContactFieldSetting**
> \Swagger\Client\Model\InlineResponse2001 deleteContactFieldSetting($contact_custom_field_setting_id)

Deletes a contact field setting

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_custom_field_setting_id = 56; // int | Id of contact field to delete

try {
    $result = $apiInstance->deleteContactFieldSetting($contact_custom_field_setting_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->deleteContactFieldSetting: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_custom_field_setting_id** | **int**| Id of contact field to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContactFieldSettingById**
> \Swagger\Client\Model\InlineResponse20014 getContactFieldSettingById($contact_custom_field_setting_id)

Find contact field setting by ID

Returns a single contact field setting

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_custom_field_setting_id = 56; // int | ID of contact field to return

try {
    $result = $apiInstance->getContactFieldSettingById($contact_custom_field_setting_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->getContactFieldSettingById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_custom_field_setting_id** | **int**| ID of contact field to return |

### Return type

[**\Swagger\Client\Model\InlineResponse20014**](../Model/InlineResponse20014.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContactFieldSettings**
> \Swagger\Client\Model\InlineResponse20014 getContactFieldSettings()

Retrieve contact field settings

Retrieve all contact field settings

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getContactFieldSettings();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->getContactFieldSettings: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse20014**](../Model/InlineResponse20014.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContactFields**
> \Swagger\Client\Model\InlineResponse20013 getContactFields()

Retrieve contact fields

Retrieve all contact fields

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getContactFields();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->getContactFields: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse20013**](../Model/InlineResponse20013.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getContactFieldsById**
> \Swagger\Client\Model\InlineResponse20013 getContactFieldsById($contact_custom_field_id)

Retrieve contact fields

Retrieve all contact fields

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_custom_field_id = 1.2; // float | id of the contact field

try {
    $result = $apiInstance->getContactFieldsById($contact_custom_field_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->getContactFieldsById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_custom_field_id** | **float**| id of the contact field |

### Return type

[**\Swagger\Client\Model\InlineResponse20013**](../Model/InlineResponse20013.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPlaceholder**
> \Swagger\Client\Model\InlineResponse20012 getPlaceholder($object_name, $sub_object_name)

Retrieve Placeholders

Retrieve all Placeholders

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$object_name = "object_name_example"; // string | Model name
$sub_object_name = "sub_object_name_example"; // string | Sub model name, required if you have \"Email\" at objectName

try {
    $result = $apiInstance->getPlaceholder($object_name, $sub_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->getPlaceholder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **object_name** | **string**| Model name |
 **sub_object_name** | **string**| Sub model name, required if you have \&quot;Email\&quot; at objectName | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getReferenceCount**
> \Swagger\Client\Model\InlineResponse20015 getReferenceCount($contact_custom_field_setting_id)

Receive count reference

Receive count reference

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_custom_field_setting_id = 56; // int | ID of contact field you want to get the reference count

try {
    $result = $apiInstance->getReferenceCount($contact_custom_field_setting_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->getReferenceCount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_custom_field_setting_id** | **int**| ID of contact field you want to get the reference count |

### Return type

[**\Swagger\Client\Model\InlineResponse20015**](../Model/InlineResponse20015.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateContactFieldSetting**
> \Swagger\Client\Model\ModelContactCustomFieldSettingResponse updateContactFieldSetting($contact_custom_field_setting_id, $body)

Update contact field setting

Update an existing contact field  setting

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_custom_field_setting_id = 56; // int | ID of contact field setting you want to update
$body = new \Swagger\Client\Model\ModelContactCustomFieldSettingUpdate(); // \Swagger\Client\Model\ModelContactCustomFieldSettingUpdate | 

try {
    $result = $apiInstance->updateContactFieldSetting($contact_custom_field_setting_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->updateContactFieldSetting: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_custom_field_setting_id** | **int**| ID of contact field setting you want to update |
 **body** | [**\Swagger\Client\Model\ModelContactCustomFieldSettingUpdate**](../Model/ModelContactCustomFieldSettingUpdate.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\ModelContactCustomFieldSettingResponse**](../Model/ModelContactCustomFieldSettingResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateContactfield**
> \Swagger\Client\Model\ModelContactCustomFieldResponse updateContactfield($contact_custom_field_id, $body)

Update a contact field

Update a contact field

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ContactFieldApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_custom_field_id = 1.2; // float | id of the contact field
$body = new \Swagger\Client\Model\ModelContactCustomFieldUpdate(); // \Swagger\Client\Model\ModelContactCustomFieldUpdate | Update data

try {
    $result = $apiInstance->updateContactfield($contact_custom_field_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ContactFieldApi->updateContactfield: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_custom_field_id** | **float**| id of the contact field |
 **body** | [**\Swagger\Client\Model\ModelContactCustomFieldUpdate**](../Model/ModelContactCustomFieldUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelContactCustomFieldResponse**](../Model/ModelContactCustomFieldResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

