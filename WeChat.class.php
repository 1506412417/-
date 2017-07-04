<?php

/**
 * 微信公众平台
 */
class WeChat {
    private $_appid;
    private $_appsecret;

    public function __construct($id,$secret){
        $this->_appid = $id;
        $this->_appsecret = $secret;
    }

    /**
     * 获取access_tonken
     * @param string $tonken_file 用来存储tonken
     */
    public function getAccessTonken($token_file='./access_token'){
        //考虑过期问题 讲获取到的access_tonken保存起来 filemtime(filename)返回文件上次修改时间
        $life_time = 7200;
        if (file_exists($touken_file)&& time()-filemtime($token_file)<$life_time){
            //存在有效的access_token file_getcontents()将文件读入字符串中
            return file_getcontents($token_file);
        }
        //目标url:
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->_appid.'&secret='.$this->_appsecret;
        $result = $this->_requestGet($url);
        if(!$result){
            return false;
        }

        //存在返回响应结果
        $result_obj = json_decode($result);
        //写入
        file_put_contents($token_file,$result_obj->access_token);
        return $result_obj->access_tonken;
    }

    /**
     * 发送GET请求的方法
     * @param string $url URL
     * @param bool $ssl 是否为http协议
     * @return string 响应主体Conent
     */
    private function _requestGet($url,$ssl=true){
        //curl完成
        $curl = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);//需要获取的URL地址，也可以在curl_init ([ string $url = NULL ] )函数中设置
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//将curl返回的数据以文件流的方式输出，而不是直接输出
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        $res=curl_exec($ch);
        curl_close($ch);
    }


}