<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace mazaicrafty\simplepvp\game;

use pocketmine\scheduler\PluginTask;

use mazaicrafty\simplepvp\Main;
use mazaicrafty\simplepvp\game\GameManager;

class WaitTimeTask extends PluginTask{

    const WAIT_TIME = 15;
    const PLAYERS = 3;
    
    public static $is_entered = false;

    private $plugin;
    private $time_limit;

    public function __construct(Main $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->time_limit = WaitTimeTask::WAIT_TIME + 1;
    }

    public function onRun(int $currentTick): void{
        if (count(TeamManager::$players) >= WaitTimeTask::PLAYERS){
        $this->time_limit--;
        $this->plugin->getServer()->broadcastPopup("§l§a" . $this->time_limit);

        if ($this->time_limit === 0){
            WaitTimeTask::$is_entered = false;
            $this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
            GameManager::startGame();
            }

        }
        else{
        $required_num = WaitTimeTask::PLAYERS - count(TeamManager::$players);
        $this->plugin->getServer()->broadcastMessage("§c人数が残り§a".$required_num."人§c集まらなければ、ゲームは開始されません。");            
        }
    }
}
