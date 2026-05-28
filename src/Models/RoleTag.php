<?php
namespace DevSphere\Models;

use PHPUtils\Attributes\DB;
use PHPUtils\BaseModel;

class RoleTag extends BaseModel {
    #[DB\Column]
    public int $roleId;
    #[DB\Column]
    public int $tagId;

    public static function create(int $roleId, int $tagId) {
        $link = new RoleTag();
        $link->roleId = $roleId;
        $link->tagId = $tagId;
        return $link;
    }

    public function insert() {
        $sql = static::getInsertQuery();
        static::run($sql, [
            $this->roleId,
            $this->tagId
        ]);
    }
}