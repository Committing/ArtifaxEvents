<?php

/**
 * API class for artifax getting data from their API
 * By: Jack Nicholson for Exeter Cathedral
 */
class Artifax
{

    /**
     * The API Key used to contact Artifax
     * @var string
     */
    protected $api_key = '';

    /**
     * The class object of Guzzle
     * @var null
     */
    protected $guzzleClient = null;

    /**
     * The API request result
     * @var null
     */
    protected $guzzleResult = null;

    /**
     * The base url at which we are requesting
     * @var string
     */
    protected $artifaxUrl = 'https://exetercathedral.artifaxevent.com/api/';

    /**
     * Keywords to slug url to request
     * @var array
     */
    protected $requestUrls = array(
        // Get events (Page 68 of API User Guide)
        'Events' => 'arrangements/event'
    );

    /**
     * Set the API key on the class
     * @param string $api_key API Key from Artifax
     * @param object $guzzleClient Guzzle class object
     */
    public function __construct($api_key, $guzzleClient)
    {
        $this->api_key = $api_key;
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * Request the data from Artifax API
     * @return array Data from request
     */
    public function requestEventData( $params = array() )
    {
        $this->guzzleResult = $this->guzzleClient->request('GET', $this->artifaxUrl . $this->requestUrls['Events'] . '?X-API-KEY=' . $this->api_key . '&' . http_build_query($params));
    }

    /**
     * Return the http status code of request
     * @return integer (200)
     */
    public function getStatusCode()
    {
        return $this->guzzleResult->getStatusCode();
    }

    /**
     * Return the header code from request
     * @return string (application/json)
     */
    public function getHeaderLine()
    {
        return $this->guzzleResult->getHeaderLine('content-type');
    }

    /**
     * Get the entire data from request
     * @return array (array (0 => object ( event_id => 1 ) ))
     */
    public function returnData()
    {
        return json_decode( $this->guzzleResult->getBody() );
    }

    /**
     * Get the result information from API request
     * @return string
     */
    public function checkRequestStatus()
    {
        return $this->guzzleResult->getStatusCode();
    }

}
