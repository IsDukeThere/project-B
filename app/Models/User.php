<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'phone', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function initials(): Attribute
    {
        return Attribute::make(
            get: function () {
                $words = explode(' ', $this->name);
                $initials = '';
                
                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                }

                return substr($initials, 0, 2);
            }
        );
    }

    public function deposits() {
        return $this->hasMany(Deposit::class);
    }
}
