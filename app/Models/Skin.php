<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Skin extends Model
{
    use LogsActivity;

    // nama tabel
    protected $table = 'skins';

    // Nama judul tabel
    public $tableHead = 'Daftar Skin';

    // nama kolom yang bisa di CRUD
    protected $fillable = [
        'name',
        'price',
        'rarity',
        'point',
        'photo',
    ];

    // Generator Tabel
    public static function labelling(){
        return [
            'name' => 'Nama Skin',
            'price' => 'Harga',
            'rarity' => 'Rarity',
            'point' => 'Poin koleksi',
            'photo' => 'Foto',
        ];
    }

    // Generator Rule
    public static function rules()
    {
        return [
            'name' => 'required|max:40',
            'price' => 'required|min:0',
            'rarity' => 'required',
            'point' => 'required',
            'photo' => 'required',


        ];
    }

    // Rule error message
    public static function message(){
        return [
        'name.required' => 'Nama wajib Disii!',
        'name.max' => 'Maksimal 40 Huruf!',

        'price.required' => 'harga wajib diisi',
        'price.min' => 'Harga minimal 0!',

        'rarity.required' => 'Rarity Mulai Wajib diisi!',
        'point.required' => 'Poin Koleksi Mulai Wajib diisi!',

        'photo.required' => 'Foto Mulai Wajib diisi!',
        ];
    }

    // Mencatat Log CRUD
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'price', 'rarity', 'point', 'photo'])
            ->useLogName('skin')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Skin {$eventName}");
    }
}
