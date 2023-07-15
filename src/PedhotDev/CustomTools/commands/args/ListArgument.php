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