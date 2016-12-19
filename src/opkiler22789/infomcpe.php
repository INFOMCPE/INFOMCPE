<?php

namespace opkiler22789;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Utils;
use pocketmine\utils\Config;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\plugin\PluginDescription;

class infomcpe extends PluginBase{
	
    public function onLoad(){
	}

	public function onEnable(){
		$this->saveDefaultConfig();
    }

	public function onDisable(){
	}

	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		
		switch($command->getName()){
         
      case "infomcpe":
if(count($args) == 0){
$sender->sendMessage("§9§l—————§eINFOMCPE.RU§9—————\n§6/infomcpe download - §f{$this->lang("download")} {$this->lang("plugin")} \n§6/infomcpe pluginlist - §f{$this->lang("listinstall")} {$this->lang("plugins")}\n§6/infomcpe update - §f {$this->lang("autoupdater")}\n§9§l—————§eINFOMCPE.RU§9—————");
}
error_reporting(0);

      switch($args [0]){
     
      case "download":
      if($sender->hasPermission("infomcpe.download")){
                $data = json_decode(file_get_contents("http://infomcpe.ru/api.php?action=getResources&category_id=2"), true);
                foreach($data["resources"] as $plugin){
                    if(strtolower($args[1]) == strtolower($plugin["title"])){
                        $file = Utils::getURL("http://infomcpe.ru/resources/{$plugin["id"]}/download?version={$plugin["version_id"]}");
                        $version = $plugin["version_string"];
                    }
                }
                
      if($file){
        $this->install($this->getServer()->getPluginPath() . "[INFOMCPE.RU]{$args[1]} v{$version}.phar", $file);
        }else{
            $sender->sendMessage($this->lang("error"));	
        	}
        }else{
		$sender->sendMessage($this->lang("noperm"));
		}
     break;
     case "pluginlist":
     if($sender->hasPermission("infomcpe.pluginlist")){
     foreach ($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
                             $sender->sendMessage("{$plugin->getName()} v{$plugin->getDescription()->getVersion()}");
                        } 
	      }else{
		$sender->sendMessage($this->lang("noperm"));
		}
     break;
     case "update":
     if($sender->hasPermission("infomcpe.update")){
     $this->autoupdate($sender);
     }else{
     	$sender->sendMessage($this->lang("noperm"));
     	}
     break;
     
	}
}
}
public function autoupdate($player){
	            $data = json_decode(file_get_contents("http://infomcpe.ru/api.php?action=getResources&category_id=2"), true);
                $count = 0;
                foreach($data["resources"] as $resources){
	            foreach ($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
		if($resources["title"] == $plugin->getName() && $resources["version_string"] != $plugin->getDescription()->getVersion()){
			$file = Utils::getURL("http://infomcpe.ru/resources/{$resources['id']}/download?version={$resources['version_id']}");
			$this->install($this->getServer()->getPluginPath() . "[INFOMCPE.RU]{$resources["title"]} v{$resources["version_string"]}.phar", $file);
			$count++;
			
			}
		}
		}
		if($count <10 && $count > 2){
			$player->sendMessage("{$this->lang("updated")} {$count} {$this->lang("plugins")}");
		}elseif($count == 1){
			$player->sendMessage("{$this->lang("updated")} {$count} {$this->lang("plugin")}");
			}elseif($count == 0){
				$player->sendMessage($this->lang("noupdate"));
			}
	}
public function install($path, $file){
	   file_put_contents($path, $file);
        $loader = new \pocketmine\plugin\PharPluginLoader($this->getServer());
       $pl = $loader->loadPlugin($path);
       $loader->enablePlugin($pl);
	
	}
	public function lang($phrase){
		$lang = $this->getConfig()->get("lang");
        $urlh = file_get_contents("http://infomcpe.ru/localizer.php?lang={$lang}"); 
        $url = json_decode($urlh, true); 
        return $url["{$phrase}"];
		}
}
