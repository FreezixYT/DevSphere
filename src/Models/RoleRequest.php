<?php
namespace DevSphere\Models;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;

class RoleRequest extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::UPDATE)]
    public int $roleId;
    #[DB\Column, DB\Block(DB\Block::UPDATE)]
    public int $userId;
    #[DB\Column]
    public string $message;
    #[DB\Column, DB\Block(DB\Block::INSERT)]
    public string $status;
    #[DB\Column, DB\Block(DB\Block::UPDATE, DB\Block::INSERT)]
    public string $createdAt;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value)
            $this->$key = $value;
    }

    /**
     *
     * @param integer $userId
     * @param integer $roleId
     * @return RoleRequest|false
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
     * @return RoleRequest[]
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
     * @return RoleRequest[]
     */
    public static function selectAllByRoleId(int $roleId) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`roleId` = ?";
        $sttmt = static::run($sql, [$roleId]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function insert(int $userId, int $roleId, string $message) {
        $sql = static::getInsertQuery();
        static::run($sql, [$roleId, $userId, $message]);
        return static::selectByUserAndRole($userId, $roleId);
    }
}