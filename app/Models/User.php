<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsers(string | null $search = null)
    {
        $users = $this->where(function ($query) use ($search) {
            if ($search) {
                $query->where('email', $search);   // com mais de um filtro
                $query->orWhere('name', 'LIKE', "%{$search}%");
            }
        })
        ->with('comments')
        ->paginate(15);
        return $users;
    // Seria mais sofisticado se tivesse também:
    //public function storeUser(){}
    //public function upDateUser(){}
    }
    // relacionamento 1 para n
    public function comments()
    {
        return $this->hasMany(Comment::class); // os parametros de foreign key e local key já estão sendo inseridos por default
    }

}
