<?php
namespace app\components;

use Yii;
use yii\base\Behavior;

class CGBBehavior extends Behavior {
        
    public $apiUri    = 'http://cgb.Themeforest.com/api';  //正式环境提交URL
    public $appKey    = ''; //填写自己申请的AppKey
    public $appSecret = ''; //填写自己申请的$appSecret
    public $returnUrl = '';
    public $orders;
    public $token;
    public $payments  = 14; // 2：储购券，4：积分，8：网银，16：现金   （储购券+积分=6，储购券+网银=10）
        
    function init()
    {
        parent::init();
        $this->apiUri = DOMAIN_PAY . '/api';
    }


    /**
     * 签名函数
     *
     * @param type $params
     * @param type $timestamp
     * @param type $multi FALSE 单行参数，TRUE 多行参数
     * @return type
     */
    function createSign($params)
    {
        $params['appsecret'] = $this->appSecret;
        $sign = $this->array2string($params);
        
        $sign = md5($sign);
        return $sign;
    }

    function array2string($array)
    {
        ksort($array);
        $string = '';
        foreach ($array as $k => $v)
        {
            if (is_array($v))
            {
                $string .= $k.$this->array2string($v);
            }
            else
            {
                $v = empty($v) ? '' : $v;
                $string .= $k.$v;
            }
        }
        return $string;
    }
    

    /**
     * 
     * @param type $params
     * @param type $multi FALSE 单行参数，TRUE 多行参数
     * @return type
     */
    function buildParams($params, $multi=FALSE)
    {
        $timestamp = time();
        if ($multi)
        {
            $params = array('orders' => $params);
        }
        $params['payments']  = $this->payments;
        $params['multi']     = $multi;
        $params['appkey']    = $this->appKey;
        $params['timestamp'] = $timestamp;
        //$params['token']     = $this->token;
        $params['returnUrl'] = $this->returnUrl;
        $sign = $this->createSign($params, $timestamp, $multi);
        $params['sign']      = $sign;
        
        return $params;
    }


    /**
     * 
     * @param type $params
     * @param type $multi FALSE 单行参数，TRUE 多行参数
     * @return type
     */
    function buildQuery($params, $multi=FALSE)
    {
        $params = $this->buildParams($params, $multi);
        return http_build_query($params);
    }

    //组参函数 
    function post($params, $multi)
    {
        $params = $this->buildParams($params, $multi);
        $this->submit($this->array2Field($params));
        die;
    }
    
    function array2Field($arr, $name='')
    {
        $html = '';
        foreach ($arr as $k => $v)
        {
            if ($name != '')
            {
                $k = $name."[{$k}]";
            }
            if (is_array($v))
            {
                $html .= $this->array2Field($v, $k);
            }
            else
            {
                $html .= "<input type='hidden' name='{$k}' value='{$v}' />";
            }
        }
        return $html;
    }
    
    function submit($fields)
    {
        echo '<!doctype html>
                <html>
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                    </head>
                    <body>';
        echo "<form id='cgbform' action='{$this->apiUri}' method='POST' enctype='multipart/form-data'>";
        echo $fields;
        echo '</form>';
        echo '<script>document.getElementById("cgbform").submit();</script>';
        echo     '</body>'
            . '</html>';
    }
}

