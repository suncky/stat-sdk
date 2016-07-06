<?php
namespace xsteach\statSdk\processing;

use xsteach\statSdk\Config;
use xsteach\statSdk\Func;
use xsteach\statSdk\http\Client;
use xsteach\statSdk\http\Error;
use yii\base\Exception;
use yii\base\Object;
use yii\log\Logger;

class Operation extends Object
{
    /**
     * @var Config $_config
    **/
    private $_config = null;
    private $_site_hash = '';
    private $_key = '';

    public function setSiteHash($siteHash) {
        $this->_site_hash = $siteHash;
    }

    public function setKey($key) {
        $this->_key = $key;
    }

    public function setUrl($url) {
        if($this->_config) {
            $this->_config->setUrl($url);
        } else {
            $config = new Config($url);

            $this->_config = $config;
        }
    }

    /**
     * @param string $apiName// 对应的处理器 如 order或o 对应订单操作的api(分析器)
     * @param string $eventType // 指定在上个api中具体的某个操作事件 如 Add 或 a 为 上个api中年的添加行为
     * @param int $user_id
     * @param array $data
     * @param array $header
     * @param string $type
     * @author sjy
     * @return array
     * @throws \Exception
     */
    public function turn($apiName, $eventType = '', $user_id = 0, $data = array(), $header = array(), $type = 'get')
    {
        try{
            $url = $this->_config->getUrl();
            if(empty($url)) {
                return ['参数url不能为空', null];
            }
            $data = array_merge([Config::P_API_NAME => $apiName, Config::P_EVENT_TYPE => $eventType, Config::P_USER_ID=> $user_id, Config::P_SITE_HASH => $this->_site_hash, Config::P_ACTION_TIME => time()], $data);
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
        } catch (Exception $e) {
            \Yii::$app->log->logger->log($e->getMessage(), Logger::LEVEL_ERROR);
            return [$e->getMessage(), null];
        }
    }
}
