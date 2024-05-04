# Swagger\Client\VoucherPosApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getVoucherPositions**](VoucherPosApi.md#getvoucherpositions) | **GET** /VoucherPos | Retrieve voucher positions

# **getVoucherPositions**
> \Swagger\Client\Model\InlineResponse20042 getVoucherPositions($voucher_id, $voucher_object_name)

Retrieve voucher positions

Retrieve all voucher positions depending on the filters defined in the query.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\VoucherPosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$voucher_id = 56; // int | Retrieve all vouchers positions belonging to this voucher. Must be provided with voucher[objectName]
$voucher_object_name = "voucher_object_name_example"; // string | Only required if voucher[id] was provided. 'Voucher' should be used as value.

try {
    $result = $apiInstance->getVoucherPositions($voucher_id, $voucher_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VoucherPosApi->getVoucherPositions: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **voucher_id** | **int**| Retrieve all vouchers positions belonging to this voucher. Must be provided with voucher[objectName] | [optional]
 **voucher_object_name** | **string**| Only required if voucher[id] was provided. &#x27;Voucher&#x27; should be used as value. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20042**](../Model/InlineResponse20042.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

