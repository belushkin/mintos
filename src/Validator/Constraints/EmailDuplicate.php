<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EmailDuplicate extends Constraint
{
    public $message = 'User with such email "{{ string }}" already exists.';
}
