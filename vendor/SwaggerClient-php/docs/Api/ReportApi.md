# Swagger\Client\ReportApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**reportContact**](ReportApi.md#reportcontact) | **GET** /Report/contactlist | Export contact list
[**reportInvoice**](ReportApi.md#reportinvoice) | **GET** /Report/invoicelist | Export invoice list
[**reportOrder**](ReportApi.md#reportorder) | **GET** /Report/orderlist | Export order list
[**reportVoucher**](ReportApi.md#reportvoucher) | **GET** /Report/voucherlist | Export voucher list

# **reportContact**
> \Swagger\Client\Model\InlineResponse20045 reportContact($sev_query, $download)

Export contact list

Export contact list

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ReportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery9(); // \Swagger\Client\Model\SevQuery9 | 
$download = true; // bool | 

try {
    $result = $apiInstance->reportContact($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReportApi->reportContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery9**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20045**](../Model/InlineResponse20045.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reportInvoice**
> \Swagger\Client\Model\InlineResponse20043 reportInvoice($view, $sev_query, $download)

Export invoice list

Export invoice list

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ReportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$view = "view_example"; // string | 
$sev_query = new \Swagger\Client\Model\SevQuery7(); // \Swagger\Client\Model\SevQuery7 | 
$download = true; // bool | 

try {
    $result = $apiInstance->reportInvoice($view, $sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReportApi->reportInvoice: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **view** | **string**|  |
 **sev_query** | [**\Swagger\Client\Model\SevQuery7**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20043**](../Model/InlineResponse20043.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reportOrder**
> \Swagger\Client\Model\InlineResponse20044 reportOrder($view, $sev_query, $download)

Export order list

Export order list

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ReportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$view = "view_example"; // string | 
$sev_query = new \Swagger\Client\Model\SevQuery8(); // \Swagger\Client\Model\SevQuery8 | 
$download = true; // bool | 

try {
    $result = $apiInstance->reportOrder($view, $sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReportApi->reportOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **view** | **string**|  |
 **sev_query** | [**\Swagger\Client\Model\SevQuery8**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20044**](../Model/InlineResponse20044.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reportVoucher**
> \Swagger\Client\Model\InlineResponse20046 reportVoucher($sev_query, $download)

Export voucher list

Export voucher list

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ReportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery10(); // \Swagger\Client\Model\SevQuery10 | 
$download = true; // bool | 

try {
    $result = $apiInstance->reportVoucher($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReportApi->reportVoucher: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery10**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20046**](../Model/InlineResponse20046.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

