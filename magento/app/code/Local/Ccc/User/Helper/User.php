<?php
class Ccc_User_Helper_User extends Mage_Core_Helper_Abstract {

	public function getAttributeInputTypes($inputType = null) {
		$inputTypes = [
			'multiselect' => [
				'backend_model' => 'eav/entity_attribute_backend_array',
				'source_model' => 'eav/entity_attribute_source_table',
			],
			'boolean' => [
				'source_model' => 'eav/entity_attribute_source_boolean',
			],
		];

		if (is_null($inputType)) {
			return $inputTypes;
		} else if (isset($inputTypes[$inputType])) {
			return $inputTypes[$inputType];
		}
		return null;
	}

	public function getAttributeBackendModelByInputType($inputType) {
		$inputTypes = $this->getAttributeInputTypes();

		if (!empty($inputTypes[$inputType]['backend_model'])) {
			return $inputTypes[$inputType]['backend_model'];
		}
		return null;
	}

	public function getAttributeSourceModelByInputType($inputType) {
		$inputTypes = $this->getAttributeInputTypes();

		if (!empty($inputTypes[$inputType]['source_model'])) {
			return $inputTypes[$inputType]['source_model'];
		}
		return null;
	}

}