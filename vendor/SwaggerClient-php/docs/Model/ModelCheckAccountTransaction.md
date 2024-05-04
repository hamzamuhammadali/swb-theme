# ModelCheckAccountTransaction

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The check account transaction id | [optional] 
**object_name** | **string** | The check account transaction object name | [optional] 
**create** | [**\DateTime**](\DateTime.md) | Date of check account transaction creation | [optional] 
**update** | [**\DateTime**](\DateTime.md) | Date of last check account transaction update | [optional] 
**sev_client** | [**\Swagger\Client\Model\ModelCheckAccountTransactionSevClient**](ModelCheckAccountTransactionSevClient.md) |  | [optional] 
**value_date** | [**\DateTime**](\DateTime.md) | Date the check account transaction was booked | 
**entry_date** | [**\DateTime**](\DateTime.md) | Date the check account transaction was imported | [optional] 
**paymt_purpose** | **string** | the purpose of the transaction | [optional] 
**amount** | **float** | Amount of the transaction | 
**payee_payer_name** | **string** | Name of the payee/payer | 
**check_account** | [**\Swagger\Client\Model\ModelCheckAccountTransactionCheckAccount**](ModelCheckAccountTransactionCheckAccount.md) |  | 
**status** | **int** | Status of the check account transaction.&lt;br&gt;       100 &lt;-&gt; Created&lt;br&gt;       200 &lt;-&gt; Linked&lt;br&gt;       300 &lt;-&gt; Private&lt;br&gt;       400 &lt;-&gt; Booked | 
**enshrined** | [**\DateTime**](\DateTime.md) | Defines if the transaction has been enshrined and can not be changed any more. | [optional] 
**source_transaction** | [**\Swagger\Client\Model\ModelCheckAccountTransactionSourceTransaction**](ModelCheckAccountTransactionSourceTransaction.md) |  | [optional] 
**target_transaction** | [**\Swagger\Client\Model\ModelCheckAccountTransactionTargetTransaction**](ModelCheckAccountTransactionTargetTransaction.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

