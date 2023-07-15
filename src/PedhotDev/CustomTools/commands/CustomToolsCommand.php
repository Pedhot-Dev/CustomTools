<?php

namespace PedhotDev\CustomTools\commands;

use CortexPE\Commando\BaseCommand;
use PedhotDev\CustomTools\commands\subcommands\GiveSubCommand;
use PedhotDev\CustomTools\commands\subcommands\ListSubCommand;
use PedhotDev\CustomTools\Main;
use pocketmine\command\CommandSender;

class CustomToolsCommand extends BaseCommand
{

    public function __construct(private Main $plugin)
    {
        parent::__construct($this->plugin, "customtools", "Custom Tools base command", ["ctools"]);
        $this->setPermission("customtools;customtools.command");
    }

    protected function prepare(): void
    {
        $this->registerSubCommand(new GiveSubCommand());
        $this->registerSubCommand(new ListSubCommand());
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        // TODO: Implement onRun() method.
    }

}