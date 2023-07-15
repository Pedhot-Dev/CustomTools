<?php

namespace PedhotDev\CustomTools;

use CortexPE\Commando\PacketHooker;
use PedhotDev\CustomTools\commands\CustomToolsCommand;
use PedhotDev\CustomTools\customtools\CustomToolsManager;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase
{
    use SingletonTrait;

    private Config $toolsConfig;
    
    private CustomToolsManager $customToolsManager;

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        $this->saveResource("tools.yml");
        $this->toolsConfig = new Config($this->getDataFolder() . "tools.yml");

        if (!PacketHooker::isRegistered()) PacketHooker::register($this);

        $this->customToolsManager = new CustomToolsManager();
        Server::getInstance()->getCommandMap()->register($this->getName(), new CustomToolsCommand($this));
    }

    protected function onDisable(): void
    {
        $tools = [];
        foreach ($this->customToolsManager->getAll() as $customTools) {
            $tools[$customTools->getToolName()] = [
                "type" => $customTools->getType(),
                "tier" => $customTools->getTier(),
                "glint" => $customTools->isGlint(),
                "durability" => $customTools->getDurability(),
                "mining-efficiency" => $customTools->getMiningEfficiency(),
                "attack-points" => $customTools->getAttackPoints(),
                "name" => $customTools->getCustomName(),
                "lore" => $customTools->getLores()
            ];
        }
        $this->toolsConfig->setAll($tools);
        $this->toolsConfig->save();
    }

    /**
     * @return Config
     */
    public function getToolsConfig(): Config
    {
        return $this->toolsConfig;
    }

    /**
     * @return CustomToolsManager
     */
    public function getCustomToolsManager(): CustomToolsManager
    {
        return $this->customToolsManager;
    }

}