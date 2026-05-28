<?php
namespace DevSphere\Models;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;
use PHPUtils\Attributes\DB\Hidden;

class Role extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::INSERT, DB\Block::UPDATE)]
    public int $id;
    #[DB\Column]    
    public string $name;
    #[DB\Column]    
    public string $description;
    #[DB\Column, DB\Block(DB\Block::UPDATE)]
    public int $projectId;
    /** @var User[] */
    #[DB\Column, DB\Block, Hidden]
    public array $users {
        get => User::selectAllByRoleId($this->id);
    }
     /** @var Tag[] */
    #[DB\Column, DB\Block]
    public array $tags { 
        get => Tag::selectAllByRoleId($this->id);
    }
    /** @var RoleRequest[] */
    public array $requests { get => RoleRequest::selectAllByRoleId($this->id); }
    public array $pendingRequests { get => RoleRequest::selectAllByRoleIdAndStatus($this->id, "pending"); }

    public static function selectById(int $id) {
        return static::selectBy("id", $id);
    }

    /**
     * @param integer $id
     * @return Tag[]
     */
    public static function selectAllByUserId(int $id): array {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "JOIN `UserRole` ON 
            `UserRole`.`roleId` = $table.`id`
            WHERE `UserRole`.`userId` = ?;";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    /**
     * @param integer $id
     * @return static[]
     */
    public static function selectAllByProjectId(int $id): array {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`projectId` = ?";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}