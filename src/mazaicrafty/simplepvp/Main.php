<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace mazaicrafty\simplepvp;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use mazaicrafty\simplepvp\game\TeamManager;
use mazaicrafty\simplepvp\game\GameManager;
use mazaicrafty\simplepvp\game\WaitTimeTask;

class Main extends PluginBase{

    public function onEnable(): void{
        
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        switch ($cmd->getName()){
            case "testpvp": // デバッグ用のコマンド
            if ($sender instanceof ConsoleCommandSender){
                $sender->sendMessage("Please execute this command in-game");
                return false;
            }
            $sender->sendMessage(TeamManager::registerPlayer($sender));
            return true;

            default:
            return false;
        }
    }

    public static function getInstance(): Main{
        return $this;
    }
}