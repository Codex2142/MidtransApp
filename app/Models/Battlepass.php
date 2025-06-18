<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Battlepass extends Model
{
    use LogsActivity;

    // nama tabel
    protected $table = 'battlepasses';

    // Nama judul tabel
    public $tableHead = 'Item Battlepass';

    // nama kolom yang bisa di CRUD
    protected $fillable = [
        'name',
        'period',
        'skin_id',
    ];

    // Generator Tabel
    public static function labelling(){
        return [
            'name' => 'Nama Battlepass',
            'period' => 'Periode',
            'skin_id' => 'Nama Skin',
        ];
    }

    // Generator Rule
    public static function rules()
    {
        return [
            'name'    => 'required|max:40',
            'period'  => 'required',
            'skin_id' => 'required|exists:skins,id',
        ];
    }

    // Rule error message
    public static function message(){
        return [
        'name.required' => 'Nama wajib Disii!',
        'name.max' => 'Maksimal 40 Huruf!',

        'period.required' => 'Periode Wajib diisi!',

        'skin_id.required' => 'Skin Wajib diisi!',
        'skin.exist' => 'Skin tidak ada dalam list!',
        ];
    }

    // Mencatat Log CRUD
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'period', 'skin_id'])
            ->useLogName('battlepass')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Battlepass {$eventName}");
    }
}
