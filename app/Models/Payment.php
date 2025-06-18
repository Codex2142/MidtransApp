<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use LogsActivity;

    // nama tabel
    protected $table = 'payments';

    // Nama judul tabel
    public $tableHead = 'Item Top Up';

    // nama kolom yang bisa di CRUD
    protected $fillable = [
        'name',
        'amount',
        'price',
    ];

    // Generator Tabel
    public static function labelling(){
        return [
            'name' => 'Nama Produk',
            'amount' => 'Kuantitas',
            'price' => 'Harga',
        ];
    }

    // Generator Rule
    public static function rules()
    {
        return [
            'name' => 'required|max:40',
            'amount' => 'required|min:0',
            'price' => 'required|min:0',
        ];
    }

    // Rule error message
    public static function message(){
        return [
        'name.required' => 'Nama wajib Disii!',
        'name.max' => 'Maksimal 40 Huruf!',

        'amount.required' => 'Kuantitas Mulai Wajib diisi!',
        'amount.min' => 'Kuantitas minimal 0!',

        'price.required' => 'harga wajib diisi',
        'price.min' => 'Harga minimal 0!',
        ];
    }

    // Mencatat Log CRUD
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'amount', 'price'])
            ->useLogName('payment')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Payment {$eventName}");
    }
}
