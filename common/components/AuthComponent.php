<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 03.03.2016
 * Time: 9:48
 */
namespace common\components;

use Yii;
use yii\base\Object;

class AuthComponent extends Object
{
    private $pageURL;

    public function init()
    {
        parent::init();
        $this->pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$this->pageURL .= "s";}
        $this->pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $this->pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $this->pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return strlen($_SERVER['QUERY_STRING']) ? $this->pageURL."?".$_SERVER['QUERY_STRING'] : $this->pageURL;
    }

    public function getLoginUrl() {
        $dp = explode('.', $_SERVER['HTTP_HOST']);
        //$t_main = $dp[count($dp) - 2].'.'.end($dp);
        $t_main = 'aliscom.'.end($dp);
        //return '//auth.'.$t_main.'/user/login?return_url='.urlencode($this->pageURL);
        //return '//auth.'.$t_main.'/user/login?return_url='.urlencode($this->pageURL);
        return '//auth.'.$t_main.'/user/login';
    }

    public function getLogoutUrl() {
        $dp = explode('.', $_SERVER['HTTP_HOST']);
        //$t_main = $dp[count($dp) - 2].'.'.end($dp);
        $t_main = 'aliscom.'.end($dp);
        return '//auth.'.$t_main.'/user/logout?return_url='.urlencode($this->pageURL);
    }
}