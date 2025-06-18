<?php

namespace App\Providers;

use App\Providers\WebHelper;
use App\Rules\Crudvalidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class MasterCrudHelper extends ServiceProvider
{
    public static function insertData($request, $model)
    {
        // mendapatkan semua data
        $data = WebHelper::getModelInformation($model);

        // Hashing password
        if($request['password']){
            $request['password'] = Hash::make($request['password']);
        }

        // binary photo menjadi alamat storage
        if ($request['photo']) {
            $file = $request->file('photo');
            $path = $file->store('photos', 'public');
            $data['photo'] = $path;
        }

        // proses validasi
        $result = Crudvalidator::masterValidator($request, $data);

        // proses update
        if ($result['valid'] === true) {
            $payload = $request->only($data['fillable']);
            $data['model']::create($payload);
            $result['message'] = 'Berhasil Menyimpan Data!';
        }
        return $result;
    }
}
