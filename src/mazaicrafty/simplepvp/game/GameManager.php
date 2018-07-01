<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace mazaicrafty\simplepvp\game;

use mazaicrafty\simplepvp\game\TeamManager;
use mazaicrafty\simplepvp\game\WaitTimeTask;

class GameManager{

    public static $is_started = false;
    private $server;

    public function __construct(Server $server){
        $this->server = $server;
    }

    public static function startGame(){
        GameManager::$is_started = true;
        TeamManager::registerPlayerToTeam(TeamManager::$players);
    }

    public static function finishGame(){
        GameManager::$is_started = false;
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new WaitTimeTask(Main::getInstance()), 20);
        $this->server->broadcastMessage("エントリーの募集が開始されました");
    }
}