# CustomTools
Tools customizer for PocketMine-MP V5

## Commands & Permission
| Command       | Permission               | Usage                             | Description                 | Default |
|---------------|--------------------------|-----------------------------------|-----------------------------|---------|
| /ctools give  | customtools.command.give | /ctools give <tool name> <player> | Give custom tools to player | OP      |
| /ctools list  | customtools.command.list | /ctools list                      | List of custom tools        | OP      |

## Registering Custom Tools API
```php
// Import
use PedhotDev\CustomTools\Main;

$customTools = [
    "type" => "hoe",
    "tier" => "netherite",
    "glint" => true,
    "durability" => 0,
    "mining-efficiency" => 10,
    "attack-points" => 1000,
    "name" => "ExampleHoe",
    "lore" => [
        "ExampleHoe"
    ]
];
Main::getInstance()->getCustomToolsManager()->registerTools("Tools_Name", $customTools)
```

## TODO List
- [ ] Create and edit tools inside game
- [ ] Custom Tools craft
- [ ] Fix mining speed
- [ ] Fix glint