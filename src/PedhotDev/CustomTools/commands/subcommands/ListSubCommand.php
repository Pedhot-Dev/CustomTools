<?php

namespace PedhotDev\CustomTools\commands\subcommands;

use CortexPE\Commando\BaseSubCommand;
use PedhotDev\CustomTools\Main;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use function ucfirst;

class ListSubCommand extends BaseSubCommand
{

    public function __construct()
    {
        parent::__construct("list", "List Custom Tools items", ["l"]);
        $this->setPermission("customtools.command.list");
    }

    protected function prepare(): void
    {
        // TODO: Implement prepare() method.
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $tools = Main::getInstance()->getCustomToolsManager()->getAll();
        $msg = TextFormat::GREEN . "Tools list (" . count($tools) . "):\n";
        $i = 1;
        foreach ($tools as $tool) {
            $msg .= TextFormat::GOLD . $i . "). " . TextFormat::AQUA . $tool->getToolName() . TextFormat::GOLD . " - " . TextFormat::GREEN . ucfirst($tool->getType()) . TextFormat::GOLD . " (" . ucfirst($tool->getTier()) . ")\n";
            $i++;
        }
        $sender->sendMessage($msg);
    }

}