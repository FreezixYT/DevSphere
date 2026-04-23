<?php
namespace DevSphere\Schemas;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;
use PHPUtils\Attributes\Validators as VA;
use PHPUtils\Attributes\Property;

use PHPUtils\BaseSchema;

class RegisterSchema extends BaseSchema {

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Max(100)]
    public string $firstname;

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Max(100)]
    public string $lastname;

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Max(20)]
    public string $pseudo;

    #[Property, VA\Filter(FILTER_VALIDATE_EMAIL), VA\Max(255)]
    public string $email;

    #[Property, VA\Max(255)]
    public string $password;
}