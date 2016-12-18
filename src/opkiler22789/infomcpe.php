<?php

namespace opkiler22789;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Utils;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\plugin\PluginDescription;

class infomcpe extends PluginBase{
	
    public function onLoad(){
	}

	public function onEnable(){
    }

	public function onDisable(){
	}

	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		switch($command->getName()){
            	
      case "infomcpe":
if(count($args) == 0){
$sender->sendMessage("§9§l—————§eINFOMCPE.RU§9—————\n§6/infomcpe download - §fскачать плагин \n§6/infomcpe pluginlist - §fсписок установленых плагинов\n§6/infomcpe update - §fкриво работуюший autoupdater \n§9§l—————§eINFOMCPE.RU§9—————");
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
        $this->download($this->getServer()->getPluginPath() . "[INFOMCPE.RU]{$args[1]} v{$version}.phar", $file);
        }else{
            $sender->sendMessage("Ошибка");	
        	}
        }else{
		$sender->sendMessage("§4Не достаточно прав");
		}
     break;
     case "pluginlist":
     if($sender->hasPermission("infomcpe.pluginlist")){
     foreach ($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
                             $sender->sendMessage("{$plugin->getName()} v{$plugin->getDescription()->getVersion()}");
                        } 
	      }else{
		$sender->sendMessage("§4Не достаточно прав");
		}
     break;
     case "update":
     if($sender->hasPermission("infomcpe.update")){
     $this->autoupdate($sender);
     }else{
     	$sender->sendMessage("§4Не достаточно прав");
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
			$this->download($this->getServer()->getPluginPath() . "[INFOMCPE.RU]{$resources["title"]} v{$resources["version_string"]}.phar", $file);
			$count++;
			
			}
		}
		}
		if($count =<10 && $count => 3){
		$player->sendMessage("Обновлено {$count} плагинов");
		}else{
			$player->sendMessage("Обновлено {$count} плагинa{");
			}
	}
public function download($path, $file){
	   file_put_contents($path, $file);
        $loader = new \pocketmine\plugin\PharPluginLoader($this->getServer());
       $pl = $loader->loadPlugin($path);
       $loader->enablePlugin($pl);
	}
	
}
            $sender->sendMessage("Ошибка");	
        	}
        }else{
		$sender->sendMessage("§4Не достаточно прав");
		}
     break;
     case "pluginlist":
     if($sender->hasPermission("infomcpe.pluginlist")){
     foreach ($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
                             $sender->sendMessage("{$plugin->getName()} v{$plugin->getDescription()->getVersion()}");
                        } 
	      }else{
		$sender->sendMessage("§4Не достаточно прав");
		}
     break;
     case "update":
     if($sender->hasPermission("infomcpe.update")){
     $this->autoupdate($sender);
     }else{
     	$sender->sendMessage("§4Не достаточно прав");
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
			$this->download($this->getServer()->getPluginPath() . "[INFOMCPE.RU]{$resources["title"]} v{$resources["version_string"]}.phar", $file);
			$count++;
			
			}
		}
		}
		if($count =<10 && $count =< 3){
		$player->sendMessage("Обновлено {$count} плагинов");
		}else{
			$player->sendMessage("Обновлено {$count} плагинa{");
			}
	}
public function download($path, $file){
	   file_put_contents($path, $file);
        $loader = new \pocketmine\plugin\PharPluginLoader($this->getServer());
       $pl = $loader->loadPlugin($path);
       $loader->enablePlugin($pl);
	}
	
}
            $sender->sendMessage("Ошибка");	
        	}
        }else{
		$sender->sendMessage($noperm);
		}
     break;
     case "pluginlist":
     if($sender->hasPermission("infomcpe.pluginlist")){
     foreach ($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
                             $sender->sendMessage("{$plugin->getName()} v{$plugin->getDescription()->getVersion()}");
                        } 
	      }else{
		$sender->sendMessage($noperm);
		}
     break;
     case "update":
     if($sender->hasPermission("infomcpe.update")){
     $this->autoupdate($sender);
     }else{
     	$sender->sendMessage($noperm);
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
			$this->download($this->getServer()->getPluginPath() . "[INFOMCPE.RU]{$resources["title"]} v{$resources["version_string"]}.phar", $file);
			$count++;
			
			}
		}
		}
		if($count =<10 && $count =< 3){
		$player->sendMessage("Обновлено {$count} плагинов");
		}else{
			$player->sendMessage("Обновлено {$count} плагинa{");
			}
	}
public function download($path, $file){
	   file_put_contents($path, $file);
        $loader = new \pocketmine\plugin\PharPluginLoader($this->getServer());
       $pl = $loader->loadPlugin($path);
       $loader->enablePlugin($pl);
	}
	
}
            $sender->sendMessage("Ошибка");	
        	}
     break;
     case "pluginlist":
     foreach ($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
                             $sender->sendMessage("{$plugin->getName()} v{$plugin->getDescription()->getVersion()}");
                        }       
     break;
     case "update":
     $this->autoupdate($sender);
     
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
			$this->download($this->getServer()->getPluginPath() . "[INFOMCPE.RU]{$resources["title"]} v{$resources["version_string"]}.phar", $file);
			$count++;
			
			}
		}
		}
		if($count =<10 && $count =< 3){
		$player->sendMessage("Обновлено {$count} плагинов");
		}else{
			$player->sendMessage("Обновлено {$count} плагинa{");
			}
	}
public function download($path, $file){
	   file_put_contents($path, $file);
        $loader = new \pocketmine\plugin\PharPluginLoader($this->getServer());
       $pl = $loader->loadPlugin($path);
       $loader->enablePlugin($pl);
	}
	
}
