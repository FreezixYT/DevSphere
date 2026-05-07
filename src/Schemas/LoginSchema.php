<?php
namespace DevSphere\Schemas;

use PHPUtils\Attributes\Validators as VA;
use PHPUtils\Attributes\Property;

use PHPUtils\BaseSchema;

class LoginSchema extends BaseSchema {

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Max(255)]
    public string $email;

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Max(255)]
    public string $password;
}