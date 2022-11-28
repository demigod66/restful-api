<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $data = Mahasiswa::all();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'adress' => 'required'
        ]);

        $data = Mahasiswa::create([
            'username' => $request->username,
            'adress' => $request->adress
        ]);

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }


    public function show($id)
    {
        $data = Mahasiswa::findorfail($id);

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'adress' => 'required'
        ]);

        $data = Mahasiswa::findorfail($id);

        $data->username = $request->username;
        $data->adress = $request->adress;
        $data->save();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function destroy($id)
    {

        try {
            $data = Mahasiswa::findorfail($id);
            $data->delete();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success', $data);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }
}
