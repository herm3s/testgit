<?php
$post = file_get_contents('php://input');
$urlReply = 'https://api.line.me/v2/bot/message/reply';
$token = 'FZldEem8ostD63IqQ5NQ0mZnYHK/NSzQutlkVIFLa9rRzFYQ3SXMvnzr6gM/rrBPK4wdLlSgA8Ba7vOJMajRtzAYouW9l8rQ3xlQeiDlBS48fUbw41nCul84q4NKVpQ53r/5mF4CUx1CNQfS3+iBbwdB04t89/1O/w1cDnyilFU=';


function postMessage($token,$packet,$urlReply){
 $dataEncode = json_encode($packet);
 $headersOption = array('Content-Type: application/json','Authorization: Bearer '.$token);
 $ch = curl_init($urlReply);
 curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
 curl_setopt($ch,CURLOPT_POSTFIELDS,$dataEncode);
 curl_setopt($ch,CURLOPT_HTTPHEADER,$headersOption);
 curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
 $result = curl_exec($ch);
 curl_close($ch);
}

function getSticker($replyToken){
 $sticker = array(
 'type' => 'sticker',
 'packageId' => '4',
 'stickerId' => '300'
 );
 $packet = array(
 'replyToken' => $replyToken,
 'messages' => array($sticker),
 );
 return $packet;
}



$res = json_decode($post, true);
if(isset($res['events']) && !is_null($res['events'])){
 foreach($res['events'] as $item){
 if($item['type'] == 'message'){
 switch($item['message']['type']){
 case 'text':

 $packet = getSticker($item['replyToken']);
 postMessage($token,$packet,$urlReply);
 
 
break;
case 'image':

break;
 case 'video':
 
 break;
 case 'audio':
 
 break;
 case 'location':

break;
 case 'sticker':

 break;

}


?>
