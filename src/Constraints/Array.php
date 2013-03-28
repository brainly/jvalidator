<?php

namespace JValidator\Constraint;
use JValidator\Validator;

require_once 'Constraint.php';

class ArrayConstraint extends Constraint {
	
	function check($element, $schema, $myName, $errors) {
		if(!is_array($element)) {
			$errors[$myName][] = 'is not an array';
			return $errors;
		}
				
		$itemsSchema = $schema->items;
		
		if(isset($schema->minItems)) {
			$minItems = $schema->minItems;
		} else {
			$minItems = 0;
		}

		if(isset($schema->maxItems)) {
			$maxItems = $schema->maxItems;
		} else {
			$maxItems = PHP_INT_MAX;
		}
		
		if(count($element) < $minItems) {
			$errors[$myName][] = 'must have at last '.$minItems.' items';
			return $errors;
		}

		if(count($element) > $maxItems) {
			$errors[$myName][] = 'must have at most '.$maxItems.' items';
			return $errors;
		}

		if(isset($schema->uniqueItems) && $schema->uniqueItems) {
			$count1 = count($element);
			$count2 = count(array_unique($element, SORT_REGULAR));
			if($count1 != $count2) {
				$errors[$myName][] = 'items must be unique';
			}
		}
		
		$i = 0;
		foreach($element as $item) {
			$errors = $this->checkArrayItems($item, $itemsSchema, $myName.'.'.$i, $errors);
			$i++;
		}
		return $errors;
	}
	
	function checkArrayItems($item, $schema, $myName, $errors) {
		return Validator::check($item, $schema, $myName, $errors);
	}
	
}
