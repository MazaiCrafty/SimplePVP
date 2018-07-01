<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace mazaicrafty\simplepvp\game;

use pocketmine\Player;
use pocketmine\Server;

use mazaicrafty\simplepvp\game\GameManager;

class TeamManager{

    const RED = 0;
    const BLUE = 1;

    public static $teams = [];
    public static $players = [];

    private $server;

    public function __construct(Server $server){
        $this->server = $server;
        TeamManager::$teams[TeamManager::RED];
        TeamManager::$teams[TeamManager::BLUE];
    }

    public static function registerPlayer(Player $player){
        if (GameManager::$is_started){
            return "既にゲームがスタートしています";
        }
        TeamManager::$players[] = $player;
        return "ゲームにエントリーしました";
    }

    public static function registerPlayerToTeam(array $players){
        
    }
}