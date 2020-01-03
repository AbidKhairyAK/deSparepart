<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'last_login', 'role_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function can($ability, $arguments = [])
    {
        if (is_array($ability)) {
            foreach ($ability as $permName) {
                if ($this->can($permName)) {
                    return true;
                }
            }
            return false;
        } else {
            foreach ($this->role->permissions()->get() as $perm) {
                if ($ability == $perm->slug ) {
                    return true;
                }
            }
            return false;
        }
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
