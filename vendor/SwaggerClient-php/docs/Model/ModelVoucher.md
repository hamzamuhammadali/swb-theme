# ModelVoucher

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The voucher id | [optional] 
**object_name** | **string** | The voucher object name | 
**map_all** | **bool** |  | 
**create** | [**\DateTime**](\DateTime.md) | Date of voucher creation | [optional] 
**update** | [**\DateTime**](\DateTime.md) | Date of last voucher update | [optional] 
**sev_client** | [**\Swagger\Client\Model\ModelVoucherSevClient**](ModelVoucherSevClient.md) |  | [optional] 
**create_user** | [**\Swagger\Client\Model\ModelVoucherCreateUser**](ModelVoucherCreateUser.md) |  | [optional] 
**voucher_date** | [**\DateTime**](\DateTime.md) | Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**supplier** | [**\Swagger\Client\Model\ModelVoucherSupplier**](ModelVoucherSupplier.md) |  | [optional] 
**supplier_name** | **string** | The supplier name.&lt;br&gt;       The value you provide here will determine what supplier name is shown for the voucher in case you did not provide a supplier. | [optional] 
**description** | **string** | The description of the voucher. Essentially the voucher number. | [optional] 
**pay_date** | [**\DateTime**](\DateTime.md) | Needs to be timestamp or dd.mm.yyyy | [optional] 
**status** | **float** | Please have a look in       &lt;a href&#x3D;&#x27;https://api.sevdesk.de/#section/Types-and-status-of-vouchers&#x27;&gt;status of vouchers&lt;/a&gt;      to see what the different status codes mean | 
**sum_net** | **float** | Net sum of the voucher | [optional] 
**sum_tax** | **float** | Tax sum of the voucher | [optional] 
**sum_gross** | **float** | Gross sum of the voucher | [optional] 
**sum_net_accounting** | **float** | Net accounting sum of the voucher. Is usually the same as sumNet | [optional] 
**sum_tax_accounting** | **float** | Tax accounting sum of the voucher. Is usually the same as sumTax | [optional] 
**sum_gross_accounting** | **float** | Gross accounting sum of the voucher. Is usually the same as sumGross | [optional] 
**sum_discounts** | **float** | Sum of all discounts in the voucher | [optional] 
**sum_discounts_foreign_currency** | **float** | Discounts sum of the voucher in the foreign currency | [optional] 
**paid_amount** | **float** | Amount which has already been paid for this voucher by the customer | [optional] 
**tax_type** | **string** | Tax type of the voucher. There are four tax types: 1. default - Umsatzsteuer ausweisen 2. eu - Steuerfreie innergemeinschaftliche Lieferung (Europäische Union) 3. noteu - Steuerschuldnerschaft des Leistungsempfängers (außerhalb EU, z. B. Schweiz) 4. custom - Using custom tax set 5. ss - Not subject to VAT according to §19 1 UStG Tax rates are heavily connected to the tax type used. | 
**credit_debit** | **string** | Defines if your voucher is a credit (C) or debit (D) | 
**voucher_type** | **string** | Type of the voucher. For more information on the different types, check       &lt;a href&#x3D;&#x27;https://api.sevdesk.de/#section/Types-and-status-of-vouchers&#x27;&gt;this&lt;/a&gt; | 
**currency** | **string** | specifies which currency the voucher should have. Attention: If the currency differs from the default currency stored in the account, then either the \&quot;propertyForeignCurrencyDeadline\&quot; or \&quot;propertyExchangeRate\&quot; parameter must be specified. If both parameters are specified, then the \&quot;propertyForeignCurrencyDeadline\&quot; parameter is preferred | [optional] 
**property_foreign_currency_deadline** | [**\DateTime**](\DateTime.md) | Defines the exchange rate day and and then the exchange rate is set from sevDesk. Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**property_exchange_rate** | **float** | Defines the exchange rate | [optional] 
**recurring_interval** | **string** | The DateInterval in which recurring vouchers are generated.&lt;br&gt;       Necessary attribute for all recurring vouchers. | [optional] 
**recurring_start_date** | [**\DateTime**](\DateTime.md) | The date when the recurring vouchers start being generated.&lt;br&gt;       Necessary attribute for all recurring vouchers. | [optional] 
**recurring_next_voucher** | [**\DateTime**](\DateTime.md) | The date when the next voucher should be generated.&lt;br&gt;       Necessary attribute for all recurring vouchers. | [optional] 
**recurring_last_voucher** | [**\DateTime**](\DateTime.md) | The date when the last voucher was generated. | [optional] 
**recurring_end_date** | [**\DateTime**](\DateTime.md) | The date when the recurring vouchers end being generated.&lt;br&gt;      Necessary attribute for all recurring vouchers. | [optional] 
**enshrined** | [**\DateTime**](\DateTime.md) | Defines if and when voucher was enshrined. Enshrined vouchers can not be manipulated. | [optional] 
**tax_set** | [**\Swagger\Client\Model\ModelVoucherTaxSet**](ModelVoucherTaxSet.md) |  | [optional] 
**payment_deadline** | [**\DateTime**](\DateTime.md) | Payment deadline of the voucher. | [optional] 
**delivery_date** | [**\DateTime**](\DateTime.md) | Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**delivery_date_until** | [**\DateTime**](\DateTime.md) | Needs to be provided as timestamp or dd.mm.yyyy | [optional] 
**document** | [**\Swagger\Client\Model\ModelVoucherDocument**](ModelVoucherDocument.md) |  | [optional] 
**cost_centre** | [**\Swagger\Client\Model\ModelVoucherCostCentre**](ModelVoucherCostCentre.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

