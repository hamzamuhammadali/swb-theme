<?php
/**
 * ModelContactResponse
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
 * ModelContactResponse Class Doc Comment
 *
 * @category Class
 * @description Contact model
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ModelContactResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Model_ContactResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'string',
        'object_name' => 'string',
        'create' => '\DateTime',
        'update' => '\DateTime',
        'name' => 'string',
        'status' => 'string',
        'customer_number' => 'string',
        'parent' => '\Swagger\Client\Model\ModelContactResponseParent',
        'surename' => 'string',
        'familyname' => 'string',
        'titel' => 'string',
        'category' => '\Swagger\Client\Model\ModelContactResponseCategory',
        'description' => 'string',
        'academic_title' => 'string',
        'gender' => 'string',
        'sev_client' => '\Swagger\Client\Model\ModelContactResponseSevClient',
        'name2' => 'string',
        'birthday' => '\DateTime',
        'vat_number' => 'string',
        'bank_account' => 'string',
        'bank_number' => 'string',
        'default_cashback_time' => 'string',
        'default_cashback_percent' => 'string',
        'default_time_to_pay' => 'string',
        'tax_number' => 'string',
        'tax_office' => 'string',
        'exempt_vat' => 'string',
        'tax_type' => 'string',
        'tax_set' => '\Swagger\Client\Model\ModelContactResponseTaxSet',
        'default_discount_amount' => 'string',
        'default_discount_percentage' => 'string',
        'buyer_reference' => 'string',
        'government_agency' => 'string',
        'additional_information' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => null,
        'object_name' => null,
        'create' => 'date-time',
        'update' => 'date-time',
        'name' => null,
        'status' => null,
        'customer_number' => null,
        'parent' => null,
        'surename' => null,
        'familyname' => null,
        'titel' => null,
        'category' => null,
        'description' => null,
        'academic_title' => null,
        'gender' => null,
        'sev_client' => null,
        'name2' => null,
        'birthday' => 'date',
        'vat_number' => null,
        'bank_account' => null,
        'bank_number' => null,
        'default_cashback_time' => null,
        'default_cashback_percent' => 'float',
        'default_time_to_pay' => null,
        'tax_number' => null,
        'tax_office' => null,
        'exempt_vat' => null,
        'tax_type' => null,
        'tax_set' => null,
        'default_discount_amount' => 'float',
        'default_discount_percentage' => null,
        'buyer_reference' => null,
        'government_agency' => null,
        'additional_information' => null
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
        'create' => 'create',
        'update' => 'update',
        'name' => 'name',
        'status' => 'status',
        'customer_number' => 'customerNumber',
        'parent' => 'parent',
        'surename' => 'surename',
        'familyname' => 'familyname',
        'titel' => 'titel',
        'category' => 'category',
        'description' => 'description',
        'academic_title' => 'academicTitle',
        'gender' => 'gender',
        'sev_client' => 'sevClient',
        'name2' => 'name2',
        'birthday' => 'birthday',
        'vat_number' => 'vatNumber',
        'bank_account' => 'bankAccount',
        'bank_number' => 'bankNumber',
        'default_cashback_time' => 'defaultCashbackTime',
        'default_cashback_percent' => 'defaultCashbackPercent',
        'default_time_to_pay' => 'defaultTimeToPay',
        'tax_number' => 'taxNumber',
        'tax_office' => 'taxOffice',
        'exempt_vat' => 'exemptVat',
        'tax_type' => 'taxType',
        'tax_set' => 'taxSet',
        'default_discount_amount' => 'defaultDiscountAmount',
        'default_discount_percentage' => 'defaultDiscountPercentage',
        'buyer_reference' => 'buyerReference',
        'government_agency' => 'governmentAgency',
        'additional_information' => 'additionalInformation'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'object_name' => 'setObjectName',
        'create' => 'setCreate',
        'update' => 'setUpdate',
        'name' => 'setName',
        'status' => 'setStatus',
        'customer_number' => 'setCustomerNumber',
        'parent' => 'setParent',
        'surename' => 'setSurename',
        'familyname' => 'setFamilyname',
        'titel' => 'setTitel',
        'category' => 'setCategory',
        'description' => 'setDescription',
        'academic_title' => 'setAcademicTitle',
        'gender' => 'setGender',
        'sev_client' => 'setSevClient',
        'name2' => 'setName2',
        'birthday' => 'setBirthday',
        'vat_number' => 'setVatNumber',
        'bank_account' => 'setBankAccount',
        'bank_number' => 'setBankNumber',
        'default_cashback_time' => 'setDefaultCashbackTime',
        'default_cashback_percent' => 'setDefaultCashbackPercent',
        'default_time_to_pay' => 'setDefaultTimeToPay',
        'tax_number' => 'setTaxNumber',
        'tax_office' => 'setTaxOffice',
        'exempt_vat' => 'setExemptVat',
        'tax_type' => 'setTaxType',
        'tax_set' => 'setTaxSet',
        'default_discount_amount' => 'setDefaultDiscountAmount',
        'default_discount_percentage' => 'setDefaultDiscountPercentage',
        'buyer_reference' => 'setBuyerReference',
        'government_agency' => 'setGovernmentAgency',
        'additional_information' => 'setAdditionalInformation'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'object_name' => 'getObjectName',
        'create' => 'getCreate',
        'update' => 'getUpdate',
        'name' => 'getName',
        'status' => 'getStatus',
        'customer_number' => 'getCustomerNumber',
        'parent' => 'getParent',
        'surename' => 'getSurename',
        'familyname' => 'getFamilyname',
        'titel' => 'getTitel',
        'category' => 'getCategory',
        'description' => 'getDescription',
        'academic_title' => 'getAcademicTitle',
        'gender' => 'getGender',
        'sev_client' => 'getSevClient',
        'name2' => 'getName2',
        'birthday' => 'getBirthday',
        'vat_number' => 'getVatNumber',
        'bank_account' => 'getBankAccount',
        'bank_number' => 'getBankNumber',
        'default_cashback_time' => 'getDefaultCashbackTime',
        'default_cashback_percent' => 'getDefaultCashbackPercent',
        'default_time_to_pay' => 'getDefaultTimeToPay',
        'tax_number' => 'getTaxNumber',
        'tax_office' => 'getTaxOffice',
        'exempt_vat' => 'getExemptVat',
        'tax_type' => 'getTaxType',
        'tax_set' => 'getTaxSet',
        'default_discount_amount' => 'getDefaultDiscountAmount',
        'default_discount_percentage' => 'getDefaultDiscountPercentage',
        'buyer_reference' => 'getBuyerReference',
        'government_agency' => 'getGovernmentAgency',
        'additional_information' => 'getAdditionalInformation'
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

    const TAX_TYPE__DEFAULT = 'default';
    const TAX_TYPE_EU = 'eu';
    const TAX_TYPE_NOTEU = 'noteu';
    const TAX_TYPE_CUSTOM = 'custom';
    const TAX_TYPE_SS = 'ss';

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
            self::TAX_TYPE_SS,
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
        $this->container['create'] = isset($data['create']) ? $data['create'] : null;
        $this->container['update'] = isset($data['update']) ? $data['update'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['customer_number'] = isset($data['customer_number']) ? $data['customer_number'] : null;
        $this->container['parent'] = isset($data['parent']) ? $data['parent'] : null;
        $this->container['surename'] = isset($data['surename']) ? $data['surename'] : null;
        $this->container['familyname'] = isset($data['familyname']) ? $data['familyname'] : null;
        $this->container['titel'] = isset($data['titel']) ? $data['titel'] : null;
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['academic_title'] = isset($data['academic_title']) ? $data['academic_title'] : null;
        $this->container['gender'] = isset($data['gender']) ? $data['gender'] : null;
        $this->container['sev_client'] = isset($data['sev_client']) ? $data['sev_client'] : null;
        $this->container['name2'] = isset($data['name2']) ? $data['name2'] : null;
        $this->container['birthday'] = isset($data['birthday']) ? $data['birthday'] : null;
        $this->container['vat_number'] = isset($data['vat_number']) ? $data['vat_number'] : null;
        $this->container['bank_account'] = isset($data['bank_account']) ? $data['bank_account'] : null;
        $this->container['bank_number'] = isset($data['bank_number']) ? $data['bank_number'] : null;
        $this->container['default_cashback_time'] = isset($data['default_cashback_time']) ? $data['default_cashback_time'] : null;
        $this->container['default_cashback_percent'] = isset($data['default_cashback_percent']) ? $data['default_cashback_percent'] : null;
        $this->container['default_time_to_pay'] = isset($data['default_time_to_pay']) ? $data['default_time_to_pay'] : null;
        $this->container['tax_number'] = isset($data['tax_number']) ? $data['tax_number'] : null;
        $this->container['tax_office'] = isset($data['tax_office']) ? $data['tax_office'] : null;
        $this->container['exempt_vat'] = isset($data['exempt_vat']) ? $data['exempt_vat'] : null;
        $this->container['tax_type'] = isset($data['tax_type']) ? $data['tax_type'] : null;
        $this->container['tax_set'] = isset($data['tax_set']) ? $data['tax_set'] : null;
        $this->container['default_discount_amount'] = isset($data['default_discount_amount']) ? $data['default_discount_amount'] : null;
        $this->container['default_discount_percentage'] = isset($data['default_discount_percentage']) ? $data['default_discount_percentage'] : null;
        $this->container['buyer_reference'] = isset($data['buyer_reference']) ? $data['buyer_reference'] : null;
        $this->container['government_agency'] = isset($data['government_agency']) ? $data['government_agency'] : null;
        $this->container['additional_information'] = isset($data['additional_information']) ? $data['additional_information'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getTaxTypeAllowableValues();
        if (!is_null($this->container['tax_type']) && !in_array($this->container['tax_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'tax_type', must be one of '%s'",
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
     * @param string $id The contact id
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
     * @param string $object_name The contact object name
     *
     * @return $this
     */
    public function setObjectName($object_name)
    {
        $this->container['object_name'] = $object_name;

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
     * @param \DateTime $create Date of contact creation
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
     * @param \DateTime $update Date of last contact update
     *
     * @return $this
     */
    public function setUpdate($update)
    {
        $this->container['update'] = $update;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name The organization name.<br> Be aware that the type of contact will depend on this attribute.<br> If it holds a value, the contact will be regarded as an organization.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

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
     * @param string $status Defines the status of the contact. 100 <-> Lead - 500 <-> Pending - 1000 <-> Active.
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets customer_number
     *
     * @return string
     */
    public function getCustomerNumber()
    {
        return $this->container['customer_number'];
    }

    /**
     * Sets customer_number
     *
     * @param string $customer_number The customer number
     *
     * @return $this
     */
    public function setCustomerNumber($customer_number)
    {
        $this->container['customer_number'] = $customer_number;

        return $this;
    }

    /**
     * Gets parent
     *
     * @return \Swagger\Client\Model\ModelContactResponseParent
     */
    public function getParent()
    {
        return $this->container['parent'];
    }

    /**
     * Sets parent
     *
     * @param \Swagger\Client\Model\ModelContactResponseParent $parent parent
     *
     * @return $this
     */
    public function setParent($parent)
    {
        $this->container['parent'] = $parent;

        return $this;
    }

    /**
     * Gets surename
     *
     * @return string
     */
    public function getSurename()
    {
        return $this->container['surename'];
    }

    /**
     * Sets surename
     *
     * @param string $surename The <b>first</b> name of the contact.<br> Yeah... not quite right in literally every way. We know.<br> Not to be used for organizations.
     *
     * @return $this
     */
    public function setSurename($surename)
    {
        $this->container['surename'] = $surename;

        return $this;
    }

    /**
     * Gets familyname
     *
     * @return string
     */
    public function getFamilyname()
    {
        return $this->container['familyname'];
    }

    /**
     * Sets familyname
     *
     * @param string $familyname The last name of the contact.<br> Not to be used for organizations.
     *
     * @return $this
     */
    public function setFamilyname($familyname)
    {
        $this->container['familyname'] = $familyname;

        return $this;
    }

    /**
     * Gets titel
     *
     * @return string
     */
    public function getTitel()
    {
        return $this->container['titel'];
    }

    /**
     * Sets titel
     *
     * @param string $titel A non-academic title for the contact. Not to be used for organizations.
     *
     * @return $this
     */
    public function setTitel($titel)
    {
        $this->container['titel'] = $titel;

        return $this;
    }

    /**
     * Gets category
     *
     * @return \Swagger\Client\Model\ModelContactResponseCategory
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param \Swagger\Client\Model\ModelContactResponseCategory $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

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
     * @param string $description A description for the contact.
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets academic_title
     *
     * @return string
     */
    public function getAcademicTitle()
    {
        return $this->container['academic_title'];
    }

    /**
     * Sets academic_title
     *
     * @param string $academic_title A academic title for the contact. Not to be used for organizations.
     *
     * @return $this
     */
    public function setAcademicTitle($academic_title)
    {
        $this->container['academic_title'] = $academic_title;

        return $this;
    }

    /**
     * Gets gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->container['gender'];
    }

    /**
     * Sets gender
     *
     * @param string $gender Gender of the contact.<br> Not to be used for organizations.
     *
     * @return $this
     */
    public function setGender($gender)
    {
        $this->container['gender'] = $gender;

        return $this;
    }

    /**
     * Gets sev_client
     *
     * @return \Swagger\Client\Model\ModelContactResponseSevClient
     */
    public function getSevClient()
    {
        return $this->container['sev_client'];
    }

    /**
     * Sets sev_client
     *
     * @param \Swagger\Client\Model\ModelContactResponseSevClient $sev_client sev_client
     *
     * @return $this
     */
    public function setSevClient($sev_client)
    {
        $this->container['sev_client'] = $sev_client;

        return $this;
    }

    /**
     * Gets name2
     *
     * @return string
     */
    public function getName2()
    {
        return $this->container['name2'];
    }

    /**
     * Sets name2
     *
     * @param string $name2 Second name of the contact.<br> Not to be used for organizations.
     *
     * @return $this
     */
    public function setName2($name2)
    {
        $this->container['name2'] = $name2;

        return $this;
    }

    /**
     * Gets birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->container['birthday'];
    }

    /**
     * Sets birthday
     *
     * @param \DateTime $birthday Birthday of the contact.<br> Not to be used for organizations.
     *
     * @return $this
     */
    public function setBirthday($birthday)
    {
        $this->container['birthday'] = $birthday;

        return $this;
    }

    /**
     * Gets vat_number
     *
     * @return string
     */
    public function getVatNumber()
    {
        return $this->container['vat_number'];
    }

    /**
     * Sets vat_number
     *
     * @param string $vat_number Vat number of the contact.
     *
     * @return $this
     */
    public function setVatNumber($vat_number)
    {
        $this->container['vat_number'] = $vat_number;

        return $this;
    }

    /**
     * Gets bank_account
     *
     * @return string
     */
    public function getBankAccount()
    {
        return $this->container['bank_account'];
    }

    /**
     * Sets bank_account
     *
     * @param string $bank_account Bank account number (IBAN) of the contact.
     *
     * @return $this
     */
    public function setBankAccount($bank_account)
    {
        $this->container['bank_account'] = $bank_account;

        return $this;
    }

    /**
     * Gets bank_number
     *
     * @return string
     */
    public function getBankNumber()
    {
        return $this->container['bank_number'];
    }

    /**
     * Sets bank_number
     *
     * @param string $bank_number Bank number of the bank used by the contact.
     *
     * @return $this
     */
    public function setBankNumber($bank_number)
    {
        $this->container['bank_number'] = $bank_number;

        return $this;
    }

    /**
     * Gets default_cashback_time
     *
     * @return string
     */
    public function getDefaultCashbackTime()
    {
        return $this->container['default_cashback_time'];
    }

    /**
     * Sets default_cashback_time
     *
     * @param string $default_cashback_time Absolute time in days which the contact has to pay his invoices and subsequently get a cashback.
     *
     * @return $this
     */
    public function setDefaultCashbackTime($default_cashback_time)
    {
        $this->container['default_cashback_time'] = $default_cashback_time;

        return $this;
    }

    /**
     * Gets default_cashback_percent
     *
     * @return string
     */
    public function getDefaultCashbackPercent()
    {
        return $this->container['default_cashback_percent'];
    }

    /**
     * Sets default_cashback_percent
     *
     * @param string $default_cashback_percent Percentage of the invoice sum the contact gets back if he payed invoices in time.
     *
     * @return $this
     */
    public function setDefaultCashbackPercent($default_cashback_percent)
    {
        $this->container['default_cashback_percent'] = $default_cashback_percent;

        return $this;
    }

    /**
     * Gets default_time_to_pay
     *
     * @return string
     */
    public function getDefaultTimeToPay()
    {
        return $this->container['default_time_to_pay'];
    }

    /**
     * Sets default_time_to_pay
     *
     * @param string $default_time_to_pay The payment goal in days which is set for every invoice of the contact.
     *
     * @return $this
     */
    public function setDefaultTimeToPay($default_time_to_pay)
    {
        $this->container['default_time_to_pay'] = $default_time_to_pay;

        return $this;
    }

    /**
     * Gets tax_number
     *
     * @return string
     */
    public function getTaxNumber()
    {
        return $this->container['tax_number'];
    }

    /**
     * Sets tax_number
     *
     * @param string $tax_number The tax number of the contact.
     *
     * @return $this
     */
    public function setTaxNumber($tax_number)
    {
        $this->container['tax_number'] = $tax_number;

        return $this;
    }

    /**
     * Gets tax_office
     *
     * @return string
     */
    public function getTaxOffice()
    {
        return $this->container['tax_office'];
    }

    /**
     * Sets tax_office
     *
     * @param string $tax_office The tax office of the contact (only for greek customers).
     *
     * @return $this
     */
    public function setTaxOffice($tax_office)
    {
        $this->container['tax_office'] = $tax_office;

        return $this;
    }

    /**
     * Gets exempt_vat
     *
     * @return string
     */
    public function getExemptVat()
    {
        return $this->container['exempt_vat'];
    }

    /**
     * Sets exempt_vat
     *
     * @param string $exempt_vat Defines if the contact is freed from paying vat.
     *
     * @return $this
     */
    public function setExemptVat($exempt_vat)
    {
        $this->container['exempt_vat'] = $exempt_vat;

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
     * @param string $tax_type Defines which tax regulation the contact is using.
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
     * Gets tax_set
     *
     * @return \Swagger\Client\Model\ModelContactResponseTaxSet
     */
    public function getTaxSet()
    {
        return $this->container['tax_set'];
    }

    /**
     * Sets tax_set
     *
     * @param \Swagger\Client\Model\ModelContactResponseTaxSet $tax_set tax_set
     *
     * @return $this
     */
    public function setTaxSet($tax_set)
    {
        $this->container['tax_set'] = $tax_set;

        return $this;
    }

    /**
     * Gets default_discount_amount
     *
     * @return string
     */
    public function getDefaultDiscountAmount()
    {
        return $this->container['default_discount_amount'];
    }

    /**
     * Sets default_discount_amount
     *
     * @param string $default_discount_amount The default discount the contact gets for every invoice.<br> Depending on defaultDiscountPercentage attribute, in percent or absolute value.
     *
     * @return $this
     */
    public function setDefaultDiscountAmount($default_discount_amount)
    {
        $this->container['default_discount_amount'] = $default_discount_amount;

        return $this;
    }

    /**
     * Gets default_discount_percentage
     *
     * @return string
     */
    public function getDefaultDiscountPercentage()
    {
        return $this->container['default_discount_percentage'];
    }

    /**
     * Sets default_discount_percentage
     *
     * @param string $default_discount_percentage Defines if the discount is a percentage (true) or an absolute value (false).
     *
     * @return $this
     */
    public function setDefaultDiscountPercentage($default_discount_percentage)
    {
        $this->container['default_discount_percentage'] = $default_discount_percentage;

        return $this;
    }

    /**
     * Gets buyer_reference
     *
     * @return string
     */
    public function getBuyerReference()
    {
        return $this->container['buyer_reference'];
    }

    /**
     * Sets buyer_reference
     *
     * @param string $buyer_reference Buyer reference of the contact.
     *
     * @return $this
     */
    public function setBuyerReference($buyer_reference)
    {
        $this->container['buyer_reference'] = $buyer_reference;

        return $this;
    }

    /**
     * Gets government_agency
     *
     * @return string
     */
    public function getGovernmentAgency()
    {
        return $this->container['government_agency'];
    }

    /**
     * Sets government_agency
     *
     * @param string $government_agency Defines whether the contact is a government agency (true) or not (false).
     *
     * @return $this
     */
    public function setGovernmentAgency($government_agency)
    {
        $this->container['government_agency'] = $government_agency;

        return $this;
    }

    /**
     * Gets additional_information
     *
     * @return string
     */
    public function getAdditionalInformation()
    {
        return $this->container['additional_information'];
    }

    /**
     * Sets additional_information
     *
     * @param string $additional_information Additional information stored for the contact.
     *
     * @return $this
     */
    public function setAdditionalInformation($additional_information)
    {
        $this->container['additional_information'] = $additional_information;

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
