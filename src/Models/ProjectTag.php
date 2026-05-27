<?php
namespace DevSphere\Models;

use PHPUtils\Attributes\DB;
use PHPUtils\BaseModel;

class ProjectTag extends BaseModel {
    #[DB\Column]
    public int $projectId;
    #[DB\Column]
    public int $tagId;

    public static function create(int $projectId, int $tagId) {
        $link = new ProjectTag();
        $link->projectId = $projectId;
        $link->tagId = $tagId;
        return $link;
    }

    public function insert() {
        $sql = static::getInsertQuery();
        static::run($sql, [
            $this->projectId,
            $this->tagId
        ]);
    }
}