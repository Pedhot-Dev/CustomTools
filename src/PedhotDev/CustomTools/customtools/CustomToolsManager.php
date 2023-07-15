<?php

namespace PedhotDev\CustomTools\customtools;

use PedhotDev\CustomTools\Main;

class CustomToolsManager
{

    public function __construct()
    {
        $this->registerAll();
    }

    private array $tools = [];

    public function isRegistered(string $toolName): bool {
        return isset($this->tools[str_replace(" ", "_", $toolName)]);
    }

    public function registerTools(string $toolName, array $properties): bool {
        if ($this->isRegistered($toolName)) {
            return false;
        }
        $this->tools[str_replace(" ", "_", $toolName)] = new CustomTools(
            toolName: $toolName,
            type: $properties["type"] ?? "sword",
            tier: $properties["tier"] ?? "wooden",
            isGlint: $properties["glint"] ?? true,
            durability: $properties["durability"] ?? 0,
            miningEfficiency: $properties["mining-efficiency"] ?? 9,
            attackPoints: $properties["attack-points"] ?? 9,
            customName: $properties["name"] ?? "&aExample Sword",
            lores: $properties["lore"] ?? []
        );
        return true;
    }

    public function unregisterTools(string $toolName): bool {
        if (!$this->isRegistered($toolName)) return false;
        unset($this->tools[str_replace(" ", "_", $toolName)]);
        return true;
    }

    public function editTools(string $toolName, array $properties): bool {
        if (!$this->isRegistered($toolName)) return false;
        if (!$this->unregisterTools($toolName)) return false;
        return $this->registerTools($toolName, $properties);
    }

    public function getCustomTools(string $toolName): ?CustomTools {
        if (!$this->isRegistered($toolName)) {
            return null;
        }
        return $this->tools[str_replace(" ", "_", $toolName)];
    }

    public function registerAll(): void {
        foreach (Main::getInstance()->getToolsConfig()->getAll() as $toolName => $properties) {
            if ($this->registerTools($toolName, $properties)) {
                Main::getInstance()->getLogger()->debug("Success registering " . $toolName . " as a custom tools!");
            }else {
                Main::getInstance()->getLogger()->debug("Failed registering " . $toolName . ", cuz " . $toolName . " already registered!");
            }
        }
    }

    /**
     * @return CustomTools[]
     */
    public function getAll(): array {
        return $this->tools;
    }

}