<?php
/*
 * Copyright 2023 PedhotDev
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

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
        $this->sendUsage();
    }

}