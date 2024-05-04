<?php
/**
 * OrderApi
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

namespace Swagger\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Swagger\Client\ApiException;
use Swagger\Client\Configuration;
use Swagger\Client\HeaderSelector;
use Swagger\Client\ObjectSerializer;

/**
 * OrderApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class OrderApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation createContractNoteFromOrder
     *
     * Create contract note from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create contract note (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\ModelOrderResponse
     */
    public function createContractNoteFromOrder($order_id, $order_object_name, $body = null)
    {
        list($response) = $this->createContractNoteFromOrderWithHttpInfo($order_id, $order_object_name, $body);
        return $response;
    }

    /**
     * Operation createContractNoteFromOrderWithHttpInfo
     *
     * Create contract note from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create contract note (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\ModelOrderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createContractNoteFromOrderWithHttpInfo($order_id, $order_object_name, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->createContractNoteFromOrderRequest($order_id, $order_object_name, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\ModelOrderResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createContractNoteFromOrderAsync
     *
     * Create contract note from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create contract note (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createContractNoteFromOrderAsync($order_id, $order_object_name, $body = null)
    {
        return $this->createContractNoteFromOrderAsyncWithHttpInfo($order_id, $order_object_name, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createContractNoteFromOrderAsyncWithHttpInfo
     *
     * Create contract note from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create contract note (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createContractNoteFromOrderAsyncWithHttpInfo($order_id, $order_object_name, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->createContractNoteFromOrderRequest($order_id, $order_object_name, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createContractNoteFromOrder'
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create contract note (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function createContractNoteFromOrderRequest($order_id, $order_object_name, $body = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling createContractNoteFromOrder'
            );
        }
        // verify the required parameter 'order_object_name' is set
        if ($order_object_name === null || (is_array($order_object_name) && count($order_object_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_object_name when calling createContractNoteFromOrder'
            );
        }

        $resourcePath = '/Order/Factory/createContractNoteFromOrder';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($order_id !== null) {
            $queryParams['order[id]'] = ObjectSerializer::toQueryValue($order_id, null);
        }
        // query params
        if ($order_object_name !== null) {
            $queryParams['order[objectName]'] = ObjectSerializer::toQueryValue($order_object_name, null);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createOrder
     *
     * Create a new order
     *
     * @param  \Swagger\Client\Model\SaveOrder $body Creation data. Please be aware, that you need to provide at least all required parameter
    of the order model! (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\SaveOrderResponse
     */
    public function createOrder($body = null)
    {
        list($response) = $this->createOrderWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createOrderWithHttpInfo
     *
     * Create a new order
     *
     * @param  \Swagger\Client\Model\SaveOrder $body Creation data. Please be aware, that you need to provide at least all required parameter
    of the order model! (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\SaveOrderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createOrderWithHttpInfo($body = null)
    {
        $returnType = '\Swagger\Client\Model\SaveOrderResponse';
        $request = $this->createOrderRequest($body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\SaveOrderResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createOrderAsync
     *
     * Create a new order
     *
     * @param  \Swagger\Client\Model\SaveOrder $body Creation data. Please be aware, that you need to provide at least all required parameter
    of the order model! (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createOrderAsync($body = null)
    {
        return $this->createOrderAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createOrderAsyncWithHttpInfo
     *
     * Create a new order
     *
     * @param  \Swagger\Client\Model\SaveOrder $body Creation data. Please be aware, that you need to provide at least all required parameter
    of the order model! (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createOrderAsyncWithHttpInfo($body = null)
    {
        $returnType = '\Swagger\Client\Model\SaveOrderResponse';
        $request = $this->createOrderRequest($body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createOrder'
     *
     * @param  \Swagger\Client\Model\SaveOrder $body Creation data. Please be aware, that you need to provide at least all required parameter
    of the order model! (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function createOrderRequest($body = null)
    {

        $resourcePath = '/Order/Factory/saveOrder';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createPackingListFromOrder
     *
     * Create packing list from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create packing list (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\ModelOrderResponse
     */
    public function createPackingListFromOrder($order_id, $order_object_name, $body = null)
    {
        list($response) = $this->createPackingListFromOrderWithHttpInfo($order_id, $order_object_name, $body);
        return $response;
    }

    /**
     * Operation createPackingListFromOrderWithHttpInfo
     *
     * Create packing list from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create packing list (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\ModelOrderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createPackingListFromOrderWithHttpInfo($order_id, $order_object_name, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->createPackingListFromOrderRequest($order_id, $order_object_name, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\ModelOrderResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createPackingListFromOrderAsync
     *
     * Create packing list from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create packing list (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPackingListFromOrderAsync($order_id, $order_object_name, $body = null)
    {
        return $this->createPackingListFromOrderAsyncWithHttpInfo($order_id, $order_object_name, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createPackingListFromOrderAsyncWithHttpInfo
     *
     * Create packing list from order
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create packing list (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPackingListFromOrderAsyncWithHttpInfo($order_id, $order_object_name, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->createPackingListFromOrderRequest($order_id, $order_object_name, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createPackingListFromOrder'
     *
     * @param  int $order_id the id of the order (required)
     * @param  string $order_object_name Model name, which is &#x27;Order&#x27; (required)
     * @param  \Swagger\Client\Model\ModelCreatePackingListFromOrder $body Create packing list (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function createPackingListFromOrderRequest($order_id, $order_object_name, $body = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling createPackingListFromOrder'
            );
        }
        // verify the required parameter 'order_object_name' is set
        if ($order_object_name === null || (is_array($order_object_name) && count($order_object_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_object_name when calling createPackingListFromOrder'
            );
        }

        $resourcePath = '/Order/Factory/createPackingListFromOrder';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($order_id !== null) {
            $queryParams['order[id]'] = ObjectSerializer::toQueryValue($order_id, null);
        }
        // query params
        if ($order_object_name !== null) {
            $queryParams['order[objectName]'] = ObjectSerializer::toQueryValue($order_object_name, null);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteOrder
     *
     * Deletes an order
     *
     * @param  int $order_id Id of order resource to delete (required)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse2001
     */
    public function deleteOrder($order_id)
    {
        list($response) = $this->deleteOrderWithHttpInfo($order_id);
        return $response;
    }

    /**
     * Operation deleteOrderWithHttpInfo
     *
     * Deletes an order
     *
     * @param  int $order_id Id of order resource to delete (required)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse2001, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteOrderWithHttpInfo($order_id)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse2001';
        $request = $this->deleteOrderRequest($order_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse2001',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteOrderAsync
     *
     * Deletes an order
     *
     * @param  int $order_id Id of order resource to delete (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteOrderAsync($order_id)
    {
        return $this->deleteOrderAsyncWithHttpInfo($order_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteOrderAsyncWithHttpInfo
     *
     * Deletes an order
     *
     * @param  int $order_id Id of order resource to delete (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteOrderAsyncWithHttpInfo($order_id)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse2001';
        $request = $this->deleteOrderRequest($order_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteOrder'
     *
     * @param  int $order_id Id of order resource to delete (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function deleteOrderRequest($order_id)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling deleteOrder'
            );
        }

        $resourcePath = '/Order/{orderId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getDiscounts
     *
     * Find order discounts
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse20038
     */
    public function getDiscounts($order_id, $limit = null, $offset = null, $embed = null)
    {
        list($response) = $this->getDiscountsWithHttpInfo($order_id, $limit, $offset, $embed);
        return $response;
    }

    /**
     * Operation getDiscountsWithHttpInfo
     *
     * Find order discounts
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse20038, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDiscountsWithHttpInfo($order_id, $limit = null, $offset = null, $embed = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20038';
        $request = $this->getDiscountsRequest($order_id, $limit, $offset, $embed);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse20038',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getDiscountsAsync
     *
     * Find order discounts
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDiscountsAsync($order_id, $limit = null, $offset = null, $embed = null)
    {
        return $this->getDiscountsAsyncWithHttpInfo($order_id, $limit, $offset, $embed)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDiscountsAsyncWithHttpInfo
     *
     * Find order discounts
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDiscountsAsyncWithHttpInfo($order_id, $limit = null, $offset = null, $embed = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20038';
        $request = $this->getDiscountsRequest($order_id, $limit, $offset, $embed);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getDiscounts'
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getDiscountsRequest($order_id, $limit = null, $offset = null, $embed = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling getDiscounts'
            );
        }

        $resourcePath = '/Order/{orderId}/getDiscounts';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, null);
        }
        // query params
        if (is_array($embed)) {
            $embed = ObjectSerializer::serializeCollection($embed, 'multi', true);
        }
        if ($embed !== null) {
            $queryParams['embed'] = ObjectSerializer::toQueryValue($embed, null);
        }

        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOrderById
     *
     * Find order by ID
     *
     * @param  int $order_id ID of order to return (required)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse20036
     */
    public function getOrderById($order_id)
    {
        list($response) = $this->getOrderByIdWithHttpInfo($order_id);
        return $response;
    }

    /**
     * Operation getOrderByIdWithHttpInfo
     *
     * Find order by ID
     *
     * @param  int $order_id ID of order to return (required)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse20036, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrderByIdWithHttpInfo($order_id)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20036';
        $request = $this->getOrderByIdRequest($order_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse20036',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrderByIdAsync
     *
     * Find order by ID
     *
     * @param  int $order_id ID of order to return (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrderByIdAsync($order_id)
    {
        return $this->getOrderByIdAsyncWithHttpInfo($order_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrderByIdAsyncWithHttpInfo
     *
     * Find order by ID
     *
     * @param  int $order_id ID of order to return (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrderByIdAsyncWithHttpInfo($order_id)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20036';
        $request = $this->getOrderByIdRequest($order_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getOrderById'
     *
     * @param  int $order_id ID of order to return (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getOrderByIdRequest($order_id)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling getOrderById'
            );
        }

        $resourcePath = '/Order/{orderId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOrderPositionsById
     *
     * Find order positions
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse20037
     */
    public function getOrderPositionsById($order_id, $limit = null, $offset = null, $embed = null)
    {
        list($response) = $this->getOrderPositionsByIdWithHttpInfo($order_id, $limit, $offset, $embed);
        return $response;
    }

    /**
     * Operation getOrderPositionsByIdWithHttpInfo
     *
     * Find order positions
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse20037, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrderPositionsByIdWithHttpInfo($order_id, $limit = null, $offset = null, $embed = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20037';
        $request = $this->getOrderPositionsByIdRequest($order_id, $limit, $offset, $embed);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse20037',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrderPositionsByIdAsync
     *
     * Find order positions
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrderPositionsByIdAsync($order_id, $limit = null, $offset = null, $embed = null)
    {
        return $this->getOrderPositionsByIdAsyncWithHttpInfo($order_id, $limit, $offset, $embed)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrderPositionsByIdAsyncWithHttpInfo
     *
     * Find order positions
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrderPositionsByIdAsyncWithHttpInfo($order_id, $limit = null, $offset = null, $embed = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20037';
        $request = $this->getOrderPositionsByIdRequest($order_id, $limit, $offset, $embed);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getOrderPositionsById'
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  int $limit limits the number of entries returned (optional)
     * @param  int $offset set the index where the returned entries start (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getOrderPositionsByIdRequest($order_id, $limit = null, $offset = null, $embed = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling getOrderPositionsById'
            );
        }

        $resourcePath = '/Order/{orderId}/getPositions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, null);
        }
        // query params
        if (is_array($embed)) {
            $embed = ObjectSerializer::serializeCollection($embed, 'multi', true);
        }
        if ($embed !== null) {
            $queryParams['embed'] = ObjectSerializer::toQueryValue($embed, null);
        }

        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOrders
     *
     * Retrieve orders
     *
     * @param  int $status Status of the order (optional)
     * @param  string $order_number Retrieve all orders with this order number (optional)
     * @param  int $start_date Retrieve all orders with a date equal or higher (optional)
     * @param  int $end_date Retrieve all orders with a date equal or lower (optional)
     * @param  int $contact_id Retrieve all orders with this contact. Must be provided with contact[objectName] (optional)
     * @param  string $contact_object_name Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse20036
     */
    public function getOrders($status = null, $order_number = null, $start_date = null, $end_date = null, $contact_id = null, $contact_object_name = null)
    {
        list($response) = $this->getOrdersWithHttpInfo($status, $order_number, $start_date, $end_date, $contact_id, $contact_object_name);
        return $response;
    }

    /**
     * Operation getOrdersWithHttpInfo
     *
     * Retrieve orders
     *
     * @param  int $status Status of the order (optional)
     * @param  string $order_number Retrieve all orders with this order number (optional)
     * @param  int $start_date Retrieve all orders with a date equal or higher (optional)
     * @param  int $end_date Retrieve all orders with a date equal or lower (optional)
     * @param  int $contact_id Retrieve all orders with this contact. Must be provided with contact[objectName] (optional)
     * @param  string $contact_object_name Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse20036, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrdersWithHttpInfo($status = null, $order_number = null, $start_date = null, $end_date = null, $contact_id = null, $contact_object_name = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20036';
        $request = $this->getOrdersRequest($status, $order_number, $start_date, $end_date, $contact_id, $contact_object_name);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse20036',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrdersAsync
     *
     * Retrieve orders
     *
     * @param  int $status Status of the order (optional)
     * @param  string $order_number Retrieve all orders with this order number (optional)
     * @param  int $start_date Retrieve all orders with a date equal or higher (optional)
     * @param  int $end_date Retrieve all orders with a date equal or lower (optional)
     * @param  int $contact_id Retrieve all orders with this contact. Must be provided with contact[objectName] (optional)
     * @param  string $contact_object_name Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrdersAsync($status = null, $order_number = null, $start_date = null, $end_date = null, $contact_id = null, $contact_object_name = null)
    {
        return $this->getOrdersAsyncWithHttpInfo($status, $order_number, $start_date, $end_date, $contact_id, $contact_object_name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrdersAsyncWithHttpInfo
     *
     * Retrieve orders
     *
     * @param  int $status Status of the order (optional)
     * @param  string $order_number Retrieve all orders with this order number (optional)
     * @param  int $start_date Retrieve all orders with a date equal or higher (optional)
     * @param  int $end_date Retrieve all orders with a date equal or lower (optional)
     * @param  int $contact_id Retrieve all orders with this contact. Must be provided with contact[objectName] (optional)
     * @param  string $contact_object_name Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrdersAsyncWithHttpInfo($status = null, $order_number = null, $start_date = null, $end_date = null, $contact_id = null, $contact_object_name = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20036';
        $request = $this->getOrdersRequest($status, $order_number, $start_date, $end_date, $contact_id, $contact_object_name);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getOrders'
     *
     * @param  int $status Status of the order (optional)
     * @param  string $order_number Retrieve all orders with this order number (optional)
     * @param  int $start_date Retrieve all orders with a date equal or higher (optional)
     * @param  int $end_date Retrieve all orders with a date equal or lower (optional)
     * @param  int $contact_id Retrieve all orders with this contact. Must be provided with contact[objectName] (optional)
     * @param  string $contact_object_name Only required if contact[id] was provided. &#x27;Contact&#x27; should be used as value. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getOrdersRequest($status = null, $order_number = null, $start_date = null, $end_date = null, $contact_id = null, $contact_object_name = null)
    {

        $resourcePath = '/Order';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status, null);
        }
        // query params
        if ($order_number !== null) {
            $queryParams['orderNumber'] = ObjectSerializer::toQueryValue($order_number, null);
        }
        // query params
        if ($start_date !== null) {
            $queryParams['startDate'] = ObjectSerializer::toQueryValue($start_date, null);
        }
        // query params
        if ($end_date !== null) {
            $queryParams['endDate'] = ObjectSerializer::toQueryValue($end_date, null);
        }
        // query params
        if ($contact_id !== null) {
            $queryParams['contact[id]'] = ObjectSerializer::toQueryValue($contact_id, null);
        }
        // query params
        if ($contact_object_name !== null) {
            $queryParams['contact[objectName]'] = ObjectSerializer::toQueryValue($contact_object_name, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getRelatedObjects
     *
     * Find related objects
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  bool $include_itself Define if the related objects include the order itself (optional)
     * @param  bool $sort_by_type Define if you want the related objects sorted by type (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse20037
     */
    public function getRelatedObjects($order_id, $include_itself = null, $sort_by_type = null, $embed = null)
    {
        list($response) = $this->getRelatedObjectsWithHttpInfo($order_id, $include_itself, $sort_by_type, $embed);
        return $response;
    }

    /**
     * Operation getRelatedObjectsWithHttpInfo
     *
     * Find related objects
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  bool $include_itself Define if the related objects include the order itself (optional)
     * @param  bool $sort_by_type Define if you want the related objects sorted by type (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse20037, HTTP status code, HTTP response headers (array of strings)
     */
    public function getRelatedObjectsWithHttpInfo($order_id, $include_itself = null, $sort_by_type = null, $embed = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20037';
        $request = $this->getRelatedObjectsRequest($order_id, $include_itself, $sort_by_type, $embed);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse20037',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getRelatedObjectsAsync
     *
     * Find related objects
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  bool $include_itself Define if the related objects include the order itself (optional)
     * @param  bool $sort_by_type Define if you want the related objects sorted by type (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRelatedObjectsAsync($order_id, $include_itself = null, $sort_by_type = null, $embed = null)
    {
        return $this->getRelatedObjectsAsyncWithHttpInfo($order_id, $include_itself, $sort_by_type, $embed)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getRelatedObjectsAsyncWithHttpInfo
     *
     * Find related objects
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  bool $include_itself Define if the related objects include the order itself (optional)
     * @param  bool $sort_by_type Define if you want the related objects sorted by type (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRelatedObjectsAsyncWithHttpInfo($order_id, $include_itself = null, $sort_by_type = null, $embed = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20037';
        $request = $this->getRelatedObjectsRequest($order_id, $include_itself, $sort_by_type, $embed);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getRelatedObjects'
     *
     * @param  int $order_id ID of order to return the positions (required)
     * @param  bool $include_itself Define if the related objects include the order itself (optional)
     * @param  bool $sort_by_type Define if you want the related objects sorted by type (optional)
     * @param  string[] $embed Get some additional information. Embed can handle multiple values, they must be separated by comma. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getRelatedObjectsRequest($order_id, $include_itself = null, $sort_by_type = null, $embed = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling getRelatedObjects'
            );
        }

        $resourcePath = '/Order/{orderId}/getRelatedObjects';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($include_itself !== null) {
            $queryParams['includeItself'] = ObjectSerializer::toQueryValue($include_itself, null);
        }
        // query params
        if ($sort_by_type !== null) {
            $queryParams['sortByType'] = ObjectSerializer::toQueryValue($sort_by_type, null);
        }
        // query params
        if (is_array($embed)) {
            $embed = ObjectSerializer::serializeCollection($embed, 'multi', true);
        }
        if ($embed !== null) {
            $queryParams['embed'] = ObjectSerializer::toQueryValue($embed, null);
        }

        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderGetPdf
     *
     * Retrieve pdf document of an order
     *
     * @param  int $order_id ID of order from which you want the pdf (required)
     * @param  bool $download If u want to download the pdf of the order. (optional)
     * @param  bool $prevent_send_by Defines if u want to send the order. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse20039
     */
    public function orderGetPdf($order_id, $download = null, $prevent_send_by = null)
    {
        list($response) = $this->orderGetPdfWithHttpInfo($order_id, $download, $prevent_send_by);
        return $response;
    }

    /**
     * Operation orderGetPdfWithHttpInfo
     *
     * Retrieve pdf document of an order
     *
     * @param  int $order_id ID of order from which you want the pdf (required)
     * @param  bool $download If u want to download the pdf of the order. (optional)
     * @param  bool $prevent_send_by Defines if u want to send the order. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse20039, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderGetPdfWithHttpInfo($order_id, $download = null, $prevent_send_by = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20039';
        $request = $this->orderGetPdfRequest($order_id, $download, $prevent_send_by);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse20039',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation orderGetPdfAsync
     *
     * Retrieve pdf document of an order
     *
     * @param  int $order_id ID of order from which you want the pdf (required)
     * @param  bool $download If u want to download the pdf of the order. (optional)
     * @param  bool $prevent_send_by Defines if u want to send the order. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderGetPdfAsync($order_id, $download = null, $prevent_send_by = null)
    {
        return $this->orderGetPdfAsyncWithHttpInfo($order_id, $download, $prevent_send_by)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderGetPdfAsyncWithHttpInfo
     *
     * Retrieve pdf document of an order
     *
     * @param  int $order_id ID of order from which you want the pdf (required)
     * @param  bool $download If u want to download the pdf of the order. (optional)
     * @param  bool $prevent_send_by Defines if u want to send the order. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderGetPdfAsyncWithHttpInfo($order_id, $download = null, $prevent_send_by = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse20039';
        $request = $this->orderGetPdfRequest($order_id, $download, $prevent_send_by);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderGetPdf'
     *
     * @param  int $order_id ID of order from which you want the pdf (required)
     * @param  bool $download If u want to download the pdf of the order. (optional)
     * @param  bool $prevent_send_by Defines if u want to send the order. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function orderGetPdfRequest($order_id, $download = null, $prevent_send_by = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling orderGetPdf'
            );
        }

        $resourcePath = '/Order/{orderId}/getPdf';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($download !== null) {
            $queryParams['download'] = ObjectSerializer::toQueryValue($download, null);
        }
        // query params
        if ($prevent_send_by !== null) {
            $queryParams['preventSendBy'] = ObjectSerializer::toQueryValue($prevent_send_by, null);
        }

        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderSendBy
     *
     * Mark order as sent
     *
     * @param  int $order_id ID of order to mark as sent (required)
     * @param  \Swagger\Client\Model\OrderIdSendByBody $body Specify the send type (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\ModelOrderResponse
     */
    public function orderSendBy($order_id, $body = null)
    {
        list($response) = $this->orderSendByWithHttpInfo($order_id, $body);
        return $response;
    }

    /**
     * Operation orderSendByWithHttpInfo
     *
     * Mark order as sent
     *
     * @param  int $order_id ID of order to mark as sent (required)
     * @param  \Swagger\Client\Model\OrderIdSendByBody $body Specify the send type (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\ModelOrderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderSendByWithHttpInfo($order_id, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->orderSendByRequest($order_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\ModelOrderResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation orderSendByAsync
     *
     * Mark order as sent
     *
     * @param  int $order_id ID of order to mark as sent (required)
     * @param  \Swagger\Client\Model\OrderIdSendByBody $body Specify the send type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderSendByAsync($order_id, $body = null)
    {
        return $this->orderSendByAsyncWithHttpInfo($order_id, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderSendByAsyncWithHttpInfo
     *
     * Mark order as sent
     *
     * @param  int $order_id ID of order to mark as sent (required)
     * @param  \Swagger\Client\Model\OrderIdSendByBody $body Specify the send type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderSendByAsyncWithHttpInfo($order_id, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->orderSendByRequest($order_id, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderSendBy'
     *
     * @param  int $order_id ID of order to mark as sent (required)
     * @param  \Swagger\Client\Model\OrderIdSendByBody $body Specify the send type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function orderSendByRequest($order_id, $body = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling orderSendBy'
            );
        }

        $resourcePath = '/Order/{orderId}/sendBy';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation sendorderViaEMail
     *
     * Send order via email
     *
     * @param  int $order_id ID of order to be sent via email (required)
     * @param  \Swagger\Client\Model\OrderIdSendViaEmailBody $body Mail data (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\InlineResponse2013
     */
    public function sendorderViaEMail($order_id, $body = null)
    {
        list($response) = $this->sendorderViaEMailWithHttpInfo($order_id, $body);
        return $response;
    }

    /**
     * Operation sendorderViaEMailWithHttpInfo
     *
     * Send order via email
     *
     * @param  int $order_id ID of order to be sent via email (required)
     * @param  \Swagger\Client\Model\OrderIdSendViaEmailBody $body Mail data (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\InlineResponse2013, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendorderViaEMailWithHttpInfo($order_id, $body = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse2013';
        $request = $this->sendorderViaEMailRequest($order_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\InlineResponse2013',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation sendorderViaEMailAsync
     *
     * Send order via email
     *
     * @param  int $order_id ID of order to be sent via email (required)
     * @param  \Swagger\Client\Model\OrderIdSendViaEmailBody $body Mail data (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendorderViaEMailAsync($order_id, $body = null)
    {
        return $this->sendorderViaEMailAsyncWithHttpInfo($order_id, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation sendorderViaEMailAsyncWithHttpInfo
     *
     * Send order via email
     *
     * @param  int $order_id ID of order to be sent via email (required)
     * @param  \Swagger\Client\Model\OrderIdSendViaEmailBody $body Mail data (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendorderViaEMailAsyncWithHttpInfo($order_id, $body = null)
    {
        $returnType = '\Swagger\Client\Model\InlineResponse2013';
        $request = $this->sendorderViaEMailRequest($order_id, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'sendorderViaEMail'
     *
     * @param  int $order_id ID of order to be sent via email (required)
     * @param  \Swagger\Client\Model\OrderIdSendViaEmailBody $body Mail data (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function sendorderViaEMailRequest($order_id, $body = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling sendorderViaEMail'
            );
        }

        $resourcePath = '/Order/{orderId}/sendViaEmail';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateOrder
     *
     * Update an existing order
     *
     * @param  int $order_id ID of order to update (required)
     * @param  \Swagger\Client\Model\ModelOrderUpdate $body Update data (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Swagger\Client\Model\ModelOrderResponse
     */
    public function updateOrder($order_id, $body = null)
    {
        list($response) = $this->updateOrderWithHttpInfo($order_id, $body);
        return $response;
    }

    /**
     * Operation updateOrderWithHttpInfo
     *
     * Update an existing order
     *
     * @param  int $order_id ID of order to update (required)
     * @param  \Swagger\Client\Model\ModelOrderUpdate $body Update data (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Swagger\Client\Model\ModelOrderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateOrderWithHttpInfo($order_id, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->updateOrderRequest($order_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Swagger\Client\Model\ModelOrderResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateOrderAsync
     *
     * Update an existing order
     *
     * @param  int $order_id ID of order to update (required)
     * @param  \Swagger\Client\Model\ModelOrderUpdate $body Update data (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateOrderAsync($order_id, $body = null)
    {
        return $this->updateOrderAsyncWithHttpInfo($order_id, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateOrderAsyncWithHttpInfo
     *
     * Update an existing order
     *
     * @param  int $order_id ID of order to update (required)
     * @param  \Swagger\Client\Model\ModelOrderUpdate $body Update data (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateOrderAsyncWithHttpInfo($order_id, $body = null)
    {
        $returnType = '\Swagger\Client\Model\ModelOrderResponse';
        $request = $this->updateOrderRequest($order_id, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateOrder'
     *
     * @param  int $order_id ID of order to update (required)
     * @param  \Swagger\Client\Model\ModelOrderUpdate $body Update data (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function updateOrderRequest($order_id, $body = null)
    {
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling updateOrder'
            );
        }

        $resourcePath = '/Order/{orderId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
