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
    #[DB\Column, DB\Block(DB\Block::UPDATE), DB\Hidden]
    public int $userId;

    #[DB\Column, DB\Block]
    public User $owner {
        get => User::selectById($this->userId);
        set => $this->userId = $value->id;
    }

    /** @var Tag[] */
    #[DB\Column, DB\Block]
    public array $tags { 
        get => Tag::selectAllByProjectId($this->id);
    }
    /** @var Role[] */
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

    public static function selectAllByUserId(int $id) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.userId = ?";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}