# ModelCreditNotePosResponse

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The creditNote position id | [optional] 
**object_name** | **string** | The creditNote position object name | [optional] 
**create** | **string** | Date of creditNote position creation | [optional] 
**update** | **string** | Date of last creditNote position update | [optional] 
**credit_note** | [**\Swagger\Client\Model\ModelCreditNotePosResponseCreditNote**](ModelCreditNotePosResponseCreditNote.md) |  | 
**part** | [**\Swagger\Client\Model\ModelCreditNotePosResponsePart**](ModelCreditNotePosResponsePart.md) |  | [optional] 
**quantity** | **string** | Quantity of the article/part | 
**price** | **string** | Price of the article/part. Is either gross or net, depending on the sevDesk account setting. | [optional] 
**price_net** | **string** | Net price of the part | [optional] 
**price_tax** | **string** | Tax on the price of the part | [optional] 
**price_gross** | **string** | Gross price of the part | [optional] 
**name** | **string** | Name of the article/part. | [optional] 
**unity** | [**\Swagger\Client\Model\ModelCreditNotePosResponseUnity**](ModelCreditNotePosResponseUnity.md) |  | 
**sev_client** | [**\Swagger\Client\Model\ModelCreditNotePosResponseSevClient**](ModelCreditNotePosResponseSevClient.md) |  | [optional] 
**position_number** | **string** | Position number of your position. Can be used to creditNote multiple positions. | [optional] 
**text** | **string** | A text describing your position. | [optional] 
**discount** | **string** | An optional discount of the position. | [optional] 
**optional** | **bool** | Defines if the position is optional. | [optional] 
**tax_rate** | **string** | Tax rate of the position. | 
**sum_discount** | **string** | Discount sum of the position | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

