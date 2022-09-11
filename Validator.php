<?php

class Validator
{

    private $field_values = [];

    private $validation_errors = [];

    public function __construct(array $fields)
    {
        $this->field_values = $fields;
    }


    /**
     * Validate the required fields
     *
     * @param array $required_fields
     * @return void
     */
    public function validateRequired(array $required_fields): void
    {
        foreach ($required_fields as $field) {
            if (empty($this->field_values[$field])) {
                $label = $this->label($field);
                $this->validation_errors[$field][] = "{$label} is a required field";
            }
        }
    }


    /**
     * Validate field for string value
     *
     * @param string $field
     * @return void
     */
    public function validateString(string $field): void
    {
        if (!empty($this->field_values[$field])) {
            $label = $this->label($field);
            if (!preg_match('/^[A-z\s\'\-]{2,}$/', $this->field_values[$field])) {
                $this->validation_errors[$field][] = "{$label} must contain at least 2 letters, must not contain numbers or special characters";
            }
        }
    }


    /**
     * Validate field for number value
     *
     * @param string $field
     * @return void
     */
    public function validateNumber(string $field): void
    {
        if (!empty($this->field_values[$field])) {
            $label = $this->label($field);
            if (!preg_match('/^[\d]{1,}$/', $this->field_values[$field])) {
                $this->validation_errors[$field][] = "{$label} must contain only numbers";
            }
        }
    }


    /**
     * Validate email field
     *
     * @param string $field
     * @return void
     */
    public function validateEmail(string $field): void
    {
        if (!empty($this->field_values[$field])) {
            if (!filter_var($this->field_values[$field], FILTER_VALIDATE_EMAIL)) {
                $label = $this->label($field);
                $this->validation_errors[$field][] = "{$label} must be a valid email address.";
            }
        }
    }

    /**
     * Validate postal code
     *
     * @param string $field
     * @return void
     */
    public function validatePostalcode(string $field): void
    {
        if (!empty($this->field_values[$field])) {
            if (!preg_match('/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/', $this->field_values[$field])) {
                $label = $this->label($field);
                $this->validation_errors[$field][] = "{$label} is not valid postal code.";
            }
        }
    }

    /**
     * Validate Phone number
     *
     * @param string $field
     * @return void
     */
    public function validatePhone(string $field): void
    {   
        if (!empty($this->field_values[$field])) {
            if (!preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $this->field_values[$field])) {
                $label = $this->label($field);
                $this->validation_errors[$field][] = "{$label} must be a valid phone number.";
            }
        }
    }

    /**
     * Validate password fields
     *
     * @param string $field
     * @return void
     */
    public function validatePassword(string $field): void
    {   
        if (!empty($this->field_values[$field])) {
            if (!preg_match('/^\S*(?=\S{8,})(?=\S*\d)(?=\S*[A-Z])(?=\S*[a-z])?(?=\S*[!@#$%^&*? ])\S*$/', $this->field_values[$field])) {
                $this->validation_errors[$field][] = 'Password must have minimum 8 character, at least 1 capital letter, and at least 1 special character.';
            }
        }
    }

    /* GETTER METHODS AND UTILITY METHODS
    ----------------------------------------------- */
    /**
     * Getter for validation_errors
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->validation_errors;
    }


    /**
     * Generate human-readable field label
     *
     * @param string $field_name
     * @return string
     */
    private function label(string $field_name): string
    {
        return ucwords(str_replace('_', ' ', $field_name));
    }
}
