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

namespace PedhotDev\CustomTools\items;

use PedhotDev\CustomTools\Main;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Shovel as PmShovel;
use pocketmine\item\TieredTool;

class Shovel extends PmShovel
{

    public function __construct(TieredTool $tool)
    {
        $identifier = new ItemIdentifier($tool->getTypeId());
        parent::__construct($identifier, $tool->getName(), $tool->getTier());
    }

    public function getMaxDurability(): int
    {
        if (($nbt = $this->getNamedTag()->getTag("customtools")) !== null) {
            $toolName = $nbt->getValue();
            $customTools = Main::getInstance()->getCustomToolsManager()->getCustomTools($toolName);
            return ($customTools->getDurability() == 0 ? 1 : $customTools->getDurability());
        }
        return parent::getMaxDurability(); // TODO: Change the autogenerated stub
    }

    public function isUnbreakable(): bool
    {
        if (($nbt = $this->getNamedTag()->getTag("customtools")) !== null) {
            $toolName = $nbt->getValue();
            $customTools = Main::getInstance()->getCustomToolsManager()->getCustomTools($toolName);
            return ($customTools->getDurability() == 0);
        }
        return parent::isUnbreakable(); // TODO: Change the autogenerated stub
    }

    protected function getBaseMiningEfficiency(): float
    {
        if (($nbt = $this->getNamedTag()->getTag("customtools")) !== null) {
            $toolName = $nbt->getValue();
            $customTools = Main::getInstance()->getCustomToolsManager()->getCustomTools($toolName);
            return $customTools->getMiningEfficiency();
        }
        return parent::getBaseMiningEfficiency(); // TODO: Change the autogenerated stub
    }

    public function getAttackPoints(): int
    {
        if (($nbt = $this->getNamedTag()->getTag("customtools")) !== null) {
            $toolName = $nbt->getValue();
            $customTools = Main::getInstance()->getCustomToolsManager()->getCustomTools($toolName);
            return $customTools->getAttackPoints();
        }
        return parent::getAttackPoints(); // TODO: Change the autogenerated stub
    }

}