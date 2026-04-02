<?php
namespace DevSphere\Models;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;


class Project extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::INSERT, DB\Block::UPDATE)]
    public int $id;
    #[DB\Column]
    public string $name;
    #[DB\Column]
    public string $description;
    #[DB\Column, DB\Block(DB\Block::UPDATE)]
    public int $userId;

    #[DB\Column, DB\Block]
    public array $tags { 
        get => Tag::selectAllByProjectId($this->id);
    }
    #[DB\Column, DB\Block]
    public array $roles {
        get => Role::selectAllByProjectId($this->id);
    }

    public static function selectById(int $id) {
        return static::selectBy("id", $id);
    }

    public static function selectByUserId(int $id) {
        return static::selectBy("userId", $id);
    }
}