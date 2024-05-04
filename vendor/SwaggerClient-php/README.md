# SwaggerClient-php
<b>Contact:</b> To contact our support click  <a href='https://landing.sevdesk.de/service-support-center-technik'>here</a><br><br>   # General information  Welcome to our API!<br>  sevDesk offers you  the possibility of retrieving data using an interface, namely the sevDesk API, and making  changes without having to use the web UI. The sevDesk interface is a REST-Full API. All sevDesk  data and functions that are used in the web UI can also be controlled through the API.   # Cross-Origin Resource Sharing  This API features Cross-Origin Resource Sharing (CORS).<br>  It enables cross-domain communication from the browser.<br>  All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.    # Embedding resources  When retrieving resources by using this API, you might encounter nested resources in the resources you requested.<br>  For example, an invoice always contains a contact, of which you can see the ID and the object name.<br>  This API gives you the possibility to embed these resources completely into the resources you originally requested.<br>  Taking our invoice example, this would mean, that you would not only see the ID and object name of a contact, but rather the complete contact resource.    To embed resources, all you need to do is to add the query parameter 'embed' to your GET request.<br>  As values, you can provide the name of the nested resource.<br>  Multiple nested resources are also possible by providing multiple names, separated by a comma.    # Authentication and Authorization  The sevDesk API uses a token authentication to authorize calls. For this purpose every sevDesk administrator has one API token, which is a <b>hexadecimal string</b>  containing <b>32 characters</b>. The following clip shows where you can find the  API token if this is your first time with our API.<br><br> <video src='openAPI/img/findingTheApiToken.mp4' controls width='640' height='360'> Ihr Browser kann dieses Video nicht wiedergeben.<br/> Dieses Video zeigt wie sie Ihr sevDesk API Token finden. </video> <br> The token will be needed in every request that you want to send and needs to be attached to the request url as a <b>Query Parameter</b><br> or provided as a value of an <b>Authorization Header</b>.<br> For security reasons, we suggest putting the API Token in the Authorization Header and not in the query string.<br> However, in the request examples in this documentation, we will keep it in the query string, as it is easier for you to copy them and try them yourself.<br> The following url is an example that shows where your token needs to be placed as a query parameter.<br> In this case, we used some random API token. <ul> <li><span>ht</span>tps://my.sevdesk.de/api/v1/Contact?token=<span style='color:red'>b7794de0085f5cd00560f160f290af38</span></li> </ul> The next example shows the token in the Authorization Header. <ul> <li>\"Authorization\" :<span style='color:red'>\"b7794de0085f5cd00560f160f290af38\"</span></li> </ul> The api tokens have an infinite lifetime and, in other words, exist as long as the sevDesk user exists.<br> For this reason, the user should <b>NEVER</b> be deleted.<br> If really necessary, it is advisable to save the api token as we will <b>NOT</b> be able to retrieve it afterwards!<br> It is also possible to generate a new API token, for example, if you want to prevent the usage of your sevDesk account by other people who got your current API token.<br> To achieve this, you just need to click on the \"generate new\" symbol to the right of your token and confirm it with your password.  # API News  To never miss API news and updates again, subscribe to our <b>free API newsletter</b> and get all relevant  information to keep your sevDesk software running smoothly. To subscribe, simply click <a href = 'https://landing.sevdesk.de/api-newsletter'><b>here</b></a> and confirm the email address to which we may send all updates relevant to you.  # API Requests  In our case, REST API requests need to be build by combining the following components. <table> <tr> <th><b>Component</b></th> <th><b>Description</b></th> </tr> <tr> <td>HTTP-Methods</td> <td> <ul> <li>GET (retrieve a resource)</li> <li>POST (create a resource)</li> <li>PUT (update a resource)</li> <li>DELETE (delete a resource)</li> </ul> </td> </tr> <tr> <td>URL of the API</td> <td><span style='color: #2aa198'>ht</span><span style='color: #2aa198'>tps://my.sevdesk.de/api/v1</span></td> </tr> <tr> <td>URI of the resource</td> <td>The resource to query.<br>For example contacts in sevDesk:<br><br> <span style='color:red'>/Contact</span><br><br> Which will result in the following complete URL:<br><br> <span style='color: #2aa198'>ht</span><span style='color: #2aa198'>tps://my.sevdesk.de/api/v1</span><span style='color:red'>/Contact</span> </td> </tr> <tr> <td>Query parameters</td> <td>Are attached by using the connectives <b>?</b> and <b>&</b> in the URL.<br></td> </tr> <tr> <td>Request headers</td> <td>Typical request headers are for example:<br> <div> <br> <ul> <li>Content-type</li> <li>Authorization</li> <li>Accept-Encoding</li> <li>User-Agent</li> <li>X-Version: Used for resource versioning see information below</li> <li>...</li> </ul> </div> </td> </tr> <tr>  <td>Response headers</td> <td> Typical response headers are for example:<br><br> <div> <ul>  <li>Deprecation: If a resource is deprecated we return true or a timestamp since when</li> <li>...</li> </ul> </div> </td> </tr> <tr> <td>Request body</td> <td>Mostly required in POST and PUT requests.<br> Often the request body contains json, in our case, it also accepts url-encoded data. </td> </tr> </table><br> <span style='color:red'>Note</span>: please pass a meaningful entry at the header \"User-Agent\".  If the \"User-Agent\" is set meaningfully, we can offer better support in case of queries from customers.<br> An example how such a \"User-Agent\" can look like: \"Integration-name by abc\". <br><br> This is a sample request for retrieving existing contacts in sevDesk using curl:<br><br> <img src='openAPI/img/GETRequest.PNG' alt='Get Request' height='150'><br><br> As you can see, the request contains all the components mentioned above.<br> It's HTTP method is GET, it has a correct endpoint  (<span style='color: #2aa198'>ht</span><span style='color: #2aa198'>tps://my.sevdesk.de/api/v1</span><span style='color:red'>/Contact</span>), query parameters like <b>token</b> and additional <b>header</b> information!<br><br> <b>Query Parameters</b><br><br> As you might have seen in the sample request above, there are several other parameters besides \"token\", located in the url.<br> Those are mostly optional but prove to be very useful for a lot of requests as they can limit, extend, sort or filter the data you will get as a response.<br><br> These are the most used query parameter for the sevDesk API. <table> <tr> <th><b>Parameter</b></th> <th><b>Description</b></th> </tr> <tr> <td>embed</td> <td>Will extend some of the returned data.<br> A brief example can be found below.</td> </tr> <tr> <td>countAll</td> <td>\"countAll=true\" returns the number of items</td> </tr> </table> This is an example for the usage of the embed parameter.<br> The following first request will return all company contact entries in sevDesk up to a limit of 100 without any additional information and no offset.<br><br> <img src='openAPI/img/ContactQueryWithoutEmbed.PNG' width='900' height='850'><br><br> Now have a look at the category attribute located in the response.<br> Naturally, it just contains the id and the object name of the object but no further information.<br> We will now use the parameter embed with the value \"category\".<br><br> <img src='openAPI/img/ContactQueryWithEmbed.PNG' width='900' height='850'><br><br> As you can see, the category object is now extended and shows all the attributes and their corresponding values.<br><br> There are lot of other query parameters that can be used to filter the returned data for objects that match a certain pattern, however, those will not be mentioned here and instead can be found at the detail documentation of the most used API endpoints like contact, invoice or voucher.<br><br> <b>Pagination</b><br> <table> <tr> <th><b>Parameter</b></th> <th><b>Description</b></th> </tr> <tr> <td>limit</td> <td>Limits the number of entries that are returned.<br> Most useful in GET requests which will most likely deliver big sets of data like country or currency lists.<br> In this case, you can bypass the default limitation on returned entries by providing a high number. </td> </tr> <tr> <td>offset</td> <td>Specifies a certain offset for the data that will be returned.<br> As an example, you can specify \"offset=2\" if you want all entries except for the first two.</td> </tr> </table> Example: <ul><li><code>ht<span>tps://my.sevdesk.de/api/v1/Invoice?offset=20&limit=10<span></code></li></ul> <b>Request Headers</b><br><br> The HTTP request (response) headers allow the client as well as the server to pass additional information with the request.<br> They transfer the parameters and arguments which are important for transmitting data over HTTP.<br> Three headers which are useful / necessary when using the sevDesk API are \"Authorization, \"Accept\" and  \"Content-type\".<br> Underneath is a brief description of why and how they should be used.<br><br> <b>Authorization</b><br><br> Can be used if you want to provide your API token in the header instead of having it in the url. <ul> <li>Authorization:<span style='color:red'>yourApiToken</span></li> </ul> <b>Accept</b><br><br> Specifies the format of the response.<br> Required for operations with a response body. <ul> <li>Accept:application/<span style='color:red'>format</span> </li> </ul> In our case, <code><span style='color:red'>format</span></code> could be replaced with <code>json</code> or <code>xml</code><br><br> <b>Content-type</b><br><br> Specifies which format is used in the request.<br> Is required for operations with a request body. <ul> <li>Content-type:application/<span style='color:red'>format</span></li> </ul> In our case,<code><span style='color:red'>format</span></code>could be replaced with <code>json</code> or <code>x-www-form-urlencoded</code> <br><br><b>API Responses</b><br><br> HTTP status codes<br> When calling the sevDesk API it is very likely that you will get a HTTP status code in the response.<br> Some API calls will also return JSON response bodies which will contain information about the resource.<br> Each status code which is returned will either be a <b>success</b> code or an <b>error</b> code.<br><br> Success codes <table> <tr> <th><b>Status code</b></th> <th><b>Description</b></th> </tr> <tr> <td><code>200 OK</code></td> <td>The request was successful</td> </tr> <tr> <td><code>201 Created</code></td> <td>Most likely to be found in the response of a <b>POST</b> request.<br> This code indicates that the desired resource was successfully created.</td> </tr> </table> <br>Error codes <table> <tr> <th><b>Status code</b></th> <th><b>Description</b></th> </tr> <tr> <td><code>400 Bad request</code></td> <td>The request you sent is most likely syntactically incorrect.<br> You should check if the parameters in the request body or the url are correct.</td> </tr> <tr> <td><code>401 Unauthorized</code></td> <td>The authentication failed.<br> Most likely caused by a missing or wrong API token.</td> </tr> <tr> <td><code>403 Forbidden</code></td> <td>You do not have the permission the access the resource which is requested.</td> </tr> <tr> <td><code>404 Not found</code></td> <td>The resource you specified does not exist.</td> </tr> <tr> <td><code>500 Internal server error</code></td> <td>An internal server error has occurred.<br> Normally this means that something went wrong on our side.<br> However, sometimes this error will appear if we missed to catch an error which is normally a 400 status code! </td> </tr> </table> <br><br> <b>Resource Versioning</b> <br><br> We use resource versioning to handle breaking changes for our endpoints, these are rarely used and will be communicated before we remove older versions.<br> To call a different version we use a specific header <code>X-Version</code> that should be filled with the desired version.<br> <ul>  <li>If you do not specify any version we assume <code>default</code></li> <li>If you specify a version that does not exist or was removed, you will get an error with information which versions are available</li> </ul> <table> <tr> <th>X-Version</th> <th>Description</th> </tr> <tr> <td><code>default</code></td> <td>Should always reference the oldest version.<br> If a specific resource is updated with a new version, <br> then the default version stays the same until the old version is deleted</td> </tr> <tr> <td><code>1.0</code> ... <code>1.9</code></td> <td>Our incrementally version for each resource independent<br> <b>Important</b>: A resource can be available via <code>default</code> but not <code>1.0</code></td> </tr> </table>  # Your First Request  After reading the introduction to our API, you should now be able to make your first call.<br> For testing our API, we would always recommend to create a trial account for sevDesk to prevent unwanted changes to your main account.<br> A trial account will be in the highest tariff (materials management), so every sevDesk function can be tested! <br><br>To start testing we would recommend one of the following tools: <ul> <li><a href='https://www.getpostman.com/'>Postman</a></li> <li><a href='https://curl.haxx.se/download.html'>cURL</a></li> </ul> This example will illustrate your first request, which is creating a new Contact in sevDesk.<br> <ol> <li>Download <a href='https://www.getpostman.com/'><b>Postman</b></a> for your desired system and start the application</li> <li>Enter <span><b>ht</span>tps://my.sevdesk.de/api/v1/Contact</b> as the url</li> <li>Use the connective <b>?</b> to append <b>token=</b> to the end of the url, or create an authorization header. Insert your API token as the value</li> <li>For this test, select <b>POST</b> as the HTTP method</li> <li>Go to <b>Headers</b> and enter the key-value pair <b>Content-type</b> + <b>application/x-www-form-urlencoded</b><br> As an alternative, you can just go to <b>Body</b> and select <b>x-www-form-urlencoded</b></li> <li>Now go to <b>Body</b> (if you are not there yet) and enter the key-value pairs as shown in the following picture<br><br> <img src='openAPI/img/FirstRequestPostman.PNG' width='900'><br><br></li> <li>Click on <b>Send</b>. Your response should now look like this:<br><br> <img src='openAPI/img/FirstRequestResponse.PNG' width='900'></li> </ol> As you can see, a successful response in this case returns a JSON-formatted response body containing the contact you just created.<br> For keeping it simple, this was only a minimal example of creating a contact.<br> There are however numerous combinations of parameters that you can provide which add information to your contact.

This PHP package is automatically generated by the [Swagger Codegen](https://github.com/swagger-api/swagger-codegen) project:

- API version: 2.0.0
- Build package: io.swagger.codegen.v3.generators.php.PhpClientCodegen

## Requirements

PHP 5.5 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/git_user_id/git_repo_id.git"
    }
  ],
  "require": {
    "git_user_id/git_repo_id": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/SwaggerClient-php/vendor/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\ModelAccountingContact(); // \Swagger\Client\Model\ModelAccountingContact | Creation data

try {
    $result = $apiInstance->createAccountingContact($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->createAccountingContact: ', $e->getMessage(), PHP_EOL;
}

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$accounting_contact_id = 56; // int | Id of accounting contact resource to delete

try {
    $result = $apiInstance->deleteAccountingContact($accounting_contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->deleteAccountingContact: ', $e->getMessage(), PHP_EOL;
}

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$contact_id = "contact_id_example"; // string | ID of contact for which you want the accounting contact.
$contact_object_name = "contact_object_name_example"; // string | Object name. Only needed if you also defined the ID of a contact.

try {
    $result = $apiInstance->getAccountingContact($contact_id, $contact_object_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->getAccountingContact: ', $e->getMessage(), PHP_EOL;
}

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$accounting_contact_id = 56; // int | ID of accounting contact to return

try {
    $result = $apiInstance->getAccountingContactById($accounting_contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->getAccountingContactById: ', $e->getMessage(), PHP_EOL;
}

$apiInstance = new Swagger\Client\Api\AccountingContactApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$accounting_contact_id = 56; // int | ID of accounting contact to update
$body = new \Swagger\Client\Model\ModelAccountingContactUpdate(); // \Swagger\Client\Model\ModelAccountingContactUpdate | Update data

try {
    $result = $apiInstance->updateAccountingContact($accounting_contact_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountingContactApi->updateAccountingContact: ', $e->getMessage(), PHP_EOL;
}
?>
```

## Documentation for API Endpoints

All URIs are relative to *https://my.sevdesk.de/api/v1*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountingContactApi* | [**createAccountingContact**](docs/Api/AccountingContactApi.md#createaccountingcontact) | **POST** /AccountingContact | Create a new accounting contact
*AccountingContactApi* | [**deleteAccountingContact**](docs/Api/AccountingContactApi.md#deleteaccountingcontact) | **DELETE** /AccountingContact/{accountingContactId} | Deletes an accounting contact
*AccountingContactApi* | [**getAccountingContact**](docs/Api/AccountingContactApi.md#getaccountingcontact) | **GET** /AccountingContact | Retrieve accounting contact
*AccountingContactApi* | [**getAccountingContactById**](docs/Api/AccountingContactApi.md#getaccountingcontactbyid) | **GET** /AccountingContact/{accountingContactId} | Find accounting contact by ID
*AccountingContactApi* | [**updateAccountingContact**](docs/Api/AccountingContactApi.md#updateaccountingcontact) | **PUT** /AccountingContact/{accountingContactId} | Update an existing accounting contact
*CheckAccountApi* | [**createCheckAccount**](docs/Api/CheckAccountApi.md#createcheckaccount) | **POST** /CheckAccount | Create a new check account
*CheckAccountApi* | [**deleteCheckAccount**](docs/Api/CheckAccountApi.md#deletecheckaccount) | **DELETE** /CheckAccount/{checkAccountId} | Deletes a check account
*CheckAccountApi* | [**getBalanceAtDate**](docs/Api/CheckAccountApi.md#getbalanceatdate) | **GET** /CheckAccount/{checkAccountId}/getBalanceAtDate | Get the balance at a given date
*CheckAccountApi* | [**getCheckAccountById**](docs/Api/CheckAccountApi.md#getcheckaccountbyid) | **GET** /CheckAccount/{checkAccountId} | Find check account by ID
*CheckAccountApi* | [**getCheckAccounts**](docs/Api/CheckAccountApi.md#getcheckaccounts) | **GET** /CheckAccount | Retrieve check accounts
*CheckAccountApi* | [**updateCheckAccount**](docs/Api/CheckAccountApi.md#updatecheckaccount) | **PUT** /CheckAccount/{checkAccountId} | Update an existing check account
*CheckAccountTransactionApi* | [**createTransaction**](docs/Api/CheckAccountTransactionApi.md#createtransaction) | **POST** /CheckAccountTransaction | Create a new transaction
*CheckAccountTransactionApi* | [**deleteCheckAccountTransaction**](docs/Api/CheckAccountTransactionApi.md#deletecheckaccounttransaction) | **DELETE** /CheckAccountTransaction/{checkAccountTransactionId} | Deletes a check account transaction
*CheckAccountTransactionApi* | [**getCheckAccountTransactionById**](docs/Api/CheckAccountTransactionApi.md#getcheckaccounttransactionbyid) | **GET** /CheckAccountTransaction/{checkAccountTransactionId} | Find check account transaction by ID
*CheckAccountTransactionApi* | [**getTransactions**](docs/Api/CheckAccountTransactionApi.md#gettransactions) | **GET** /CheckAccountTransaction | Retrieve transactions
*CheckAccountTransactionApi* | [**updateCheckAccountTransaction**](docs/Api/CheckAccountTransactionApi.md#updatecheckaccounttransaction) | **PUT** /CheckAccountTransaction/{checkAccountTransactionId} | Update an existing check account transaction
*CommunicationWayApi* | [**createCommunicationWay**](docs/Api/CommunicationWayApi.md#createcommunicationway) | **POST** /CommunicationWay | Create a new contact communication way
*CommunicationWayApi* | [**deleteCommunicationWay**](docs/Api/CommunicationWayApi.md#deletecommunicationway) | **DELETE** /CommunicationWay/{communicationWayId} | Deletes a communication way
*CommunicationWayApi* | [**getCommunicationWayById**](docs/Api/CommunicationWayApi.md#getcommunicationwaybyid) | **GET** /CommunicationWay/{communicationWayId} | Find communication way by ID
*CommunicationWayApi* | [**getCommunicationWayKeys**](docs/Api/CommunicationWayApi.md#getcommunicationwaykeys) | **GET** /CommunicationWayKey | Retrieve communication way keys
*CommunicationWayApi* | [**getCommunicationWays**](docs/Api/CommunicationWayApi.md#getcommunicationways) | **GET** /CommunicationWay | Retrieve communication ways
*CommunicationWayApi* | [**updateCommunicationWay**](docs/Api/CommunicationWayApi.md#updatecommunicationway) | **PUT** /CommunicationWay/{communicationWayId} | Update a existing communication way
*ContactApi* | [**contactCustomerNumberAvailabilityCheck**](docs/Api/ContactApi.md#contactcustomernumberavailabilitycheck) | **GET** /Contact/Mapper/checkCustomerNumberAvailability | Check if a customer number is available
*ContactApi* | [**createContact**](docs/Api/ContactApi.md#createcontact) | **POST** /Contact | Create a new contact
*ContactApi* | [**deleteContact**](docs/Api/ContactApi.md#deletecontact) | **DELETE** /Contact/{contactId} | Deletes a contact
*ContactApi* | [**findContactsByCustomFieldValue**](docs/Api/ContactApi.md#findcontactsbycustomfieldvalue) | **GET** /Contact/Factory/findContactsByCustomFieldValue | Find contacts by custom field value
*ContactApi* | [**getContactById**](docs/Api/ContactApi.md#getcontactbyid) | **GET** /Contact/{contactId} | Find contact by ID
*ContactApi* | [**getContactTabsItemCountById**](docs/Api/ContactApi.md#getcontacttabsitemcountbyid) | **GET** /Contact/{contactId}/getTabsItemCount | Get number of all items
*ContactApi* | [**getContacts**](docs/Api/ContactApi.md#getcontacts) | **GET** /Contact | Retrieve contacts
*ContactApi* | [**getNextCustomerNumber**](docs/Api/ContactApi.md#getnextcustomernumber) | **GET** /Contact/Factory/getNextCustomerNumber | Get next free customer number
*ContactApi* | [**updateContact**](docs/Api/ContactApi.md#updatecontact) | **PUT** /Contact/{contactId} | Update a existing contact
*ContactAddressApi* | [**contactAddressId**](docs/Api/ContactAddressApi.md#contactaddressid) | **GET** /ContactAddress/{contactAddressId} | Find contact address by ID
*ContactAddressApi* | [**createContactAddress**](docs/Api/ContactAddressApi.md#createcontactaddress) | **POST** /ContactAddress | Create a new contact address
*ContactAddressApi* | [**deleteContactAddress**](docs/Api/ContactAddressApi.md#deletecontactaddress) | **DELETE** /ContactAddress/{contactAddressId} | Deletes a contact address
*ContactAddressApi* | [**getContactAddresses**](docs/Api/ContactAddressApi.md#getcontactaddresses) | **GET** /ContactAddress | Retrieve contact addresses
*ContactAddressApi* | [**updateContactAddress**](docs/Api/ContactAddressApi.md#updatecontactaddress) | **PUT** /ContactAddress/{contactAddressId} | update a existing contact address
*ContactFieldApi* | [**createContactField**](docs/Api/ContactFieldApi.md#createcontactfield) | **POST** /ContactCustomField | Create contact field
*ContactFieldApi* | [**createContactFieldSetting**](docs/Api/ContactFieldApi.md#createcontactfieldsetting) | **POST** /ContactCustomFieldSetting | Create contact field setting
*ContactFieldApi* | [**deleteContactCustomFieldId**](docs/Api/ContactFieldApi.md#deletecontactcustomfieldid) | **DELETE** /ContactCustomField/{contactCustomFieldId} | delete a contact field
*ContactFieldApi* | [**deleteContactFieldSetting**](docs/Api/ContactFieldApi.md#deletecontactfieldsetting) | **DELETE** /ContactCustomFieldSetting/{contactCustomFieldSettingId} | Deletes a contact field setting
*ContactFieldApi* | [**getContactFieldSettingById**](docs/Api/ContactFieldApi.md#getcontactfieldsettingbyid) | **GET** /ContactCustomFieldSetting/{contactCustomFieldSettingId} | Find contact field setting by ID
*ContactFieldApi* | [**getContactFieldSettings**](docs/Api/ContactFieldApi.md#getcontactfieldsettings) | **GET** /ContactCustomFieldSetting | Retrieve contact field settings
*ContactFieldApi* | [**getContactFields**](docs/Api/ContactFieldApi.md#getcontactfields) | **GET** /ContactCustomField | Retrieve contact fields
*ContactFieldApi* | [**getContactFieldsById**](docs/Api/ContactFieldApi.md#getcontactfieldsbyid) | **GET** /ContactCustomField/{contactCustomFieldId} | Retrieve contact fields
*ContactFieldApi* | [**getPlaceholder**](docs/Api/ContactFieldApi.md#getplaceholder) | **GET** /Textparser/fetchDictionaryEntriesByType | Retrieve Placeholders
*ContactFieldApi* | [**getReferenceCount**](docs/Api/ContactFieldApi.md#getreferencecount) | **GET** /ContactCustomFieldSetting/{contactCustomFieldSettingId}/getReferenceCount | Receive count reference
*ContactFieldApi* | [**updateContactFieldSetting**](docs/Api/ContactFieldApi.md#updatecontactfieldsetting) | **PUT** /ContactCustomFieldSetting/{contactCustomFieldSettingId} | Update contact field setting
*ContactFieldApi* | [**updateContactfield**](docs/Api/ContactFieldApi.md#updatecontactfield) | **PUT** /ContactCustomField/{contactCustomFieldId} | Update a contact field
*CreditNoteApi* | [**bookCreditNote**](docs/Api/CreditNoteApi.md#bookcreditnote) | **PUT** /CreditNote/{creditNoteId}/bookAmount | Book a credit note
*CreditNoteApi* | [**createCreditNoteFromInvoice**](docs/Api/CreditNoteApi.md#createcreditnotefrominvoice) | **POST** /CreditNote/Factory/createFromInvoice | Creates a new creditNote from an invoice
*CreditNoteApi* | [**createCreditNoteFromVoucher**](docs/Api/CreditNoteApi.md#createcreditnotefromvoucher) | **POST** /CreditNote/Factory/createFromVoucher | Creates a new creditNote from a voucher
*CreditNoteApi* | [**createcreditNote**](docs/Api/CreditNoteApi.md#createcreditnote) | **POST** /CreditNote/Factory/saveCreditNote | Create a new creditNote
*CreditNoteApi* | [**creditNoteGetPdf**](docs/Api/CreditNoteApi.md#creditnotegetpdf) | **GET** /CreditNote/{creditNoteId}/getPdf | Retrieve pdf document of a credit note
*CreditNoteApi* | [**creditNoteSendBy**](docs/Api/CreditNoteApi.md#creditnotesendby) | **PUT** /CreditNote/{creditNoteId}/sendBy | Mark credit note as sent
*CreditNoteApi* | [**deletecreditNote**](docs/Api/CreditNoteApi.md#deletecreditnote) | **DELETE** /CreditNote/{creditNoteId} | Deletes an creditNote
*CreditNoteApi* | [**getCreditNotes**](docs/Api/CreditNoteApi.md#getcreditnotes) | **GET** /CreditNote | Retrieve CreditNote
*CreditNoteApi* | [**getcreditNoteById**](docs/Api/CreditNoteApi.md#getcreditnotebyid) | **GET** /CreditNote/{creditNoteId} | Find creditNote by ID
*CreditNoteApi* | [**sendCreditNoteByPrinting**](docs/Api/CreditNoteApi.md#sendcreditnotebyprinting) | **GET** /CreditNote/{creditNoteId}/sendByWithRender | Send credit note by printing
*CreditNoteApi* | [**sendCreditNoteViaEMail**](docs/Api/CreditNoteApi.md#sendcreditnoteviaemail) | **POST** /CreditNote/{creditNoteId}/sendViaEmail | Send credit note via email
*CreditNoteApi* | [**updatecreditNote**](docs/Api/CreditNoteApi.md#updatecreditnote) | **PUT** /CreditNote/{creditNoteId} | Update an existing creditNote
*CreditNotePosApi* | [**getcreditNotePositions**](docs/Api/CreditNotePosApi.md#getcreditnotepositions) | **GET** /CreditNotePos | Retrieve creditNote positions
*ExportApi* | [**exportContact**](docs/Api/ExportApi.md#exportcontact) | **GET** /Export/contactListCsv | Export contact
*ExportApi* | [**exportCreditNote**](docs/Api/ExportApi.md#exportcreditnote) | **GET** /Export/creditNoteCsv | Export creditNote
*ExportApi* | [**exportDatev**](docs/Api/ExportApi.md#exportdatev) | **GET** /Export/datevCSV | Export datev
*ExportApi* | [**exportInvoice**](docs/Api/ExportApi.md#exportinvoice) | **GET** /Export/invoiceCsv | Export invoice
*ExportApi* | [**exportInvoiceZip**](docs/Api/ExportApi.md#exportinvoicezip) | **GET** /Export/invoiceZip | Export Invoice as zip
*ExportApi* | [**exportTransactions**](docs/Api/ExportApi.md#exporttransactions) | **GET** /Export/transactionsCsv | Export transaction
*ExportApi* | [**exportVoucher**](docs/Api/ExportApi.md#exportvoucher) | **GET** /Export/voucherListCsv | Export voucher as zip
*ExportApi* | [**exportVoucherZip**](docs/Api/ExportApi.md#exportvoucherzip) | **GET** /Export/voucherZip | Export voucher zip
*ExportApi* | [**updateExportConfig**](docs/Api/ExportApi.md#updateexportconfig) | **PUT** /SevClient/{SevClientId}/updateExportConfig | Update export config
*InvoiceApi* | [**bookInvoice**](docs/Api/InvoiceApi.md#bookinvoice) | **PUT** /Invoice/{invoiceId}/bookAmount | Book an invoice
*InvoiceApi* | [**cancelInvoice**](docs/Api/InvoiceApi.md#cancelinvoice) | **POST** /Invoice/{invoiceId}/cancelInvoice | Cancel an invoice / Create cancellation invoice
*InvoiceApi* | [**createInvoiceByFactory**](docs/Api/InvoiceApi.md#createinvoicebyfactory) | **POST** /Invoice/Factory/saveInvoice | Create a new invoice
*InvoiceApi* | [**createInvoiceFromOrder**](docs/Api/InvoiceApi.md#createinvoicefromorder) | **POST** /Invoice/Factory/createInvoiceFromOrder | Create invoice from order
*InvoiceApi* | [**createInvoiceReminder**](docs/Api/InvoiceApi.md#createinvoicereminder) | **POST** /Invoice/Factory/createInvoiceReminder | Create invoice reminder
*InvoiceApi* | [**getInvoiceById**](docs/Api/InvoiceApi.md#getinvoicebyid) | **GET** /Invoice/{invoiceId} | Find invoice by ID
*InvoiceApi* | [**getInvoicePositionsById**](docs/Api/InvoiceApi.md#getinvoicepositionsbyid) | **GET** /Invoice/{invoiceId}/getPositions | Find invoice positions
*InvoiceApi* | [**getInvoices**](docs/Api/InvoiceApi.md#getinvoices) | **GET** /Invoice | Retrieve invoices
*InvoiceApi* | [**getIsInvoicePartiallyPaid**](docs/Api/InvoiceApi.md#getisinvoicepartiallypaid) | **GET** /Invoice/{invoiceId}/getIsPartiallyPaid | Check if an invoice is already partially paid
*InvoiceApi* | [**invoiceGetPdf**](docs/Api/InvoiceApi.md#invoicegetpdf) | **GET** /Invoice/{invoiceId}/getPdf | Retrieve pdf document of an invoice
*InvoiceApi* | [**invoiceRender**](docs/Api/InvoiceApi.md#invoicerender) | **POST** /Invoice/{invoiceId}/render | Render the pdf document of an invoice
*InvoiceApi* | [**invoiceSendBy**](docs/Api/InvoiceApi.md#invoicesendby) | **PUT** /Invoice/{invoiceId}/sendBy | Mark invoice as sent
*InvoiceApi* | [**sendInvoiceViaEMail**](docs/Api/InvoiceApi.md#sendinvoiceviaemail) | **POST** /Invoice/{invoiceId}/sendViaEmail | Send invoice via email
*InvoicePosApi* | [**getInvoicePos**](docs/Api/InvoicePosApi.md#getinvoicepos) | **GET** /InvoicePos | Retrieve InvoicePos
*LayoutApi* | [**getLetterpapersWithThumb**](docs/Api/LayoutApi.md#getletterpaperswiththumb) | **GET** /DocServer/getLetterpapersWithThumb | Retrieve letterpapers
*LayoutApi* | [**getTemplates**](docs/Api/LayoutApi.md#gettemplates) | **GET** /DocServer/getTemplatesWithThumb | Retrieve templates
*LayoutApi* | [**updateCreditNoteTemplate**](docs/Api/LayoutApi.md#updatecreditnotetemplate) | **PUT** /CreditNote/{creditNoteId}/changeParameter | Update an of credit note template
*LayoutApi* | [**updateInvoiceTemplate**](docs/Api/LayoutApi.md#updateinvoicetemplate) | **PUT** /Invoice/{invoiceId}/changeParameter | Update an invoice template
*LayoutApi* | [**updateOrderTemplate**](docs/Api/LayoutApi.md#updateordertemplate) | **PUT** /Order/{orderId}/changeParameter | Update an order template
*OrderApi* | [**createContractNoteFromOrder**](docs/Api/OrderApi.md#createcontractnotefromorder) | **POST** /Order/Factory/createContractNoteFromOrder | Create contract note from order
*OrderApi* | [**createOrder**](docs/Api/OrderApi.md#createorder) | **POST** /Order/Factory/saveOrder | Create a new order
*OrderApi* | [**createPackingListFromOrder**](docs/Api/OrderApi.md#createpackinglistfromorder) | **POST** /Order/Factory/createPackingListFromOrder | Create packing list from order
*OrderApi* | [**deleteOrder**](docs/Api/OrderApi.md#deleteorder) | **DELETE** /Order/{orderId} | Deletes an order
*OrderApi* | [**getDiscounts**](docs/Api/OrderApi.md#getdiscounts) | **GET** /Order/{orderId}/getDiscounts | Find order discounts
*OrderApi* | [**getOrderById**](docs/Api/OrderApi.md#getorderbyid) | **GET** /Order/{orderId} | Find order by ID
*OrderApi* | [**getOrderPositionsById**](docs/Api/OrderApi.md#getorderpositionsbyid) | **GET** /Order/{orderId}/getPositions | Find order positions
*OrderApi* | [**getOrders**](docs/Api/OrderApi.md#getorders) | **GET** /Order | Retrieve orders
*OrderApi* | [**getRelatedObjects**](docs/Api/OrderApi.md#getrelatedobjects) | **GET** /Order/{orderId}/getRelatedObjects | Find related objects
*OrderApi* | [**orderGetPdf**](docs/Api/OrderApi.md#ordergetpdf) | **GET** /Order/{orderId}/getPdf | Retrieve pdf document of an order
*OrderApi* | [**orderSendBy**](docs/Api/OrderApi.md#ordersendby) | **PUT** /Order/{orderId}/sendBy | Mark order as sent
*OrderApi* | [**sendorderViaEMail**](docs/Api/OrderApi.md#sendorderviaemail) | **POST** /Order/{orderId}/sendViaEmail | Send order via email
*OrderApi* | [**updateOrder**](docs/Api/OrderApi.md#updateorder) | **PUT** /Order/{orderId} | Update an existing order
*OrderPosApi* | [**deleteOrderPos**](docs/Api/OrderPosApi.md#deleteorderpos) | **DELETE** /OrderPos/{orderPosId} | Deletes an order Position
*OrderPosApi* | [**getOrderPositionById**](docs/Api/OrderPosApi.md#getorderpositionbyid) | **GET** /OrderPos/{orderPosId} | Find order position by ID
*OrderPosApi* | [**getOrderPositions**](docs/Api/OrderPosApi.md#getorderpositions) | **GET** /OrderPos | Retrieve order positions
*OrderPosApi* | [**updateOrderPosition**](docs/Api/OrderPosApi.md#updateorderposition) | **PUT** /OrderPos/{orderPosId} | Update an existing order position
*PartApi* | [**createPart**](docs/Api/PartApi.md#createpart) | **POST** /Part | Create a new part
*PartApi* | [**getPartById**](docs/Api/PartApi.md#getpartbyid) | **GET** /Part/{partId} | Find part by ID
*PartApi* | [**getParts**](docs/Api/PartApi.md#getparts) | **GET** /Part | Retrieve parts
*PartApi* | [**partGetStock**](docs/Api/PartApi.md#partgetstock) | **GET** /Part/{partId}/getStock | Get stock of a part
*PartApi* | [**updatePart**](docs/Api/PartApi.md#updatepart) | **PUT** /Part/{partId} | Update an existing part
*ReportApi* | [**reportContact**](docs/Api/ReportApi.md#reportcontact) | **GET** /Report/contactlist | Export contact list
*ReportApi* | [**reportInvoice**](docs/Api/ReportApi.md#reportinvoice) | **GET** /Report/invoicelist | Export invoice list
*ReportApi* | [**reportOrder**](docs/Api/ReportApi.md#reportorder) | **GET** /Report/orderlist | Export order list
*ReportApi* | [**reportVoucher**](docs/Api/ReportApi.md#reportvoucher) | **GET** /Report/voucherlist | Export voucher list
*TagApi* | [**createTag**](docs/Api/TagApi.md#createtag) | **POST** /Tag/Factory/create | Create a new tag
*TagApi* | [**deleteTag**](docs/Api/TagApi.md#deletetag) | **DELETE** /Tag/{tagId} | Deletes a tag
*TagApi* | [**getTagById**](docs/Api/TagApi.md#gettagbyid) | **GET** /Tag/{tagId} | Find tag by ID
*TagApi* | [**getTagRelations**](docs/Api/TagApi.md#gettagrelations) | **GET** /TagRelation | Retrieve tag relations
*TagApi* | [**getTags**](docs/Api/TagApi.md#gettags) | **GET** /Tag | Retrieve tags
*TagApi* | [**updateTag**](docs/Api/TagApi.md#updatetag) | **PUT** /Tag/{tagId} | Update tag
*VoucherApi* | [**bookVoucher**](docs/Api/VoucherApi.md#bookvoucher) | **PUT** /Voucher/{voucherId}/bookAmount | Book a voucher
*VoucherApi* | [**createVoucherByFactory**](docs/Api/VoucherApi.md#createvoucherbyfactory) | **POST** /Voucher/Factory/saveVoucher | Create a new voucher
*VoucherApi* | [**getVoucherById**](docs/Api/VoucherApi.md#getvoucherbyid) | **GET** /Voucher/{voucherId} | Find voucher by ID
*VoucherApi* | [**getVouchers**](docs/Api/VoucherApi.md#getvouchers) | **GET** /Voucher | Retrieve vouchers
*VoucherApi* | [**updateVoucher**](docs/Api/VoucherApi.md#updatevoucher) | **PUT** /Voucher/{voucherId} | Update an existing voucher
*VoucherApi* | [**voucherUploadFile**](docs/Api/VoucherApi.md#voucheruploadfile) | **POST** /Voucher/Factory/uploadTempFile | Upload voucher file
*VoucherPosApi* | [**getVoucherPositions**](docs/Api/VoucherPosApi.md#getvoucherpositions) | **GET** /VoucherPos | Retrieve voucher positions

## Documentation For Models

 - [AllOfModelContactCustomFieldResponseContactCustomFieldSetting](docs/Model/AllOfModelContactCustomFieldResponseContactCustomFieldSetting.md)
 - [CreditNoteFactorycreateFromInvoiceInvoice](docs/Model/CreditNoteFactorycreateFromInvoiceInvoice.md)
 - [CreditNoteFactorycreateFromVoucherVoucher](docs/Model/CreditNoteFactorycreateFromVoucherVoucher.md)
 - [CreditNoteIdBookAmountBody](docs/Model/CreditNoteIdBookAmountBody.md)
 - [CreditNoteIdSendByBody](docs/Model/CreditNoteIdSendByBody.md)
 - [CreditNoteIdSendViaEmailBody](docs/Model/CreditNoteIdSendViaEmailBody.md)
 - [CreditNotecreditNoteIdbookAmountCheckAccount](docs/Model/CreditNotecreditNoteIdbookAmountCheckAccount.md)
 - [CreditNotecreditNoteIdbookAmountCheckAccountTransaction](docs/Model/CreditNotecreditNoteIdbookAmountCheckAccountTransaction.md)
 - [ExportcontactListCsvFilter](docs/Model/ExportcontactListCsvFilter.md)
 - [ExportcontactListCsvFilterCountry](docs/Model/ExportcontactListCsvFilterCountry.md)
 - [ExportcreditNoteCsvFilter](docs/Model/ExportcreditNoteCsvFilter.md)
 - [ExportcreditNoteCsvFilterContact](docs/Model/ExportcreditNoteCsvFilterContact.md)
 - [ExportinvoiceCsvFilter](docs/Model/ExportinvoiceCsvFilter.md)
 - [ExportinvoiceCsvFilterContact](docs/Model/ExportinvoiceCsvFilterContact.md)
 - [ExporttransactionsCsvFilter](docs/Model/ExporttransactionsCsvFilter.md)
 - [ExporttransactionsCsvFilterCheckAccount](docs/Model/ExporttransactionsCsvFilterCheckAccount.md)
 - [ExportvoucherListCsvFilter](docs/Model/ExportvoucherListCsvFilter.md)
 - [ExportvoucherListCsvFilterContact](docs/Model/ExportvoucherListCsvFilterContact.md)
 - [ExportvoucherZipFilter](docs/Model/ExportvoucherZipFilter.md)
 - [ExportvoucherZipFilterContact](docs/Model/ExportvoucherZipFilterContact.md)
 - [FactoryCreateBody](docs/Model/FactoryCreateBody.md)
 - [FactoryCreateFromInvoiceBody](docs/Model/FactoryCreateFromInvoiceBody.md)
 - [FactoryCreateFromVoucherBody](docs/Model/FactoryCreateFromVoucherBody.md)
 - [FactoryCreateInvoiceReminderBody](docs/Model/FactoryCreateInvoiceReminderBody.md)
 - [FactoryUploadTempFileBody](docs/Model/FactoryUploadTempFileBody.md)
 - [InlineResponse200](docs/Model/InlineResponse200.md)
 - [InlineResponse2001](docs/Model/InlineResponse2001.md)
 - [InlineResponse20010](docs/Model/InlineResponse20010.md)
 - [InlineResponse20010Objects](docs/Model/InlineResponse20010Objects.md)
 - [InlineResponse20011](docs/Model/InlineResponse20011.md)
 - [InlineResponse20012](docs/Model/InlineResponse20012.md)
 - [InlineResponse20013](docs/Model/InlineResponse20013.md)
 - [InlineResponse20014](docs/Model/InlineResponse20014.md)
 - [InlineResponse20015](docs/Model/InlineResponse20015.md)
 - [InlineResponse20016](docs/Model/InlineResponse20016.md)
 - [InlineResponse20017](docs/Model/InlineResponse20017.md)
 - [InlineResponse20018](docs/Model/InlineResponse20018.md)
 - [InlineResponse20018CreditNote](docs/Model/InlineResponse20018CreditNote.md)
 - [InlineResponse20018SevClient](docs/Model/InlineResponse20018SevClient.md)
 - [InlineResponse20019](docs/Model/InlineResponse20019.md)
 - [InlineResponse2002](docs/Model/InlineResponse2002.md)
 - [InlineResponse20020](docs/Model/InlineResponse20020.md)
 - [InlineResponse20021](docs/Model/InlineResponse20021.md)
 - [InlineResponse20021Objects](docs/Model/InlineResponse20021Objects.md)
 - [InlineResponse20022](docs/Model/InlineResponse20022.md)
 - [InlineResponse20022Objects](docs/Model/InlineResponse20022Objects.md)
 - [InlineResponse20023](docs/Model/InlineResponse20023.md)
 - [InlineResponse20023Objects](docs/Model/InlineResponse20023Objects.md)
 - [InlineResponse20024](docs/Model/InlineResponse20024.md)
 - [InlineResponse20025](docs/Model/InlineResponse20025.md)
 - [InlineResponse20025Objects](docs/Model/InlineResponse20025Objects.md)
 - [InlineResponse20026](docs/Model/InlineResponse20026.md)
 - [InlineResponse20026Objects](docs/Model/InlineResponse20026Objects.md)
 - [InlineResponse20027](docs/Model/InlineResponse20027.md)
 - [InlineResponse20027Objects](docs/Model/InlineResponse20027Objects.md)
 - [InlineResponse20028](docs/Model/InlineResponse20028.md)
 - [InlineResponse20029](docs/Model/InlineResponse20029.md)
 - [InlineResponse2003](docs/Model/InlineResponse2003.md)
 - [InlineResponse20030](docs/Model/InlineResponse20030.md)
 - [InlineResponse20031](docs/Model/InlineResponse20031.md)
 - [InlineResponse20032](docs/Model/InlineResponse20032.md)
 - [InlineResponse20033](docs/Model/InlineResponse20033.md)
 - [InlineResponse20033CreditNote](docs/Model/InlineResponse20033CreditNote.md)
 - [InlineResponse20033SevClient](docs/Model/InlineResponse20033SevClient.md)
 - [InlineResponse20034](docs/Model/InlineResponse20034.md)
 - [InlineResponse20034Letterpapers](docs/Model/InlineResponse20034Letterpapers.md)
 - [InlineResponse20035](docs/Model/InlineResponse20035.md)
 - [InlineResponse20035Templates](docs/Model/InlineResponse20035Templates.md)
 - [InlineResponse20036](docs/Model/InlineResponse20036.md)
 - [InlineResponse20037](docs/Model/InlineResponse20037.md)
 - [InlineResponse20038](docs/Model/InlineResponse20038.md)
 - [InlineResponse20039](docs/Model/InlineResponse20039.md)
 - [InlineResponse2004](docs/Model/InlineResponse2004.md)
 - [InlineResponse20040](docs/Model/InlineResponse20040.md)
 - [InlineResponse20041](docs/Model/InlineResponse20041.md)
 - [InlineResponse20041CreditNote](docs/Model/InlineResponse20041CreditNote.md)
 - [InlineResponse20042](docs/Model/InlineResponse20042.md)
 - [InlineResponse20043](docs/Model/InlineResponse20043.md)
 - [InlineResponse20043Objects](docs/Model/InlineResponse20043Objects.md)
 - [InlineResponse20044](docs/Model/InlineResponse20044.md)
 - [InlineResponse20044Objects](docs/Model/InlineResponse20044Objects.md)
 - [InlineResponse20045](docs/Model/InlineResponse20045.md)
 - [InlineResponse20045Objects](docs/Model/InlineResponse20045Objects.md)
 - [InlineResponse20046](docs/Model/InlineResponse20046.md)
 - [InlineResponse20046Objects](docs/Model/InlineResponse20046Objects.md)
 - [InlineResponse20047](docs/Model/InlineResponse20047.md)
 - [InlineResponse20048](docs/Model/InlineResponse20048.md)
 - [InlineResponse2005](docs/Model/InlineResponse2005.md)
 - [InlineResponse2006](docs/Model/InlineResponse2006.md)
 - [InlineResponse2007](docs/Model/InlineResponse2007.md)
 - [InlineResponse2008](docs/Model/InlineResponse2008.md)
 - [InlineResponse2009](docs/Model/InlineResponse2009.md)
 - [InlineResponse201](docs/Model/InlineResponse201.md)
 - [InlineResponse2011](docs/Model/InlineResponse2011.md)
 - [InlineResponse2012](docs/Model/InlineResponse2012.md)
 - [InlineResponse2013](docs/Model/InlineResponse2013.md)
 - [InlineResponse2014](docs/Model/InlineResponse2014.md)
 - [InlineResponse2014Objects](docs/Model/InlineResponse2014Objects.md)
 - [InlineResponse201Objects](docs/Model/InlineResponse201Objects.md)
 - [InvoiceFactorycreateInvoiceReminderInvoice](docs/Model/InvoiceFactorycreateInvoiceReminderInvoice.md)
 - [InvoiceIdBookAmountBody](docs/Model/InvoiceIdBookAmountBody.md)
 - [InvoiceIdRenderBody](docs/Model/InvoiceIdRenderBody.md)
 - [InvoiceIdSendByBody](docs/Model/InvoiceIdSendByBody.md)
 - [InvoiceIdSendViaEmailBody](docs/Model/InvoiceIdSendViaEmailBody.md)
 - [InvoiceinvoiceIdbookAmountCheckAccountTransaction](docs/Model/InvoiceinvoiceIdbookAmountCheckAccountTransaction.md)
 - [ModelAccountingContact](docs/Model/ModelAccountingContact.md)
 - [ModelAccountingContactContact](docs/Model/ModelAccountingContactContact.md)
 - [ModelAccountingContactResponse](docs/Model/ModelAccountingContactResponse.md)
 - [ModelAccountingContactResponseContact](docs/Model/ModelAccountingContactResponseContact.md)
 - [ModelAccountingContactResponseSevClient](docs/Model/ModelAccountingContactResponseSevClient.md)
 - [ModelAccountingContactUpdate](docs/Model/ModelAccountingContactUpdate.md)
 - [ModelAccountingContactUpdateContact](docs/Model/ModelAccountingContactUpdateContact.md)
 - [ModelChangeLayout](docs/Model/ModelChangeLayout.md)
 - [ModelChangeLayoutResponse](docs/Model/ModelChangeLayoutResponse.md)
 - [ModelChangeLayoutResponseMetadaten](docs/Model/ModelChangeLayoutResponseMetadaten.md)
 - [ModelChangeLayoutResponseMetadatenThumbs](docs/Model/ModelChangeLayoutResponseMetadatenThumbs.md)
 - [ModelChangeLayoutResponseMetadatenValues](docs/Model/ModelChangeLayoutResponseMetadatenValues.md)
 - [ModelCheckAccount](docs/Model/ModelCheckAccount.md)
 - [ModelCheckAccountResponse](docs/Model/ModelCheckAccountResponse.md)
 - [ModelCheckAccountResponseSevClient](docs/Model/ModelCheckAccountResponseSevClient.md)
 - [ModelCheckAccountSevClient](docs/Model/ModelCheckAccountSevClient.md)
 - [ModelCheckAccountTransaction](docs/Model/ModelCheckAccountTransaction.md)
 - [ModelCheckAccountTransactionCheckAccount](docs/Model/ModelCheckAccountTransactionCheckAccount.md)
 - [ModelCheckAccountTransactionResponse](docs/Model/ModelCheckAccountTransactionResponse.md)
 - [ModelCheckAccountTransactionResponseCheckAccount](docs/Model/ModelCheckAccountTransactionResponseCheckAccount.md)
 - [ModelCheckAccountTransactionResponseSevClient](docs/Model/ModelCheckAccountTransactionResponseSevClient.md)
 - [ModelCheckAccountTransactionResponseSourceTransaction](docs/Model/ModelCheckAccountTransactionResponseSourceTransaction.md)
 - [ModelCheckAccountTransactionResponseTargetTransaction](docs/Model/ModelCheckAccountTransactionResponseTargetTransaction.md)
 - [ModelCheckAccountTransactionSevClient](docs/Model/ModelCheckAccountTransactionSevClient.md)
 - [ModelCheckAccountTransactionSourceTransaction](docs/Model/ModelCheckAccountTransactionSourceTransaction.md)
 - [ModelCheckAccountTransactionTargetTransaction](docs/Model/ModelCheckAccountTransactionTargetTransaction.md)
 - [ModelCheckAccountTransactionUpdate](docs/Model/ModelCheckAccountTransactionUpdate.md)
 - [ModelCheckAccountTransactionUpdateCheckAccount](docs/Model/ModelCheckAccountTransactionUpdateCheckAccount.md)
 - [ModelCheckAccountUpdate](docs/Model/ModelCheckAccountUpdate.md)
 - [ModelCommunicationWay](docs/Model/ModelCommunicationWay.md)
 - [ModelCommunicationWayContact](docs/Model/ModelCommunicationWayContact.md)
 - [ModelCommunicationWayKey](docs/Model/ModelCommunicationWayKey.md)
 - [ModelCommunicationWayResponse](docs/Model/ModelCommunicationWayResponse.md)
 - [ModelCommunicationWayResponseContact](docs/Model/ModelCommunicationWayResponseContact.md)
 - [ModelCommunicationWayResponseKey](docs/Model/ModelCommunicationWayResponseKey.md)
 - [ModelCommunicationWayResponseSevClient](docs/Model/ModelCommunicationWayResponseSevClient.md)
 - [ModelCommunicationWaySevClient](docs/Model/ModelCommunicationWaySevClient.md)
 - [ModelCommunicationWayUpdate](docs/Model/ModelCommunicationWayUpdate.md)
 - [ModelCommunicationWayUpdateContact](docs/Model/ModelCommunicationWayUpdateContact.md)
 - [ModelCommunicationWayUpdateKey](docs/Model/ModelCommunicationWayUpdateKey.md)
 - [ModelContact](docs/Model/ModelContact.md)
 - [ModelContactAddress](docs/Model/ModelContactAddress.md)
 - [ModelContactAddressResponse](docs/Model/ModelContactAddressResponse.md)
 - [ModelContactAddressResponseCategory](docs/Model/ModelContactAddressResponseCategory.md)
 - [ModelContactAddressResponseContact](docs/Model/ModelContactAddressResponseContact.md)
 - [ModelContactAddressResponseCountry](docs/Model/ModelContactAddressResponseCountry.md)
 - [ModelContactAddressResponseSevClient](docs/Model/ModelContactAddressResponseSevClient.md)
 - [ModelContactAddressUpdate](docs/Model/ModelContactAddressUpdate.md)
 - [ModelContactAddressUpdateContact](docs/Model/ModelContactAddressUpdateContact.md)
 - [ModelContactAddressUpdateCountry](docs/Model/ModelContactAddressUpdateCountry.md)
 - [ModelContactCategory](docs/Model/ModelContactCategory.md)
 - [ModelContactCustomField](docs/Model/ModelContactCustomField.md)
 - [ModelContactCustomFieldContact](docs/Model/ModelContactCustomFieldContact.md)
 - [ModelContactCustomFieldContactCustomFieldSetting](docs/Model/ModelContactCustomFieldContactCustomFieldSetting.md)
 - [ModelContactCustomFieldResponse](docs/Model/ModelContactCustomFieldResponse.md)
 - [ModelContactCustomFieldResponseContact](docs/Model/ModelContactCustomFieldResponseContact.md)
 - [ModelContactCustomFieldResponseSevClient](docs/Model/ModelContactCustomFieldResponseSevClient.md)
 - [ModelContactCustomFieldSetting](docs/Model/ModelContactCustomFieldSetting.md)
 - [ModelContactCustomFieldSettingResponse](docs/Model/ModelContactCustomFieldSettingResponse.md)
 - [ModelContactCustomFieldSettingResponseSevClient](docs/Model/ModelContactCustomFieldSettingResponseSevClient.md)
 - [ModelContactCustomFieldSettingUpdate](docs/Model/ModelContactCustomFieldSettingUpdate.md)
 - [ModelContactCustomFieldUpdate](docs/Model/ModelContactCustomFieldUpdate.md)
 - [ModelContactParent](docs/Model/ModelContactParent.md)
 - [ModelContactResponse](docs/Model/ModelContactResponse.md)
 - [ModelContactResponseCategory](docs/Model/ModelContactResponseCategory.md)
 - [ModelContactResponseParent](docs/Model/ModelContactResponseParent.md)
 - [ModelContactResponseSevClient](docs/Model/ModelContactResponseSevClient.md)
 - [ModelContactResponseTaxSet](docs/Model/ModelContactResponseTaxSet.md)
 - [ModelContactTaxSet](docs/Model/ModelContactTaxSet.md)
 - [ModelContactUpdate](docs/Model/ModelContactUpdate.md)
 - [ModelContactUpdateCategory](docs/Model/ModelContactUpdateCategory.md)
 - [ModelContactUpdateParent](docs/Model/ModelContactUpdateParent.md)
 - [ModelCreateInvoiceFromOrder](docs/Model/ModelCreateInvoiceFromOrder.md)
 - [ModelCreateInvoiceFromOrderOrder](docs/Model/ModelCreateInvoiceFromOrderOrder.md)
 - [ModelCreatePackingListFromOrder](docs/Model/ModelCreatePackingListFromOrder.md)
 - [ModelCreditNote](docs/Model/ModelCreditNote.md)
 - [ModelCreditNoteAddressCountry](docs/Model/ModelCreditNoteAddressCountry.md)
 - [ModelCreditNoteContact](docs/Model/ModelCreditNoteContact.md)
 - [ModelCreditNoteContactPerson](docs/Model/ModelCreditNoteContactPerson.md)
 - [ModelCreditNoteCreateUser](docs/Model/ModelCreditNoteCreateUser.md)
 - [ModelCreditNoteMailResponse](docs/Model/ModelCreditNoteMailResponse.md)
 - [ModelCreditNoteMailResponseSevClient](docs/Model/ModelCreditNoteMailResponseSevClient.md)
 - [ModelCreditNotePos](docs/Model/ModelCreditNotePos.md)
 - [ModelCreditNotePosCreditNote](docs/Model/ModelCreditNotePosCreditNote.md)
 - [ModelCreditNotePosPart](docs/Model/ModelCreditNotePosPart.md)
 - [ModelCreditNotePosResponse](docs/Model/ModelCreditNotePosResponse.md)
 - [ModelCreditNotePosResponseCreditNote](docs/Model/ModelCreditNotePosResponseCreditNote.md)
 - [ModelCreditNotePosResponsePart](docs/Model/ModelCreditNotePosResponsePart.md)
 - [ModelCreditNotePosResponseSevClient](docs/Model/ModelCreditNotePosResponseSevClient.md)
 - [ModelCreditNotePosResponseUnity](docs/Model/ModelCreditNotePosResponseUnity.md)
 - [ModelCreditNotePosSevClient](docs/Model/ModelCreditNotePosSevClient.md)
 - [ModelCreditNotePosUnity](docs/Model/ModelCreditNotePosUnity.md)
 - [ModelCreditNoteResponse](docs/Model/ModelCreditNoteResponse.md)
 - [ModelCreditNoteResponseAddressCountry](docs/Model/ModelCreditNoteResponseAddressCountry.md)
 - [ModelCreditNoteResponseContact](docs/Model/ModelCreditNoteResponseContact.md)
 - [ModelCreditNoteResponseContactPerson](docs/Model/ModelCreditNoteResponseContactPerson.md)
 - [ModelCreditNoteResponseCreateUser](docs/Model/ModelCreditNoteResponseCreateUser.md)
 - [ModelCreditNoteResponseSevClient](docs/Model/ModelCreditNoteResponseSevClient.md)
 - [ModelCreditNoteResponseTaxSet](docs/Model/ModelCreditNoteResponseTaxSet.md)
 - [ModelCreditNoteSendByWithRender](docs/Model/ModelCreditNoteSendByWithRender.md)
 - [ModelCreditNoteSendByWithRenderParameters](docs/Model/ModelCreditNoteSendByWithRenderParameters.md)
 - [ModelCreditNoteSendByWithRenderValues](docs/Model/ModelCreditNoteSendByWithRenderValues.md)
 - [ModelCreditNoteSevClient](docs/Model/ModelCreditNoteSevClient.md)
 - [ModelCreditNoteTaxSet](docs/Model/ModelCreditNoteTaxSet.md)
 - [ModelCreditNoteUpdate](docs/Model/ModelCreditNoteUpdate.md)
 - [ModelCreditNoteUpdateContact](docs/Model/ModelCreditNoteUpdateContact.md)
 - [ModelCreditNoteUpdateContactPerson](docs/Model/ModelCreditNoteUpdateContactPerson.md)
 - [ModelDiscount](docs/Model/ModelDiscount.md)
 - [ModelDiscountObject](docs/Model/ModelDiscountObject.md)
 - [ModelDiscountsResponse](docs/Model/ModelDiscountsResponse.md)
 - [ModelEmail](docs/Model/ModelEmail.md)
 - [ModelEmailOrder](docs/Model/ModelEmailOrder.md)
 - [ModelEmailSevClient](docs/Model/ModelEmailSevClient.md)
 - [ModelInvoice](docs/Model/ModelInvoice.md)
 - [ModelInvoiceAddressCountry](docs/Model/ModelInvoiceAddressCountry.md)
 - [ModelInvoiceContact](docs/Model/ModelInvoiceContact.md)
 - [ModelInvoiceContactPerson](docs/Model/ModelInvoiceContactPerson.md)
 - [ModelInvoiceOrigin](docs/Model/ModelInvoiceOrigin.md)
 - [ModelInvoicePaymentMethod](docs/Model/ModelInvoicePaymentMethod.md)
 - [ModelInvoicePos](docs/Model/ModelInvoicePos.md)
 - [ModelInvoicePosInvoice](docs/Model/ModelInvoicePosInvoice.md)
 - [ModelInvoicePosResponse](docs/Model/ModelInvoicePosResponse.md)
 - [ModelInvoicePosResponseInvoice](docs/Model/ModelInvoicePosResponseInvoice.md)
 - [ModelInvoicePosResponsePart](docs/Model/ModelInvoicePosResponsePart.md)
 - [ModelInvoicePosResponseSevClient](docs/Model/ModelInvoicePosResponseSevClient.md)
 - [ModelInvoicePosResponseUnity](docs/Model/ModelInvoicePosResponseUnity.md)
 - [ModelInvoicePosSevClient](docs/Model/ModelInvoicePosSevClient.md)
 - [ModelInvoicePosUnity](docs/Model/ModelInvoicePosUnity.md)
 - [ModelInvoiceResponse](docs/Model/ModelInvoiceResponse.md)
 - [ModelInvoiceResponseAddressCountry](docs/Model/ModelInvoiceResponseAddressCountry.md)
 - [ModelInvoiceResponseContact](docs/Model/ModelInvoiceResponseContact.md)
 - [ModelInvoiceResponseContactPerson](docs/Model/ModelInvoiceResponseContactPerson.md)
 - [ModelInvoiceResponseCostCentre](docs/Model/ModelInvoiceResponseCostCentre.md)
 - [ModelInvoiceResponseOrigin](docs/Model/ModelInvoiceResponseOrigin.md)
 - [ModelInvoiceResponsePaymentMethod](docs/Model/ModelInvoiceResponsePaymentMethod.md)
 - [ModelInvoiceResponseTaxSet](docs/Model/ModelInvoiceResponseTaxSet.md)
 - [ModelInvoiceSevClient](docs/Model/ModelInvoiceSevClient.md)
 - [ModelInvoiceTaxSet](docs/Model/ModelInvoiceTaxSet.md)
 - [ModelOrder](docs/Model/ModelOrder.md)
 - [ModelOrderAddressCountry](docs/Model/ModelOrderAddressCountry.md)
 - [ModelOrderContact](docs/Model/ModelOrderContact.md)
 - [ModelOrderContactPerson](docs/Model/ModelOrderContactPerson.md)
 - [ModelOrderOrigin](docs/Model/ModelOrderOrigin.md)
 - [ModelOrderPos](docs/Model/ModelOrderPos.md)
 - [ModelOrderPosOrder](docs/Model/ModelOrderPosOrder.md)
 - [ModelOrderPosResponse](docs/Model/ModelOrderPosResponse.md)
 - [ModelOrderPosResponseOrder](docs/Model/ModelOrderPosResponseOrder.md)
 - [ModelOrderPosResponseSevClient](docs/Model/ModelOrderPosResponseSevClient.md)
 - [ModelOrderPosSevClient](docs/Model/ModelOrderPosSevClient.md)
 - [ModelOrderPosUpdate](docs/Model/ModelOrderPosUpdate.md)
 - [ModelOrderResponse](docs/Model/ModelOrderResponse.md)
 - [ModelOrderResponseAddressCountry](docs/Model/ModelOrderResponseAddressCountry.md)
 - [ModelOrderResponseContact](docs/Model/ModelOrderResponseContact.md)
 - [ModelOrderResponseContactPerson](docs/Model/ModelOrderResponseContactPerson.md)
 - [ModelOrderResponseOrigin](docs/Model/ModelOrderResponseOrigin.md)
 - [ModelOrderResponseSevClient](docs/Model/ModelOrderResponseSevClient.md)
 - [ModelOrderResponseTaxSet](docs/Model/ModelOrderResponseTaxSet.md)
 - [ModelOrderTaxSet](docs/Model/ModelOrderTaxSet.md)
 - [ModelOrderUpdate](docs/Model/ModelOrderUpdate.md)
 - [ModelOrderUpdateAddressCountry](docs/Model/ModelOrderUpdateAddressCountry.md)
 - [ModelOrderUpdateContact](docs/Model/ModelOrderUpdateContact.md)
 - [ModelOrderUpdateContactPerson](docs/Model/ModelOrderUpdateContactPerson.md)
 - [ModelOrderUpdateCreateUser](docs/Model/ModelOrderUpdateCreateUser.md)
 - [ModelOrderUpdateSevClient](docs/Model/ModelOrderUpdateSevClient.md)
 - [ModelOrderUpdateTaxSet](docs/Model/ModelOrderUpdateTaxSet.md)
 - [ModelPart](docs/Model/ModelPart.md)
 - [ModelPartCategory](docs/Model/ModelPartCategory.md)
 - [ModelPartSevClient](docs/Model/ModelPartSevClient.md)
 - [ModelPartUnity](docs/Model/ModelPartUnity.md)
 - [ModelPartUpdate](docs/Model/ModelPartUpdate.md)
 - [ModelTagCreateResponse](docs/Model/ModelTagCreateResponse.md)
 - [ModelTagCreateResponseTag](docs/Model/ModelTagCreateResponseTag.md)
 - [ModelTagResponse](docs/Model/ModelTagResponse.md)
 - [ModelTagResponseSevClient](docs/Model/ModelTagResponseSevClient.md)
 - [ModelTextparserFetchDictionaryEntriesByTypeResponse](docs/Model/ModelTextparserFetchDictionaryEntriesByTypeResponse.md)
 - [ModelTextparserFetchDictionaryEntriesByTypeResponseValue](docs/Model/ModelTextparserFetchDictionaryEntriesByTypeResponseValue.md)
 - [ModelVoucher](docs/Model/ModelVoucher.md)
 - [ModelVoucherCostCentre](docs/Model/ModelVoucherCostCentre.md)
 - [ModelVoucherCreateUser](docs/Model/ModelVoucherCreateUser.md)
 - [ModelVoucherDocument](docs/Model/ModelVoucherDocument.md)
 - [ModelVoucherPos](docs/Model/ModelVoucherPos.md)
 - [ModelVoucherPosAccountingType](docs/Model/ModelVoucherPosAccountingType.md)
 - [ModelVoucherPosEstimatedAccountingType](docs/Model/ModelVoucherPosEstimatedAccountingType.md)
 - [ModelVoucherPosResponse](docs/Model/ModelVoucherPosResponse.md)
 - [ModelVoucherPosResponseAccountingType](docs/Model/ModelVoucherPosResponseAccountingType.md)
 - [ModelVoucherPosResponseEstimatedAccountingType](docs/Model/ModelVoucherPosResponseEstimatedAccountingType.md)
 - [ModelVoucherPosResponseSevClient](docs/Model/ModelVoucherPosResponseSevClient.md)
 - [ModelVoucherPosResponseVoucher](docs/Model/ModelVoucherPosResponseVoucher.md)
 - [ModelVoucherPosSevClient](docs/Model/ModelVoucherPosSevClient.md)
 - [ModelVoucherPosVoucher](docs/Model/ModelVoucherPosVoucher.md)
 - [ModelVoucherResponse](docs/Model/ModelVoucherResponse.md)
 - [ModelVoucherResponseCostCentre](docs/Model/ModelVoucherResponseCostCentre.md)
 - [ModelVoucherResponseCreateUser](docs/Model/ModelVoucherResponseCreateUser.md)
 - [ModelVoucherResponseDocument](docs/Model/ModelVoucherResponseDocument.md)
 - [ModelVoucherResponseSevClient](docs/Model/ModelVoucherResponseSevClient.md)
 - [ModelVoucherResponseSupplier](docs/Model/ModelVoucherResponseSupplier.md)
 - [ModelVoucherResponseTaxSet](docs/Model/ModelVoucherResponseTaxSet.md)
 - [ModelVoucherSevClient](docs/Model/ModelVoucherSevClient.md)
 - [ModelVoucherSupplier](docs/Model/ModelVoucherSupplier.md)
 - [ModelVoucherTaxSet](docs/Model/ModelVoucherTaxSet.md)
 - [ModelVoucherUpdate](docs/Model/ModelVoucherUpdate.md)
 - [ModelVoucherUpdateSupplier](docs/Model/ModelVoucherUpdateSupplier.md)
 - [OrderIdSendByBody](docs/Model/OrderIdSendByBody.md)
 - [OrderIdSendViaEmailBody](docs/Model/OrderIdSendViaEmailBody.md)
 - [ReportorderlistFilter](docs/Model/ReportorderlistFilter.md)
 - [ReportorderlistFilterContact](docs/Model/ReportorderlistFilterContact.md)
 - [SaveCreditNote](docs/Model/SaveCreditNote.md)
 - [SaveCreditNoteCreditNotePosDelete](docs/Model/SaveCreditNoteCreditNotePosDelete.md)
 - [SaveCreditNoteDiscountDelete](docs/Model/SaveCreditNoteDiscountDelete.md)
 - [SaveCreditNoteDiscountSave](docs/Model/SaveCreditNoteDiscountSave.md)
 - [SaveCreditNoteResponse](docs/Model/SaveCreditNoteResponse.md)
 - [SaveInvoice](docs/Model/SaveInvoice.md)
 - [SaveInvoiceDiscountDelete](docs/Model/SaveInvoiceDiscountDelete.md)
 - [SaveInvoiceDiscountSave](docs/Model/SaveInvoiceDiscountSave.md)
 - [SaveInvoiceInvoicePosDelete](docs/Model/SaveInvoiceInvoicePosDelete.md)
 - [SaveInvoiceResponse](docs/Model/SaveInvoiceResponse.md)
 - [SaveOrder](docs/Model/SaveOrder.md)
 - [SaveOrderOrderPosDelete](docs/Model/SaveOrderOrderPosDelete.md)
 - [SaveOrderResponse](docs/Model/SaveOrderResponse.md)
 - [SaveVoucher](docs/Model/SaveVoucher.md)
 - [SaveVoucherResponse](docs/Model/SaveVoucherResponse.md)
 - [SaveVoucherVoucherPosDelete](docs/Model/SaveVoucherVoucherPosDelete.md)
 - [SevClientIdUpdateExportConfigBody](docs/Model/SevClientIdUpdateExportConfigBody.md)
 - [SevQuery](docs/Model/SevQuery.md)
 - [SevQuery1](docs/Model/SevQuery1.md)
 - [SevQuery10](docs/Model/SevQuery10.md)
 - [SevQuery2](docs/Model/SevQuery2.md)
 - [SevQuery3](docs/Model/SevQuery3.md)
 - [SevQuery4](docs/Model/SevQuery4.md)
 - [SevQuery5](docs/Model/SevQuery5.md)
 - [SevQuery6](docs/Model/SevQuery6.md)
 - [SevQuery7](docs/Model/SevQuery7.md)
 - [SevQuery8](docs/Model/SevQuery8.md)
 - [SevQuery9](docs/Model/SevQuery9.md)
 - [TagFactorycreateObject](docs/Model/TagFactorycreateObject.md)
 - [TagTagIdBody](docs/Model/TagTagIdBody.md)
 - [ValidationError](docs/Model/ValidationError.md)
 - [ValidationErrorError](docs/Model/ValidationErrorError.md)
 - [VoucherIdBookAmountBody](docs/Model/VoucherIdBookAmountBody.md)
 - [VouchervoucherIdbookAmountCheckAccountTransaction](docs/Model/VouchervoucherIdbookAmountCheckAccountTransaction.md)

## Documentation For Authorization


## api_key

- **Type**: API key
- **API key parameter name**: Authorization
- **Location**: HTTP header


## Author



