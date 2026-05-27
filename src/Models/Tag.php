<?php
namespace DevSphere\Models;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;

class Tag extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::INSERT, DB\Block::UPDATE)]
    public int $id;
    #[DB\Column]
    public string $name;

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
        $sql .= "JOIN `UserTag` ON 
            `UserTag`.`tagId` = $table.`id`
            WHERE `UserTag`.`userId` = ?;";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    /**
     * @param integer $id
     * @return Tag[]
     */
    public static function selectAllByProjectId(int $id): array {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "JOIN `ProjectTag` ON 
            `ProjectTag`.`tagId` = $table.`id`
            WHERE `ProjectTag`.`projectId` = ?;";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
    /**
     * @param integer $id
     * @return Tag[]
     */
    public static function selectAllByRoleId(int $id): array {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "JOIN `RoleTag` ON 
            `RoleTag`.`tagId` = $table.`id`
            WHERE `RoleTag`.`roleId` = ?;";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}