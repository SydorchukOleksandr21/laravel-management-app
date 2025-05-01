<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class User
 *
 * Represents a user in the system.
 *
 * @package App\Models
 *
 * @property string name
 * @property string email
 * @property string password
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
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

    /**
     * Get the positions associated with the user.
     * Defines a many-to-many relationship between User and Position.
     * @return BelongsToMany
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'user_positions', 'user_id', 'position_id');
    }

    /**
     * @param string $positionName
     * @return bool
     */
    public function hasPosition(string $positionName): bool
    {
        return $this->positions()->get()->contains('name', $positionName);
    }

    /**
     * @param Position $position
     * @return void
     */
    public function assignPosition(Position $position): void
    {
        if (!$this->hasPosition($position)) {
            $this->positions()->attach($position);
        }
    }

    /**
     * @param Position $position
     * @return void
     */
    public function removePosition(Position $position): void
    {
        if ($this->hasPosition($position)) {
            $this->positions()->detach($position);
        }
    }

    /**
     * @param array $roles
     * @return bool
     */
    public function hasRole(array $roles): bool
    {
        return $this->positions()->whereIn('name', $roles)->exists();
    }

    /**
     * @return bool
     */
    public function hasAnyRole(): bool
    {
        return $this->positions()->exists();
    }
}
