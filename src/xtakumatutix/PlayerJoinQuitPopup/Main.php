<?php

namespace xtakumatutix\PlayerJoinQuitPopup;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

Class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getLogger()->notice("Hello World");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML, [
            "Joinの時" => "§b{name}§eさんが参加しました！！",
            "Quitの時" => "§b{name}§eさんが退出しました！！"
        ]);
    }

    public function OnJoin(PlayerJoinEvent $event){
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $player =$event->getPlayer();
        $join =$this->config->get("Joinの時");
        $join = str_replace("{name}",$player->getName(), $join);
        $event->setJoinMessage("");
        $this->getServer()->broadcastPopup($join);
    }
        public function OnQuit(PlayerQuitEvent $event){
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $player =$event->getPlayer();
        $quit =$this->config->get("Quitの時");
        $quit = str_replace("{name}",$player->getName(), $quit);
        $event->setQuitMessage("");
        $this->getServer()->broadcastPopup($quit);
    }
}