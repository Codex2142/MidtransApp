<?php

namespace App\Http\Controllers;

use App\Providers\MasterCrudHelper;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ini contoh data
        $request = Request::create('/', 'POST', [
            'name' => 'Diamond 1 Truck',
            'amount' => 10000,
            'price' => 1500000,
        ]);

        $model = 'Payment';
        $result = MasterCrudHelper::insertData($request, $model);

        // Ini format untuk semua redirect
        if ($result['valid'] == true){
            return redirect('/payment')->withErrors($result['message']);
        }
        return redirect('/payment/tambah')->withInput()->withErrors($result['message']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
