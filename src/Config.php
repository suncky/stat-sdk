<?php
namespace xsteach\statSdk;

final class Config
{
    const P_SITE_HASH = 'sh';
    const P_EVENT_TYPE = 'et';
    const P_USER_ID = 'uid';
    const P_API_NAME = 'ass';
    const P_ACTION_TIME = 'tm';

    private $_url = 'local.dev.jinengxia.cn/test/pick'; //服务请求地址 如 local.dev.test.cn/test/pick'

    public function __construct($url = '')
    {
        $url && $this->_url = $url;
    }

    public function getUrl()
    {
        return $this->_url;
    }
    
    public function setUrl($url)
    {
        return $this->_url = $url;
    }
}
