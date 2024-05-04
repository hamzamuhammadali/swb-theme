# Swagger\Client\CheckAccountApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createCheckAccount**](CheckAccountApi.md#createcheckaccount) | **POST** /CheckAccount | Create a new check account
[**deleteCheckAccount**](CheckAccountApi.md#deletecheckaccount) | **DELETE** /CheckAccount/{checkAccountId} | Deletes a check account
[**getBalanceAtDate**](CheckAccountApi.md#getbalanceatdate) | **GET** /CheckAccount/{checkAccountId}/getBalanceAtDate | Get the balance at a given date
[**getCheckAccountById**](CheckAccountApi.md#getcheckaccountbyid) | **GET** /CheckAccount/{checkAccountId} | Find check account by ID
[**getCheckAccounts**](CheckAccountApi.md#getcheckaccounts) | **GET** /CheckAccount | Retrieve check accounts
[**updateCheckAccount**](CheckAccountApi.md#updatecheckaccount) | **PUT** /CheckAccount/{checkAccountId} | Update an existing check account

# **createCheckAccount**
> \Swagger\Client\Model\InlineResponse200 createCheckAccount($body)

Create a new check account

Creates a new banking account on which transactions can be created.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelCheckAccount(); // \Swagger\Client\Model\ModelCheckAccount | Creation data. Please be aware, that you need to provide at least all required parameter
    of the CheckAccount model!

try {
    $result = $apiInstance->createCheckAccount($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountApi->createCheckAccount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelCheckAccount**](../Model/ModelCheckAccount.md)| Creation data. Please be aware, that you need to provide at least all required parameter
    of the CheckAccount model! | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteCheckAccount**
> \Swagger\Client\Model\InlineResponse2001 deleteCheckAccount($check_account_id)

Deletes a check account

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_id = 56; // int | Id of check account to delete

try {
    $result = $apiInstance->deleteCheckAccount($check_account_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountApi->deleteCheckAccount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_id** | **int**| Id of check account to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBalanceAtDate**
> \Swagger\Client\Model\InlineResponse2002 getBalanceAtDate($check_account_id, $date)

Get the balance at a given date

Get the balance, calculated as the sum of all transactions sevDesk knows, up to and including the given date. Note that this balance does not have to be the actual bank account balance, e.g. if sevDesk did not import old transactions.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_id = 56; // int | ID of check account
$date = new \DateTime("2013-10-20"); // \DateTime | Only consider transactions up to this date at 23:59:59

try {
    $result = $apiInstance->getBalanceAtDate($check_account_id, $date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountApi->getBalanceAtDate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_id** | **int**| ID of check account |
 **date** | **\DateTime**| Only consider transactions up to this date at 23:59:59 |

### Return type

[**\Swagger\Client\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCheckAccountById**
> \Swagger\Client\Model\InlineResponse200 getCheckAccountById($check_account_id)

Find check account by ID

Retrieve an existing check account

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_id = 56; // int | ID of check account

try {
    $result = $apiInstance->getCheckAccountById($check_account_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountApi->getCheckAccountById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_id** | **int**| ID of check account |

### Return type

[**\Swagger\Client\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCheckAccounts**
> \Swagger\Client\Model\InlineResponse200 getCheckAccounts()

Retrieve check accounts

Retrieve all check accounts

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getCheckAccounts();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountApi->getCheckAccounts: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateCheckAccount**
> \Swagger\Client\Model\ModelCheckAccountResponse updateCheckAccount($check_account_id, $body)

Update an existing check account

Update a check account

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_id = 56; // int | ID of check account to update
$body = new \Swagger\Client\Model\ModelCheckAccountUpdate(); // \Swagger\Client\Model\ModelCheckAccountUpdate | Update data

try {
    $result = $apiInstance->updateCheckAccount($check_account_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountApi->updateCheckAccount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_id** | **int**| ID of check account to update |
 **body** | [**\Swagger\Client\Model\ModelCheckAccountUpdate**](../Model/ModelCheckAccountUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelCheckAccountResponse**](../Model/ModelCheckAccountResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

