<?php
namespace Home\Controller;

use Think\Controller;
class IndexController extends Controller
{
    public static $arr=[];
    public function indexAction(){

        //1.将timestamp,nonce,token按字典排序
        $timestamp 	= $_GET['timestamp'];
        $nonce    	= $_GET['nonce'];
        $token 		= 'sunxulong';
        $signature	= $_GET['signature'];

        $array 		= array($timestamp,$nonce,$token);
        sort($array);

        //2.将排序后的三个参数拼接后用sha1加密
        $str=implode('', $array);
        $str=sha1($str);
        //3.将加密后的字符串与signature进行对比，判断改请求是否来自微信
        if($str==$signature){
            //第一次接入微信api接口的时候
            echo $_GET['echostr'];
            exit;
        }else{
            //非第一次

            $this->reponseMsg();
        }
    }

    //接收事件推送并回复信息
    public function reponseMsg(){
        //获取微信推送过来的消息
        //如果post过来的数据不是PHP能够识别的，
        //你可以用 $GLOBALS['HTTP_RAW_POST_DATA']来接收，比如 text/xml 或者 soap 等等。
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //处理消息类型

        /*<xml>
            <ToUserName><![CDATA[toUser]]></ToUserName>
            <FromUserName><![CDATA[FromUser]]></FromUserName>
            <CreateTime>123456789</CreateTime>
            <MsgType><![CDATA[event]]></MsgType>
            <Event><![CDATA[subscribe]]></Event>
        </xml>*/

        $postObj= simplexml_load_string($postArr); //把 XML 字符串载入对象中
        $postObj->ToUserName='';	//开发者微信号
        $postObj->FromUserName='';	//发送方帐号（一个OpenID）
        $postObj->CreateTime='';	//消息创建时间 （整型）
        $postObj->MsgType='';	//消息类型，event
        $postObj->Event='';	//事件类型，subscribe(订阅)、unsubscribe(取消订阅)
        //判断该数据包是否是订阅的事件推送
        if( strtolower( $postObj->MsgType) == 'event'){ //转换小写
            //如果是关注 subscribe事件
            if( strtolower($postObj->Event == 'subscribe') ){
                //回复用户消息 格式如下
                /*<xml>
                    <ToUserName><![CDATA[toUser]]></ToUserName>
                    <FromUserName><![CDATA[fromUser]]></FromUserName>
                    <CreateTime>12345678</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[你好]]></Content>
                </xml>*/
                $toUser   = $postObj->FromUserName;
                $fromUser = $postObj->ToUserName;
                $time     = time();
                $msgType  =  'text';
                $content  = '欢迎关注我们的微信公众账号'.$postObj->FromUserName.'-'.$postObj->ToUserName;
                $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
                //字符传格式化函数 sprintf($str,顺序替换字符串%号);s字符传 f浮点......
                $info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
                echo $info;
            }
        }
        //文本消息格式
        /*<xml>
             <ToUserName><![CDATA[toUser]]></ToUserName>
             <FromUserName><![CDATA[fromUser]]></FromUserName>
             <CreateTime>1348831860</CreateTime>
             <MsgType><![CDATA[text]]></MsgType>
             <Content><![CDATA[this is a test]]></Content>
             <MsgId>1234567890123456</MsgId>
         </xml>*/
        //判断是否为文本消息
        if( strtolower( $postObj->MsgType) == 'text'){ //转换小写
            if(trim($postObj->Content=='图文')){
                $toUser 	= $postObj->FromUserName;
                $fromUser 	= $postObj->ToUserName;
                $msgType 	= 'news';
                $time 		= time();
                $arr = array(
                    array(
                        'title'=>'百度首页',
                        'description'=>'描述',
					    'picUrl'=>'https://imgsa.baidu.com/baike/c0%3Dbaike80%2C5%2C5%2C80%2C26/sign=0fc9b8c7261f95cab2f89ae4a87e145b/1c950a7b02087bf49212ea50f1d3572c10dfcf89.jpg',
					'url'=>'http://www.baidu.com',
					),
					array(
                        'title'=>'hao123',
                        'description'=>"hao123 is very cool",
                        'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
                        'url'=>'http://www.hao123.com',
                    ),
					array(
                        'title'=>'qq',
                        'description'=>"qq is very cool",
                        'picUrl'=>'http://www.imooc.com/static/img/common/logo.png',
                        'url'=>'http://www.qq.com',
                    ),
				);
				/*<xml>
					<ToUserName><![CDATA[toUser]]></ToUserName>
					<FromUserName><![CDATA[fromUser]]></FromUserName>
					<CreateTime>12345678</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>2</ArticleCount>
					<Articles>
					<item>
					<Title><![CDATA[title1]]></Title>
					<Description><![CDATA[description1]]></Description>
					<PicUrl><![CDATA[picurl]]></PicUrl>
					<Url><![CDATA[url]]></Url>
					</item>
					<item>
					<Title><![CDATA[title]]></Title>
					<Description><![CDATA[description]]></Description>
					<PicUrl><![CDATA[picurl]]></PicUrl>
					<Url><![CDATA[url]]></Url>
					</item>
					</Articles>
				</xml>*/
				$template  = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<ArticleCount>".count($arr)."</ArticleCount>
								<Articles>";
				foreach($arr as $v){
                    $template .="<item>
								<Title><![CDATA[".$v['title']."]]></Title>
								<Description><![CDATA[".$v['description']."]]></Description>
								<PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>
								<Url><![CDATA[".$v['url']."]]></Url>
								</item>";
                }
				$template .="</Articles>
							</xml>";

				$info     = sprintf($template, $toUser, $fromUser, $time, 'news');
				echo $info;
			}else{
            //如果内容是'你好'
            switch ($postObj->Content) {
                case '你好':
                    $content = '请问有什么可以帮助您？';
                    break;
                case '没有':
                    $content = '再见！';
                    break;
                case '哎呀':
                    $content = '卧槽';
                    break;
                default:
                    $content = '地址：灞桥区水狄东路小孙樱桃;\/电话：18966820298';
                    break;
                }
                $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
                //字符传格式化函数 sprintf($str,顺序替换字符串%号);s字符传 f浮点......
                $info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
                echo $info;
            }

        }

    }//end方法
}
