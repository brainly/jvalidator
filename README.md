# JValidator
[![Build Status](https://travis-ci.org/brainly/jvalidator.png?branch=master)](https://travis-ci.org/brainly/jvalidator)

JSON Schema validation library for [draft v3](http://tools.ietf.org/search/draft-zyp-json-schema-03)
- Builds JSON Schemas and checks their syntax
- Validates JSON's against schemas

## Implemented features
- types: `array`, `boolean`, `integer`, `null`, `number`, `object`, `string`, `union`
- constraints: `type`, `properties`, `additionalProperties`, `items`, `required`, `minimum`, `exclusiveMinimum`, `maximum`, `minItems`, `maxItems`, `uniqueItems`, `pattern`, `minLength`, `maxLength`, `enum`
- other: `description`, `id`, `extends`

# Usage

## JSON validation

```
use Brainly\JValidator\Validator;

$schema = '{...}';
$json = '{...}';

$validator = new Validator();
$validator->validate($json, $schema);

echo "Validation result: " . $validator->getResultCode() . "\n";
print_r($validator->getValidationErrors());
```

## Schema building

```
use Brainly\JValidator\SchemaProvider;

$provider = new SchemaProvider(__DIR__ . '/SchemaDir');

try {
    $schema = $provider->getSchema("test.jsonschema");
} catch (Brainly\JValidator\SchemaProviderException $e) {
    die("Can not read schema from file. " . $e->getMessage());
} catch (Brainly\JValidator\SchemaBuilderException $e) {
    die("Invalid schema. " . $e->getMessage());
}
```

## Analyzing validation results
Following functions can be used to obtain validation results:
- `Validator::getResultCode()` returns: 
  - `0` - validation passed
  - `1` - validation passed, but JSON has been changed (not implemented yet)
  - `2` - JSON is not valid regarding to schema
  - `3` - validation has not been performed yet
- `Validator::getValidationErrors()` returns associative array with errors for each property e.g. `Array ("property" => "error message")`

# About
## Author
Łukasz Lalik for Brainly - lukasz.lalik@brainly.com - https://twitter.com/LukaszLalik  
See also the list of [contributors](/contributors) which participated in this project.

## License
JValidator is licensed under the BSD-3 License - see the `LICENSE` file for details.
