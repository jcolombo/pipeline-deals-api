<?php
namespace PipelineDeals\Connection;

use PipelineDeals\Queue\PipelineDeals_Queue;

/**
 * Establish a connection holder for Pipeline Deals API
 *
 * @author Joel Colombo
 */
class PipelineDeals_Connection {

    private static $connections = array();

    protected $api_key = null;
    protected $connection_url = null;
    protected $cookie_jar = null;

    /*
     * Perform an API request and return the response in PHP. Parses the JSON responses automatically.
     *
     * @param $resource The resource call to be made after the base API URL... for example "deals" or "deals/12345"
     * @param $method The required request method for the resource... get, post, put, delete
     * @param $params An associative array of URL parameters for the request. Includes page, per_page, conditions, etc
     * @param $attribs An array of attributes that should be returned for the request or entities
     * @param $data An associative array of values to be "sent" to the request in the post/put body (pushing data to the system)
     * @param $return_raw If set to true returns the raw response from the request (including headers), by default it is parsed from JSON to PHP
     */
    public function executeRequest($resource, $method='get', $params=null, $attribs=null, $data=null, $return_raw=false)
    {
        PipelineDeals_Queue::stall();

        $method = strtolower($method);

        $param_string = "?api_key={$this->api_key}";
        if (is_array($params)) {
            foreach ($params as $k => $v) {
                if (is_array($v)) {
                    foreach($v as $k2 => $v2) {
                        $param_string .= "&{$k}[{$k2}]={$v2}";
                    }
                } else {
                    $param_string .= "&{$k}={$v}";
                }
            }
        }
        if (!is_null($attribs) && is_array($attribs) && count($attribs)>0) {
            $param_string .= "&attrs=".implode(',', $attribs);
        }

        $url = $this->connection_url.$resource.'.json'.$param_string;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_COOKIESESSION,0);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_jar);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_jar);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        if ($method == "post" OR $method == "put") {
            if (!is_array($data)) { $data = array(); }
            $json_string = json_encode($data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json_string))
            );
            if ($method == "post") { curl_setopt($ch, CURLOPT_POST, 1); }
            else if ($method == "put") { curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); }

            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
        }
        if ($method == "delete") { curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); }

        if (defined('PDAPI_ECHO_REQUESTS') && PDAPI_ECHO_REQUESTS) {
            echo "=========================================================</br>\n";
            echo strtoupper($method)." {$url}</br>\n";
            var_dump($data);
            echo "=========================================================</br>\n";
        }

        $run_it = true;
        $attempts = 0;

        while ($run_it) {
            $res = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header_string = substr($res, 0, $header_size);
            $headers = preg_split("/\r\n|\n|\r/", $header_string);
            $response_status = $headers[0];

            if (strpos($response_status, '200')) {
                // Good Request
                $run_it = false; //Stop looping let it fall through to be processed
            } elseif(strpos($response_status, '422')) {
                // Validation error occurred
                // Handle validation in some way. Assuming a header message comes back with problem?
                // @todo Need to check the message and handle correctly
                // var_dump($headers); exit;
                return false;
            } elseif(strpos($response_status, '429')) {
                // Request rate limited exceeded or hitting the wrong url
                // Error message should come back with the response in the headers.
                // @todo Need to check the message and handle correctly
                PipelineDeals_Queue::stall();
                $attempts++;
                if ($attempts > 3) {
                    $run_it = false;
                    return null;
                }
            } elseif(strpos($response_status, '500')) {
                // An internal error occurred at the API side
                $attempts++;
                if ($attempts > 3) {
                    $run_it = false;
                    return null;
                }
                sleep(2); // Pause for 2 seconds and try again in case API server was just hiccuping
            }
        }

        $body = substr($res, $header_size);

        curl_close($ch);

        if ($return_raw) {
            return $res;
        }
        return json_decode((string)$body, true);
    }

    /*
     * Fetch the API key attached to this connection instance
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /*
     * Set the URL for the connection to the version of the API being used.
     */
    public function setConnectionUrl($url)
    {
        if (substr($url, -1, 1) != '/') {
            $url .= '/';
        }
        $this->connection_url = $url;
    }

    /*
     * Set the file for the cookiejar storage. Defaults to the filepath of the library
     */
    public function setCookieJar($file)
    {
        $this->cookie_jar = $file;
    }

    /**
     * Create or retrieve a connection instance. If no api_key is passed, the first connection established is returned.
     *
     * @param $api_key The Pipeline Deals API key for this connection. If no key is passed, the first connection is returned
     * @param $connection_url An optional paramter to an alternative API URL
     *
     * @return PipelineDeals_Connection
     */
    public static function getConnection($api_key=null, $connection_url=null) {
        if (is_null($api_key)) {
            if (count(self::$connections)<1) {
                die('Cannot get connection that has not been established yet. Please insure at least one API KEY connection has been established first.');
            }
            $api_key = array_shift(array_keys(self::$connections));
        }
        if(!isset(self::$connections) || !is_array(self::$connections)) {
            self::$connections = array();
        }
        if(!isset(self::$connections[$api_key])) {
            self::$connections[$api_key] = new PipelineDeals_Connection($api_key, $connection_url);
        }
        return self::$connections[$api_key];
    }

    /**
     * Private constructor for new connection instances from the singleton getConnection calls
     *
     * @param $api_key The user API key for this connection
     * @param $connection_url The connection url for the API, if null uses the default /v3/ API
     */
    private function __construct($api_key, $connection_url)
    {
        $this->api_key = $api_key;
        if (is_null($connection_url)) {
            $connection_url = "https://api.pipelinedeals.com/api/v3/";
        }
        $this->cookie_jar = dirname(__FILE__) . "/pdc-cookiejar.txt";
        $this->setConnectionUrl($connection_url);
    }

}
