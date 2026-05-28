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

    public User $user { get => User::selectById($this->userId); }
    public Role $role { get => Role::selectById($this->roleId); }

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

    public static function selectAllByUserIdAndStatus(int $userId, string $status) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`userId` = ? AND `$table`.`status` = ?";
        $sttmt = static::run($sql, [$userId, $status]);
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

    /**
     *
     * @param integer $roleId
     * @return RoleRequest[]
     */
    public static function selectAllByRoleIdAndStatus(int $roleId, string $status) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "WHERE `$table`.`roleId` = ? AND `$table`.`status` = ?";
        $sttmt = static::run($sql, [$roleId, $status]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function insert(int $userId, int $roleId, string $message) {
        $sql = static::getInsertQuery();
        static::run($sql, [$roleId, $userId, $message]);
        return static::selectByUserAndRole($userId, $roleId);
    }

    public function update() {
        $table = $this->getTable();
        $sql = "UPDATE `$table` SET `status` = ?, `message` = ? WHERE `$table`.`userId` = ? AND `$table`.`roleId` = ?";
        static::run($sql, [
            $this->status,
            $this->message,
            $this->userId,
            $this->roleId
        ]);
    }
}