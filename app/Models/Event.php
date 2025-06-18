<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use LogsActivity;

    // nama tabel
    protected $table = 'events';

    // Nama judul tabel
    public $tableHead = 'Event Game';

    // nama kolom yang bisa di CRUD
    protected $fillable = [
        'name',
        'start',
        'end',
        'skin',
    ];

    // Generator Tabel
    public static function labelling(){
        return [
            'name' => 'Nama Event',
            'start' => 'Tanggal Mulai',
            'end' => 'Tanggal Berakhir',
            'skin' => 'Daftar Skin',
        ];
    }

    // Generator Rule
    public static function rules()
    {
        return [
            'name' => 'required|max:40',
            'start' => 'required',
            'end' => 'required',
            'skin' => 'required',
        ];
    }

    // Rule error message
    public static function message(){
        return [
        'name.required' => 'Nama wajib Disii!',
        'name.max' => 'Maksimal 40 Huruf!',

        'start.required' => 'Tanggal Mulai Wajib diisi!',
        'end.required' => 'Tanggal berakhir Wajib diisi!',

        'skin.required' => 'Skin Wajib diisi!',
        ];
    }

    // Mencatat Log CRUD
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'start', 'end', 'skin'])
            ->useLogName('event')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Event {$eventName}");
    }
}
