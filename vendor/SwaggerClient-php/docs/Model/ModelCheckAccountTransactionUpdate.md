# ModelCheckAccountTransactionUpdate

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**value_date** | [**\DateTime**](\DateTime.md) | Date the check account transaction was booked | [optional] 
**entry_date** | [**\DateTime**](\DateTime.md) | Date the check account transaction was imported | [optional] 
**paymt_purpose** | **string** | the purpose of the transaction | [optional] 
**amount** | **float** | Amount of the transaction | [optional] 
**payee_payer_name** | **string** | Name of the payee/payer | [optional] 
**check_account** | [**\Swagger\Client\Model\ModelCheckAccountTransactionUpdateCheckAccount**](ModelCheckAccountTransactionUpdateCheckAccount.md) |  | [optional] 
**status** | **int** | Status of the check account transaction.&lt;br&gt;       100 &lt;-&gt; Created&lt;br&gt;       200 &lt;-&gt; Linked&lt;br&gt;       300 &lt;-&gt; Private&lt;br&gt;       400 &lt;-&gt; Booked | [optional] 
**enshrined** | [**\DateTime**](\DateTime.md) | Defines if the transaction has been enshrined and can not be changed any more. | [optional] 
**source_transaction** | [**\Swagger\Client\Model\ModelCheckAccountTransactionSourceTransaction**](ModelCheckAccountTransactionSourceTransaction.md) |  | [optional] 
**target_transaction** | [**\Swagger\Client\Model\ModelCheckAccountTransactionTargetTransaction**](ModelCheckAccountTransactionTargetTransaction.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

