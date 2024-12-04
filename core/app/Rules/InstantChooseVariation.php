<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InstantChooseVariation implements Rule
{
    protected $maxTickets;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($maxTickets)
    {
        $this->maxTickets = $maxTickets;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $maxVarNum = max(explode(',', $value));
        return $maxVarNum <= $this->maxTickets;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Instant Choose Variation must be less than or equal to ' . $this->maxTickets . '.';
    }
}
