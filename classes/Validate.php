<?php
/**
* Deals with validation
*/
class Validate {
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = array()) {

		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				//print("$item must be $rule of $rule_value <br>");
				$value = $source[$item];
				if ($rule === 'required' && empty($value)) {

					$this->addError("$item is required");
				} else if (!empty($value)) {
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("$item must be a minimum of $rule_value characters");
							}
							break;
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("$item must not exceed $rule_value characters");
							}
							break;
						case 'matches':
							if ($value !== $source[$rule_value]) {
								$this->addError("The {$rule_value}'s must match");
							}
							break;
						case 'unique':
							$check = $this->_db->get($rule_value, array($item,'=', $value)); 
							if ($check->count()) {
								$this->addError("$item is already taken.");
							}
							break;
						
						default:
							break;
					}
				}
			}
		}
		if (empty($this->errors())) {
			$this->_passed = true;
		} 

		return $this;
	}
	
	public function addError($string){		 
		array_push($this->_errors, $string);
	}

	public function errors() {
		return $this->_errors;
	}

	public function passed() {
		return $this->_passed;
	}
}
?>