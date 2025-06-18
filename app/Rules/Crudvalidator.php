<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class Crudvalidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public static function masterValidator($request, $data)
    {
        $input    = $request;
        $rules    = $data['rule'] ?? []; // jika tidak ada rule
        $messages = $data['message'] ?? []; // jika tidak ada pesan error

        $validator = Validator::make($request->all(), $rules, $messages);

        // jika pesan gagal
        if ($validator->fails()) {
            return [
                'valid'  => false,
                'message' => $validator->errors()->toArray(),
            ];
        }

        // jika pesan berhasil
        return [
            'valid'  => true,
            'message' => [],
        ];
    }
}
