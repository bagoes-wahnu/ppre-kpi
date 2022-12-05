<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UnitRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = 'The :attribute no valid.';
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
        $user = User::find($value);

        if (!$user) {
            $this->message = ':attribute tidak tersedia.';

            return false;
        }

        $roles = [
            3, // Korporat
            4, // Unit
        ];

        if (!in_array($user->role_id, $roles)) {
            $this->message = ':attribute role tidak valid.';

            return false;
        }

        $role = $user->role_id == 4;

        if (boolval($role)) {
            if (empty($user->unit) && empty($user->atasan)) {
                $this->message = ':attribute tidak memiliki unit dan atasan.';

                return false;
            }

            if (empty($user->unit)) {
                $this->message = ':attribute tidak memiliki unit.';

                return false;
            }

            if (empty($user->atasan)) {
                $this->message = ':attribute tidak memiliki atasan.';

                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
