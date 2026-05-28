<?php
namespace DevSphere\Schemas;

use PHPUtils\Attributes\Property;
use PHPUtils\BaseSchema;

class CreateRole extends BaseSchema{
    #[Property]
    public string $roleName;
    #[Property]
    public string $roleDescription;
}