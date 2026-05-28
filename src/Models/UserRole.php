<?php
namespace DevSphere\Models;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;

class UserRole extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::UPDATE)]
    public int $roleId;
    #[DB\Column, DB\Block(DB\Block::UPDATE)]
    public int $userId;

    public function insert(): int {
        $sql = static::getInsertQuery();
        static::run($sql, [
            $this->roleId,
            $this->userId
        ]);
        return static::getDB()->lastInsertId();
    }

    public static function create(int $roleId, int $userId): object {
        $link = new UserRole();
        $link->roleId = $roleId;
        $link->userId = $userId;
        return $link;
    }
}