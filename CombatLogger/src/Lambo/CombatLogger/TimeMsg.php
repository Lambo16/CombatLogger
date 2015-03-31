<?php
namespace Lambo\CombatLogger;

use pocketmine\Player;
use pocketmine\scheduler\PluginTask;

class TimeMsg extends PluginTask{

    private $seconds = 0;
    private $interval = 10;
    private $player = null;

    public function __construct($plugin, $player){
        $this->plugin = $plugin;
        parent::__construct($plugin);
        $this->interval = $plugin->interval;
        $this->player = $player;
    }

    public function onRun($currentTick){
        $this->seconds++;
        if($this->seconds === $this->interval){
            if($this->player->isOnline()){
                $this->player->sendMessage("[CombatLogger] You can now log out.");
                $this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
                unset($this->plugin->tasks[$this->player->getName()]);
            }
        }
    }
}
