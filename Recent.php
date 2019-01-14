<?php
namespace kjBotModule\kj415j45\Arcaea;

use kjBot\Framework\Module;
use kjBot\Framework\Message;
use kjBot\Framework\Event\MessageEvent;
use kjBotModule\kj415j45\CoreModule\Access;
use kjBotModule\kj415j45\CoreModule\AccessLevel;

class Recent extends Module{
    public function process(array $args, MessageEvent $event): Message{
        Access::Control($event)->requireLevel(AccessLevel::Supporter);
        $webHeader = [
            "http" => [
                "header" => 'Authorization: '.Config('arcaea_bearer'),
            ]
        ];
        $data = json_decode(file_get_contents('https://arcapi.lowiro.com/4/user/me', false, stream_context_create($webHeader)))->value->friends;

        if($data === NULL)q('Token 过期');

        foreach($data as $friend){
            if($friend->user_code == $args[1]??q('请提供查询ID')){
                return $event->sendBack((new Score($friend->recent_score[0]))->toText());
            }
        }

        q('玩家不在关注列表中');
    }
}