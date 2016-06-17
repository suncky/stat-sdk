<?php
namespace xsteach\statSdk\processing;

use xsteach\statSdk\Config;
use xsteach\statSdk\Func;
use xsteach\statSdk\http\Client;
use xsteach\statSdk\http\Error;

class Operation
{
    /**
     * @var Config $_config
    **/
    private $_config = null;
    private $_site_hash = '';
    private $_key = '';

    public function __construct($siteHash, $key = '', $url = '')
    {
        $config = new Config($url);

        $this->_config = $config;
        $this->_site_hash = $siteHash;
        $this->_key = $key;
    }

    /**
     * @param string $apiName// 对应的处理器 如 order或o 对应订单操作的api(分析器)
     * @param string $eventType // 指定在上个api中具体的某个操作事件 如 Add 或 a 为 上个api中年的添加行为
     * @param array $data
     * @param array $header
     * @param string $type
     * @author sjy
     * @return array
     * @throws \Exception
     */
    public function turn($apiName, $eventType = '', $data = array(), $header = array(), $type = 'get')
    {
        $url = $this->_config->getUrl();
        if(empty($url)) {
            throw new \Exception('url can not be empty');
        }
        $data = array_merge([Config::P_API_NAME => $apiName, Config::P_EVENT_TYPE => $eventType, Config::P_SITE_HASH => $this->_site_hash], $data);
        $header = array_merge(['Authorization' => 'Basic '.$this->_key], $header);
        if($type == 'get') {
            $resp = Client::get($url, $data, $header);
        } else {
            $resp = Client::post($url, $data, $header);
        }
        if (!$resp->ok()) {
            return array(null, new Error($url, $resp));
        }
        if ($resp->json() !== null) {
            return array($resp->json(), null);
        }
        return array($resp->body, null);
    }
}
