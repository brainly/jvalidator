<?php

/*
 * This file is part of the JValidator library.
 *
 * (c) Łukasz Lalik <lukasz.lalik@brainly.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Brainly\JValidator\Constraints;

use Brainly\JValidator\Validator;
use Brainly\JValidator\Constraints\Constraint;

/**
 * Constraint for validating numbers
 */
class NumberConstraint implements Constraint
{
    /**
     * Performs validation of given element.
     *
     * @param Validator $validator  Instance of Validator to perform recursive validation
     * @param mixed     $element    Element to validate against schema
     * @param object    $schema     Part of Schema that validates given element
     * @param string    $myName     Name of validated element
     * @param array     $errors     Array of currently gathered errors
     * @return array    Currently gathered errors
     */
    public function check(Validator $validator, $element, $schema, $myName, array $errors)
    {
        if (!is_numeric($element) || is_string($element)) {
            $errors[$myName][] = 'must be a number';
            return $errors;
        }
        
        if (isset($schema->minimum)) {
            if ($element == $schema->minimum) {
                if (isset($schema->exclusiveMinimum)) {
                    if ($schema->exclusiveMinimum) {
                        $errors[$myName][] = 'must be exclusively greater than '.$schema->minimum;
                    }
                }
            } else if ($element < $schema->minimum) {
                $errors[$myName][] = 'must be greater than '.$schema->minimum;
            }
        }
        
        if (isset($schema->maximum)) {
            if ($element > $schema->maximum) {
                $errors[$myName][] = 'must be less than '.$schema->maximum;
            }
        }
        
        if (isset($schema->enum) && !in_array($element, $schema->enum)) {
            $errors[$myName][] = 'must have one of the given values: '.join(', ', $schema->enum);
        }

        return $errors;
    }
}
