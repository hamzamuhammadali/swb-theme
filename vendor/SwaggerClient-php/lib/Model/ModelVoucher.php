<?php
/**
 * ModelVoucher
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
 * ModelVoucher Class Doc Comment
 *
 * @category Class
 * @description Voucher model
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ModelVoucher implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Model_Voucher';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
        'object_name' => 'string',
        'map_all' => 'bool',
        'create' => '\DateTime',
        'update' => '\DateTime',
        'sev_client' => '\Swagger\Client\Model\ModelVoucherSevClient',
        'create_user' => '\Swagger\Client\Model\ModelVoucherCreateUser',
        'voucher_date' => '\DateTime',
        'supplier' => '\Swagger\Client\Model\ModelVoucherSupplier',
        'supplier_name' => 'string',
        'description' => 'string',
        'pay_date' => '\DateTime',
        'status' => 'float',
        'sum_net' => 'float',
        'sum_tax' => 'float',
        'sum_gross' => 'float',
        'sum_net_accounting' => 'float',
        'sum_tax_accounting' => 'float',
        'sum_gross_accounting' => 'float',
        'sum_discounts' => 'float',
        'sum_discounts_foreign_currency' => 'float',
        'paid_amount' => 'float',
        'tax_type' => 'string',
        'credit_debit' => 'string',
        'voucher_type' => 'string',
        'currency' => 'string',
        'property_foreign_currency_deadline' => '\DateTime',
        'property_exchange_rate' => 'float',
        'recurring_interval' => 'string',
        'recurring_start_date' => '\DateTime',
        'recurring_next_voucher' => '\DateTime',
        'recurring_last_voucher' => '\DateTime',
        'recurring_end_date' => '\DateTime',
        'enshrined' => '\DateTime',
        'tax_set' => '\Swagger\Client\Model\ModelVoucherTaxSet',
        'payment_deadline' => '\DateTime',
        'delivery_date' => '\DateTime',
        'delivery_date_until' => '\DateTime',
        'document' => '\Swagger\Client\Model\ModelVoucherDocument',
        'cost_centre' => '\Swagger\Client\Model\ModelVoucherCostCentre'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => null,
        'object_name' => null,
        'map_all' => null,
        'create' => 'date-time',
        'update' => 'date-time',
        'sev_client' => null,
        'create_user' => null,
        'voucher_date' => 'date-time',
        'supplier' => null,
        'supplier_name' => null,
        'description' => null,
        'pay_date' => 'date-time',
        'status' => null,
        'sum_net' => 'float',
        'sum_tax' => 'float',
        'sum_gross' => 'float',
        'sum_net_accounting' => 'float',
        'sum_tax_accounting' => 'float',
        'sum_gross_accounting' => 'float',
        'sum_discounts' => 'float',
        'sum_discounts_foreign_currency' => 'float',
        'paid_amount' => 'float',
        'tax_type' => null,
        'credit_debit' => null,
        'voucher_type' => null,
        'currency' => null,
        'property_foreign_currency_deadline' => 'date-time',
        'property_exchange_rate' => 'float',
        'recurring_interval' => null,
        'recurring_start_date' => 'date-time',
        'recurring_next_voucher' => 'date-time',
        'recurring_last_voucher' => 'date-time',
        'recurring_end_date' => 'date-time',
        'enshrined' => 'date-time',
        'tax_set' => null,
        'payment_deadline' => 'date-time',
        'delivery_date' => 'date-time',
        'delivery_date_until' => 'date-time',
        'document' => null,
        'cost_centre' => null
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
        'map_all' => 'mapAll',
        'create' => 'create',
        'update' => 'update',
        'sev_client' => 'sevClient',
        'create_user' => 'createUser',
        'voucher_date' => 'voucherDate',
        'supplier' => 'supplier',
        'supplier_name' => 'supplierName',
        'description' => 'description',
        'pay_date' => 'payDate',
        'status' => 'status',
        'sum_net' => 'sumNet',
        'sum_tax' => 'sumTax',
        'sum_gross' => 'sumGross',
        'sum_net_accounting' => 'sumNetAccounting',
        'sum_tax_accounting' => 'sumTaxAccounting',
        'sum_gross_accounting' => 'sumGrossAccounting',
        'sum_discounts' => 'sumDiscounts',
        'sum_discounts_foreign_currency' => 'sumDiscountsForeignCurrency',
        'paid_amount' => 'paidAmount',
        'tax_type' => 'taxType',
        'credit_debit' => 'creditDebit',
        'voucher_type' => 'voucherType',
        'currency' => 'currency',
        'property_foreign_currency_deadline' => 'propertyForeignCurrencyDeadline',
        'property_exchange_rate' => 'propertyExchangeRate',
        'recurring_interval' => 'recurringInterval',
        'recurring_start_date' => 'recurringStartDate',
        'recurring_next_voucher' => 'recurringNextVoucher',
        'recurring_last_voucher' => 'recurringLastVoucher',
        'recurring_end_date' => 'recurringEndDate',
        'enshrined' => 'enshrined',
        'tax_set' => 'taxSet',
        'payment_deadline' => 'paymentDeadline',
        'delivery_date' => 'deliveryDate',
        'delivery_date_until' => 'deliveryDateUntil',
        'document' => 'document',
        'cost_centre' => 'costCentre'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'object_name' => 'setObjectName',
        'map_all' => 'setMapAll',
        'create' => 'setCreate',
        'update' => 'setUpdate',
        'sev_client' => 'setSevClient',
        'create_user' => 'setCreateUser',
        'voucher_date' => 'setVoucherDate',
        'supplier' => 'setSupplier',
        'supplier_name' => 'setSupplierName',
        'description' => 'setDescription',
        'pay_date' => 'setPayDate',
        'status' => 'setStatus',
        'sum_net' => 'setSumNet',
        'sum_tax' => 'setSumTax',
        'sum_gross' => 'setSumGross',
        'sum_net_accounting' => 'setSumNetAccounting',
        'sum_tax_accounting' => 'setSumTaxAccounting',
        'sum_gross_accounting' => 'setSumGrossAccounting',
        'sum_discounts' => 'setSumDiscounts',
        'sum_discounts_foreign_currency' => 'setSumDiscountsForeignCurrency',
        'paid_amount' => 'setPaidAmount',
        'tax_type' => 'setTaxType',
        'credit_debit' => 'setCreditDebit',
        'voucher_type' => 'setVoucherType',
        'currency' => 'setCurrency',
        'property_foreign_currency_deadline' => 'setPropertyForeignCurrencyDeadline',
        'property_exchange_rate' => 'setPropertyExchangeRate',
        'recurring_interval' => 'setRecurringInterval',
        'recurring_start_date' => 'setRecurringStartDate',
        'recurring_next_voucher' => 'setRecurringNextVoucher',
        'recurring_last_voucher' => 'setRecurringLastVoucher',
        'recurring_end_date' => 'setRecurringEndDate',
        'enshrined' => 'setEnshrined',
        'tax_set' => 'setTaxSet',
        'payment_deadline' => 'setPaymentDeadline',
        'delivery_date' => 'setDeliveryDate',
        'delivery_date_until' => 'setDeliveryDateUntil',
        'document' => 'setDocument',
        'cost_centre' => 'setCostCentre'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'object_name' => 'getObjectName',
        'map_all' => 'getMapAll',
        'create' => 'getCreate',
        'update' => 'getUpdate',
        'sev_client' => 'getSevClient',
        'create_user' => 'getCreateUser',
        'voucher_date' => 'getVoucherDate',
        'supplier' => 'getSupplier',
        'supplier_name' => 'getSupplierName',
        'description' => 'getDescription',
        'pay_date' => 'getPayDate',
        'status' => 'getStatus',
        'sum_net' => 'getSumNet',
        'sum_tax' => 'getSumTax',
        'sum_gross' => 'getSumGross',
        'sum_net_accounting' => 'getSumNetAccounting',
        'sum_tax_accounting' => 'getSumTaxAccounting',
        'sum_gross_accounting' => 'getSumGrossAccounting',
        'sum_discounts' => 'getSumDiscounts',
        'sum_discounts_foreign_currency' => 'getSumDiscountsForeignCurrency',
        'paid_amount' => 'getPaidAmount',
        'tax_type' => 'getTaxType',
        'credit_debit' => 'getCreditDebit',
        'voucher_type' => 'getVoucherType',
        'currency' => 'getCurrency',
        'property_foreign_currency_deadline' => 'getPropertyForeignCurrencyDeadline',
        'property_exchange_rate' => 'getPropertyExchangeRate',
        'recurring_interval' => 'getRecurringInterval',
        'recurring_start_date' => 'getRecurringStartDate',
        'recurring_next_voucher' => 'getRecurringNextVoucher',
        'recurring_last_voucher' => 'getRecurringLastVoucher',
        'recurring_end_date' => 'getRecurringEndDate',
        'enshrined' => 'getEnshrined',
        'tax_set' => 'getTaxSet',
        'payment_deadline' => 'getPaymentDeadline',
        'delivery_date' => 'getDeliveryDate',
        'delivery_date_until' => 'getDeliveryDateUntil',
        'document' => 'getDocument',
        'cost_centre' => 'getCostCentre'
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

    const STATUS_50 = 50;
    const STATUS_100 = 100;
    const STATUS_1000 = 1000;
    const CREDIT_DEBIT_C = 'C';
    const CREDIT_DEBIT_D = 'D';
    const VOUCHER_TYPE_VOU = 'VOU';
    const VOUCHER_TYPE_RV = 'RV';
    const RECURRING_INTERVAL_P0_Y0_M1_W = 'P0Y0M1W';
    const RECURRING_INTERVAL_P0_Y0_M2_W = 'P0Y0M2W';
    const RECURRING_INTERVAL_P0_Y1_M0_W = 'P0Y1M0W';
    const RECURRING_INTERVAL_P0_Y3_M0_W = 'P0Y3M0W';
    const RECURRING_INTERVAL_P0_Y6_M0_W = 'P0Y6M0W';
    const RECURRING_INTERVAL_P1_Y0_M0_W = 'P1Y0M0W';
    const RECURRING_INTERVAL_P2_Y0_M0_W = 'P2Y0M0W';
    const RECURRING_INTERVAL_P3_Y0_M0_W = 'P3Y0M0W';
    const RECURRING_INTERVAL_P4_Y0_M0_W = 'P4Y0M0W';
    const RECURRING_INTERVAL_P5_Y0_M0_W = 'P5Y0M0W';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_50,
            self::STATUS_100,
            self::STATUS_1000,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCreditDebitAllowableValues()
    {
        return [
            self::CREDIT_DEBIT_C,
            self::CREDIT_DEBIT_D,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVoucherTypeAllowableValues()
    {
        return [
            self::VOUCHER_TYPE_VOU,
            self::VOUCHER_TYPE_RV,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRecurringIntervalAllowableValues()
    {
        return [
            self::RECURRING_INTERVAL_P0_Y0_M1_W,
            self::RECURRING_INTERVAL_P0_Y0_M2_W,
            self::RECURRING_INTERVAL_P0_Y1_M0_W,
            self::RECURRING_INTERVAL_P0_Y3_M0_W,
            self::RECURRING_INTERVAL_P0_Y6_M0_W,
            self::RECURRING_INTERVAL_P1_Y0_M0_W,
            self::RECURRING_INTERVAL_P2_Y0_M0_W,
            self::RECURRING_INTERVAL_P3_Y0_M0_W,
            self::RECURRING_INTERVAL_P4_Y0_M0_W,
            self::RECURRING_INTERVAL_P5_Y0_M0_W,
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
        $this->container['map_all'] = isset($data['map_all']) ? $data['map_all'] : null;
        $this->container['create'] = isset($data['create']) ? $data['create'] : null;
        $this->container['update'] = isset($data['update']) ? $data['update'] : null;
        $this->container['sev_client'] = isset($data['sev_client']) ? $data['sev_client'] : null;
        $this->container['create_user'] = isset($data['create_user']) ? $data['create_user'] : null;
        $this->container['voucher_date'] = isset($data['voucher_date']) ? $data['voucher_date'] : null;
        $this->container['supplier'] = isset($data['supplier']) ? $data['supplier'] : null;
        $this->container['supplier_name'] = isset($data['supplier_name']) ? $data['supplier_name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['pay_date'] = isset($data['pay_date']) ? $data['pay_date'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['sum_net'] = isset($data['sum_net']) ? $data['sum_net'] : null;
        $this->container['sum_tax'] = isset($data['sum_tax']) ? $data['sum_tax'] : null;
        $this->container['sum_gross'] = isset($data['sum_gross']) ? $data['sum_gross'] : null;
        $this->container['sum_net_accounting'] = isset($data['sum_net_accounting']) ? $data['sum_net_accounting'] : null;
        $this->container['sum_tax_accounting'] = isset($data['sum_tax_accounting']) ? $data['sum_tax_accounting'] : null;
        $this->container['sum_gross_accounting'] = isset($data['sum_gross_accounting']) ? $data['sum_gross_accounting'] : null;
        $this->container['sum_discounts'] = isset($data['sum_discounts']) ? $data['sum_discounts'] : null;
        $this->container['sum_discounts_foreign_currency'] = isset($data['sum_discounts_foreign_currency']) ? $data['sum_discounts_foreign_currency'] : null;
        $this->container['paid_amount'] = isset($data['paid_amount']) ? $data['paid_amount'] : null;
        $this->container['tax_type'] = isset($data['tax_type']) ? $data['tax_type'] : null;
        $this->container['credit_debit'] = isset($data['credit_debit']) ? $data['credit_debit'] : null;
        $this->container['voucher_type'] = isset($data['voucher_type']) ? $data['voucher_type'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['property_foreign_currency_deadline'] = isset($data['property_foreign_currency_deadline']) ? $data['property_foreign_currency_deadline'] : null;
        $this->container['property_exchange_rate'] = isset($data['property_exchange_rate']) ? $data['property_exchange_rate'] : null;
        $this->container['recurring_interval'] = isset($data['recurring_interval']) ? $data['recurring_interval'] : null;
        $this->container['recurring_start_date'] = isset($data['recurring_start_date']) ? $data['recurring_start_date'] : null;
        $this->container['recurring_next_voucher'] = isset($data['recurring_next_voucher']) ? $data['recurring_next_voucher'] : null;
        $this->container['recurring_last_voucher'] = isset($data['recurring_last_voucher']) ? $data['recurring_last_voucher'] : null;
        $this->container['recurring_end_date'] = isset($data['recurring_end_date']) ? $data['recurring_end_date'] : null;
        $this->container['enshrined'] = isset($data['enshrined']) ? $data['enshrined'] : null;
        $this->container['tax_set'] = isset($data['tax_set']) ? $data['tax_set'] : null;
        $this->container['payment_deadline'] = isset($data['payment_deadline']) ? $data['payment_deadline'] : null;
        $this->container['delivery_date'] = isset($data['delivery_date']) ? $data['delivery_date'] : null;
        $this->container['delivery_date_until'] = isset($data['delivery_date_until']) ? $data['delivery_date_until'] : null;
        $this->container['document'] = isset($data['document']) ? $data['document'] : null;
        $this->container['cost_centre'] = isset($data['cost_centre']) ? $data['cost_centre'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['object_name'] === null) {
            $invalidProperties[] = "'object_name' can't be null";
        }
        if ($this->container['map_all'] === null) {
            $invalidProperties[] = "'map_all' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['tax_type'] === null) {
            $invalidProperties[] = "'tax_type' can't be null";
        }
        if ($this->container['credit_debit'] === null) {
            $invalidProperties[] = "'credit_debit' can't be null";
        }
        $allowedValues = $this->getCreditDebitAllowableValues();
        if (!is_null($this->container['credit_debit']) && !in_array($this->container['credit_debit'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'credit_debit', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['voucher_type'] === null) {
            $invalidProperties[] = "'voucher_type' can't be null";
        }
        $allowedValues = $this->getVoucherTypeAllowableValues();
        if (!is_null($this->container['voucher_type']) && !in_array($this->container['voucher_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'voucher_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getRecurringIntervalAllowableValues();
        if (!is_null($this->container['recurring_interval']) && !in_array($this->container['recurring_interval'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'recurring_interval', must be one of '%s'",
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
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id The voucher id
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
     * @param string $object_name The voucher object name
     *
     * @return $this
     */
    public function setObjectName($object_name)
    {
        $this->container['object_name'] = $object_name;

        return $this;
    }

    /**
     * Gets map_all
     *
     * @return bool
     */
    public function getMapAll()
    {
        return $this->container['map_all'];
    }

    /**
     * Sets map_all
     *
     * @param bool $map_all map_all
     *
     * @return $this
     */
    public function setMapAll($map_all)
    {
        $this->container['map_all'] = $map_all;

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
     * @param \DateTime $create Date of voucher creation
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
     * @param \DateTime $update Date of last voucher update
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
     * @return \Swagger\Client\Model\ModelVoucherSevClient
     */
    public function getSevClient()
    {
        return $this->container['sev_client'];
    }

    /**
     * Sets sev_client
     *
     * @param \Swagger\Client\Model\ModelVoucherSevClient $sev_client sev_client
     *
     * @return $this
     */
    public function setSevClient($sev_client)
    {
        $this->container['sev_client'] = $sev_client;

        return $this;
    }

    /**
     * Gets create_user
     *
     * @return \Swagger\Client\Model\ModelVoucherCreateUser
     */
    public function getCreateUser()
    {
        return $this->container['create_user'];
    }

    /**
     * Sets create_user
     *
     * @param \Swagger\Client\Model\ModelVoucherCreateUser $create_user create_user
     *
     * @return $this
     */
    public function setCreateUser($create_user)
    {
        $this->container['create_user'] = $create_user;

        return $this;
    }

    /**
     * Gets voucher_date
     *
     * @return \DateTime
     */
    public function getVoucherDate()
    {
        return $this->container['voucher_date'];
    }

    /**
     * Sets voucher_date
     *
     * @param \DateTime $voucher_date Needs to be provided as timestamp or dd.mm.yyyy
     *
     * @return $this
     */
    public function setVoucherDate($voucher_date)
    {
        $this->container['voucher_date'] = $voucher_date;

        return $this;
    }

    /**
     * Gets supplier
     *
     * @return \Swagger\Client\Model\ModelVoucherSupplier
     */
    public function getSupplier()
    {
        return $this->container['supplier'];
    }

    /**
     * Sets supplier
     *
     * @param \Swagger\Client\Model\ModelVoucherSupplier $supplier supplier
     *
     * @return $this
     */
    public function setSupplier($supplier)
    {
        $this->container['supplier'] = $supplier;

        return $this;
    }

    /**
     * Gets supplier_name
     *
     * @return string
     */
    public function getSupplierName()
    {
        return $this->container['supplier_name'];
    }

    /**
     * Sets supplier_name
     *
     * @param string $supplier_name The supplier name.<br>       The value you provide here will determine what supplier name is shown for the voucher in case you did not provide a supplier.
     *
     * @return $this
     */
    public function setSupplierName($supplier_name)
    {
        $this->container['supplier_name'] = $supplier_name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description The description of the voucher. Essentially the voucher number.
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

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
     * Gets status
     *
     * @return float
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param float $status Please have a look in       <a href='https://api.sevdesk.de/#section/Types-and-status-of-vouchers'>status of vouchers</a>      to see what the different status codes mean
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
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
     * Gets sum_net
     *
     * @return float
     */
    public function getSumNet()
    {
        return $this->container['sum_net'];
    }

    /**
     * Sets sum_net
     *
     * @param float $sum_net Net sum of the voucher
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
     * @return float
     */
    public function getSumTax()
    {
        return $this->container['sum_tax'];
    }

    /**
     * Sets sum_tax
     *
     * @param float $sum_tax Tax sum of the voucher
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
     * @return float
     */
    public function getSumGross()
    {
        return $this->container['sum_gross'];
    }

    /**
     * Sets sum_gross
     *
     * @param float $sum_gross Gross sum of the voucher
     *
     * @return $this
     */
    public function setSumGross($sum_gross)
    {
        $this->container['sum_gross'] = $sum_gross;

        return $this;
    }

    /**
     * Gets sum_net_accounting
     *
     * @return float
     */
    public function getSumNetAccounting()
    {
        return $this->container['sum_net_accounting'];
    }

    /**
     * Sets sum_net_accounting
     *
     * @param float $sum_net_accounting Net accounting sum of the voucher. Is usually the same as sumNet
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
     * @return float
     */
    public function getSumTaxAccounting()
    {
        return $this->container['sum_tax_accounting'];
    }

    /**
     * Sets sum_tax_accounting
     *
     * @param float $sum_tax_accounting Tax accounting sum of the voucher. Is usually the same as sumTax
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
     * @return float
     */
    public function getSumGrossAccounting()
    {
        return $this->container['sum_gross_accounting'];
    }

    /**
     * Sets sum_gross_accounting
     *
     * @param float $sum_gross_accounting Gross accounting sum of the voucher. Is usually the same as sumGross
     *
     * @return $this
     */
    public function setSumGrossAccounting($sum_gross_accounting)
    {
        $this->container['sum_gross_accounting'] = $sum_gross_accounting;

        return $this;
    }

    /**
     * Gets sum_discounts
     *
     * @return float
     */
    public function getSumDiscounts()
    {
        return $this->container['sum_discounts'];
    }

    /**
     * Sets sum_discounts
     *
     * @param float $sum_discounts Sum of all discounts in the voucher
     *
     * @return $this
     */
    public function setSumDiscounts($sum_discounts)
    {
        $this->container['sum_discounts'] = $sum_discounts;

        return $this;
    }

    /**
     * Gets sum_discounts_foreign_currency
     *
     * @return float
     */
    public function getSumDiscountsForeignCurrency()
    {
        return $this->container['sum_discounts_foreign_currency'];
    }

    /**
     * Sets sum_discounts_foreign_currency
     *
     * @param float $sum_discounts_foreign_currency Discounts sum of the voucher in the foreign currency
     *
     * @return $this
     */
    public function setSumDiscountsForeignCurrency($sum_discounts_foreign_currency)
    {
        $this->container['sum_discounts_foreign_currency'] = $sum_discounts_foreign_currency;

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
     * @param float $paid_amount Amount which has already been paid for this voucher by the customer
     *
     * @return $this
     */
    public function setPaidAmount($paid_amount)
    {
        $this->container['paid_amount'] = $paid_amount;

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
     * @param string $tax_type Tax type of the voucher. There are four tax types: 1. default - Umsatzsteuer ausweisen 2. eu - Steuerfreie innergemeinschaftliche Lieferung (Europäische Union) 3. noteu - Steuerschuldnerschaft des Leistungsempfängers (außerhalb EU, z. B. Schweiz) 4. custom - Using custom tax set 5. ss - Not subject to VAT according to §19 1 UStG Tax rates are heavily connected to the tax type used.
     *
     * @return $this
     */
    public function setTaxType($tax_type)
    {
        $this->container['tax_type'] = $tax_type;

        return $this;
    }

    /**
     * Gets credit_debit
     *
     * @return string
     */
    public function getCreditDebit()
    {
        return $this->container['credit_debit'];
    }

    /**
     * Sets credit_debit
     *
     * @param string $credit_debit Defines if your voucher is a credit (C) or debit (D)
     *
     * @return $this
     */
    public function setCreditDebit($credit_debit)
    {
        $allowedValues = $this->getCreditDebitAllowableValues();
        if (!in_array($credit_debit, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'credit_debit', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['credit_debit'] = $credit_debit;

        return $this;
    }

    /**
     * Gets voucher_type
     *
     * @return string
     */
    public function getVoucherType()
    {
        return $this->container['voucher_type'];
    }

    /**
     * Sets voucher_type
     *
     * @param string $voucher_type Type of the voucher. For more information on the different types, check       <a href='https://api.sevdesk.de/#section/Types-and-status-of-vouchers'>this</a>
     *
     * @return $this
     */
    public function setVoucherType($voucher_type)
    {
        $allowedValues = $this->getVoucherTypeAllowableValues();
        if (!in_array($voucher_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'voucher_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['voucher_type'] = $voucher_type;

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
     * @param string $currency specifies which currency the voucher should have. Attention: If the currency differs from the default currency stored in the account, then either the \"propertyForeignCurrencyDeadline\" or \"propertyExchangeRate\" parameter must be specified. If both parameters are specified, then the \"propertyForeignCurrencyDeadline\" parameter is preferred
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets property_foreign_currency_deadline
     *
     * @return \DateTime
     */
    public function getPropertyForeignCurrencyDeadline()
    {
        return $this->container['property_foreign_currency_deadline'];
    }

    /**
     * Sets property_foreign_currency_deadline
     *
     * @param \DateTime $property_foreign_currency_deadline Defines the exchange rate day and and then the exchange rate is set from sevDesk. Needs to be provided as timestamp or dd.mm.yyyy
     *
     * @return $this
     */
    public function setPropertyForeignCurrencyDeadline($property_foreign_currency_deadline)
    {
        $this->container['property_foreign_currency_deadline'] = $property_foreign_currency_deadline;

        return $this;
    }

    /**
     * Gets property_exchange_rate
     *
     * @return float
     */
    public function getPropertyExchangeRate()
    {
        return $this->container['property_exchange_rate'];
    }

    /**
     * Sets property_exchange_rate
     *
     * @param float $property_exchange_rate Defines the exchange rate
     *
     * @return $this
     */
    public function setPropertyExchangeRate($property_exchange_rate)
    {
        $this->container['property_exchange_rate'] = $property_exchange_rate;

        return $this;
    }

    /**
     * Gets recurring_interval
     *
     * @return string
     */
    public function getRecurringInterval()
    {
        return $this->container['recurring_interval'];
    }

    /**
     * Sets recurring_interval
     *
     * @param string $recurring_interval The DateInterval in which recurring vouchers are generated.<br>       Necessary attribute for all recurring vouchers.
     *
     * @return $this
     */
    public function setRecurringInterval($recurring_interval)
    {
        $allowedValues = $this->getRecurringIntervalAllowableValues();
        if (!is_null($recurring_interval) && !in_array($recurring_interval, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'recurring_interval', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['recurring_interval'] = $recurring_interval;

        return $this;
    }

    /**
     * Gets recurring_start_date
     *
     * @return \DateTime
     */
    public function getRecurringStartDate()
    {
        return $this->container['recurring_start_date'];
    }

    /**
     * Sets recurring_start_date
     *
     * @param \DateTime $recurring_start_date The date when the recurring vouchers start being generated.<br>       Necessary attribute for all recurring vouchers.
     *
     * @return $this
     */
    public function setRecurringStartDate($recurring_start_date)
    {
        $this->container['recurring_start_date'] = $recurring_start_date;

        return $this;
    }

    /**
     * Gets recurring_next_voucher
     *
     * @return \DateTime
     */
    public function getRecurringNextVoucher()
    {
        return $this->container['recurring_next_voucher'];
    }

    /**
     * Sets recurring_next_voucher
     *
     * @param \DateTime $recurring_next_voucher The date when the next voucher should be generated.<br>       Necessary attribute for all recurring vouchers.
     *
     * @return $this
     */
    public function setRecurringNextVoucher($recurring_next_voucher)
    {
        $this->container['recurring_next_voucher'] = $recurring_next_voucher;

        return $this;
    }

    /**
     * Gets recurring_last_voucher
     *
     * @return \DateTime
     */
    public function getRecurringLastVoucher()
    {
        return $this->container['recurring_last_voucher'];
    }

    /**
     * Sets recurring_last_voucher
     *
     * @param \DateTime $recurring_last_voucher The date when the last voucher was generated.
     *
     * @return $this
     */
    public function setRecurringLastVoucher($recurring_last_voucher)
    {
        $this->container['recurring_last_voucher'] = $recurring_last_voucher;

        return $this;
    }

    /**
     * Gets recurring_end_date
     *
     * @return \DateTime
     */
    public function getRecurringEndDate()
    {
        return $this->container['recurring_end_date'];
    }

    /**
     * Sets recurring_end_date
     *
     * @param \DateTime $recurring_end_date The date when the recurring vouchers end being generated.<br>      Necessary attribute for all recurring vouchers.
     *
     * @return $this
     */
    public function setRecurringEndDate($recurring_end_date)
    {
        $this->container['recurring_end_date'] = $recurring_end_date;

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
     * @param \DateTime $enshrined Defines if and when voucher was enshrined. Enshrined vouchers can not be manipulated.
     *
     * @return $this
     */
    public function setEnshrined($enshrined)
    {
        $this->container['enshrined'] = $enshrined;

        return $this;
    }

    /**
     * Gets tax_set
     *
     * @return \Swagger\Client\Model\ModelVoucherTaxSet
     */
    public function getTaxSet()
    {
        return $this->container['tax_set'];
    }

    /**
     * Sets tax_set
     *
     * @param \Swagger\Client\Model\ModelVoucherTaxSet $tax_set tax_set
     *
     * @return $this
     */
    public function setTaxSet($tax_set)
    {
        $this->container['tax_set'] = $tax_set;

        return $this;
    }

    /**
     * Gets payment_deadline
     *
     * @return \DateTime
     */
    public function getPaymentDeadline()
    {
        return $this->container['payment_deadline'];
    }

    /**
     * Sets payment_deadline
     *
     * @param \DateTime $payment_deadline Payment deadline of the voucher.
     *
     * @return $this
     */
    public function setPaymentDeadline($payment_deadline)
    {
        $this->container['payment_deadline'] = $payment_deadline;

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
     * @param \DateTime $delivery_date Needs to be provided as timestamp or dd.mm.yyyy
     *
     * @return $this
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->container['delivery_date'] = $delivery_date;

        return $this;
    }

    /**
     * Gets delivery_date_until
     *
     * @return \DateTime
     */
    public function getDeliveryDateUntil()
    {
        return $this->container['delivery_date_until'];
    }

    /**
     * Sets delivery_date_until
     *
     * @param \DateTime $delivery_date_until Needs to be provided as timestamp or dd.mm.yyyy
     *
     * @return $this
     */
    public function setDeliveryDateUntil($delivery_date_until)
    {
        $this->container['delivery_date_until'] = $delivery_date_until;

        return $this;
    }

    /**
     * Gets document
     *
     * @return \Swagger\Client\Model\ModelVoucherDocument
     */
    public function getDocument()
    {
        return $this->container['document'];
    }

    /**
     * Sets document
     *
     * @param \Swagger\Client\Model\ModelVoucherDocument $document document
     *
     * @return $this
     */
    public function setDocument($document)
    {
        $this->container['document'] = $document;

        return $this;
    }

    /**
     * Gets cost_centre
     *
     * @return \Swagger\Client\Model\ModelVoucherCostCentre
     */
    public function getCostCentre()
    {
        return $this->container['cost_centre'];
    }

    /**
     * Sets cost_centre
     *
     * @param \Swagger\Client\Model\ModelVoucherCostCentre $cost_centre cost_centre
     *
     * @return $this
     */
    public function setCostCentre($cost_centre)
    {
        $this->container['cost_centre'] = $cost_centre;

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
