<?php
namespace DevSphere\Schemas;

use PHPUtils\Attributes\Validators as VA;
use PHPUtils\Attributes\Property;

use PHPUtils\BaseSchema;

class UpdateSchema extends BaseSchema {


    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Min(2), VA\Max(100)]
    public string $firstname;

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Min(2), VA\Max(100)]
    public string $lastname;

    #[Property, VA\Filter(FILTER_SANITIZE_FULL_SPECIAL_CHARS), VA\Min(2), VA\Max(20)]
    public string $pseudo;

    #[Property, VA\Filter(FILTER_VALIDATE_EMAIL), VA\Min(3), VA\Max(255)]
    public string $email;
}