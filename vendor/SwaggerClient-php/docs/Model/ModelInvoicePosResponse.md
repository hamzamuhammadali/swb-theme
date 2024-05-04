# ModelInvoicePosResponse

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The invoice position id | [optional] 
**object_name** | **string** | The invoice position object name | [optional] 
**create** | [**\DateTime**](\DateTime.md) | Date of invoice position creation | [optional] 
**update** | [**\DateTime**](\DateTime.md) | Date of last invoice position update | [optional] 
**invoice** | [**\Swagger\Client\Model\ModelInvoicePosResponseInvoice**](ModelInvoicePosResponseInvoice.md) |  | [optional] 
**part** | [**\Swagger\Client\Model\ModelInvoicePosResponsePart**](ModelInvoicePosResponsePart.md) |  | [optional] 
**quantity** | **bool** | Quantity of the article/part | [optional] 
**price** | **string** | Price of the article/part. Is either gross or net, depending on the sevDesk account setting. | [optional] 
**name** | **string** | Name of the article/part. | [optional] 
**unity** | [**\Swagger\Client\Model\ModelInvoicePosResponseUnity**](ModelInvoicePosResponseUnity.md) |  | [optional] 
**sev_client** | [**\Swagger\Client\Model\ModelInvoicePosResponseSevClient**](ModelInvoicePosResponseSevClient.md) |  | [optional] 
**position_number** | **string** | Position number of your position. Can be used to order multiple positions. | [optional] 
**text** | **string** | A text describing your position. | [optional] 
**discount** | **string** | An optional discount of the position. | [optional] 
**tax_rate** | **string** | Tax rate of the position. | [optional] 
**sum_discount** | **string** | Discount sum of the position | [optional] 
**sum_net_accounting** | **string** | Net accounting sum of the position | [optional] 
**sum_tax_accounting** | **string** | Tax accounting sum of the position | [optional] 
**sum_gross_accounting** | **string** | Gross accounting sum of the position | [optional] 
**price_net** | **string** | Net price of the part | [optional] 
**price_gross** | **string** | Gross price of the part | [optional] 
**price_tax** | **string** | Tax on the price of the part | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

