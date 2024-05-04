# ModelOrderPosUpdate

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The order position id | [optional] 
**object_name** | **string** | The order position object name | [optional] 
**create** | [**\DateTime**](\DateTime.md) | Date of order position creation | [optional] 
**update** | [**\DateTime**](\DateTime.md) | Date of last order position update | [optional] 
**order** | [**\Swagger\Client\Model\ModelOrderPosOrder**](ModelOrderPosOrder.md) |  | [optional] 
**part** | [**\Swagger\Client\Model\ModelCreditNotePosPart**](ModelCreditNotePosPart.md) |  | [optional] 
**quantity** | **float** | Quantity of the article/part | [optional] 
**price** | **float** | Price of the article/part. Is either gross or net, depending on the sevDesk account setting. | [optional] 
**price_net** | **float** | Net price of the part | [optional] 
**price_tax** | **float** | Tax on the price of the part | [optional] 
**price_gross** | **float** | Gross price of the part | [optional] 
**name** | **float** | Name of the article/part. | [optional] 
**unity** | [**\Swagger\Client\Model\ModelCreditNotePosUnity**](ModelCreditNotePosUnity.md) |  | [optional] 
**sev_client** | [**\Swagger\Client\Model\ModelOrderPosSevClient**](ModelOrderPosSevClient.md) |  | [optional] 
**position_number** | **int** | Position number of your position. Can be used to order multiple positions. | [optional] 
**text** | **string** | A text describing your position. | [optional] 
**discount** | **float** | An optional discount of the position. | [optional] 
**optional** | **bool** | Defines if the position is optional. | [optional] 
**tax_rate** | **float** | Tax rate of the position. | [optional] 
**sum_discount** | **float** | Discount sum of the position | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

