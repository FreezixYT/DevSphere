<?php
namespace DevSphere\Models;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB; 

class Role extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::INSERT, DB\Block::UPDATE)]
    public int $id;
    #[DB\Column]    
    public string $name;
    #[DB\Column]    
    public string $description;
    #[DB\Column, DB\Block(DB\Block::UPDATE)]
    public int $projectId;

    public static function selectById(int $id) {
        return parent::selectBy("", $id);
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
     * @return Tag[]
     */
    public static function selectAllByProjectId(int $id): array {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`projectId` = ?";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}