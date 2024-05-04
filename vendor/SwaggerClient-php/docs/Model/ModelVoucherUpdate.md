# ModelVoucherUpdate

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**voucher_date** | [**\DateTime**](\DateTime.md) | Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**supplier** | [**\Swagger\Client\Model\ModelVoucherUpdateSupplier**](ModelVoucherUpdateSupplier.md) |  | [optional] 
**supplier_name** | **string** | The supplier name.&lt;br&gt;       The value you provide here will determine what supplier name is shown for the voucher in case you did not provide a supplier. | [optional] 
**description** | **string** | The description of the voucher. Essentially the voucher number. | [optional] 
**pay_date** | [**\DateTime**](\DateTime.md) | Needs to be timestamp or dd.mm.yyyy | [optional] 
**status** | **float** | Please have a look in       &lt;a href&#x3D;&#x27;https://api.sevdesk.de/#section/Types-and-status-of-vouchers&#x27;&gt;status of vouchers&lt;/a&gt;      to see what the different status codes mean | [optional] 
**paid_amount** | **float** | Amount which has already been paid for this voucher by the customer | [optional] 
**tax_type** | **string** | Tax type of the voucher. There are four tax types: 1. default - Umsatzsteuer ausweisen 2. eu - Steuerfreie innergemeinschaftliche Lieferung (Europäische Union) 3. noteu - Steuerschuldnerschaft des Leistungsempfängers (außerhalb EU, z. B. Schweiz) 4. custom - Using custom tax set 5. ss - Not subject to VAT according to §19 1 UStG Tax rates are heavily connected to the tax type used. | [optional] 
**credit_debit** | **string** | Defines if your voucher is a credit (C) or debit (D) | [optional] 
**voucher_type** | **string** | Type of the voucher. For more information on the different types, check       &lt;a href&#x3D;&#x27;https://api.sevdesk.de/#section/Types-and-status-of-vouchers&#x27;&gt;this&lt;/a&gt; | [optional] 
**currency** | **string** | specifies which currency the voucher should have. Attention: If the currency differs from the default currency stored in the account, then either the \&quot;propertyForeignCurrencyDeadline\&quot; or \&quot;propertyExchangeRate\&quot; parameter must be specified. If both parameters are specified, then the \&quot;propertyForeignCurrencyDeadline\&quot; parameter is preferred | [optional] 
**property_foreign_currency_deadline** | [**\DateTime**](\DateTime.md) | Defines the exchange rate day and and then the exchange rate is set from sevDesk. Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**property_exchange_rate** | **float** | Defines the exchange rate | [optional] 
**tax_set** | [**\Swagger\Client\Model\ModelVoucherTaxSet**](ModelVoucherTaxSet.md) |  | [optional] 
**payment_deadline** | [**\DateTime**](\DateTime.md) | Payment deadline of the voucher. | [optional] 
**delivery_date** | [**\DateTime**](\DateTime.md) | Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**delivery_date_until** | [**\DateTime**](\DateTime.md) | Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**document** | [**\Swagger\Client\Model\ModelVoucherDocument**](ModelVoucherDocument.md) |  | [optional] 
**cost_centre** | [**\Swagger\Client\Model\ModelVoucherCostCentre**](ModelVoucherCostCentre.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

