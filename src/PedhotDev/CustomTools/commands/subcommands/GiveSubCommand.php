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

namespace PedhotDev\CustomTools\commands\subcommands;

use CortexPE\Commando\BaseSubCommand;
use PedhotDev\CustomTools\commands\args\ListArgument;
use PedhotDev\CustomTools\commands\args\TargetPlayerArgument;
use PedhotDev\CustomTools\customtools\CustomTools;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class GiveSubCommand extends BaseSubCommand
{

    public function __construct()
    {
        parent::__construct("give", "Give Custom Tools items", ["g"]);
        $this->setPermission("customtools.command.give");
    }

    protected function prepare(): void
    {
        $this->registerArgument(0, new ListArgument("tools"));
        $this->registerArgument(1, new TargetPlayerArgument(true));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $target = $sender;
        if (!empty($args["player"])) {
            if (!($target = Server::getInstance()->getPlayerExact($args["player"])) instanceof Player) {
                $sender->sendMessage(TextFormat::RED . "The given player is offline!");
                return;
            }
        }else {
            if (!$sender instanceof Player) {
                $sender->sendMessage(TextFormat::RED . "You can only execute this command as player!");
                return;
            }
        }
        $tool = $args["tools"];
        if (!$tool instanceof CustomTools) {
            $sender->sendMessage(TextFormat::RED . "The given Custom Tools does not exist!");
        }

        $item = $tool->getTool();
        if (!$target->getInventory()->canAddItem($item)) {
            $sender->sendMessage(TextFormat::RED . "You cannot give the " . $tool->getCustomName() . TextFormat::RED . " to " . ($target === $sender ? "yourself" : $target->getName()) . " for unknown reasons!");
            return;
        }
        $target->getInventory()->addItem($item);
        $sender->sendMessage(TextFormat::GREEN . "Successfull gave " . $tool->getCustomName() . TextFormat::GREEN . " to " . ($target === $sender ? "yourself" : $target->getName()) . ".");
        if ($target !== $sender) {
            $target->sendMessage(TextFormat::GREEN . "You received " . $tool->getCustomName() . TextFormat::GREEN . " from " . $sender->getName() . ".");
        }
    }

}