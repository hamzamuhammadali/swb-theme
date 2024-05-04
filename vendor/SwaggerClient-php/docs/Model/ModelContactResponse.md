# ModelContactResponse

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The contact id | [optional] 
**object_name** | **string** | The contact object name | [optional] 
**create** | [**\DateTime**](\DateTime.md) | Date of contact creation | [optional] 
**update** | [**\DateTime**](\DateTime.md) | Date of last contact update | [optional] 
**name** | **string** | The organization name.&lt;br&gt; Be aware that the type of contact will depend on this attribute.&lt;br&gt; If it holds a value, the contact will be regarded as an organization. | [optional] 
**status** | **string** | Defines the status of the contact. 100 &lt;-&gt; Lead - 500 &lt;-&gt; Pending - 1000 &lt;-&gt; Active. | [optional] 
**customer_number** | **string** | The customer number | [optional] 
**parent** | [**\Swagger\Client\Model\ModelContactResponseParent**](ModelContactResponseParent.md) |  | [optional] 
**surename** | **string** | The &lt;b&gt;first&lt;/b&gt; name of the contact.&lt;br&gt; Yeah... not quite right in literally every way. We know.&lt;br&gt; Not to be used for organizations. | [optional] 
**familyname** | **string** | The last name of the contact.&lt;br&gt; Not to be used for organizations. | [optional] 
**titel** | **string** | A non-academic title for the contact. Not to be used for organizations. | [optional] 
**category** | [**\Swagger\Client\Model\ModelContactResponseCategory**](ModelContactResponseCategory.md) |  | [optional] 
**description** | **string** | A description for the contact. | [optional] 
**academic_title** | **string** | A academic title for the contact. Not to be used for organizations. | [optional] 
**gender** | **string** | Gender of the contact.&lt;br&gt; Not to be used for organizations. | [optional] 
**sev_client** | [**\Swagger\Client\Model\ModelContactResponseSevClient**](ModelContactResponseSevClient.md) |  | [optional] 
**name2** | **string** | Second name of the contact.&lt;br&gt; Not to be used for organizations. | [optional] 
**birthday** | [**\DateTime**](\DateTime.md) | Birthday of the contact.&lt;br&gt; Not to be used for organizations. | [optional] 
**vat_number** | **string** | Vat number of the contact. | [optional] 
**bank_account** | **string** | Bank account number (IBAN) of the contact. | [optional] 
**bank_number** | **string** | Bank number of the bank used by the contact. | [optional] 
**default_cashback_time** | **string** | Absolute time in days which the contact has to pay his invoices and subsequently get a cashback. | [optional] 
**default_cashback_percent** | **string** | Percentage of the invoice sum the contact gets back if he payed invoices in time. | [optional] 
**default_time_to_pay** | **string** | The payment goal in days which is set for every invoice of the contact. | [optional] 
**tax_number** | **string** | The tax number of the contact. | [optional] 
**tax_office** | **string** | The tax office of the contact (only for greek customers). | [optional] 
**exempt_vat** | **string** | Defines if the contact is freed from paying vat. | [optional] 
**tax_type** | **string** | Defines which tax regulation the contact is using. | [optional] 
**tax_set** | [**\Swagger\Client\Model\ModelContactResponseTaxSet**](ModelContactResponseTaxSet.md) |  | [optional] 
**default_discount_amount** | **string** | The default discount the contact gets for every invoice.&lt;br&gt; Depending on defaultDiscountPercentage attribute, in percent or absolute value. | [optional] 
**default_discount_percentage** | **string** | Defines if the discount is a percentage (true) or an absolute value (false). | [optional] 
**buyer_reference** | **string** | Buyer reference of the contact. | [optional] 
**government_agency** | **string** | Defines whether the contact is a government agency (true) or not (false). | [optional] 
**additional_information** | **string** | Additional information stored for the contact. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

