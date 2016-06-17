## 调用方式

```php
$operate = new Operation('666eed3d1138aba8c53e5d28cf45cdff', 'a98yq239hjtoqgaog90agua0j', 'www.test.cn/test/pick');; // 666eed3d1138aba8c53e5d28cf45cdff => $appid , a98yq239hjtoqgaog90agua0j => $key, www.test.cn/test/pick => $url
$data = $operate->turn(apiName, $eventType, $data, $headers); // $data 和 $headers 是键值对数组
if($error = $data[1]) {
    echo 'code:'.$error->code().'message'.$error->message();
} else {
    print_r($data[0]);
}
```