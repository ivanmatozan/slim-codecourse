<?php

namespace App\Models;

class User
{
    public function fullName(): string
    {
        if ($this->last_name === null) {
            return $this->first_name;
        }

        return "{$this->first_name} {$this->last_name}";
    }

    public function getFormattedBalance(): string
    {
        if ($this->balance === null) {
            return 'Zero funds';
        }

        return '$' . number_format($this->balance, 2);
    }
}