<?php

/*
 * This file is part of the JValidator library.
 *
 * (c) Łukasz Lalik <lukasz.lalik@brainly.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Brainly\JValidator;

/**
 * Specification of fields that can be used in schemas.
 */
class SchemaSpec
{
    public static function getAllowedTypes()
    {
        return [
            "string",
            "number",
            "integer",
            "boolean",
            "object",
            "array",
            "any",
            "null"
        ];
    }

    public static function getAllowedProperties($type)
    {
        $allowedProperties = [
                "*" => [
                    "type",
                    "required",
                    "id",
                    "value"
                ],
                "string" => [
                    "pattern",
                    "minLength",
                    "maxLength",
                    "enum",
                    "description",
                    "extends",
                    "id",
                    "format"
                ],
                "number" => [
                    "minimum",
                    "exclusiveMinimum",
                    "maximum",
                    "enum",
                    "description",
                    "extends",
                    "id"
                ],
                "integer" => [
                    "minimum",
                    "exclusiveMinimum",
                    "maximum",
                    "enum",
                    "description",
                    "extends",
                    "id"
                ],
                "boolean" => [
                    "description",
                    "extends",
                    "id"
                ],
                "object" => [
                    "properties",
                    "additionalProperties",
                    "description",
                    "extends",
                    "id"
                ],
                "array" => [
                    "items",
                    "minItems",
                    "maxItems",
                    "description",
                    "extends",
                    "id",
                    "uniqueItems"
                ],
                "any" => [
                    "description",
                    "extends",
                    "id",
                    "properties"
                ],
                "null" => []
            ];

        return array_merge($allowedProperties[$type], $allowedProperties["*"]);
    }

    public static function getDefault($key)
    {
        $defaults = ["type" => "any"];
        return $defaults[$key];
    }
}
