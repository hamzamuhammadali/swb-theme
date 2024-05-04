# Swagger\Client\ExportApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**exportContact**](ExportApi.md#exportcontact) | **GET** /Export/contactListCsv | Export contact
[**exportCreditNote**](ExportApi.md#exportcreditnote) | **GET** /Export/creditNoteCsv | Export creditNote
[**exportDatev**](ExportApi.md#exportdatev) | **GET** /Export/datevCSV | Export datev
[**exportInvoice**](ExportApi.md#exportinvoice) | **GET** /Export/invoiceCsv | Export invoice
[**exportInvoiceZip**](ExportApi.md#exportinvoicezip) | **GET** /Export/invoiceZip | Export Invoice as zip
[**exportTransactions**](ExportApi.md#exporttransactions) | **GET** /Export/transactionsCsv | Export transaction
[**exportVoucher**](ExportApi.md#exportvoucher) | **GET** /Export/voucherListCsv | Export voucher as zip
[**exportVoucherZip**](ExportApi.md#exportvoucherzip) | **GET** /Export/voucherZip | Export voucher zip
[**updateExportConfig**](ExportApi.md#updateexportconfig) | **PUT** /SevClient/{SevClientId}/updateExportConfig | Update export config

# **exportContact**
> \Swagger\Client\Model\InlineResponse20027 exportContact($sev_query, $download)

Export contact

Contact export as csv

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery6(); // \Swagger\Client\Model\SevQuery6 | 
$download = true; // bool | 

try {
    $result = $apiInstance->exportContact($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery6**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20027**](../Model/InlineResponse20027.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **exportCreditNote**
> \Swagger\Client\Model\InlineResponse20023 exportCreditNote($sev_query, $download)

Export creditNote

Export all credit notes as csv

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery2(); // \Swagger\Client\Model\SevQuery2 | 
$download = true; // bool | 

try {
    $result = $apiInstance->exportCreditNote($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportCreditNote: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery2**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20023**](../Model/InlineResponse20023.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **exportDatev**
> object exportDatev($start_date, $end_date, $scope, $download, $with_unpaid_documents, $with_enshrined_documents, $enshrine)

Export datev

Datev export as zip with csv´s. Before you can perform the datev export,  you must first set the \"accountingYearBegin\". To do this, you must use the  <a href='https://api.sevdesk.de/#tag/Export/operation/updateExportConfig'>updateExportConfig</a> endpoint.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$start_date = 56; // int | the start date of the export as timestamp
$end_date = 56; // int | the end date of the export as timestamp
$scope = "scope_example"; // string | Define what you want to include in the datev export. This parameter takes a string of  5 letters. Each stands for a model that should be included. Possible letters are: ‘E’ (Earnings), ‘X’ (Expenditure), ‘T’ (Transactions), ‘C’ (Cashregister), ‘D’ (Assets). By providing one of those letter you specify that it should be included in the datev export. Some combinations are: ‘EXTCD’, ‘EXTD’ …
$download = true; // bool | Specifies if the document is downloaded
$with_unpaid_documents = true; // bool | include unpaid documents
$with_enshrined_documents = true; // bool | include enshrined documents
$enshrine = true; // bool | Specify if you want to enshrine all models which were included in the export

try {
    $result = $apiInstance->exportDatev($start_date, $end_date, $scope, $download, $with_unpaid_documents, $with_enshrined_documents, $enshrine);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportDatev: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **start_date** | **int**| the start date of the export as timestamp |
 **end_date** | **int**| the end date of the export as timestamp |
 **scope** | **string**| Define what you want to include in the datev export. This parameter takes a string of  5 letters. Each stands for a model that should be included. Possible letters are: ‘E’ (Earnings), ‘X’ (Expenditure), ‘T’ (Transactions), ‘C’ (Cashregister), ‘D’ (Assets). By providing one of those letter you specify that it should be included in the datev export. Some combinations are: ‘EXTCD’, ‘EXTD’ … |
 **download** | **bool**| Specifies if the document is downloaded | [optional]
 **with_unpaid_documents** | **bool**| include unpaid documents | [optional]
 **with_enshrined_documents** | **bool**| include enshrined documents | [optional]
 **enshrine** | **bool**| Specify if you want to enshrine all models which were included in the export | [optional]

### Return type

**object**

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **exportInvoice**
> \Swagger\Client\Model\InlineResponse20021 exportInvoice($sev_query, $download)

Export invoice

Export all invoices as csv

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery(); // \Swagger\Client\Model\SevQuery | 
$download = true; // bool | 

try {
    $result = $apiInstance->exportInvoice($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportInvoice: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20021**](../Model/InlineResponse20021.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **exportInvoiceZip**
> \Swagger\Client\Model\InlineResponse20022 exportInvoiceZip($sev_query, $download)

Export Invoice as zip

Export all invoices as zip

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery1(); // \Swagger\Client\Model\SevQuery1 | 
$download = true; // bool | 

try {
    $result = $apiInstance->exportInvoiceZip($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportInvoiceZip: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery1**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20022**](../Model/InlineResponse20022.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **exportTransactions**
> \Swagger\Client\Model\InlineResponse20025 exportTransactions($sev_query, $download)

Export transaction

Export all transactions as csv

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery4(); // \Swagger\Client\Model\SevQuery4 | 
$download = true; // bool | 

try {
    $result = $apiInstance->exportTransactions($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportTransactions: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery4**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20025**](../Model/InlineResponse20025.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **exportVoucher**
> \Swagger\Client\Model\InlineResponse20024 exportVoucher($sev_query, $download)

Export voucher as zip

Export all vouchers as zip

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery3(); // \Swagger\Client\Model\SevQuery3 | 
$download = true; // bool | 

try {
    $result = $apiInstance->exportVoucher($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportVoucher: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery3**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20024**](../Model/InlineResponse20024.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **exportVoucherZip**
> \Swagger\Client\Model\InlineResponse20026 exportVoucherZip($sev_query, $download)

Export voucher zip

export all vouchers as zip

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_query = new \Swagger\Client\Model\SevQuery5(); // \Swagger\Client\Model\SevQuery5 | 
$download = true; // bool | 

try {
    $result = $apiInstance->exportVoucherZip($sev_query, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->exportVoucherZip: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_query** | [**\Swagger\Client\Model\SevQuery5**](../Model/.md)|  |
 **download** | **bool**|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20026**](../Model/InlineResponse20026.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateExportConfig**
> \Swagger\Client\Model\InlineResponse20020 updateExportConfig($sev_client_id, $body)

Update export config

Update export config to export datev CSV

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\ExportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sev_client_id = 1.2; // float | id of sevClient
$body = new \Swagger\Client\Model\SevClientIdUpdateExportConfigBody(); // \Swagger\Client\Model\SevClientIdUpdateExportConfigBody | Specify the update

try {
    $result = $apiInstance->updateExportConfig($sev_client_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ExportApi->updateExportConfig: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sev_client_id** | **float**| id of sevClient |
 **body** | [**\Swagger\Client\Model\SevClientIdUpdateExportConfigBody**](../Model/SevClientIdUpdateExportConfigBody.md)| Specify the update | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20020**](../Model/InlineResponse20020.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

