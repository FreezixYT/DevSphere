<?php
namespace DevSphere\Models;

use DateTime;
use DevSphere\Enums\UserType;
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
    #[DB\Column("type")]
    private string $_type;
    #[DB\Column("createdAt")]
    private string $_createdAt;
    #[DB\Column, DB\Block]
    public array $tags {
        get => Tag::selectAllByUserId($this->id);
    }
    #[DB\Column, DB\Block]
    public array $roles {
        get => Role::selectAllByUserId($this->id);
    }
    
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
}