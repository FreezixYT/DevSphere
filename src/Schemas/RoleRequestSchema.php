<?php
namespace DevSphere\Schemas;

use PHPUtils\BaseSchema;
use PHPUtils\Attributes\Validators as VA;
use PHPUtils\Attributes\Property;

class RoleRequestSchema extends BaseSchema {
    #[Property, VA\Max(150)]
    public string $message;
}