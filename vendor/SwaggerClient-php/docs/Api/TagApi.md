# Swagger\Client\TagApi

All URIs are relative to *https://my.sevdesk.de/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTag**](TagApi.md#createtag) | **POST** /Tag/Factory/create | Create a new tag
[**deleteTag**](TagApi.md#deletetag) | **DELETE** /Tag/{tagId} | Deletes a tag
[**getTagById**](TagApi.md#gettagbyid) | **GET** /Tag/{tagId} | Find tag by ID
[**getTagRelations**](TagApi.md#gettagrelations) | **GET** /TagRelation | Retrieve tag relations
[**getTags**](TagApi.md#gettags) | **GET** /Tag | Retrieve tags
[**updateTag**](TagApi.md#updatetag) | **PUT** /Tag/{tagId} | Update tag

# **createTag**
> \Swagger\Client\Model\ModelTagCreateResponse createTag($body)

Create a new tag

Create a new tag

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\TagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\FactoryCreateBody(); // \Swagger\Client\Model\FactoryCreateBody | 

try {
    $result = $apiInstance->createTag($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagApi->createTag: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\FactoryCreateBody**](../Model/FactoryCreateBody.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\ModelTagCreateResponse**](../Model/ModelTagCreateResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteTag**
> \Swagger\Client\Model\InlineResponse2001 deleteTag($tag_id)

Deletes a tag

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\TagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$tag_id = 56; // int | Id of tag to delete

try {
    $result = $apiInstance->deleteTag($tag_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagApi->deleteTag: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tag_id** | **int**| Id of tag to delete |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTagById**
> \Swagger\Client\Model\InlineResponse20047 getTagById($tag_id)

Find tag by ID

Returns a single tag

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\TagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$tag_id = 56; // int | ID of tag to return

try {
    $result = $apiInstance->getTagById($tag_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagApi->getTagById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tag_id** | **int**| ID of tag to return |

### Return type

[**\Swagger\Client\Model\InlineResponse20047**](../Model/InlineResponse20047.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTagRelations**
> \Swagger\Client\Model\InlineResponse20048 getTagRelations()

Retrieve tag relations

Retrieve all tag relations

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\TagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getTagRelations();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagApi->getTagRelations: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse20048**](../Model/InlineResponse20048.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTags**
> \Swagger\Client\Model\InlineResponse20047 getTags($id, $name)

Retrieve tags

Retrieve all tags

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\TagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 1.2; // float | ID of the Tag
$name = "name_example"; // string | Name of the Tag

try {
    $result = $apiInstance->getTags($id, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagApi->getTags: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **float**| ID of the Tag | [optional]
 **name** | **string**| Name of the Tag | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse20047**](../Model/InlineResponse20047.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateTag**
> \Swagger\Client\Model\ModelTagResponse updateTag($tag_id, $body)

Update tag

Update an existing tag

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\TagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$tag_id = 56; // int | ID of tag you want to update
$body = new \Swagger\Client\Model\TagTagIdBody(); // \Swagger\Client\Model\TagTagIdBody | 

try {
    $result = $apiInstance->updateTag($tag_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagApi->updateTag: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tag_id** | **int**| ID of tag you want to update |
 **body** | [**\Swagger\Client\Model\TagTagIdBody**](../Model/TagTagIdBody.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\ModelTagResponse**](../Model/ModelTagResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

