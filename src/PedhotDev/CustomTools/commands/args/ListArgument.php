<?php

namespace PedhotDev\CustomTools\commands\args;

use CortexPE\Commando\args\BaseArgument;
use PedhotDev\CustomTools\customtools\CustomToolsManager;
use PedhotDev\CustomTools\Main;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;

class ListArgument extends BaseArgument
{

    private CustomToolsManager $customToolsManager;

    public function __construct(string $name, bool $optional = false)
    {
        parent::__construct($name, $optional);
        $this->customToolsManager = Main::getInstance()->getCustomToolsManager();
    }

    public function getNetworkType(): int
    {
        return AvailableCommandsPacket::ARG_TYPE_STRING;
    }

    public function canParse(string $testString, CommandSender $sender): bool
    {
        return ($this->parse($testString, $sender) !== null);
    }

    public function parse(string $argument, CommandSender $sender): mixed
    {
        return $this->customToolsManager->getCustomTools($argument);
    }

    public function getTypeName(): string
    {
        return "tools";
    }

}