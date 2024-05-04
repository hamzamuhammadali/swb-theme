# Swagger\Client\VoucherApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**bookVoucher**](VoucherApi.md#bookvoucher) | **PUT** /Voucher/{voucherId}/bookAmount | Book a voucher
[**createVoucherByFactory**](VoucherApi.md#createvoucherbyfactory) | **POST** /Voucher/Factory/saveVoucher | Create a new voucher
[**getVoucherById**](VoucherApi.md#getvoucherbyid) | **GET** /Voucher/{voucherId} | Find voucher by ID
[**getVouchers**](VoucherApi.md#getvouchers) | **GET** /Voucher | Retrieve vouchers
[**updateVoucher**](VoucherApi.md#updatevoucher) | **PUT** /Voucher/{voucherId} | Update an existing voucher
[**voucherUploadFile**](VoucherApi.md#voucheruploadfile) | **POST** /Voucher/Factory/uploadTempFile | Upload voucher file

# **bookVoucher**
> \Swagger\Client\Model\InlineResponse20041 bookVoucher($voucher_id, $body)

Book a voucher

Booking the voucher with a transaction is probably the most important part in the bookkeeping process.<br> There are several ways on correctly booking a voucher, all by using the same endpoint.<br> Conveniently, the booking process is exactly the same as the process for invoices.<br> For this reason, you can have a look at it <a href='https://api.sevdesk.de/#section/How-to-book-an-invoice'>here</a> and all you need to to is to change \"Invoice\" into \"Voucher\" in the URL.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\VoucherApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$voucher_id = 56; // int | ID of voucher to book
$body = new \Swagger\Client\Model\VoucherIdBookAmountBody(); // \Swagger\Client\Model\VoucherIdBookAmountBody | Booking data

try {
    $result = $apiInstance->bookVoucher($voucher_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VoucherApi->bookVoucher: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **voucher_id** | **int**| ID of voucher to book |
 **body** | [**\Swagger\Client\Model\VoucherIdBookAmountBody**](../Model/VoucherIdBookAmountBody.md)| Booking data | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20041**](../Model/InlineResponse20041.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createVoucherByFactory**
> \Swagger\Client\Model\SaveVoucherResponse createVoucherByFactory($body)

Create a new voucher

Bundles the creation or updating of voucher and voucher position.<br> The list of parameters starts with the voucher array.<br> This array contains all required attributes for a complete voucher.<br> Most of the attributes are covered in the voucher attribute list, there are only two parameters standing out, namely <b>mapAll</b> and <b>objectName</b>.<br> These are just needed for our system and you always need to provide them.<br><br> The list of parameters then continues with the voucher position array.<br> With this array you have the possibility to add multiple positions at once.<br> In the example it only contains one position, again together with the parameters <b>mapAll</b> and <b>objectName</b>, however, you can add more voucher positions by extending the array.<br> So if you wanted to add another position, you would add the same list of parameters with an incremented array index of \\\"1\\\" instead of \\\"0\\\".<br><br> The list ends with the two parameters voucherPosDelete and filename.<br> We will shortly explain what they can do.<br> With voucherPosDelete you have to option to delete voucher positions as this request can also be used to update vouchers.<br> With filename you can attach a file to the voucher.<br> For most of our customers this is a really important step, as they need to digitize their receipts.<br> Finally, after covering all parameters, they only important information left, is that the order of the last two attributes always needs to be kept.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\VoucherApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\SaveVoucher(); // \Swagger\Client\Model\SaveVoucher | Creation data. Please be aware, that you need to provide at least all required parameter
    of the voucher and voucher position model!

try {
    $result = $apiInstance->createVoucherByFactory($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VoucherApi->createVoucherByFactory: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\SaveVoucher**](../Model/SaveVoucher.md)| Creation data. Please be aware, that you need to provide at least all required parameter
    of the voucher and voucher position model! | [optional]

### Return type

[**\Swagger\Client\Model\SaveVoucherResponse**](../Model/SaveVoucherResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getVoucherById**
> \Swagger\Client\Model\InlineResponse20040 getVoucherById($voucher_id)

Find voucher by ID

Returns a single voucher

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\VoucherApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$voucher_id = 56; // int | ID of voucher to return

try {
    $result = $apiInstance->getVoucherById($voucher_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VoucherApi->getVoucherById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **voucher_id** | **int**| ID of voucher to return |

### Return type

[**\Swagger\Client\Model\InlineResponse20040**](../Model/InlineResponse20040.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getVouchers**
> \Swagger\Client\Model\InlineResponse20040 getVouchers($status, $credit_debit, $description_like, $start_date, $end_date, $contact_id, $contact_object_name)

Retrieve vouchers

There are a multitude of parameter which can be used to filter. A few of them are attached but      for a complete list please check out <a href='https://api.sevdesk.de/#section/How-to-filter-for-certain-vouchers'>this</a> list

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\VoucherApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$status = 1.2; // float | Status of the vouchers to retrieve.
$credit_debit = "credit_debit_example"; // string | Define if you only want credit or debit vouchers.
$description_like = "description_like_example"; // string | Retrieve all vouchers with a description like this.
$start_date = 56; // int | Retrieve all vouchers with a date equal or higher
$end_date = 56; // int | Retrieve all vouchers with a date equal or lower
$contact_id = 56; // int | Retrieve all vouchers with this contact. Must be provided with contact[objectName]
$contact_object_name = "contact_object_name_example"; // string | Only required if contact[id] was provided. 'Contact' should be used as value.

try {
    $result = $apiInstance->getVouchers($status, $credit_debit, $description_like, $start_date, $end_date, $contact_id, $contact_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VoucherApi->getVouchers: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **status** | **float**| Status of the vouchers to retrieve. | [optional]
 **credit_debit** | **string**| Define if you only want credit or debit vouchers. | [optional]
 **description_like** | **string**| Retrieve all vouchers with a description like this. | [optional]
 **start_date** | **int**| Retrieve all vouchers with a date equal or higher | [optional]
 **end_date** | **int**| Retrieve all vouchers with a date equal or lower | [optional]
 **contact_id** | **int**| Retrieve all vouchers with this contact. Must be provided with contact[objectName] | [optional]
 **contact_object_name** | **string**| Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20040**](../Model/InlineResponse20040.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateVoucher**
> \Swagger\Client\Model\ModelVoucherResponse updateVoucher($voucher_id, $body)

Update an existing voucher

Update a voucher

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\VoucherApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$voucher_id = 56; // int | ID of voucher to update
$body = new \Swagger\Client\Model\ModelVoucherUpdate(); // \Swagger\Client\Model\ModelVoucherUpdate | Update data

try {
    $result = $apiInstance->updateVoucher($voucher_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VoucherApi->updateVoucher: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **voucher_id** | **int**| ID of voucher to update |
 **body** | [**\Swagger\Client\Model\ModelVoucherUpdate**](../Model/ModelVoucherUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelVoucherResponse**](../Model/ModelVoucherResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **voucherUploadFile**
> \Swagger\Client\Model\InlineResponse2014 voucherUploadFile($body)

Upload voucher file

To attach a document to a voucher, you will need to upload it first for later use.<br> To do this, you can use this request.<br> When you successfully uploaded the file, you will get a sevDesk internal filename in the response.<br> The filename will be a hash generated from your uploaded file. You will need it in the next request!<br> After you got the just mentioned filename, you can enter it as a value for the filename parameter of the saveVoucher request.<br> If you provided all necessary parameters and kept all of them in the right order, the file will be attached to your voucher.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\VoucherApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\FactoryUploadTempFileBody(); // \Swagger\Client\Model\FactoryUploadTempFileBody | File to upload

try {
    $result = $apiInstance->voucherUploadFile($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VoucherApi->voucherUploadFile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\FactoryUploadTempFileBody**](../Model/FactoryUploadTempFileBody.md)| File to upload | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2014**](../Model/InlineResponse2014.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: form-data
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

