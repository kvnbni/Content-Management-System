<?php 
	$errors=array();
	function field_name_as_text($field_name)
	{
		$field_name=str_replace("_"," ",$field_name);
		$field_name=ucfirst($field_name);
		return $field_name;
	}
	function has_presence($value)
	{
		$value=trim($value); //We trim the input of any spaces so that a string with just spaces do not pass through. Note that trim only removes white spaces from the left and right 
		                       //of a string and not from the middle.
		return isset($value) && $value!=="";   //We check if the value is set and if the value is not an empty string
	}	
	
	function validate_presences($required_fields)
	{
		global $errors;
		foreach($required_fields as $field)
		{
			$value=trim($_POST[$field]);
			if(!has_presence($value))
			{
				$errors[$field]=field_name_as_text($field). " not present";
			}
		}
	}
	
	function is_length_ok($value,$max)
	{
		return strlen($value) <= $max ;
	}
	
	function validate_max_lengths($fields_with_max_lengths)
	{
		global $errors;
		//Expects an assoc. array
		foreach($fields_with_max_lengths as $field => $max)
		{
			$value=trim($_POST[$field]);
			if(!is_length_ok($value,$max))
			{
				$errors[$field]=field_name_as_text($field). " is too long";
			}
		}
	}
	
	function has_inclusion_in($value,$set)
	{
		return in_array($value,$set);
	}
	
	
?>