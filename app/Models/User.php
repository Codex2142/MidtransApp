<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use LogsActivity;

    // nama tabel
    protected $table = 'users';

    // Nama judul tabel
    public $tableHead = 'Pengguna';

    // nama kolom yang bisa di CRUD
    protected $fillable = [
        'name',
        'email',
        'role',
        'gold',
        'diamond',
        'skin',
        'password',
    ];

    // Generator Tabel
    public static function labelling(){
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'role' => 'Role',
            'Gold' => 'Gold',
            'Diamond' => 'Diamond',
        ];
    }

    // Generator Rule
    public static function rules()
    {
        return [
            'name' => 'required|max:40',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'gold' => 'required',
            'diamond' => 'required',
            'skin' => 'nullable',
            'password' => 'required'


        ];
    }

    // Rule error message
    public static function message()
    {
        return [
            'name.required' => 'Nama wajib diisi!',
            'name.max' => 'Nama maksimal 40 karakter!',

            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email sudah terdaftar!',

            'role.required' => 'Role wajib dipilih!',

            'gold.required' => 'Jumlah Gold wajib diisi!',

            'diamond.required' => 'Jumlah Diamond wajib diisi!',

            'password.required' => 'Password wajib diisi!',
        ];
    }

    // Mencatat Log CRUD
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'role', 'gold', 'diamond'])
            ->useLogName('user')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "User {$eventName}");
    }


    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
}
