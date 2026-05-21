<?php
namespace DevSphere\Models;

use DateTime;
use DevSphere\Enums\UserType;
use DevSphere\Schemas\RegisterSchema;
use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;

class User extends BaseModel {
    #[DB\Column, DB\Block(DB\Block::INSERT, DB\Block::UPDATE)]
    public int $id;
    #[DB\Column]
    public string $name;
    #[DB\Column]
    public string $lastname;
    #[DB\Column]
    public string $username;
    #[DB\Column]
    public string $email;
    #[DB\Column, DB\Hidden]
    public string $password;
    #[DB\Column("type"), DB\Block(DB\Block::INSERT)]
    private string $_type;
    #[DB\Column("createdAt"), DB\Block(DB\Block::INSERT)]
    private string $_createdAt;

    #[DB\Column, DB\Block]
    public array $tags {
        get => Tag::selectAllByUserId($this->id);
    }

    private array $_roles = [];

    #[DB\Column, DB\Block]
    public array $roles {
        get {
            if (count($this->_roles) < 1)
                $this->_roles = Role::selectAllByUserId($this->id);
            return $this->_roles;
        }
    }

    public array $projects { get => Project::selectAllByUserId($this->id); }
    
    public DateTime $createAt {
        get => DateTime::createFromFormat("Y-m-d H:i:s", $this->_createdAt);
        set(DateTime|string $value) {
            if ($value instanceof DateTime)
                $value = $value->format("Y-m-d H:i:s");
            $this->_createdAt = $value;
        }
    }

    public UserType $type {
        get => UserType::from($this->_type);
        set(UserType|string $value) {
            if ($value instanceof UserType)
                $value = $value->value;
            $this->_type = $value;
        }
    }
    
    public static function createUser(RegisterSchema $data)
    {
        $table = static::getTable();
        $sql = static::getInsertQuery();
        $params = [$data->firstname, $data->lastname, $data->pseudo, $data->email, password_hash($data->password, PASSWORD_BCRYPT)];
        $sttmt = static::run($sql, $params);
        return static::getDB()->lastInsertId();
    }

    public static function checkEmail(RegisterSchema $data)
    {
        $user = static::findByEmail($data->email);
        return $user !== false;
    }

    public static function findByEmail(string $email)
    {
        return static::selectBy("email", $email);
    }

    public static function getUser(int $id)
    {
        return static::selectBy("id", $id);
    }

    public static function deleteUser(int $id)
    {
        return static::deleteBy("id", $id);
    }

    public static function selectAllByRoleId(int $id) {
        $table = static::getTable();
        $sql = static::getSelectQuery();
        $sql .= "JOIN `UserRole` ON 
            `UserRole`.`roleId` = $table.`id`
            WHERE `UserRole`.`roleId` = ?;";
        $sttmt = static::run($sql, [$id]);
        return $sttmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public function hasRequestedRole(int $id) {
        $request = RoleRequest::selectByUserAndRole($this->id, $id);
        return $request !== false;
    }

    public static function selectById(int $id) {
        return static::selectBy("id", $id);
    }

    /**
     * Undocumented function
     *
     * @return RoleRequest[]
     */
    public function getRoleRequests() {
        $requests = [];
        foreach ($this->projects as $project) {
            foreach (Role::selectAllByProjectId($project->id) as $role) {
                $requests = array_merge($requests, $role->requests);
            }
        }
        return $requests;
    }
}