# Swagger\Client\CheckAccountTransactionApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTransaction**](CheckAccountTransactionApi.md#createtransaction) | **POST** /CheckAccountTransaction | Create a new transaction
[**deleteCheckAccountTransaction**](CheckAccountTransactionApi.md#deletecheckaccounttransaction) | **DELETE** /CheckAccountTransaction/{checkAccountTransactionId} | Deletes a check account transaction
[**getCheckAccountTransactionById**](CheckAccountTransactionApi.md#getcheckaccounttransactionbyid) | **GET** /CheckAccountTransaction/{checkAccountTransactionId} | Find check account transaction by ID
[**getTransactions**](CheckAccountTransactionApi.md#gettransactions) | **GET** /CheckAccountTransaction | Retrieve transactions
[**updateCheckAccountTransaction**](CheckAccountTransactionApi.md#updatecheckaccounttransaction) | **PUT** /CheckAccountTransaction/{checkAccountTransactionId} | Update an existing check account transaction

# **createTransaction**
> \Swagger\Client\Model\ModelCheckAccountTransactionResponse createTransaction($body)

Create a new transaction

Creates a new transaction on a check account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountTransactionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelCheckAccountTransaction(); // \Swagger\Client\Model\ModelCheckAccountTransaction | Creation data. Please be aware, that you need to provide at least all required parameter
    of the CheckAccountTransaction model!

try {
    $result = $apiInstance->createTransaction($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountTransactionApi->createTransaction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\ModelCheckAccountTransaction**](../Model/ModelCheckAccountTransaction.md)| Creation data. Please be aware, that you need to provide at least all required parameter
    of the CheckAccountTransaction model! | [optional]

### Return type

[**\Swagger\Client\Model\ModelCheckAccountTransactionResponse**](../Model/ModelCheckAccountTransactionResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteCheckAccountTransaction**
> \Swagger\Client\Model\InlineResponse2001 deleteCheckAccountTransaction($check_account_transaction_id)

Deletes a check account transaction

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountTransactionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_transaction_id = 56; // int | Id of check account transaction to delete

try {
    $result = $apiInstance->deleteCheckAccountTransaction($check_account_transaction_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountTransactionApi->deleteCheckAccountTransaction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_transaction_id** | **int**| Id of check account transaction to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCheckAccountTransactionById**
> \Swagger\Client\Model\InlineResponse2003 getCheckAccountTransactionById($check_account_transaction_id)

Find check account transaction by ID

Retrieve an existing check account transaction

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountTransactionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_transaction_id = 56; // int | ID of check account transaction

try {
    $result = $apiInstance->getCheckAccountTransactionById($check_account_transaction_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountTransactionApi->getCheckAccountTransactionById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_transaction_id** | **int**| ID of check account transaction |

### Return type

[**\Swagger\Client\Model\InlineResponse2003**](../Model/InlineResponse2003.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTransactions**
> \Swagger\Client\Model\InlineResponse2003 getTransactions($check_account_id, $check_account_object_name, $is_booked, $paymt_purpose, $start_date, $end_date, $payee_payer_name, $only_credit, $only_debit)

Retrieve transactions

Retrieve all transactions depending on the filters defined in the query.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountTransactionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_id = 56; // int | Retrieve all transactions on this check account. Must be provided with checkAccount[objectName]
$check_account_object_name = "check_account_object_name_example"; // string | Only required if checkAccount[id] was provided. 'CheckAccount' should be used as value.
$is_booked = true; // bool | Only retrieve booked transactions
$paymt_purpose = "paymt_purpose_example"; // string | Only retrieve transactions with this payment purpose
$start_date = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Only retrieve transactions from this date on
$end_date = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Only retrieve transactions up to this date
$payee_payer_name = "payee_payer_name_example"; // string | Only retrieve transactions with this payee / payer
$only_credit = true; // bool | Only retrieve credit transactions
$only_debit = true; // bool | Only retrieve debit transactions

try {
    $result = $apiInstance->getTransactions($check_account_id, $check_account_object_name, $is_booked, $paymt_purpose, $start_date, $end_date, $payee_payer_name, $only_credit, $only_debit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountTransactionApi->getTransactions: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_id** | **int**| Retrieve all transactions on this check account. Must be provided with checkAccount[objectName] | [optional]
 **check_account_object_name** | **string**| Only required if checkAccount[id] was provided. &#x27;CheckAccount&#x27; should be used as value. | [optional]
 **is_booked** | **bool**| Only retrieve booked transactions | [optional]
 **paymt_purpose** | **string**| Only retrieve transactions with this payment purpose | [optional]
 **start_date** | **\DateTime**| Only retrieve transactions from this date on | [optional]
 **end_date** | **\DateTime**| Only retrieve transactions up to this date | [optional]
 **payee_payer_name** | **string**| Only retrieve transactions with this payee / payer | [optional]
 **only_credit** | **bool**| Only retrieve credit transactions | [optional]
 **only_debit** | **bool**| Only retrieve debit transactions | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2003**](../Model/InlineResponse2003.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateCheckAccountTransaction**
> \Swagger\Client\Model\ModelCheckAccountTransactionResponse updateCheckAccountTransaction($check_account_transaction_id, $body)

Update an existing check account transaction

Update a check account transaction

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CheckAccountTransactionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$check_account_transaction_id = 56; // int | ID of check account to update transaction
$body = new \Swagger\Client\Model\ModelCheckAccountTransactionUpdate(); // \Swagger\Client\Model\ModelCheckAccountTransactionUpdate | Update data

try {
    $result = $apiInstance->updateCheckAccountTransaction($check_account_transaction_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckAccountTransactionApi->updateCheckAccountTransaction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_account_transaction_id** | **int**| ID of check account to update transaction |
 **body** | [**\Swagger\Client\Model\ModelCheckAccountTransactionUpdate**](../Model/ModelCheckAccountTransactionUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelCheckAccountTransactionResponse**](../Model/ModelCheckAccountTransactionResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

