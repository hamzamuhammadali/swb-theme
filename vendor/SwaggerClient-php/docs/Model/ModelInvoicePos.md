# ModelInvoicePos

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The invoice position id. &lt;span style&#x3D;&#x27;color:red&#x27;&gt;Required&lt;/span&gt; if you want to update an invoice position for an existing invoice | [optional] 
**object_name** | **string** | The invoice position object name | 
**map_all** | **bool** |  | 
**create** | [**\DateTime**](\DateTime.md) | Date of invoice position creation | [optional] 
**update** | [**\DateTime**](\DateTime.md) | Date of last invoice position update | [optional] 
**invoice** | [**\Swagger\Client\Model\ModelInvoicePosInvoice**](ModelInvoicePosInvoice.md) |  | [optional] 
**part** | [**\Swagger\Client\Model\ModelCreditNotePosPart**](ModelCreditNotePosPart.md) |  | [optional] 
**quantity** | **float** | Quantity of the article/part | 
**price** | **float** | Price of the article/part. Is either gross or net, depending on the sevDesk account setting. | [optional] 
**name** | **string** | Name of the article/part. | [optional] 
**unity** | [**\Swagger\Client\Model\ModelInvoicePosUnity**](ModelInvoicePosUnity.md) |  | 
**sev_client** | [**\Swagger\Client\Model\ModelInvoicePosSevClient**](ModelInvoicePosSevClient.md) |  | [optional] 
**position_number** | **int** | Position number of your position. Can be used to order multiple positions. | [optional] 
**text** | **string** | A text describing your position. | [optional] 
**discount** | **float** | An optional discount of the position. | [optional] 
**tax_rate** | **float** | Tax rate of the position. | 
**sum_discount** | **float** | Discount sum of the position | [optional] 
**sum_net_accounting** | **float** | Net accounting sum of the position | [optional] 
**sum_tax_accounting** | **float** | Tax accounting sum of the position | [optional] 
**sum_gross_accounting** | **float** | Gross accounting sum of the position | [optional] 
**price_net** | **float** | Net price of the part | [optional] 
**price_gross** | **float** | Gross price of the part | [optional] 
**price_tax** | **float** | Tax on the price of the part | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

