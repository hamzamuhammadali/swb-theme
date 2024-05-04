# ModelVoucherPosResponse

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The voucher position id | [optional] 
**object_name** | **string** | The voucher position object name | [optional] 
**create** | **string** | Date of voucher position creation | [optional] 
**update** | **string** | Date of last voucher position update | [optional] 
**sev_client** | [**\Swagger\Client\Model\ModelVoucherPosResponseSevClient**](ModelVoucherPosResponseSevClient.md) |  | [optional] 
**voucher** | [**\Swagger\Client\Model\ModelVoucherPosResponseVoucher**](ModelVoucherPosResponseVoucher.md) |  | 
**accounting_type** | [**\Swagger\Client\Model\ModelVoucherPosResponseAccountingType**](ModelVoucherPosResponseAccountingType.md) |  | 
**estimated_accounting_type** | [**\Swagger\Client\Model\ModelVoucherPosResponseEstimatedAccountingType**](ModelVoucherPosResponseEstimatedAccountingType.md) |  | [optional] 
**tax_rate** | **string** | Tax rate of the voucher position. | 
**net** | **bool** | Determines whether &#x27;sumNet&#x27; or &#x27;sumGross&#x27; is regarded.&lt;br&gt;       If both are not given, &#x27;sum&#x27; is regarded and treated as net or gross depending on &#x27;net&#x27;.  All positions must be either net or gross, a mixture of the two is not possible. | 
**is_asset** | **bool** | Determines whether position is regarded as an asset which can be depreciated. | [optional] 
**sum_net** | **string** | Net sum of the voucher position.&lt;br&gt;      Only regarded if &#x27;net&#x27; is &#x27;true&#x27;, otherwise its readOnly. | 
**sum_tax** | **string** | Tax sum of the voucher position. | [optional] 
**sum_gross** | **string** | Gross sum of the voucher position.&lt;br&gt;      Only regarded if &#x27;net&#x27; is &#x27;false&#x27;, otherwise its readOnly. | 
**sum_net_accounting** | **string** | Net accounting sum. Is equal to sumNet. | [optional] 
**sum_tax_accounting** | **string** | Tax accounting sum. Is equal to sumTax. | [optional] 
**sum_gross_accounting** | **string** | Gross accounting sum. Is equal to sumGross. | [optional] 
**comment** | **string** | Comment for the voucher position. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

