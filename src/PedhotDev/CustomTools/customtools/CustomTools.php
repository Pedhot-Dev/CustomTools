<?php

namespace PedhotDev\CustomTools\customtools;

use PedhotDev\CustomTools\utils\Utils;
use pocketmine\item\Tool;
use pocketmine\nbt\tag\ListTag;
use pocketmine\utils\TextFormat;

class CustomTools
{

    public function __construct(
        private string $toolName,
        private string $type = "",
        private string $tier = "",
        private bool $isGlint = false,
        private int $durability = 0,
        private int $miningEfficiency = 0,
        private int $attackPoints = 0,
        private string $customName = "",
        private array $lores = [],
    )
    {
    }

    public function getTool(): Tool {
        $tool = Utils::getToolFromTypeAndTier($this->type, $this->tier);
        $tool->setCustomName(TextFormat::colorize("&r" . $this->customName));

        if ($this->isGlint) $tool->getNamedTag()->setTag("ench", new ListTag());
        $tool->getNamedTag()->setString("customtools", $this->toolName);

        $tool->setLore(Utils::replaceLore($this->lores));
        return $tool;
    }

    /**
     * @return string
     */
    public function getToolName(): string
    {
        return $this->toolName;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTier(): string
    {
        return $this->tier;
    }

    /**
     * @param string $tier
     */
    public function setTier(string $tier): void
    {
        $this->tier = $tier;
    }

    /**
     * @return bool
     */
    public function isGlint(): bool
    {
        return $this->isGlint;
    }

    /**
     * @param bool $isGlint
     */
    public function setIsGlint(bool $isGlint): void
    {
        $this->isGlint = $isGlint;
    }

    /**
     * @return int
     */
    public function getDurability(): int
    {
        return $this->durability;
    }

    /**
     * @param int $durability
     */
    public function setDurability(int $durability): void
    {
        $this->durability = $durability;
    }

    /**
     * @return int
     */
    public function getMiningEfficiency(): int
    {
        return $this->miningEfficiency;
    }

    /**
     * @param int $miningEfficiency
     */
    public function setMiningEfficiency(int $miningEfficiency): void
    {
        $this->miningEfficiency = $miningEfficiency;
    }

    /**
     * @return int
     */
    public function getAttackPoints(): int
    {
        return $this->attackPoints;
    }

    /**
     * @param int $attackPoints
     */
    public function setAttackPoints(int $attackPoints): void
    {
        $this->attackPoints = $attackPoints;
    }

    /**
     * @return string
     */
    public function getCustomName(): string
    {
        return $this->customName;
    }

    /**
     * @param string $customName
     */
    public function setCustomName(string $customName): void
    {
        $this->customName = $customName;
    }

    /**
     * @return array
     */
    public function getLores(): array
    {
        return $this->lores;
    }

    /**
     * @param array $lores
     */
    public function setLores(array $lores): void
    {
        $this->lores = $lores;
    }

}