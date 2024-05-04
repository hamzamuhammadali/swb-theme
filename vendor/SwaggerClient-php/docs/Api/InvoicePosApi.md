# Swagger\Client\InvoicePosApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getInvoicePos**](InvoicePosApi.md#getinvoicepos) | **GET** /InvoicePos | Retrieve InvoicePos

# **getInvoicePos**
> \Swagger\Client\Model\InlineResponse20031 getInvoicePos($id, $invoice_id, $invoice_object_name, $part_id, $part_object_name)

Retrieve InvoicePos

There are a multitude of parameter which can be used to filter.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure API key authorization: api_key
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\InvoicePosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 1.2; // float | Retrieve all InvoicePos with this InvoicePos id
$invoice_id = 1.2; // float | Retrieve all invoices positions with this invoice. Must be provided with invoice[objectName]
$invoice_object_name = "invoice_object_name_example"; // string | Only required if invoice[id] was provided. 'Invoice' should be used as value.
$part_id = 1.2; // float | Retrieve all invoices positions with this part. Must be provided with part[objectName]
$part_object_name = "part_object_name_example"; // string | Only required if part[id] was provided. 'Part' should be used as value.

try {
    $result = $apiInstance->getInvoicePos($id, $invoice_id, $invoice_object_name, $part_id, $part_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicePosApi->getInvoicePos: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **float**| Retrieve all InvoicePos with this InvoicePos id | [optional]
 **invoice_id** | **float**| Retrieve all invoices positions with this invoice. Must be provided with invoice[objectName] | [optional]
 **invoice_object_name** | **string**| Only required if invoice[id] was provided. &#x27;Invoice&#x27; should be used as value. | [optional]
 **part_id** | **float**| Retrieve all invoices positions with this part. Must be provided with part[objectName] | [optional]
 **part_object_name** | **string**| Only required if part[id] was provided. &#x27;Part&#x27; should be used as value. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20031**](../Model/InlineResponse20031.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

