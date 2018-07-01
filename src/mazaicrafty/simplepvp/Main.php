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

    private static $instance;

    public function onEnable(): void{
        self::$instance = $this;
        GameManager::$is_started = false;
        WaitTimeTask::$is_entered = true;
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new WaitTimeTask(Main::getInstance()), 20*15);
        $this->getServer()->broadcastMessage("エントリーの募集が開始されました");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        switch ($cmd->getName()){
            case "testpvp": // デバッグ用のコマンド
            if ($sender instanceof ConsoleCommandSender){
                $sender->sendMessage("Please execute this command in-game");
                return false;
            }
            if (!(WaitTimeTask::$is_entered)){
                $sender->sendMessage("現在試合中のため、エントリーは行われていません");
                return false;
            }
            $sender->sendMessage(TeamManager::registerPlayer($sender));
            return true;

            default:
            return false;
        }
    }

    public function onDisable(): void{
        //unset(TeamManager::$players);
        //unset(TeamManager::$team_colors);
        WaitTimeTask::$is_entered = true;
        GameManager::$is_started = false;
    }

    public static function getInstance(): Main{
        return Main::$instance;
    }
}