<?php
namespace DevSphere\Schemas;

use PHPUtils\BaseModel;
use PHPUtils\Attributes\DB;
use PHPUtils\Attributes\Validators as VA;
use PHPUtils\Attributes\Property;

use PHPUtils\BaseSchema;

class LoginSchema extends BaseSchema {

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Max(20)]
    public string $username;

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Max(255)]
    public string $password;
}