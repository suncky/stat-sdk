## 调用方式

### 调用方法1
```php
$operate = new Operation(['siteHash' => 'ab4e2cebd0f7f7442c57ae9a5cf5fe48', 'key' => 'a98yq239hjtoqgaog90agua0j', 'url' => 'http://uba.dev.xsteach.com/']);
$data = $operate->turn(apiName, $eventType, $user_id, $data, $headers); // $data 和 $headers 是键值对数组
if($error = $data[1]) {
    echo 'code:'.$error->code().'message'.$error->message();
} else {
    print_r($data[0]);
}
```

### 调用方法2
```php
   //配置中
   $config['components']['trail']  => [
                   'class' => 'xsteach\statSdk\processing\Operation',
                   'siteHash' => 'ab4e2cebd0f7f7442c57ae9a5cf5fe48',
                   'key' => '',
                   'url' => 'http://uba.dev.xsteach.com/'
               ]


    $data = Yii::$app->trail->turn('c', 'a', '323', [ 'tm' => 1465986567, 'course' => [['cid' => '123', 'cn' => '测试课程收藏2', 'cp' => '2300','st' =>0],['cid' => '124', 'cn' => '证书收藏2', 'cp' => '1400','st' =>1]]]);
    if($error = $data[1]) {
        echo 'code:'.$error->code().'message'.$error->message();
    } else {
        print_r($data[0]);
    }
```