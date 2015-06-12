<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

class themeforestHelper extends Component {

    public static function modalImg($img, $isUrl = false)
    {
        if ($isUrl)
        {
            $imgUrl = $img;
        }
        else
        {
            $imgUrl = Url::to('file/show/?id=' . $img, true);
        }
        ob_start();
        ob_implicit_flush(false);

        Modal::begin([
            'header' => '<h2>查看图片</h2>',
            'toggleButton' => ['label' => '查看图片', 'class' => 'kv-editable-value kv-editable-link'],
        ]);

        echo Html::img($imgUrl, ['width' => '568px']);

        Modal::end();
        return ob_get_clean();
    }

    function GetDistance($lat1, $lng1, $lat2, $lng2, $len_type = 1, $decimal = 2)
    {
        $earthRadius = 6378.137; //地球半径 
        $pi = 3.1415926;
        
        $radLat1 = $lat1 * $pi / 180.0;
        $radLat2 = $lat2 * $pi / 180.0;
        $a = $radLat1 - $radLat2;
        $b = ($lng1 * $pi / 180.0) - ($lng2 * $pi / 180.0);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * $earthRadius;
        $s = round($s * 1000);
        if ($len_type > 1)
        {
            $s /= 1000;
        }
        return round($s, $decimal);
    }
    static function forceDownload($filename = '', $downloadName='file',$data = '', $set_mime = FALSE)
    {

        if ($filename === '' )
        {
            exit($filename);
            return FALSE;
        }
        elseif ($data === NULL)
        {
            if (@is_file($filename) && ($filesize = @filesize($filename)) !== FALSE)
            {
                $filepath = $filename;
                $filename = explode('/', str_replace(DIRECTORY_SEPARATOR, '/', $filename));
                $filename = end($filename);

            }
            else
            {

                return FALSE;
            }
        }
        else
        {
            $filesize = strlen($data);
        }

// Set the default MIME type to send
        $mime = 'application/octet-stream';

        $x = explode('.', $filename);
        $extension = end($x);

        if ($set_mime === TRUE)
        {
            if (count($x) === 1 OR $extension === '')
            {
                /* If we're going to detect the MIME type,
                * we'll need a file extension.
                */
                return FALSE;
            }

// Load the mime types
            $mimes =[];

// Only change the default MIME if we can find one
            if (isset($mimes[$extension]))
            {
                $mime = is_array($mimes[$extension]) ? $mimes[$extension][0] : $mimes[$extension];
            }
        }

        /* It was reported that browsers on Android 2.1 (and possibly older as well)
        * need to have the filename extension upper-cased in order to be able to
        * download it.
        *
        * Reference: http://digiblog.de/2011/04/19/android-and-the-download-file-headers/
        */
        if (count($x) !== 1 && isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/Android\s(1|2\.[01])/', $_SERVER['HTTP_USER_AGENT']))
        {
            $x[count($x) - 1] = strtoupper($extension);
            $filename = implode('.', $x);
        }

        if ($data === NULL && ($fp = @fopen($filepath, 'rb')) === FALSE)
        {
            return FALSE;
        }

// Clean output buffer
        if (ob_get_level() !== 0 && @ob_end_clean() === FALSE)
        {
            ob_clean();
        }

// Generate the server headers
        header('Content-Type: '.$mime);
        header('Content-Disposition: attachment; filename="'.$downloadName.'"');
        header('Expires: 0');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.$filesize);

// Internet Explorer-specific headers
        if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
        {
            header('Cache-Control: no-cache, no-store, must-revalidate');
        }

        header('Pragma: no-cache');

// If we have raw data - just dump it
        if ($data !== NULL)
        {
            exit($data);
        }

// Flush 1MB chunks of data
        while ( ! feof($fp) && ($data = fread($fp, 1048576)) !== FALSE)
        {
            echo $data;
        }

        fclose($fp);
        exit;
    }

    /**
     * 获取客户端IP地址
     */
    static public function getIP()
    {
        static $ip = NULL;
        if ($ip !== NULL)
            return $ip;
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos)
                unset($arr[$pos]);
            $ip = trim($arr[0]);
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (isset($_SERVER['REMOTE_ADDR']))
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $ip = ( false !== ip2long($ip) ) ? $ip : '0.0.0.0';
        return $ip;
    }

    /**
     * 获取远程URL内容
     * @param string $url
     * @return string
     */
    public static function curl($url, $param = array(), $referer = NULL, $ua = NULL)
    {
        if ($param)
        {
            $url .= '?' . http_build_query($param);
        }

        $ip = self::getIP();
        $headers['CLIENT-IP'] = $ip;
        $headers['X-FORWARDED-FOR'] = $ip;
        $headers['REMOTE_ADDR'] = $ip;

        $header = array();
        foreach ($headers as $n => $v)
        {
            $header[] = $n . ':' . $v;
        }
        $ua = ($ua == NULL ? self::rand_ua() : $ua);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $body = curl_exec($ch);
        curl_close($ch);

        return $body;
    }

    private static function rand_ua()
    {
        $ua[] = "AppleWebKit/535.11 (KHTML, like Gecko) Chrome/23.0.234.23 Safari/635.21";
        return $ua[0];
    }
}

?>