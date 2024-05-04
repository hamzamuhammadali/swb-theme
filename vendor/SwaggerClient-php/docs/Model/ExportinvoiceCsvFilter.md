# ExportinvoiceCsvFilter

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_type** | **string[]** | Type of invoices you want to export 1. RE - Rechnung 2. SR - Stornorechnung 3. TR - Teilrechnung 4. AR - Abschlagsrechnung 5. ER - Endrechnung 6. WKR - Wiederkehrende Rechnung 7. MA - Mahnung | [optional] 
**start_date** | [**\DateTime**](\DateTime.md) | Start date of the invoice | [optional] 
**end_date** | [**\DateTime**](\DateTime.md) | End date of the invoice | [optional] 
**contact** | [**\Swagger\Client\Model\ExportinvoiceCsvFilterContact**](ExportinvoiceCsvFilterContact.md) |  | [optional] 
**start_amount** | **int** | filters the invoices by amount | [optional] 
**end_amount** | **int** | filters the invoices by amount | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

