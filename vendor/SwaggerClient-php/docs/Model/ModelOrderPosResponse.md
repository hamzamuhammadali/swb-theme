# ModelOrderPosResponse

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The order position id | [optional] 
**object_name** | **string** | The order position object name | [optional] 
**create** | [**\DateTime**](\DateTime.md) | Date of order position creation | [optional] 
**update** | [**\DateTime**](\DateTime.md) | Date of last order position update | [optional] 
**order** | [**\Swagger\Client\Model\ModelOrderPosResponseOrder**](ModelOrderPosResponseOrder.md) |  | [optional] 
**part** | [**\Swagger\Client\Model\ModelCreditNotePosResponsePart**](ModelCreditNotePosResponsePart.md) |  | [optional] 
**quantity** | **string** | Quantity of the article/part | [optional] 
**price** | **string** | Price of the article/part. Is either gross or net, depending on the sevDesk account setting. | [optional] 
**price_net** | **string** | Net price of the part | [optional] 
**price_tax** | **string** | Tax on the price of the part | [optional] 
**price_gross** | **string** | Gross price of the part | [optional] 
**name** | **string** | Name of the article/part. | [optional] 
**unity** | [**\Swagger\Client\Model\ModelCreditNotePosResponseUnity**](ModelCreditNotePosResponseUnity.md) |  | [optional] 
**sev_client** | [**\Swagger\Client\Model\ModelOrderPosResponseSevClient**](ModelOrderPosResponseSevClient.md) |  | [optional] 
**position_number** | **string** | Position number of your position. Can be used to order multiple positions. | [optional] 
**text** | **string** | A text describing your position. | [optional] 
**discount** | **string** | An optional discount of the position. | [optional] 
**optional** | **bool** | Defines if the position is optional. | [optional] 
**tax_rate** | **string** | Tax rate of the position. | [optional] 
**sum_discount** | **string** | Discount sum of the position | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

