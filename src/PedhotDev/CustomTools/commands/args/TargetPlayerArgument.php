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
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use function is_null;
use function preg_match;
use function strtolower;

class TargetPlayerArgument extends BaseArgument {
    public function __construct(bool $optional = false, ?string $name = null){
        $name = is_null($name) ? "player" : $name;

        parent::__construct($name, $optional);
    }

    public function getTypeName(): string{
        return "target";
    }

    public function getNetworkType(): int{
        return AvailableCommandsPacket::ARG_TYPE_TARGET;
    }

    public function canParse(string $testString, CommandSender $sender): bool{
        return (bool) preg_match("/^(?!rcon|console)[a-zA-Z0-9_ ]{1,16}$/i", $testString);
    }

    public function parse(string $argument, CommandSender $sender): mixed{
        return strtolower($argument);
    }
}