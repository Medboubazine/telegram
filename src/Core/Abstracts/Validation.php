<?php

namespace Medboubazine\Telegram\Core\Abstracts;

use Medboubazine\Telegram\Core\Helpers\Validator;

abstract class Validation
{
    /**
     * Undocumented variable
     *
     * @var object|null
     */
    protected ?object $validation;
    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $validator = new Validator();
        $validation = $validator->make($data, $this->rules());

        $validation->validate();

        $this->validation = $validation;
    }
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
    /**
     * Errors
     *
     * @return array
     */
    public function errors(): array
    {
        return ($this->validation) ? $this->validation->errors()->firstOfAll() : [];
    }
    /**
     * Errors
     *
     * @return bool
     */
    public function passed(): bool
    {
        return ($this->validation) ? !$this->validation->fails() : true;
    }
}
