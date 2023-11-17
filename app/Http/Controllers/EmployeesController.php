<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Menampilkan semua resource
        $employees = Employees::all();

        //Response jika resource kosong(json)
        if($employees->isEmpty()) {
            $data = [
                'message' => 'Data is empty'
            ];

            //mengirim data (json) dan status code 200
            return response()->json($data, 200);
        }

        //Response jika resource ada (json)
        $data = [
            'message' => 'Get all resource',
            'data' => $employees
        ];

        //mengirim data (json) dan status code 200 (successfull)
        return response()->json($data, 200);
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
        //membuat validasi
        $validatedData = $request->validate([
            'nama' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'email|required',
            'status' => 'required',
            'hired_on' => 'required'
        ]);

        //menggunakan model employees untuk insert data
        $employees = Employees::create($validatedData);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $employees
        ];

        //mengembalikan data(json) dan status code 201
        return response()->json($data, 201);

        //validasi data request
        $request->validate([
            "nama" => "required",
            "gender" => "required",
            "phone" => "required",
            "address" => "required",
            "email" => "required|email",
            "status" => "required",
            "hired_on" => "required"
        ]);

        $input = [
            'nama' => $request ->nama,
            'gender' => $request ->gender,
            'phone' => $request ->phone,
            'address' => $request ->address,
            'email' => $request ->email,
            'status' => $request ->status,
            'hired_on' => $request ->hired_on
        ];

        //menambahkan resource
        //response jika resource berhasil ditambahkan(json)
        $employees = Employees::create($input);
        $data = [
            'message' => 'Resource is added successfully',
            'data' => $employees
        ];

        //mengembalikan data (json) dan status code 201
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //mencari id resource yang ingin ditampilkan 
        $employees = Employees::find($id);

        if($employees){
            $data = [
                'message' => 'Get detail resource',
                'data' => $employees
            ];

            //mengembalikan data (json) dan status code 200
            return response()->json($data, 200);
        }
        else {
            //response jika resource tidak ada
            $data = [
                'message' => 'Resource not found',
            ];

            //mengembalikan data (json) dan status code 404 (not found)
            return response()->json($data, 404);
        }
    }

    public function search($nama)
    {
        //mencari id resource yang ingin ditampilkan 
        $employees = Employees::where('nama', 'like', '%' . $nama . '%')->get();

        if($employees->count() > 0){
            $data = [
                'message' => 'Get detail resource',
                'data' => $employees
            ];

            //mengembalikan data (json) dan status code 200
            return response()->json($data, 200);
        }
        else {
            //response jika resource tidak ada
            $data = [
                'message' => 'Resource not found',
            ];

            //mengembalikan data (json) dan status code 404 (not found)
            return response()->json($data, 404);
        }
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
    public function update(Request $request, $id)
    {
        //memperbarui single resource
        //mencari id resource yang ingin di update
        $employees = Employees::find($id);

        if($employees){
            $input = [
                'nama' => $request->nama ?? $employees->nama,
                'gender' => $request->gender ?? $employees->gender,
                'phone' => $request->phone ?? $employees->phone,
                'address' => $request->address ?? $employees->address,
                'email' => $request->email ?? $employees->email,
                'status' => $request->status ?? $employees->status,
                'hired_on' => $request->hired_on ?? $employees->hired_on
            ];
            //melakukan update data
            $employees->update($input);

            $data = [
                'message' => 'Resource is update successfully',
                'data' => $employees
            ];

            //mengembalikan data (json) dan status code 200
            return response()->json($data, 200);
        }
        else {
            //respon jika resource tidak ada
            $data = [
                'message' => 'Resource not found'
            ];

            //mengembalikan data (json) dan status code 404 (not found)
            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //mencari id resource yang ingin dihapus
        $employees = Employees::find($id);
        
        if($employees){
            //menghapus data student
            $employees->delete();

            $data = [
                'message' => 'Resource is delete successfully',
                'data' => $employees
            ];

            //mengembalikan data (json) dan status code 200
            return response()->json($data, 200);
        }
        else {
            //response jika resource tidak ada 
            $data = [
                'message' => 'Resource not found',
            ];

            //mengembalikan data (json) dan status code 404 (not found)
            return response()->json($data, 404);
        }
    }
}
