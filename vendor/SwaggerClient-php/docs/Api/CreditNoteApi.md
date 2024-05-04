# Swagger\Client\CreditNoteApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**bookCreditNote**](CreditNoteApi.md#bookcreditnote) | **PUT** /CreditNote/{creditNoteId}/bookAmount | Book a credit note
[**createCreditNoteFromInvoice**](CreditNoteApi.md#createcreditnotefrominvoice) | **POST** /CreditNote/Factory/createFromInvoice | Creates a new creditNote from an invoice
[**createCreditNoteFromVoucher**](CreditNoteApi.md#createcreditnotefromvoucher) | **POST** /CreditNote/Factory/createFromVoucher | Creates a new creditNote from a voucher
[**createcreditNote**](CreditNoteApi.md#createcreditnote) | **POST** /CreditNote/Factory/saveCreditNote | Create a new creditNote
[**creditNoteGetPdf**](CreditNoteApi.md#creditnotegetpdf) | **GET** /CreditNote/{creditNoteId}/getPdf | Retrieve pdf document of a credit note
[**creditNoteSendBy**](CreditNoteApi.md#creditnotesendby) | **PUT** /CreditNote/{creditNoteId}/sendBy | Mark credit note as sent
[**deletecreditNote**](CreditNoteApi.md#deletecreditnote) | **DELETE** /CreditNote/{creditNoteId} | Deletes an creditNote
[**getCreditNotes**](CreditNoteApi.md#getcreditnotes) | **GET** /CreditNote | Retrieve CreditNote
[**getcreditNoteById**](CreditNoteApi.md#getcreditnotebyid) | **GET** /CreditNote/{creditNoteId} | Find creditNote by ID
[**sendCreditNoteByPrinting**](CreditNoteApi.md#sendcreditnotebyprinting) | **GET** /CreditNote/{creditNoteId}/sendByWithRender | Send credit note by printing
[**sendCreditNoteViaEMail**](CreditNoteApi.md#sendcreditnoteviaemail) | **POST** /CreditNote/{creditNoteId}/sendViaEmail | Send credit note via email
[**updatecreditNote**](CreditNoteApi.md#updatecreditnote) | **PUT** /CreditNote/{creditNoteId} | Update an existing creditNote

# **bookCreditNote**
> \Swagger\Client\Model\InlineResponse20018 bookCreditNote($credit_note_id, $body)

Book a credit note

Booking the credit note with a transaction is probably the most important part in the bookkeeping  process.<br> There are several ways on correctly booking a credit note, all by using the same endpoint.<br> Conveniently, the booking process is exactly the same as the process for invoices and vouchers.<br> For this reason, you can have a look at it in the  <a href='https://api.sevdesk.de/#section/How-to-book-an-invoice'>invoice chapter</a> and all you need to do is to change \"Invoice\" into \"CreditNote\" in the URL.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | ID of credit note to book
$body = new \Swagger\Client\Model\CreditNoteIdBookAmountBody(); // \Swagger\Client\Model\CreditNoteIdBookAmountBody | Booking data

try {
    $result = $apiInstance->bookCreditNote($credit_note_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->bookCreditNote: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| ID of credit note to book |
 **body** | [**\Swagger\Client\Model\CreditNoteIdBookAmountBody**](../Model/CreditNoteIdBookAmountBody.md)| Booking data | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20018**](../Model/InlineResponse20018.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createCreditNoteFromInvoice**
> \Swagger\Client\Model\InlineResponse201 createCreditNoteFromInvoice($body)

Creates a new creditNote from an invoice

Use this endpoint to create a new creditNote from an invoice.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\FactoryCreateFromInvoiceBody(); // \Swagger\Client\Model\FactoryCreateFromInvoiceBody | 

try {
    $result = $apiInstance->createCreditNoteFromInvoice($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->createCreditNoteFromInvoice: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\FactoryCreateFromInvoiceBody**](../Model/FactoryCreateFromInvoiceBody.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse201**](../Model/InlineResponse201.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createCreditNoteFromVoucher**
> \Swagger\Client\Model\InlineResponse201 createCreditNoteFromVoucher($body)

Creates a new creditNote from a voucher

Use this endpoint to create a new creditNote from a voucher.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\FactoryCreateFromVoucherBody(); // \Swagger\Client\Model\FactoryCreateFromVoucherBody | 

try {
    $result = $apiInstance->createCreditNoteFromVoucher($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->createCreditNoteFromVoucher: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\FactoryCreateFromVoucherBody**](../Model/FactoryCreateFromVoucherBody.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse201**](../Model/InlineResponse201.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createcreditNote**
> \Swagger\Client\Model\SaveCreditNoteResponse createcreditNote($body)

Create a new creditNote

The list of parameters starts with the credit note array.<br> This array contains all required attributes for a complete credit note.<br> Most of the attributes are covered in the credit note attribute list, there are only two parameters standing out, namely <b>mapAll</b> and <b>objectName</b>.<br> These are just needed for our system and you always need to provide them.<br> The list of parameters then continues with the credit note position array.<br> With this array you have the possibility to add multiple positions at once.<br> In the example it only contains one position, again together with the parameters <b>mapAll</b> and <b>objectName</b>, however, you can add more credit note positions by extending the array.<br> So if you wanted to add another position, you would add the same list of parameters with an incremented array index of \"1\" instead of \"0\".<br><br> The list ends with the five parameters creditNotePosDelete, discountSave, discountDelete, takeDefaultAddress and forCashRegister.<br> They only play a minor role if you only want to create a credit note but we will shortly explain what they can do.<br> With creditNotePosDelete you have to option to delete credit note positions as this request can also be used to update credit notes.<br> Both discount parameters are deprecated and have no use for credit notes, however they need to be provided in case you want to use the following two parameters.<br> With takeDefaultAddress you can specify that the first address of the contact you are using for the credit note is taken for the credit note address attribute automatically, so you don't need to provide the address yourself.<br> Finally, the forCashRegister parameter needs to be set to <b>true</b> if your credit note is to be booked on the cash register.<br> If you want to know more about these parameters, for example if you want to use this request to update credit notes, feel free to contact our support.<br> Finally, after covering all parameters, they only important information left, is that the order of the last five attributes always needs to be kept.<br> You will also always need to provide all of them, as otherwise the request won't work properly.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\SaveCreditNote(); // \Swagger\Client\Model\SaveCreditNote | Creation data. Please be aware, that you need to provide at least all required parameter
    of the credit note model!

try {
    $result = $apiInstance->createcreditNote($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->createcreditNote: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\SaveCreditNote**](../Model/SaveCreditNote.md)| Creation data. Please be aware, that you need to provide at least all required parameter
    of the credit note model! | [optional]

### Return type

[**\Swagger\Client\Model\SaveCreditNoteResponse**](../Model/SaveCreditNoteResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **creditNoteGetPdf**
> \Swagger\Client\Model\InlineResponse20017 creditNoteGetPdf($credit_note_id, $download, $prevent_send_by)

Retrieve pdf document of a credit note

Retrieves the pdf document of a credit note with additional metadata.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | ID of credit note from which you want the pdf
$download = true; // bool | If u want to download the pdf of the credit note.
$prevent_send_by = true; // bool | Defines if u want to send the credit note.

try {
    $result = $apiInstance->creditNoteGetPdf($credit_note_id, $download, $prevent_send_by);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->creditNoteGetPdf: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| ID of credit note from which you want the pdf |
 **download** | **bool**| If u want to download the pdf of the credit note. | [optional]
 **prevent_send_by** | **bool**| Defines if u want to send the credit note. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20017**](../Model/InlineResponse20017.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **creditNoteSendBy**
> \Swagger\Client\Model\ModelCreditNoteResponse creditNoteSendBy($credit_note_id, $body)

Mark credit note as sent

Marks an credit note as sent by a chosen send type.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | ID of credit note to mark as sent
$body = new \Swagger\Client\Model\CreditNoteIdSendByBody(); // \Swagger\Client\Model\CreditNoteIdSendByBody | Specify the send type

try {
    $result = $apiInstance->creditNoteSendBy($credit_note_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->creditNoteSendBy: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| ID of credit note to mark as sent |
 **body** | [**\Swagger\Client\Model\CreditNoteIdSendByBody**](../Model/CreditNoteIdSendByBody.md)| Specify the send type | [optional]

### Return type

[**\Swagger\Client\Model\ModelCreditNoteResponse**](../Model/ModelCreditNoteResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deletecreditNote**
> \Swagger\Client\Model\InlineResponse2001 deletecreditNote($credit_note_id)

Deletes an creditNote

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | Id of creditNote resource to delete

try {
    $result = $apiInstance->deletecreditNote($credit_note_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->deletecreditNote: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| Id of creditNote resource to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCreditNotes**
> \Swagger\Client\Model\InlineResponse20016 getCreditNotes($status, $credit_note_number, $start_date, $end_date, $contact_id, $contact_object_name)

Retrieve CreditNote

There are a multitude of parameter which can be used to filter.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$status = "status_example"; // string | Status of the CreditNote
$credit_note_number = "credit_note_number_example"; // string | Retrieve all CreditNotes with this creditNote number
$start_date = 56; // int | Retrieve all CreditNotes with a date equal or higher
$end_date = 56; // int | Retrieve all CreditNotes with a date equal or lower
$contact_id = 56; // int | Retrieve all CreditNotes with this contact. Must be provided with contact[objectName]
$contact_object_name = "contact_object_name_example"; // string | Only required if contact[id] was provided. 'Contact' should be used as value.

try {
    $result = $apiInstance->getCreditNotes($status, $credit_note_number, $start_date, $end_date, $contact_id, $contact_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->getCreditNotes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **status** | **string**| Status of the CreditNote | [optional]
 **credit_note_number** | **string**| Retrieve all CreditNotes with this creditNote number | [optional]
 **start_date** | **int**| Retrieve all CreditNotes with a date equal or higher | [optional]
 **end_date** | **int**| Retrieve all CreditNotes with a date equal or lower | [optional]
 **contact_id** | **int**| Retrieve all CreditNotes with this contact. Must be provided with contact[objectName] | [optional]
 **contact_object_name** | **string**| Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20016**](../Model/InlineResponse20016.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getcreditNoteById**
> \Swagger\Client\Model\InlineResponse20016 getcreditNoteById($credit_note_id)

Find creditNote by ID

Returns a single creditNote

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | ID of creditNote to return

try {
    $result = $apiInstance->getcreditNoteById($credit_note_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->getcreditNoteById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| ID of creditNote to return |

### Return type

[**\Swagger\Client\Model\InlineResponse20016**](../Model/InlineResponse20016.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **sendCreditNoteByPrinting**
> \Swagger\Client\Model\ModelCreditNoteSendByWithRender sendCreditNoteByPrinting($credit_note_id, $send_type)

Send credit note by printing

Sending a credit note to end-customers is an important part of the bookkeeping process.<br> Depending on the way you want to send the credit note, you need to use different endpoints.<br> Let's start with just printing out the credit note, meaning we only need to render the pdf.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | ID of creditNote to return
$send_type = "send_type_example"; // string | the type you want to print.

try {
    $result = $apiInstance->sendCreditNoteByPrinting($credit_note_id, $send_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->sendCreditNoteByPrinting: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| ID of creditNote to return |
 **send_type** | **string**| the type you want to print. |

### Return type

[**\Swagger\Client\Model\ModelCreditNoteSendByWithRender**](../Model/ModelCreditNoteSendByWithRender.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **sendCreditNoteViaEMail**
> \Swagger\Client\Model\InlineResponse2011 sendCreditNoteViaEMail($credit_note_id, $body)

Send credit note via email

This endpoint sends the specified credit note to a customer via email.<br>      This will automatically mark the credit note as sent.<br>      Please note, that in production an credit note is not allowed to be changed after this happened!

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | ID of credit note to be sent via email
$body = new \Swagger\Client\Model\CreditNoteIdSendViaEmailBody(); // \Swagger\Client\Model\CreditNoteIdSendViaEmailBody | Mail data

try {
    $result = $apiInstance->sendCreditNoteViaEMail($credit_note_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->sendCreditNoteViaEMail: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| ID of credit note to be sent via email |
 **body** | [**\Swagger\Client\Model\CreditNoteIdSendViaEmailBody**](../Model/CreditNoteIdSendViaEmailBody.md)| Mail data | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2011**](../Model/InlineResponse2011.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updatecreditNote**
> \Swagger\Client\Model\ModelCreditNoteResponse updatecreditNote($credit_note_id, $body)

Update an existing creditNote

Update a creditNote

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNoteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | ID of creditNote to update
$body = new \Swagger\Client\Model\ModelCreditNoteUpdate(); // \Swagger\Client\Model\ModelCreditNoteUpdate | Update data

try {
    $result = $apiInstance->updatecreditNote($credit_note_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNoteApi->updatecreditNote: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| ID of creditNote to update |
 **body** | [**\Swagger\Client\Model\ModelCreditNoteUpdate**](../Model/ModelCreditNoteUpdate.md)| Update data | [optional]

### Return type

[**\Swagger\Client\Model\ModelCreditNoteResponse**](../Model/ModelCreditNoteResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

