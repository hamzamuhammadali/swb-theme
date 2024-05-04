# Swagger\Client\CreditNotePosApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getcreditNotePositions**](CreditNotePosApi.md#getcreditnotepositions) | **GET** /CreditNotePos | Retrieve creditNote positions

# **getcreditNotePositions**
> \Swagger\Client\Model\InlineResponse20019 getcreditNotePositions($credit_note_id, $credit_note_object_name)

Retrieve creditNote positions

Retrieve all creditNote positions depending on the filters defined in the query.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\CreditNotePosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credit_note_id = 56; // int | Retrieve all creditNote positions belonging to this creditNote. Must be provided with creditNote[objectName]
$credit_note_object_name = "credit_note_object_name_example"; // string | Only required if creditNote[id] was provided. 'creditNote' should be used as value.

try {
    $result = $apiInstance->getcreditNotePositions($credit_note_id, $credit_note_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CreditNotePosApi->getcreditNotePositions: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_note_id** | **int**| Retrieve all creditNote positions belonging to this creditNote. Must be provided with creditNote[objectName] | [optional]
 **credit_note_object_name** | **string**| Only required if creditNote[id] was provided. &#x27;creditNote&#x27; should be used as value. | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20019**](../Model/InlineResponse20019.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

