<?php
namespace xsteach\statSdk\http;

use xsteach\statSdk\Func;

final class Request
{
    public $url;
    public $headers;
    public $body;
    public $method;
    public $options;

    /**
     * POST method
     *
     * @var string
     */
    const POST = 'POST';
    /**
     * GET method
     *
     * @var string
     */
    const GET = 'GET';

    public function __construct($method, $url, array $headers = array(), $body = null, $options = array())
    {
        $this->method = strtoupper($method);
        $this->url = $url;
        $this->headers = array_merge(self::get_header_default_options(), $headers);
        $this->body = $body;
        $this->options = array_merge(self::get_default_options(), $options);
    }


    /**
     * Get the default options
     *
     * @see Requests::request() for values returned by this method
     * @return array Default option values
     */
    protected static function get_default_options() {
        $defaults = array(
            'type' => self::GET,
        );
        return $defaults;
    }

    /**
     * Get the header default options
     *
     * @see Requests::request() for values returned by this method
     * @return array Default option values
     */
    protected static function get_header_default_options() {
        $defaults = array(
            'CLIENT-IP' => Func::getUserIP(),
            'CLIENT-USER-AGENT' => Func::getUserAgent(),
            'CLIENT-URI' => Func::getUserHost().Func::getUserRequestUri(),
            'CLIENT-REFERER' => Func::getReferrer(),
            'SDK-VERSION' => 'php',
        );
        return $defaults;
    }
}
