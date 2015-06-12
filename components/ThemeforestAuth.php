<?php

namespace app\components;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of themeforestAuthV2
 *
 * @author Sylar
 */
/**
 * @ignore
 */
class OAuthException extends \yii\base\Exception {
    // pass
}

/**
 * 认证类(OAuth)
 *
 * 授权机制说明请大家参考开放平台文档：{@link }
 *
 * @package themeforest
 * @author Sylar.Ling
 * @version 1.0
 */
class themeforestAuth {

    /**
     * @ignore
     */
    public $client_id;

    /**
     * @ignore
     */
    public $client_secret;

    /**
     * @ignore
     */
    public $access_token;

    /**
     * @ignore
     */
    public $refresh_token;

    /**
     * Contains the last HTTP status code returned. 
     *
     * @ignore
     */
    public $http_code;

    /**
     * Contains the last API call.
     *
     * @ignore
     */
    public $url;

    /**
     * Set up the API root URL.
     *
     * @ignore
     */
    public $host = "http://i.Themeforest.com";

    /**
     * Set timeout default.
     *
     * @ignore
     */
    public $timeout = 30;

    /**
     * Set connect timeout.
     *
     * @ignore
     */
    public $connecttimeout = 30;

    /**
     * Verify SSL Cert.
     *
     * @ignore
     */
    public $ssl_verifypeer = FALSE;

    /**
     * Respons format.
     *
     * @ignore
     */
    public $format = 'json';

    /**
     * Decode returned json data.
     *
     * @ignore
     */
    public $decode_json = TRUE;

    /**
     * Contains the last HTTP headers returned.
     *
     * @ignore
     */
    public $http_info;

    /**
     * Set the useragnet.
     *
     * @ignore
     */
    public $useragent = 'themeforest OAuth';

    /**
     * print the debug info
     *
     * @ignore
     */
    public $debug = FALSE;

    /**
     * boundary of multipart
     * @ignore
     */
    public static $boundary = '';

    /**
     * Set API URLS
     */

    /**
     * @ignore
     */
    function accessTokenURL()
    {
        return $this->host.'/oauth/accessToken';
    }

    /**
     * @ignore
     */
    function authorizeURL()
    {
        return $this->host.'/oauth/authorize';
    }

    /**
     * @ignore
     */
    function getUserURL()
    {
        return $this->host.'/oauth/getUser';
    }

    /**
     * construct OAuth object
     */
    function __construct($client_id, $client_secret, $access_token = NULL, $refresh_token = NULL)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;
    }

    /**
     * authorize接口
     *
     *
     * @param string $url 授权后的回调地址,站外应用需与回调地址一致,站内应用需要填写canvas page的地址
     * @param string $response_type 支持的值包括 code 和token 默认值为code
     * @param string $state 用于保持请求和回调的状态。在回调时,会在Query Parameter中回传该参数
     * @param string $display 授权页面类型 可选范围: 
     *  - default		默认授权页面		
     *  - mobile		支持html5的手机		
     *  - popup			弹窗授权页		
     *  - wap1.2		wap1.2页面		
     *  - wap2.0		wap2.0页面		
     *  - js			js-sdk 专用 授权页面是弹窗，返回结果为js-sdk回掉函数		
     *  - themeforest	站内应用专用
     * @return array
     */
    function getAuthorizeURL($url, $response_type = 'code', $scope = 'web', $state = NULL, $display = NULL)
    {
        $params = array();
        $params['client_id'] = $this->client_id;
        $params['redirect_uri'] = $url;
        $params['response_type'] = $response_type;
        $params['scope'] = $scope;
        $params['state'] = $state;
        $params['display'] = $display;
        return $this->authorizeURL() . "?" . http_build_query($params);
    }

    /**
     * access_token接口
     *
     *
     * @param string $type 请求的类型,可以为:code, password, token
     * @param array $keys 其他参数：
     *  - 当$type为code时： array('code'=>..., 'redirect_uri'=>...)
     *  - 当$type为password时： array('username'=>..., 'password'=>...)
     *  - 当$type为token时： array('refresh_token'=>...)
     * @return array
     */
    function getAccessToken($type = 'code', $keys)
    {
        $params = array();
        $params['client_id'] = $this->client_id;
        $params['client_secret'] = $this->client_secret;
        if ($type === 'refresh_token')
        {
            $params['grant_type'] = 'refresh_token';
            $params['username']   = $keys['username'];
        }
        elseif ($type === 'code')
        {
            $params['grant_type'] = 'authorization_code';
            $params['code'] = $keys['code'];
        }
        elseif ($type === 'password')
        {
            $params['grant_type'] = 'password';
            $params['username'] = $keys['username'];
            $params['password'] = $keys['password'];
        }
        else
        {
            throw new OAuthException("wrong auth type");
        }

        $response = $this->oAuthRequest($this->accessTokenURL(), 'POST', $params);
        
        $token = json_decode($response, true);
        if (is_array($token) && !isset($token['error']) && isset($token['access_token']))
        {
            $this->access_token = $token['access_token'];
            //$this->refresh_token = $token['refresh_token'];
        }
        else
        {
            return false;
            throw new OAuthException("get access token failed." . $token['error']);
        }
        return $token;
    }

    /**
     * user接口
     *
     *
     * @param string $type 请求的类型,可以为:code, password, token
     * @param array $keys 其他参数：
     *  - 当$type为code时： array('code'=>..., 'redirect_uri'=>...)
     *  - 当$type为password时： array('username'=>..., 'password'=>...)
     *  - 当$type为token时： array('refresh_token'=>...)
     * @return array
     */
    function getUser($token)
    {
        $params = array();
        $params['client_id'] = $this->client_id;
        $params['client_secret'] = $this->client_secret;
        $params['token'] = $token;

        $response = $this->oAuthRequest($this->getUserURL(), 'POST', $params);
        
        $user = json_decode($response, true);
        if (is_array($user) && $user['ret'] == 0)
        {
            return $user;
        }
        return FALSE;
    }
    /**
     * 从数组中读取access_token和refresh_token
     * 常用于从Session或Cookie中读取token，或通过Session/Cookie中是否存有token判断登录状态。
     *
     * @param array $arr 存有access_token和secret_token的数组
     * @return array 成功返回array('access_token'=>'value', 'refresh_token'=>'value'); 失败返回false
     */
    function getTokenFromArray($arr)
    {
        if (isset($arr['access_token']) && $arr['access_token'])
        {
            $token = array();
            $this->access_token = $token['access_token'] = $arr['access_token'];
            if (isset($arr['refresh_token']) && $arr['refresh_token'])
            {
                $this->refresh_token = $token['refresh_token'] = $arr['refresh_token'];
            }

            return $token;
        }
        else
        {
            return false;
        }
    }

    /**
     * GET wrappwer for oAuthRequest.
     *
     * @return mixed
     */
    function get($url, $parameters = array())
    {
        $response = $this->oAuthRequest($url, 'GET', $parameters);
        if ($this->format === 'json' && $this->decode_json)
        {
            return json_decode($response, true);
        }
        return $response;
    }

    /**
     * POST wreapper for oAuthRequest.
     *
     * @return mixed
     */
    function post($url, $parameters = array())
    {
        $response = $this->oAuthRequest($url, 'POST', $parameters);
        if ($this->format === 'json' && $this->decode_json)
        {
            return json_decode($response, true);
        }
        return $response;
    }

    /**
     * DELTE wrapper for oAuthReqeust.
     *
     * @return mixed
     */
    function delete($url, $parameters = array())
    {
        $response = $this->oAuthRequest($url, 'DELETE', $parameters);
        if ($this->format === 'json' && $this->decode_json)
        {
            return json_decode($response, true);
        }
        return $response;
    }

    /**
     * Format and sign an OAuth / API request
     *
     * @return string
     * @ignore
     */
    function oAuthRequest($url, $method, $parameters, $multi = false)
    {

        if (strrpos($url, 'http://') !== 0 && strrpos($url, 'https://') !== 0)
        {
            $url = "{$this->host}{$url}.{$this->format}";
        }

        switch ($method)
        {
            case 'GET':
                $url = $url . '?' . http_build_query($parameters);
                return $this->http($url, 'GET');
            default:
                $headers = array();
                if (is_array($parameters) || is_object($parameters))
                {
                    $body = http_build_query($parameters);
                }
                return $this->http($url, $method, $body, $headers);
        }
    }

    /**
     * Make an HTTP request
     *
     * @return string API results
     * @ignore
     */
    function http($url, $method, $postfields = NULL, $headers = array())
    {
        $this->http_info = array();
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ci, CURLOPT_ENCODING, "");
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
        if (version_compare(phpversion(), '5.4.0', '<'))
        {
            curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 1);
        }
        else
        {
            curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 2);
        }
        curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ci, CURLOPT_HEADER, FALSE);

        switch ($method)
        {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if (!empty($postfields))
                {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                    $this->postdata = $postfields;
                }
                break;
            case 'DELETE':
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($postfields))
                {
                    $url = "{$url}?{$postfields}";
                }
        }

        if (isset($this->access_token) && $this->access_token)
            $headers[] = "Authorization: OAuth " . $this->access_token;

        if (!empty($this->remote_ip))
        {
            $headers[] = "API-RemoteIP: " . $this->remote_ip;
           
        }
        else
        {
            $headers[] = "API-RemoteIP: " . $_SERVER['REMOTE_ADDR'];           
        }
        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);

        $response = curl_exec($ci);
        $this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ci));
        $this->url = $url;

        if ($this->debug)
        {
            echo "=====post data======\r\n";
            var_dump($postfields);

            echo "=====headers======\r\n";
            print_r($headers);

            echo '=====request info=====' . "\r\n";
            print_r(curl_getinfo($ci));

            echo '=====response=====' . "\r\n";
            print_r($response);
        }
        curl_close($ci);
        return $response;
    }

    /**
     * Get the header info to store.
     *
     * @return int
     * @ignore
     */
    function getHeader($ch, $header)
    {
        $i = strpos($header, ':');
        if (!empty($i))
        {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }
        return strlen($header);
    }

}
