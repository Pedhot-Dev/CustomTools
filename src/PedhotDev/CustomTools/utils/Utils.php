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

namespace PedhotDev\CustomTools\utils;

use PedhotDev\CustomTools\items\Hoe;
use PedhotDev\CustomTools\items\Pickaxe;
use PedhotDev\CustomTools\items\Shovel;
use PedhotDev\CustomTools\items\Sword;
use pocketmine\item\TieredTool;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;
use function strtolower;

class Utils
{

    public static function getToolFromTypeAndTier(string $type, string $tier): TieredTool {
        return match (strtolower($type)) {
            "pickaxe" => Utils::getPickaxeFromTier($tier),
            "sword" => Utils::getSwordFromTier($tier),
            "shovel" => Utils::getShovelFromTier($tier),
            "hoe" => Utils::getHoeFromTier($tier)
        };
    }

    public static function getPickaxeFromTier(string $tier): Pickaxe {
        return match (strtolower($tier)) {
            "wooden" => new Pickaxe(VanillaItems::WOODEN_PICKAXE()),
            "stone" => new Pickaxe(VanillaItems::STONE_PICKAXE()),
            "golden" => new Pickaxe(VanillaItems::GOLDEN_PICKAXE()),
            "iron" => new Pickaxe(VanillaItems::IRON_PICKAXE()),
            "diamond" => new Pickaxe(VanillaItems::DIAMOND_PICKAXE()),
            "netherite" => new Pickaxe(VanillaItems::NETHERITE_PICKAXE()),
        };
    }

    public static function getSwordFromTier(string $tier): Sword {
        return match (strtolower($tier)) {
            "wooden" => new Sword(VanillaItems::WOODEN_SWORD()),
            "stone" => new Sword(VanillaItems::STONE_SWORD()),
            "golden" => new Sword(VanillaItems::GOLDEN_SWORD()),
            "iron" => new Sword(VanillaItems::IRON_SWORD()),
            "diamond" => new Sword(VanillaItems::DIAMOND_SWORD()),
            "netherite" => new Sword(VanillaItems::NETHERITE_SWORD()),
        };
    }

    public static function getShovelFromTier(string $tier): Shovel {
        return match (strtolower($tier)) {
            "wooden" => new Shovel(VanillaItems::WOODEN_SHOVEL()),
            "stone" => new Shovel(VanillaItems::STONE_SHOVEL()),
            "golden" => new Shovel(VanillaItems::GOLDEN_SHOVEL()),
            "iron" => new Shovel(VanillaItems::IRON_SHOVEL()),
            "diamond" => new Shovel(VanillaItems::DIAMOND_SHOVEL()),
            "netherite" => new Shovel(VanillaItems::NETHERITE_SHOVEL()),
        };
    }

    public static function getHoeFromTier(string $tier): Hoe {
        return match (strtolower($tier)) {
            "wooden" => new Hoe(VanillaItems::WOODEN_HOE()),
            "stone" => new Hoe(VanillaItems::STONE_HOE()),
            "golden" => new Hoe(VanillaItems::GOLDEN_HOE()),
            "iron" => new Hoe(VanillaItems::IRON_HOE()),
            "diamond" => new Hoe(VanillaItems::DIAMOND_HOE()),
            "netherite" => new Hoe(VanillaItems::NETHERITE_HOE()),
        };
    }

    public static function replaceLore(array $lores): array {
        $newLores = [];
        foreach ($lores as $lore) {
            $newLores[] = TextFormat::colorize("&r" . $lore);
        }

        return $newLores;
    }

}