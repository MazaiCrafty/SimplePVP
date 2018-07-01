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

    private $plugin;
    private $time_limit;

    public function __construct(Main $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->time_limit = WaitTimeTask::WAIT_TIME + 1;
    }

    public function onRun(int $currentTick): void{
        $this->time_limit--;
        $this->plugin->getServer()->broadcastPopup("エントリー終了まで残り §l§a" . $this->time_limit);
        if ($this->time_limit === 0){
            $this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
            GameManager::startGame();
            return;
        }
    }
}