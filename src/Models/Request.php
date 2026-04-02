<?php
namespace DevSphere\Models;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;

class Request extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::INSERT, DB\Block::UPDATE)]
    public string $roleId;
    #[DB\Column, DB\Block(DB\Block::INSERT, DB\Block::UPDATE)]
    public string $userId;
    #[DB\Column]
    public string $message;
    #[DB\Column, DB\Block(DB\Block::INSERT)]
    public string $status;
    #[DB\Column, DB\Block]
    public string $createdAt;

    /**
     *
     * @param integer $userId
     * @param integer $roleId
     * @return Request[]
     */
    public static function selectByUserAndRole(int $userId, int $roleId) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`userId` = ? AND `$table`.`roleId` = ?";
        $sttmt = static::run($sql, [$userId, $roleId]);
        return $sttmt->fetchObject(static::class);
    }

     /**
     *
     * @param integer $userId
     * @return Request[]
     */
    public static function selectAllByUserId(int $userId) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`userId` = ?";
        $sttmt = static::run($sql, [$userId]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    } 

     /**
     *
     * @param integer $roleId
     * @return Request[]
     */
    public static function selectAllByRoleId(int $roleId) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`roleId` = ?";
        $sttmt = static::run($sql, [$roleId]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}