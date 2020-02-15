<?php

namespace xtakumatutix\PlayerJoinQuitPopup;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

Class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getLogger()->notice("Hello World");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, [
            "Joinの時" => "§b{name}§eさんが参加しました！！",
            "Quitの時" => "§b{name}§eさんが退出しました！！"
        ]);
    }

    public function onJoin(PlayerJoinEvent $event): void {
        $event->setJoinMessage("");
        $this->sendPopup($event, $this->config->get("Joinの時"));
    }

    public function onQuit(PlayerQuitEvent $event): void {
        $event->setQuitMessage("");
        $this->sendPopup($event, $this->config->get("Quitの時"));
    }

    private function sendPopup(PlayerEvent $event, string $message): void {
        $player = $event->getPlayer();
        $message = str_replace("{name}",$player->getName(), $message);
        $this->getServer()->broadcastPopup($message);
    }
}