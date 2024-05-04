<?php
/**
 * ModelInvoiceResponse
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * sevDesk API
 *
 * <b>Contact:</b> To contact our support click  <a href='https://landing.sevdesk.de/service-support-center-technik'>here</a><br><br>   # General information  Welcome to our API!<br>  sevDesk offers you  the possibility of retrieving data using an interface, namely the sevDesk API, and making  changes without having to use the web UI. The sevDesk interface is a REST-Full API. All sevDesk  data and functions that are used in the web UI can also be controlled through the API.   # Cross-Origin Resource Sharing  This API features Cross-Origin Resource Sharing (CORS).<br>  It enables cross-domain communication from the browser.<br>  All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.    # Embedding resources  When retrieving resources by using this API, you might encounter nested resources in the resources you requested.<br>  For example, an invoice always contains a contact, of which you can see the ID and the object name.<br>  This API gives you the possibility to embed these resources completely into the resources you originally requested.<br>  Taking our invoice example, this would mean, that you would not only see the ID and object name of a contact, but rather the complete contact resource.    To embed resources, all you need to do is to add the query parameter 'embed' to your GET request.<br>  As values, you can provide the name of the nested resource.<br>  Multiple nested resources are also possible by providing multiple names, separated by a comma.    # Authentication and Authorization  The sevDesk API uses a token authentication to authorize calls. For this purpose every sevDesk administrator has one API token, which is a <b>hexadecimal string</b>  containing <b>32 characters</b>. The following clip shows where you can find the  API token if this is your first time with our API.<br><br> <video src='openAPI/img/findingTheApiToken.mp4' controls width='640' height='360'> Ihr Browser kann dieses Video nicht wiedergeben.<br/> Dieses Video zeigt wie sie Ihr sevDesk API Token finden. </video> <br> The token will be needed in every request that you want to send and needs to be attached to the request url as a <b>Query Parameter</b><br> or provided as a value of an <b>Authorization Header</b>.<br> For security reasons, we suggest putting the API Token in the Authorization Header and not in the query string.<br> However, in the request examples in this documentation, we will keep it in the query string, as it is easier for you to copy them and try them yourself.<br> The following url is an example that shows where your token needs to be placed as a query parameter.<br> In this case, we used some random API token. <ul> <li><span>ht</span>tps://my.sevdesk.de/api/v1/Contact?token=<span style='color:red'>b7794de0085f5cd00560f160f290af38</span></li> </ul> The next example shows the token in the Authorization Header. <ul> <li>\"Authorization\" :<span style='color:red'>\"b7794de0085f5cd00560f160f290af38\"</span></li> </ul> The api tokens have an infinite lifetime and, in other words, exist as long as the sevDesk user exists.<br> For this reason, the user should <b>NEVER</b> be deleted.<br> If really necessary, it is advisable to save the api token as we will <b>NOT</b> be able to retrieve it afterwards!<br> It is also possible to generate a new API token, for example, if you want to prevent the usage of your sevDesk account by other people who got your current API token.<br> To achieve this, you just need to click on the \"generate new\" symbol to the right of your token and confirm it with your password.  # API News  To never miss API news and updates again, subscribe to our <b>free API newsletter</b> and get all relevant  information to keep your sevDesk software running smoothly. To subscribe, simply click <a href = 'https://landing.sevdesk.de/api-newsletter'><b>here</b></a> and confirm the email address to which we may send all updates relevant to you.  # API Requests  In our case, REST API requests need to be build by combining the following components. <table> <tr> <th><b>Component</b></th> <th><b>Description</b></th> </tr> <tr> <td>HTTP-Methods</td> <td> <ul> <li>GET (retrieve a resource)</li> <li>POST (create a resource)</li> <li>PUT (update a resource)</li> <li>DELETE (delete a resource)</li> </ul> </td> </tr> <tr> <td>URL of the API</td> <td><span style='color: #2aa198'>ht</span><span style='color: #2aa198'>tps://my.sevdesk.de/api/v1</span></td> </tr> <tr> <td>URI of the resource</td> <td>The resource to query.<br>For example contacts in sevDesk:<br><br> <span style='color:red'>/Contact</span><br><br> Which will result in the following complete URL:<br><br> <span style='color: #2aa198'>ht</span><span style='color: #2aa198'>tps://my.sevdesk.de/api/v1</span><span style='color:red'>/Contact</span> </td> </tr> <tr> <td>Query parameters</td> <td>Are attached by using the connectives <b>?</b> and <b>&</b> in the URL.<br></td> </tr> <tr> <td>Request headers</td> <td>Typical request headers are for example:<br> <div> <br> <ul> <li>Content-type</li> <li>Authorization</li> <li>Accept-Encoding</li> <li>User-Agent</li> <li>X-Version: Used for resource versioning see information below</li> <li>...</li> </ul> </div> </td> </tr> <tr>  <td>Response headers</td> <td> Typical response headers are for example:<br><br> <div> <ul>  <li>Deprecation: If a resource is deprecated we return true or a timestamp since when</li> <li>...</li> </ul> </div> </td> </tr> <tr> <td>Request body</td> <td>Mostly required in POST and PUT requests.<br> Often the request body contains json, in our case, it also accepts url-encoded data. </td> </tr> </table><br> <span style='color:red'>Note</span>: please pass a meaningful entry at the header \"User-Agent\".  If the \"User-Agent\" is set meaningfully, we can offer better support in case of queries from customers.<br> An example how such a \"User-Agent\" can look like: \"Integration-name by abc\". <br><br> This is a sample request for retrieving existing contacts in sevDesk using curl:<br><br> <img src='openAPI/img/GETRequest.PNG' alt='Get Request' height='150'><br><br> As you can see, the request contains all the components mentioned above.<br> It's HTTP method is GET, it has a correct endpoint  (<span style='color: #2aa198'>ht</span><span style='color: #2aa198'>tps://my.sevdesk.de/api/v1</span><span style='color:red'>/Contact</span>), query parameters like <b>token</b> and additional <b>header</b> information!<br><br> <b>Query Parameters</b><br><br> As you might have seen in the sample request above, there are several other parameters besides \"token\", located in the url.<br> Those are mostly optional but prove to be very useful for a lot of requests as they can limit, extend, sort or filter the data you will get as a response.<br><br> These are the most used query parameter for the sevDesk API. <table> <tr> <th><b>Parameter</b></th> <th><b>Description</b></th> </tr> <tr> <td>embed</td> <td>Will extend some of the returned data.<br> A brief example can be found below.</td> </tr> <tr> <td>countAll</td> <td>\"countAll=true\" returns the number of items</td> </tr> </table> This is an example for the usage of the embed parameter.<br> The following first request will return all company contact entries in sevDesk up to a limit of 100 without any additional information and no offset.<br><br> <img src='openAPI/img/ContactQueryWithoutEmbed.PNG' width='900' height='850'><br><br> Now have a look at the category attribute located in the response.<br> Naturally, it just contains the id and the object name of the object but no further information.<br> We will now use the parameter embed with the value \"category\".<br><br> <img src='openAPI/img/ContactQueryWithEmbed.PNG' width='900' height='850'><br><br> As you can see, the category object is now extended and shows all the attributes and their corresponding values.<br><br> There are lot of other query parameters that can be used to filter the returned data for objects that match a certain pattern, however, those will not be mentioned here and instead can be found at the detail documentation of the most used API endpoints like contact, invoice or voucher.<br><br> <b>Pagination</b><br> <table> <tr> <th><b>Parameter</b></th> <th><b>Description</b></th> </tr> <tr> <td>limit</td> <td>Limits the number of entries that are returned.<br> Most useful in GET requests which will most likely deliver big sets of data like country or currency lists.<br> In this case, you can bypass the default limitation on returned entries by providing a high number. </td> </tr> <tr> <td>offset</td> <td>Specifies a certain offset for the data that will be returned.<br> As an example, you can specify \"offset=2\" if you want all entries except for the first two.</td> </tr> </table> Example: <ul><li><code>ht<span>tps://my.sevdesk.de/api/v1/Invoice?offset=20&limit=10<span></code></li></ul> <b>Request Headers</b><br><br> The HTTP request (response) headers allow the client as well as the server to pass additional information with the request.<br> They transfer the parameters and arguments which are important for transmitting data over HTTP.<br> Three headers which are useful / necessary when using the sevDesk API are \"Authorization, \"Accept\" and  \"Content-type\".<br> Underneath is a brief description of why and how they should be used.<br><br> <b>Authorization</b><br><br> Can be used if you want to provide your API token in the header instead of having it in the url. <ul> <li>Authorization:<span style='color:red'>yourApiToken</span></li> </ul> <b>Accept</b><br><br> Specifies the format of the response.<br> Required for operations with a response body. <ul> <li>Accept:application/<span style='color:red'>format</span> </li> </ul> In our case, <code><span style='color:red'>format</span></code> could be replaced with <code>json</code> or <code>xml</code><br><br> <b>Content-type</b><br><br> Specifies which format is used in the request.<br> Is required for operations with a request body. <ul> <li>Content-type:application/<span style='color:red'>format</span></li> </ul> In our case,<code><span style='color:red'>format</span></code>could be replaced with <code>json</code> or <code>x-www-form-urlencoded</code> <br><br><b>API Responses</b><br><br> HTTP status codes<br> When calling the sevDesk API it is very likely that you will get a HTTP status code in the response.<br> Some API calls will also return JSON response bodies which will contain information about the resource.<br> Each status code which is returned will either be a <b>success</b> code or an <b>error</b> code.<br><br> Success codes <table> <tr> <th><b>Status code</b></th> <th><b>Description</b></th> </tr> <tr> <td><code>200 OK</code></td> <td>The request was successful</td> </tr> <tr> <td><code>201 Created</code></td> <td>Most likely to be found in the response of a <b>POST</b> request.<br> This code indicates that the desired resource was successfully created.</td> </tr> </table> <br>Error codes <table> <tr> <th><b>Status code</b></th> <th><b>Description</b></th> </tr> <tr> <td><code>400 Bad request</code></td> <td>The request you sent is most likely syntactically incorrect.<br> You should check if the parameters in the request body or the url are correct.</td> </tr> <tr> <td><code>401 Unauthorized</code></td> <td>The authentication failed.<br> Most likely caused by a missing or wrong API token.</td> </tr> <tr> <td><code>403 Forbidden</code></td> <td>You do not have the permission the access the resource which is requested.</td> </tr> <tr> <td><code>404 Not found</code></td> <td>The resource you specified does not exist.</td> </tr> <tr> <td><code>500 Internal server error</code></td> <td>An internal server error has occurred.<br> Normally this means that something went wrong on our side.<br> However, sometimes this error will appear if we missed to catch an error which is normally a 400 status code! </td> </tr> </table> <br><br> <b>Resource Versioning</b> <br><br> We use resource versioning to handle breaking changes for our endpoints, these are rarely used and will be communicated before we remove older versions.<br> To call a different version we use a specific header <code>X-Version</code> that should be filled with the desired version.<br> <ul>  <li>If you do not specify any version we assume <code>default</code></li> <li>If you specify a version that does not exist or was removed, you will get an error with information which versions are available</li> </ul> <table> <tr> <th>X-Version</th> <th>Description</th> </tr> <tr> <td><code>default</code></td> <td>Should always reference the oldest version.<br> If a specific resource is updated with a new version, <br> then the default version stays the same until the old version is deleted</td> </tr> <tr> <td><code>1.0</code> ... <code>1.9</code></td> <td>Our incrementally version for each resource independent<br> <b>Important</b>: A resource can be available via <code>default</code> but not <code>1.0</code></td> </tr> </table>  # Your First Request  After reading the introduction to our API, you should now be able to make your first call.<br> For testing our API, we would always recommend to create a trial account for sevDesk to prevent unwanted changes to your main account.<br> A trial account will be in the highest tariff (materials management), so every sevDesk function can be tested! <br><br>To start testing we would recommend one of the following tools: <ul> <li><a href='https://www.getpostman.com/'>Postman</a></li> <li><a href='https://curl.haxx.se/download.html'>cURL</a></li> </ul> This example will illustrate your first request, which is creating a new Contact in sevDesk.<br> <ol> <li>Download <a href='https://www.getpostman.com/'><b>Postman</b></a> for your desired system and start the application</li> <li>Enter <span><b>ht</span>tps://my.sevdesk.de/api/v1/Contact</b> as the url</li> <li>Use the connective <b>?</b> to append <b>token=</b> to the end of the url, or create an authorization header. Insert your API token as the value</li> <li>For this test, select <b>POST</b> as the HTTP method</li> <li>Go to <b>Headers</b> and enter the key-value pair <b>Content-type</b> + <b>application/x-www-form-urlencoded</b><br> As an alternative, you can just go to <b>Body</b> and select <b>x-www-form-urlencoded</b></li> <li>Now go to <b>Body</b> (if you are not there yet) and enter the key-value pairs as shown in the following picture<br><br> <img src='openAPI/img/FirstRequestPostman.PNG' width='900'><br><br></li> <li>Click on <b>Send</b>. Your response should now look like this:<br><br> <img src='openAPI/img/FirstRequestResponse.PNG' width='900'></li> </ol> As you can see, a successful response in this case returns a JSON-formatted response body containing the contact you just created.<br> For keeping it simple, this was only a minimal example of creating a contact.<br> There are however numerous combinations of parameters that you can provide which add information to your contact.
 *
 * OpenAPI spec version: 2.0.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.47
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;
use \Swagger\Client\ObjectSerializer;

/**
 * ModelInvoiceResponse Class Doc Comment
 *
 * @category Class
 * @description Invoice model
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ModelInvoiceResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Model_InvoiceResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'string',
        'object_name' => 'string',
        'invoice_number' => 'string',
        'contact' => '\Swagger\Client\Model\ModelInvoiceResponseContact',
        'create' => '\DateTime',
        'update' => '\DateTime',
        'sev_client' => '\Swagger\Client\Model\ModelContactCustomFieldSettingResponseSevClient',
        'invoice_date' => 'string',
        'header' => 'string',
        'head_text' => 'string',
        'foot_text' => 'string',
        'time_to_pay' => 'string',
        'discount_time' => 'string',
        'discount' => 'string',
        'address_country' => '\Swagger\Client\Model\ModelInvoiceResponseAddressCountry',
        'pay_date' => '\DateTime',
        'create_user' => '\Swagger\Client\Model\ModelCreditNoteResponseCreateUser',
        'delivery_date' => '\DateTime',
        'status' => 'string',
        'small_settlement' => 'bool',
        'contact_person' => '\Swagger\Client\Model\ModelInvoiceResponseContactPerson',
        'tax_rate' => 'string',
        'tax_text' => 'string',
        'dunning_level' => 'string',
        'tax_type' => 'string',
        'payment_method' => '\Swagger\Client\Model\ModelInvoiceResponsePaymentMethod',
        'cost_centre' => '\Swagger\Client\Model\ModelInvoiceResponseCostCentre',
        'send_date' => '\DateTime',
        'origin' => '\Swagger\Client\Model\ModelInvoiceResponseOrigin',
        'invoice_type' => 'string',
        'account_intervall' => 'string',
        'account_next_invoice' => 'string',
        'reminder_total' => 'string',
        'reminder_debit' => 'string',
        'reminder_deadline' => '\DateTime',
        'reminder_charge' => 'string',
        'tax_set' => '\Swagger\Client\Model\ModelInvoiceResponseTaxSet',
        'address' => 'string',
        'currency' => 'string',
        'sum_net' => 'string',
        'sum_tax' => 'string',
        'sum_gross' => 'string',
        'sum_discounts' => 'string',
        'sum_net_foreign_currency' => 'string',
        'sum_tax_foreign_currency' => 'string',
        'sum_gross_foreign_currency' => 'string',
        'sum_discounts_foreign_currency' => 'string',
        'sum_net_accounting' => 'string',
        'sum_tax_accounting' => 'string',
        'sum_gross_accounting' => 'string',
        'paid_amount' => 'float',
        'customer_internal_note' => 'string',
        'show_net' => 'bool',
        'enshrined' => '\DateTime',
        'send_type' => 'string',
        'delivery_date_until' => 'string',
        'datev_connect_online' => 'object',
        'send_payment_received_notification_date' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => null,
        'object_name' => null,
        'invoice_number' => null,
        'contact' => null,
        'create' => 'date-time',
        'update' => 'date-time',
        'sev_client' => null,
        'invoice_date' => null,
        'header' => null,
        'head_text' => null,
        'foot_text' => null,
        'time_to_pay' => null,
        'discount_time' => null,
        'discount' => null,
        'address_country' => null,
        'pay_date' => 'date-time',
        'create_user' => null,
        'delivery_date' => 'date-time',
        'status' => null,
        'small_settlement' => null,
        'contact_person' => null,
        'tax_rate' => null,
        'tax_text' => null,
        'dunning_level' => null,
        'tax_type' => null,
        'payment_method' => null,
        'cost_centre' => null,
        'send_date' => 'date-time',
        'origin' => null,
        'invoice_type' => null,
        'account_intervall' => null,
        'account_next_invoice' => null,
        'reminder_total' => null,
        'reminder_debit' => null,
        'reminder_deadline' => 'date-time',
        'reminder_charge' => null,
        'tax_set' => null,
        'address' => null,
        'currency' => null,
        'sum_net' => null,
        'sum_tax' => null,
        'sum_gross' => null,
        'sum_discounts' => null,
        'sum_net_foreign_currency' => null,
        'sum_tax_foreign_currency' => null,
        'sum_gross_foreign_currency' => null,
        'sum_discounts_foreign_currency' => null,
        'sum_net_accounting' => null,
        'sum_tax_accounting' => null,
        'sum_gross_accounting' => null,
        'paid_amount' => 'float',
        'customer_internal_note' => null,
        'show_net' => null,
        'enshrined' => 'date-time',
        'send_type' => null,
        'delivery_date_until' => null,
        'datev_connect_online' => null,
        'send_payment_received_notification_date' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'object_name' => 'objectName',
        'invoice_number' => 'invoiceNumber',
        'contact' => 'contact',
        'create' => 'create',
        'update' => 'update',
        'sev_client' => 'sevClient',
        'invoice_date' => 'invoiceDate',
        'header' => 'header',
        'head_text' => 'headText',
        'foot_text' => 'footText',
        'time_to_pay' => 'timeToPay',
        'discount_time' => 'discountTime',
        'discount' => 'discount',
        'address_country' => 'addressCountry',
        'pay_date' => 'payDate',
        'create_user' => 'createUser',
        'delivery_date' => 'deliveryDate',
        'status' => 'status',
        'small_settlement' => 'smallSettlement',
        'contact_person' => 'contactPerson',
        'tax_rate' => 'taxRate',
        'tax_text' => 'taxText',
        'dunning_level' => 'dunningLevel',
        'tax_type' => 'taxType',
        'payment_method' => 'paymentMethod',
        'cost_centre' => 'costCentre',
        'send_date' => 'sendDate',
        'origin' => 'origin',
        'invoice_type' => 'invoiceType',
        'account_intervall' => 'accountIntervall',
        'account_next_invoice' => 'accountNextInvoice',
        'reminder_total' => 'reminderTotal',
        'reminder_debit' => 'reminderDebit',
        'reminder_deadline' => 'reminderDeadline',
        'reminder_charge' => 'reminderCharge',
        'tax_set' => 'taxSet',
        'address' => 'address',
        'currency' => 'currency',
        'sum_net' => 'sumNet',
        'sum_tax' => 'sumTax',
        'sum_gross' => 'sumGross',
        'sum_discounts' => 'sumDiscounts',
        'sum_net_foreign_currency' => 'sumNetForeignCurrency',
        'sum_tax_foreign_currency' => 'sumTaxForeignCurrency',
        'sum_gross_foreign_currency' => 'sumGrossForeignCurrency',
        'sum_discounts_foreign_currency' => 'sumDiscountsForeignCurrency',
        'sum_net_accounting' => 'sumNetAccounting',
        'sum_tax_accounting' => 'sumTaxAccounting',
        'sum_gross_accounting' => 'sumGrossAccounting',
        'paid_amount' => 'paidAmount',
        'customer_internal_note' => 'customerInternalNote',
        'show_net' => 'showNet',
        'enshrined' => 'enshrined',
        'send_type' => 'sendType',
        'delivery_date_until' => 'deliveryDateUntil',
        'datev_connect_online' => 'datevConnectOnline',
        'send_payment_received_notification_date' => 'sendPaymentReceivedNotificationDate'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'object_name' => 'setObjectName',
        'invoice_number' => 'setInvoiceNumber',
        'contact' => 'setContact',
        'create' => 'setCreate',
        'update' => 'setUpdate',
        'sev_client' => 'setSevClient',
        'invoice_date' => 'setInvoiceDate',
        'header' => 'setHeader',
        'head_text' => 'setHeadText',
        'foot_text' => 'setFootText',
        'time_to_pay' => 'setTimeToPay',
        'discount_time' => 'setDiscountTime',
        'discount' => 'setDiscount',
        'address_country' => 'setAddressCountry',
        'pay_date' => 'setPayDate',
        'create_user' => 'setCreateUser',
        'delivery_date' => 'setDeliveryDate',
        'status' => 'setStatus',
        'small_settlement' => 'setSmallSettlement',
        'contact_person' => 'setContactPerson',
        'tax_rate' => 'setTaxRate',
        'tax_text' => 'setTaxText',
        'dunning_level' => 'setDunningLevel',
        'tax_type' => 'setTaxType',
        'payment_method' => 'setPaymentMethod',
        'cost_centre' => 'setCostCentre',
        'send_date' => 'setSendDate',
        'origin' => 'setOrigin',
        'invoice_type' => 'setInvoiceType',
        'account_intervall' => 'setAccountIntervall',
        'account_next_invoice' => 'setAccountNextInvoice',
        'reminder_total' => 'setReminderTotal',
        'reminder_debit' => 'setReminderDebit',
        'reminder_deadline' => 'setReminderDeadline',
        'reminder_charge' => 'setReminderCharge',
        'tax_set' => 'setTaxSet',
        'address' => 'setAddress',
        'currency' => 'setCurrency',
        'sum_net' => 'setSumNet',
        'sum_tax' => 'setSumTax',
        'sum_gross' => 'setSumGross',
        'sum_discounts' => 'setSumDiscounts',
        'sum_net_foreign_currency' => 'setSumNetForeignCurrency',
        'sum_tax_foreign_currency' => 'setSumTaxForeignCurrency',
        'sum_gross_foreign_currency' => 'setSumGrossForeignCurrency',
        'sum_discounts_foreign_currency' => 'setSumDiscountsForeignCurrency',
        'sum_net_accounting' => 'setSumNetAccounting',
        'sum_tax_accounting' => 'setSumTaxAccounting',
        'sum_gross_accounting' => 'setSumGrossAccounting',
        'paid_amount' => 'setPaidAmount',
        'customer_internal_note' => 'setCustomerInternalNote',
        'show_net' => 'setShowNet',
        'enshrined' => 'setEnshrined',
        'send_type' => 'setSendType',
        'delivery_date_until' => 'setDeliveryDateUntil',
        'datev_connect_online' => 'setDatevConnectOnline',
        'send_payment_received_notification_date' => 'setSendPaymentReceivedNotificationDate'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'object_name' => 'getObjectName',
        'invoice_number' => 'getInvoiceNumber',
        'contact' => 'getContact',
        'create' => 'getCreate',
        'update' => 'getUpdate',
        'sev_client' => 'getSevClient',
        'invoice_date' => 'getInvoiceDate',
        'header' => 'getHeader',
        'head_text' => 'getHeadText',
        'foot_text' => 'getFootText',
        'time_to_pay' => 'getTimeToPay',
        'discount_time' => 'getDiscountTime',
        'discount' => 'getDiscount',
        'address_country' => 'getAddressCountry',
        'pay_date' => 'getPayDate',
        'create_user' => 'getCreateUser',
        'delivery_date' => 'getDeliveryDate',
        'status' => 'getStatus',
        'small_settlement' => 'getSmallSettlement',
        'contact_person' => 'getContactPerson',
        'tax_rate' => 'getTaxRate',
        'tax_text' => 'getTaxText',
        'dunning_level' => 'getDunningLevel',
        'tax_type' => 'getTaxType',
        'payment_method' => 'getPaymentMethod',
        'cost_centre' => 'getCostCentre',
        'send_date' => 'getSendDate',
        'origin' => 'getOrigin',
        'invoice_type' => 'getInvoiceType',
        'account_intervall' => 'getAccountIntervall',
        'account_next_invoice' => 'getAccountNextInvoice',
        'reminder_total' => 'getReminderTotal',
        'reminder_debit' => 'getReminderDebit',
        'reminder_deadline' => 'getReminderDeadline',
        'reminder_charge' => 'getReminderCharge',
        'tax_set' => 'getTaxSet',
        'address' => 'getAddress',
        'currency' => 'getCurrency',
        'sum_net' => 'getSumNet',
        'sum_tax' => 'getSumTax',
        'sum_gross' => 'getSumGross',
        'sum_discounts' => 'getSumDiscounts',
        'sum_net_foreign_currency' => 'getSumNetForeignCurrency',
        'sum_tax_foreign_currency' => 'getSumTaxForeignCurrency',
        'sum_gross_foreign_currency' => 'getSumGrossForeignCurrency',
        'sum_discounts_foreign_currency' => 'getSumDiscountsForeignCurrency',
        'sum_net_accounting' => 'getSumNetAccounting',
        'sum_tax_accounting' => 'getSumTaxAccounting',
        'sum_gross_accounting' => 'getSumGrossAccounting',
        'paid_amount' => 'getPaidAmount',
        'customer_internal_note' => 'getCustomerInternalNote',
        'show_net' => 'getShowNet',
        'enshrined' => 'getEnshrined',
        'send_type' => 'getSendType',
        'delivery_date_until' => 'getDeliveryDateUntil',
        'datev_connect_online' => 'getDatevConnectOnline',
        'send_payment_received_notification_date' => 'getSendPaymentReceivedNotificationDate'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    const STATUS__50 = '50';
    const STATUS__100 = '100';
    const STATUS__200 = '200';
    const STATUS__1000 = '1000';
    const TAX_TYPE__DEFAULT = 'default';
    const TAX_TYPE_EU = 'eu';
    const TAX_TYPE_NOTEU = 'noteu';
    const TAX_TYPE_CUSTOM = 'custom';
    const INVOICE_TYPE_RE = 'RE';
    const INVOICE_TYPE_WKR = 'WKR';
    const INVOICE_TYPE_SR = 'SR';
    const INVOICE_TYPE_MA = 'MA';
    const INVOICE_TYPE_TR = 'TR';
    const INVOICE_TYPE_ER = 'ER';
    const SEND_TYPE_VPR = 'VPR';
    const SEND_TYPE_VPDF = 'VPDF';
    const SEND_TYPE_VM = 'VM';
    const SEND_TYPE_VP = 'VP';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS__50,
            self::STATUS__100,
            self::STATUS__200,
            self::STATUS__1000,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTaxTypeAllowableValues()
    {
        return [
            self::TAX_TYPE__DEFAULT,
            self::TAX_TYPE_EU,
            self::TAX_TYPE_NOTEU,
            self::TAX_TYPE_CUSTOM,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceTypeAllowableValues()
    {
        return [
            self::INVOICE_TYPE_RE,
            self::INVOICE_TYPE_WKR,
            self::INVOICE_TYPE_SR,
            self::INVOICE_TYPE_MA,
            self::INVOICE_TYPE_TR,
            self::INVOICE_TYPE_ER,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSendTypeAllowableValues()
    {
        return [
            self::SEND_TYPE_VPR,
            self::SEND_TYPE_VPDF,
            self::SEND_TYPE_VM,
            self::SEND_TYPE_VP,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['object_name'] = isset($data['object_name']) ? $data['object_name'] : null;
        $this->container['invoice_number'] = isset($data['invoice_number']) ? $data['invoice_number'] : null;
        $this->container['contact'] = isset($data['contact']) ? $data['contact'] : null;
        $this->container['create'] = isset($data['create']) ? $data['create'] : null;
        $this->container['update'] = isset($data['update']) ? $data['update'] : null;
        $this->container['sev_client'] = isset($data['sev_client']) ? $data['sev_client'] : null;
        $this->container['invoice_date'] = isset($data['invoice_date']) ? $data['invoice_date'] : null;
        $this->container['header'] = isset($data['header']) ? $data['header'] : null;
        $this->container['head_text'] = isset($data['head_text']) ? $data['head_text'] : null;
        $this->container['foot_text'] = isset($data['foot_text']) ? $data['foot_text'] : null;
        $this->container['time_to_pay'] = isset($data['time_to_pay']) ? $data['time_to_pay'] : null;
        $this->container['discount_time'] = isset($data['discount_time']) ? $data['discount_time'] : null;
        $this->container['discount'] = isset($data['discount']) ? $data['discount'] : null;
        $this->container['address_country'] = isset($data['address_country']) ? $data['address_country'] : null;
        $this->container['pay_date'] = isset($data['pay_date']) ? $data['pay_date'] : null;
        $this->container['create_user'] = isset($data['create_user']) ? $data['create_user'] : null;
        $this->container['delivery_date'] = isset($data['delivery_date']) ? $data['delivery_date'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['small_settlement'] = isset($data['small_settlement']) ? $data['small_settlement'] : null;
        $this->container['contact_person'] = isset($data['contact_person']) ? $data['contact_person'] : null;
        $this->container['tax_rate'] = isset($data['tax_rate']) ? $data['tax_rate'] : null;
        $this->container['tax_text'] = isset($data['tax_text']) ? $data['tax_text'] : null;
        $this->container['dunning_level'] = isset($data['dunning_level']) ? $data['dunning_level'] : null;
        $this->container['tax_type'] = isset($data['tax_type']) ? $data['tax_type'] : null;
        $this->container['payment_method'] = isset($data['payment_method']) ? $data['payment_method'] : null;
        $this->container['cost_centre'] = isset($data['cost_centre']) ? $data['cost_centre'] : null;
        $this->container['send_date'] = isset($data['send_date']) ? $data['send_date'] : null;
        $this->container['origin'] = isset($data['origin']) ? $data['origin'] : null;
        $this->container['invoice_type'] = isset($data['invoice_type']) ? $data['invoice_type'] : null;
        $this->container['account_intervall'] = isset($data['account_intervall']) ? $data['account_intervall'] : null;
        $this->container['account_next_invoice'] = isset($data['account_next_invoice']) ? $data['account_next_invoice'] : null;
        $this->container['reminder_total'] = isset($data['reminder_total']) ? $data['reminder_total'] : null;
        $this->container['reminder_debit'] = isset($data['reminder_debit']) ? $data['reminder_debit'] : null;
        $this->container['reminder_deadline'] = isset($data['reminder_deadline']) ? $data['reminder_deadline'] : null;
        $this->container['reminder_charge'] = isset($data['reminder_charge']) ? $data['reminder_charge'] : null;
        $this->container['tax_set'] = isset($data['tax_set']) ? $data['tax_set'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['sum_net'] = isset($data['sum_net']) ? $data['sum_net'] : null;
        $this->container['sum_tax'] = isset($data['sum_tax']) ? $data['sum_tax'] : null;
        $this->container['sum_gross'] = isset($data['sum_gross']) ? $data['sum_gross'] : null;
        $this->container['sum_discounts'] = isset($data['sum_discounts']) ? $data['sum_discounts'] : null;
        $this->container['sum_net_foreign_currency'] = isset($data['sum_net_foreign_currency']) ? $data['sum_net_foreign_currency'] : null;
        $this->container['sum_tax_foreign_currency'] = isset($data['sum_tax_foreign_currency']) ? $data['sum_tax_foreign_currency'] : null;
        $this->container['sum_gross_foreign_currency'] = isset($data['sum_gross_foreign_currency']) ? $data['sum_gross_foreign_currency'] : null;
        $this->container['sum_discounts_foreign_currency'] = isset($data['sum_discounts_foreign_currency']) ? $data['sum_discounts_foreign_currency'] : null;
        $this->container['sum_net_accounting'] = isset($data['sum_net_accounting']) ? $data['sum_net_accounting'] : null;
        $this->container['sum_tax_accounting'] = isset($data['sum_tax_accounting']) ? $data['sum_tax_accounting'] : null;
        $this->container['sum_gross_accounting'] = isset($data['sum_gross_accounting']) ? $data['sum_gross_accounting'] : null;
        $this->container['paid_amount'] = isset($data['paid_amount']) ? $data['paid_amount'] : null;
        $this->container['customer_internal_note'] = isset($data['customer_internal_note']) ? $data['customer_internal_note'] : null;
        $this->container['show_net'] = isset($data['show_net']) ? $data['show_net'] : null;
        $this->container['enshrined'] = isset($data['enshrined']) ? $data['enshrined'] : null;
        $this->container['send_type'] = isset($data['send_type']) ? $data['send_type'] : null;
        $this->container['delivery_date_until'] = isset($data['delivery_date_until']) ? $data['delivery_date_until'] : null;
        $this->container['datev_connect_online'] = isset($data['datev_connect_online']) ? $data['datev_connect_online'] : null;
        $this->container['send_payment_received_notification_date'] = isset($data['send_payment_received_notification_date']) ? $data['send_payment_received_notification_date'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTaxTypeAllowableValues();
        if (!is_null($this->container['tax_type']) && !in_array($this->container['tax_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'tax_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($this->container['invoice_type']) && !in_array($this->container['invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoice_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSendTypeAllowableValues();
        if (!is_null($this->container['send_type']) && !in_array($this->container['send_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'send_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id The invoice id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets object_name
     *
     * @return string
     */
    public function getObjectName()
    {
        return $this->container['object_name'];
    }

    /**
     * Sets object_name
     *
     * @param string $object_name The invoice object name
     *
     * @return $this
     */
    public function setObjectName($object_name)
    {
        $this->container['object_name'] = $object_name;

        return $this;
    }

    /**
     * Gets invoice_number
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string $invoice_number The invoice number
     *
     * @return $this
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets contact
     *
     * @return \Swagger\Client\Model\ModelInvoiceResponseContact
     */
    public function getContact()
    {
        return $this->container['contact'];
    }

    /**
     * Sets contact
     *
     * @param \Swagger\Client\Model\ModelInvoiceResponseContact $contact contact
     *
     * @return $this
     */
    public function setContact($contact)
    {
        $this->container['contact'] = $contact;

        return $this;
    }

    /**
     * Gets create
     *
     * @return \DateTime
     */
    public function getCreate()
    {
        return $this->container['create'];
    }

    /**
     * Sets create
     *
     * @param \DateTime $create Date of invoice creation
     *
     * @return $this
     */
    public function setCreate($create)
    {
        $this->container['create'] = $create;

        return $this;
    }

    /**
     * Gets update
     *
     * @return \DateTime
     */
    public function getUpdate()
    {
        return $this->container['update'];
    }

    /**
     * Sets update
     *
     * @param \DateTime $update Date of last invoice update
     *
     * @return $this
     */
    public function setUpdate($update)
    {
        $this->container['update'] = $update;

        return $this;
    }

    /**
     * Gets sev_client
     *
     * @return \Swagger\Client\Model\ModelContactCustomFieldSettingResponseSevClient
     */
    public function getSevClient()
    {
        return $this->container['sev_client'];
    }

    /**
     * Sets sev_client
     *
     * @param \Swagger\Client\Model\ModelContactCustomFieldSettingResponseSevClient $sev_client sev_client
     *
     * @return $this
     */
    public function setSevClient($sev_client)
    {
        $this->container['sev_client'] = $sev_client;

        return $this;
    }

    /**
     * Gets invoice_date
     *
     * @return string
     */
    public function getInvoiceDate()
    {
        return $this->container['invoice_date'];
    }

    /**
     * Sets invoice_date
     *
     * @param string $invoice_date Needs to be provided as timestamp or dd.mm.yyyy  **Requirements:** * For final invoices (invoiceType = 'ER'), the invoiceDate must be later than or equal to the invoiceDate of related advance (invoiceType = 'AR') / partial (invoiceType = 'TR') invoices.</li>
     *
     * @return $this
     */
    public function setInvoiceDate($invoice_date)
    {
        $this->container['invoice_date'] = $invoice_date;

        return $this;
    }

    /**
     * Gets header
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->container['header'];
    }

    /**
     * Sets header
     *
     * @param string $header Normally consist of prefix plus the invoice number
     *
     * @return $this
     */
    public function setHeader($header)
    {
        $this->container['header'] = $header;

        return $this;
    }

    /**
     * Gets head_text
     *
     * @return string
     */
    public function getHeadText()
    {
        return $this->container['head_text'];
    }

    /**
     * Sets head_text
     *
     * @param string $head_text Certain html tags can be used here to format your text
     *
     * @return $this
     */
    public function setHeadText($head_text)
    {
        $this->container['head_text'] = $head_text;

        return $this;
    }

    /**
     * Gets foot_text
     *
     * @return string
     */
    public function getFootText()
    {
        return $this->container['foot_text'];
    }

    /**
     * Sets foot_text
     *
     * @param string $foot_text Certain html tags can be used here to format your text
     *
     * @return $this
     */
    public function setFootText($foot_text)
    {
        $this->container['foot_text'] = $foot_text;

        return $this;
    }

    /**
     * Gets time_to_pay
     *
     * @return string
     */
    public function getTimeToPay()
    {
        return $this->container['time_to_pay'];
    }

    /**
     * Sets time_to_pay
     *
     * @param string $time_to_pay The time the customer has to pay the invoice in days
     *
     * @return $this
     */
    public function setTimeToPay($time_to_pay)
    {
        $this->container['time_to_pay'] = $time_to_pay;

        return $this;
    }

    /**
     * Gets discount_time
     *
     * @return string
     */
    public function getDiscountTime()
    {
        return $this->container['discount_time'];
    }

    /**
     * Sets discount_time
     *
     * @param string $discount_time If a value other than zero is used for the discount attribute,      you need to specify the amount of days for which the discount is granted.
     *
     * @return $this
     */
    public function setDiscountTime($discount_time)
    {
        $this->container['discount_time'] = $discount_time;

        return $this;
    }

    /**
     * Gets discount
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->container['discount'];
    }

    /**
     * Sets discount
     *
     * @param string $discount If you want to give a discount, define the percentage here. Otherwise provide zero as value
     *
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->container['discount'] = $discount;

        return $this;
    }

    /**
     * Gets address_country
     *
     * @return \Swagger\Client\Model\ModelInvoiceResponseAddressCountry
     */
    public function getAddressCountry()
    {
        return $this->container['address_country'];
    }

    /**
     * Sets address_country
     *
     * @param \Swagger\Client\Model\ModelInvoiceResponseAddressCountry $address_country address_country
     *
     * @return $this
     */
    public function setAddressCountry($address_country)
    {
        $this->container['address_country'] = $address_country;

        return $this;
    }

    /**
     * Gets pay_date
     *
     * @return \DateTime
     */
    public function getPayDate()
    {
        return $this->container['pay_date'];
    }

    /**
     * Sets pay_date
     *
     * @param \DateTime $pay_date Needs to be timestamp or dd.mm.yyyy
     *
     * @return $this
     */
    public function setPayDate($pay_date)
    {
        $this->container['pay_date'] = $pay_date;

        return $this;
    }

    /**
     * Gets create_user
     *
     * @return \Swagger\Client\Model\ModelCreditNoteResponseCreateUser
     */
    public function getCreateUser()
    {
        return $this->container['create_user'];
    }

    /**
     * Sets create_user
     *
     * @param \Swagger\Client\Model\ModelCreditNoteResponseCreateUser $create_user create_user
     *
     * @return $this
     */
    public function setCreateUser($create_user)
    {
        $this->container['create_user'] = $create_user;

        return $this;
    }

    /**
     * Gets delivery_date
     *
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->container['delivery_date'];
    }

    /**
     * Sets delivery_date
     *
     * @param \DateTime $delivery_date Timestamp. This can also be a date range if you also use the attribute deliveryDateUntil
     *
     * @return $this
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->container['delivery_date'] = $delivery_date;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status Please have a look in our       <a href='https://api.sevdesk.de/#section/Types-and-status-of-invoices'>Types and status of invoices</a>       to see what the different status codes mean
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets small_settlement
     *
     * @return bool
     */
    public function getSmallSettlement()
    {
        return $this->container['small_settlement'];
    }

    /**
     * Sets small_settlement
     *
     * @param bool $small_settlement Defines if the client uses the small settlement scheme.      If yes, the invoice must not contain any vat
     *
     * @return $this
     */
    public function setSmallSettlement($small_settlement)
    {
        $this->container['small_settlement'] = $small_settlement;

        return $this;
    }

    /**
     * Gets contact_person
     *
     * @return \Swagger\Client\Model\ModelInvoiceResponseContactPerson
     */
    public function getContactPerson()
    {
        return $this->container['contact_person'];
    }

    /**
     * Sets contact_person
     *
     * @param \Swagger\Client\Model\ModelInvoiceResponseContactPerson $contact_person contact_person
     *
     * @return $this
     */
    public function setContactPerson($contact_person)
    {
        $this->container['contact_person'] = $contact_person;

        return $this;
    }

    /**
     * Gets tax_rate
     *
     * @return string
     */
    public function getTaxRate()
    {
        return $this->container['tax_rate'];
    }

    /**
     * Sets tax_rate
     *
     * @param string $tax_rate Is overwritten by invoice position tax rates
     *
     * @return $this
     */
    public function setTaxRate($tax_rate)
    {
        $this->container['tax_rate'] = $tax_rate;

        return $this;
    }

    /**
     * Gets tax_text
     *
     * @return string
     */
    public function getTaxText()
    {
        return $this->container['tax_text'];
    }

    /**
     * Sets tax_text
     *
     * @param string $tax_text A common tax text would be 'Umsatzsteuer 19%'
     *
     * @return $this
     */
    public function setTaxText($tax_text)
    {
        $this->container['tax_text'] = $tax_text;

        return $this;
    }

    /**
     * Gets dunning_level
     *
     * @return string
     */
    public function getDunningLevel()
    {
        return $this->container['dunning_level'];
    }

    /**
     * Sets dunning_level
     *
     * @param string $dunning_level Defines how many reminders have already been sent for the invoice.      Starts with 1 (Payment reminder) and should be incremented by one every time another reminder is sent.
     *
     * @return $this
     */
    public function setDunningLevel($dunning_level)
    {
        $this->container['dunning_level'] = $dunning_level;

        return $this;
    }

    /**
     * Gets tax_type
     *
     * @return string
     */
    public function getTaxType()
    {
        return $this->container['tax_type'];
    }

    /**
     * Sets tax_type
     *
     * @param string $tax_type Tax type of the invoice. There are four tax types: 1. default - Umsatzsteuer ausweisen 2. eu - Steuerfreie innergemeinschaftliche Lieferung (Europäische Union) 3. noteu - Steuerschuldnerschaft des Leistungsempfängers (außerhalb EU, z. B. Schweiz) 4. custom - Using custom tax set 5. ss - Not subject to VAT according to §19 1 UStG Tax rates are heavily connected to the tax type used.
     *
     * @return $this
     */
    public function setTaxType($tax_type)
    {
        $allowedValues = $this->getTaxTypeAllowableValues();
        if (!is_null($tax_type) && !in_array($tax_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'tax_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tax_type'] = $tax_type;

        return $this;
    }

    /**
     * Gets payment_method
     *
     * @return \Swagger\Client\Model\ModelInvoiceResponsePaymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->container['payment_method'];
    }

    /**
     * Sets payment_method
     *
     * @param \Swagger\Client\Model\ModelInvoiceResponsePaymentMethod $payment_method payment_method
     *
     * @return $this
     */
    public function setPaymentMethod($payment_method)
    {
        $this->container['payment_method'] = $payment_method;

        return $this;
    }

    /**
     * Gets cost_centre
     *
     * @return \Swagger\Client\Model\ModelInvoiceResponseCostCentre
     */
    public function getCostCentre()
    {
        return $this->container['cost_centre'];
    }

    /**
     * Sets cost_centre
     *
     * @param \Swagger\Client\Model\ModelInvoiceResponseCostCentre $cost_centre cost_centre
     *
     * @return $this
     */
    public function setCostCentre($cost_centre)
    {
        $this->container['cost_centre'] = $cost_centre;

        return $this;
    }

    /**
     * Gets send_date
     *
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->container['send_date'];
    }

    /**
     * Sets send_date
     *
     * @param \DateTime $send_date The date the invoice was sent to the customer
     *
     * @return $this
     */
    public function setSendDate($send_date)
    {
        $this->container['send_date'] = $send_date;

        return $this;
    }

    /**
     * Gets origin
     *
     * @return \Swagger\Client\Model\ModelInvoiceResponseOrigin
     */
    public function getOrigin()
    {
        return $this->container['origin'];
    }

    /**
     * Sets origin
     *
     * @param \Swagger\Client\Model\ModelInvoiceResponseOrigin $origin origin
     *
     * @return $this
     */
    public function setOrigin($origin)
    {
        $this->container['origin'] = $origin;

        return $this;
    }

    /**
     * Gets invoice_type
     *
     * @return string
     */
    public function getInvoiceType()
    {
        return $this->container['invoice_type'];
    }

    /**
     * Sets invoice_type
     *
     * @param string $invoice_type Type of the invoice. For more information on the different types, check       <a href='https://api.sevdesk.de/#section/Types-and-status-of-invoices'>this</a> section
     *
     * @return $this
     */
    public function setInvoiceType($invoice_type)
    {
        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($invoice_type) && !in_array($invoice_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoice_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_type'] = $invoice_type;

        return $this;
    }

    /**
     * Gets account_intervall
     *
     * @return string
     */
    public function getAccountIntervall()
    {
        return $this->container['account_intervall'];
    }

    /**
     * Sets account_intervall
     *
     * @param string $account_intervall The interval in which recurring invoices are due as ISO-8601 duration.<br>       Necessary attribute for all recurring invoices.
     *
     * @return $this
     */
    public function setAccountIntervall($account_intervall)
    {
        $this->container['account_intervall'] = $account_intervall;

        return $this;
    }

    /**
     * Gets account_next_invoice
     *
     * @return string
     */
    public function getAccountNextInvoice()
    {
        return $this->container['account_next_invoice'];
    }

    /**
     * Sets account_next_invoice
     *
     * @param string $account_next_invoice Timestamp when the next invoice will be generated by this recurring invoice.
     *
     * @return $this
     */
    public function setAccountNextInvoice($account_next_invoice)
    {
        $this->container['account_next_invoice'] = $account_next_invoice;

        return $this;
    }

    /**
     * Gets reminder_total
     *
     * @return string
     */
    public function getReminderTotal()
    {
        return $this->container['reminder_total'];
    }

    /**
     * Sets reminder_total
     *
     * @param string $reminder_total Total reminder amount
     *
     * @return $this
     */
    public function setReminderTotal($reminder_total)
    {
        $this->container['reminder_total'] = $reminder_total;

        return $this;
    }

    /**
     * Gets reminder_debit
     *
     * @return string
     */
    public function getReminderDebit()
    {
        return $this->container['reminder_debit'];
    }

    /**
     * Sets reminder_debit
     *
     * @param string $reminder_debit Debit of the reminder
     *
     * @return $this
     */
    public function setReminderDebit($reminder_debit)
    {
        $this->container['reminder_debit'] = $reminder_debit;

        return $this;
    }

    /**
     * Gets reminder_deadline
     *
     * @return \DateTime
     */
    public function getReminderDeadline()
    {
        return $this->container['reminder_deadline'];
    }

    /**
     * Sets reminder_deadline
     *
     * @param \DateTime $reminder_deadline Deadline of the reminder as timestamp
     *
     * @return $this
     */
    public function setReminderDeadline($reminder_deadline)
    {
        $this->container['reminder_deadline'] = $reminder_deadline;

        return $this;
    }

    /**
     * Gets reminder_charge
     *
     * @return string
     */
    public function getReminderCharge()
    {
        return $this->container['reminder_charge'];
    }

    /**
     * Sets reminder_charge
     *
     * @param string $reminder_charge The additional reminder charge
     *
     * @return $this
     */
    public function setReminderCharge($reminder_charge)
    {
        $this->container['reminder_charge'] = $reminder_charge;

        return $this;
    }

    /**
     * Gets tax_set
     *
     * @return \Swagger\Client\Model\ModelInvoiceResponseTaxSet
     */
    public function getTaxSet()
    {
        return $this->container['tax_set'];
    }

    /**
     * Sets tax_set
     *
     * @param \Swagger\Client\Model\ModelInvoiceResponseTaxSet $tax_set tax_set
     *
     * @return $this
     */
    public function setTaxSet($tax_set)
    {
        $this->container['tax_set'] = $tax_set;

        return $this;
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param string $address Complete address of the recipient including name, street, city, zip and country.       * Line breaks can be used and will be displayed on the invoice pdf.
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string $currency Currency used in the invoice. Needs to be currency code according to ISO-4217
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets sum_net
     *
     * @return string
     */
    public function getSumNet()
    {
        return $this->container['sum_net'];
    }

    /**
     * Sets sum_net
     *
     * @param string $sum_net Net sum of the invoice
     *
     * @return $this
     */
    public function setSumNet($sum_net)
    {
        $this->container['sum_net'] = $sum_net;

        return $this;
    }

    /**
     * Gets sum_tax
     *
     * @return string
     */
    public function getSumTax()
    {
        return $this->container['sum_tax'];
    }

    /**
     * Sets sum_tax
     *
     * @param string $sum_tax Tax sum of the invoice
     *
     * @return $this
     */
    public function setSumTax($sum_tax)
    {
        $this->container['sum_tax'] = $sum_tax;

        return $this;
    }

    /**
     * Gets sum_gross
     *
     * @return string
     */
    public function getSumGross()
    {
        return $this->container['sum_gross'];
    }

    /**
     * Sets sum_gross
     *
     * @param string $sum_gross Gross sum of the invoice
     *
     * @return $this
     */
    public function setSumGross($sum_gross)
    {
        $this->container['sum_gross'] = $sum_gross;

        return $this;
    }

    /**
     * Gets sum_discounts
     *
     * @return string
     */
    public function getSumDiscounts()
    {
        return $this->container['sum_discounts'];
    }

    /**
     * Sets sum_discounts
     *
     * @param string $sum_discounts Sum of all discounts in the invoice
     *
     * @return $this
     */
    public function setSumDiscounts($sum_discounts)
    {
        $this->container['sum_discounts'] = $sum_discounts;

        return $this;
    }

    /**
     * Gets sum_net_foreign_currency
     *
     * @return string
     */
    public function getSumNetForeignCurrency()
    {
        return $this->container['sum_net_foreign_currency'];
    }

    /**
     * Sets sum_net_foreign_currency
     *
     * @param string $sum_net_foreign_currency Net sum of the invoice in the foreign currency
     *
     * @return $this
     */
    public function setSumNetForeignCurrency($sum_net_foreign_currency)
    {
        $this->container['sum_net_foreign_currency'] = $sum_net_foreign_currency;

        return $this;
    }

    /**
     * Gets sum_tax_foreign_currency
     *
     * @return string
     */
    public function getSumTaxForeignCurrency()
    {
        return $this->container['sum_tax_foreign_currency'];
    }

    /**
     * Sets sum_tax_foreign_currency
     *
     * @param string $sum_tax_foreign_currency Tax sum of the invoice in the foreign currency
     *
     * @return $this
     */
    public function setSumTaxForeignCurrency($sum_tax_foreign_currency)
    {
        $this->container['sum_tax_foreign_currency'] = $sum_tax_foreign_currency;

        return $this;
    }

    /**
     * Gets sum_gross_foreign_currency
     *
     * @return string
     */
    public function getSumGrossForeignCurrency()
    {
        return $this->container['sum_gross_foreign_currency'];
    }

    /**
     * Sets sum_gross_foreign_currency
     *
     * @param string $sum_gross_foreign_currency Gross sum of the invoice in the foreign currency
     *
     * @return $this
     */
    public function setSumGrossForeignCurrency($sum_gross_foreign_currency)
    {
        $this->container['sum_gross_foreign_currency'] = $sum_gross_foreign_currency;

        return $this;
    }

    /**
     * Gets sum_discounts_foreign_currency
     *
     * @return string
     */
    public function getSumDiscountsForeignCurrency()
    {
        return $this->container['sum_discounts_foreign_currency'];
    }

    /**
     * Sets sum_discounts_foreign_currency
     *
     * @param string $sum_discounts_foreign_currency Discounts sum of the invoice in the foreign currency
     *
     * @return $this
     */
    public function setSumDiscountsForeignCurrency($sum_discounts_foreign_currency)
    {
        $this->container['sum_discounts_foreign_currency'] = $sum_discounts_foreign_currency;

        return $this;
    }

    /**
     * Gets sum_net_accounting
     *
     * @return string
     */
    public function getSumNetAccounting()
    {
        return $this->container['sum_net_accounting'];
    }

    /**
     * Sets sum_net_accounting
     *
     * @param string $sum_net_accounting Net accounting sum of the invoice. Is usually the same as sumNet
     *
     * @return $this
     */
    public function setSumNetAccounting($sum_net_accounting)
    {
        $this->container['sum_net_accounting'] = $sum_net_accounting;

        return $this;
    }

    /**
     * Gets sum_tax_accounting
     *
     * @return string
     */
    public function getSumTaxAccounting()
    {
        return $this->container['sum_tax_accounting'];
    }

    /**
     * Sets sum_tax_accounting
     *
     * @param string $sum_tax_accounting Tax accounting sum of the invoice. Is usually the same as sumTax
     *
     * @return $this
     */
    public function setSumTaxAccounting($sum_tax_accounting)
    {
        $this->container['sum_tax_accounting'] = $sum_tax_accounting;

        return $this;
    }

    /**
     * Gets sum_gross_accounting
     *
     * @return string
     */
    public function getSumGrossAccounting()
    {
        return $this->container['sum_gross_accounting'];
    }

    /**
     * Sets sum_gross_accounting
     *
     * @param string $sum_gross_accounting Gross accounting sum of the invoice. Is usually the same as sumGross
     *
     * @return $this
     */
    public function setSumGrossAccounting($sum_gross_accounting)
    {
        $this->container['sum_gross_accounting'] = $sum_gross_accounting;

        return $this;
    }

    /**
     * Gets paid_amount
     *
     * @return float
     */
    public function getPaidAmount()
    {
        return $this->container['paid_amount'];
    }

    /**
     * Sets paid_amount
     *
     * @param float $paid_amount Amount which has already been paid for this invoice by the customer
     *
     * @return $this
     */
    public function setPaidAmount($paid_amount)
    {
        $this->container['paid_amount'] = $paid_amount;

        return $this;
    }

    /**
     * Gets customer_internal_note
     *
     * @return string
     */
    public function getCustomerInternalNote()
    {
        return $this->container['customer_internal_note'];
    }

    /**
     * Sets customer_internal_note
     *
     * @param string $customer_internal_note Internal note of the customer. Contains data entered into field 'Referenz/Bestellnummer'
     *
     * @return $this
     */
    public function setCustomerInternalNote($customer_internal_note)
    {
        $this->container['customer_internal_note'] = $customer_internal_note;

        return $this;
    }

    /**
     * Gets show_net
     *
     * @return bool
     */
    public function getShowNet()
    {
        return $this->container['show_net'];
    }

    /**
     * Sets show_net
     *
     * @param bool $show_net If true, the net amount of each position will be shown on the invoice. Otherwise gross amount
     *
     * @return $this
     */
    public function setShowNet($show_net)
    {
        $this->container['show_net'] = $show_net;

        return $this;
    }

    /**
     * Gets enshrined
     *
     * @return \DateTime
     */
    public function getEnshrined()
    {
        return $this->container['enshrined'];
    }

    /**
     * Sets enshrined
     *
     * @param \DateTime $enshrined Defines if and when invoice was enshrined. Enshrined invoices can not be manipulated.
     *
     * @return $this
     */
    public function setEnshrined($enshrined)
    {
        $this->container['enshrined'] = $enshrined;

        return $this;
    }

    /**
     * Gets send_type
     *
     * @return string
     */
    public function getSendType()
    {
        return $this->container['send_type'];
    }

    /**
     * Sets send_type
     *
     * @param string $send_type Type which was used to send the invoice. IMPORTANT: Please refer to the invoice section of the       *     API-Overview to understand how this attribute can be used before using it!
     *
     * @return $this
     */
    public function setSendType($send_type)
    {
        $allowedValues = $this->getSendTypeAllowableValues();
        if (!is_null($send_type) && !in_array($send_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'send_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['send_type'] = $send_type;

        return $this;
    }

    /**
     * Gets delivery_date_until
     *
     * @return string
     */
    public function getDeliveryDateUntil()
    {
        return $this->container['delivery_date_until'];
    }

    /**
     * Sets delivery_date_until
     *
     * @param string $delivery_date_until If the delivery date should be a time range, another timestamp can be provided in this attribute       * to define a range from timestamp used in deliveryDate attribute to the timestamp used here.
     *
     * @return $this
     */
    public function setDeliveryDateUntil($delivery_date_until)
    {
        $this->container['delivery_date_until'] = $delivery_date_until;

        return $this;
    }

    /**
     * Gets datev_connect_online
     *
     * @return object
     */
    public function getDatevConnectOnline()
    {
        return $this->container['datev_connect_online'];
    }

    /**
     * Sets datev_connect_online
     *
     * @param object $datev_connect_online Internal attribute
     *
     * @return $this
     */
    public function setDatevConnectOnline($datev_connect_online)
    {
        $this->container['datev_connect_online'] = $datev_connect_online;

        return $this;
    }

    /**
     * Gets send_payment_received_notification_date
     *
     * @return string
     */
    public function getSendPaymentReceivedNotificationDate()
    {
        return $this->container['send_payment_received_notification_date'];
    }

    /**
     * Sets send_payment_received_notification_date
     *
     * @param string $send_payment_received_notification_date Internal attribute
     *
     * @return $this
     */
    public function setSendPaymentReceivedNotificationDate($send_payment_received_notification_date)
    {
        $this->container['send_payment_received_notification_date'] = $send_payment_received_notification_date;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
