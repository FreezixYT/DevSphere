<?php
namespace DevSphere\Schemas;

use PHPUtils\Attributes\Property;
use PHPUtils\BaseSchema;

class CreateRole extends BaseSchema{
    #[Property]
    public string $name;
    #[Property]
    public string $description;
    #[Property]
    public array $tags;
}