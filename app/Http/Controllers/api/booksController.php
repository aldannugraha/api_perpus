<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class booksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = books::orderBy('id')->get();
        return response()->json([
            'status'=>true,
            'message'=>'Data ditemukan',
            'data'=>$data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $databooks = new books;

        $rules = [
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'gambar' => 'required',
            'tahun_terbit' => 'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>true,
            'message'=>'Gagal memasukan data',
            'data'=>$validator->errors()
            ]);
        }

        
        $databooks->judul = $request->judul;
        $databooks->penulis = $request->penulis;
        $databooks->penerbit = $request->penerbit;
        $databooks->gambar = $request->gambar;
        $databooks->tahun_terbit = $request->tahun_terbit;

        $post = $databooks->save();

        return response()->json([
            'status'=>true,
            'message'=>'Sukses memasukan data',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = books::find($id);
        if($data){
            return response()->json([
                    'status'=>true,
                    'message'=>'Data ditemukan',
                    'data'=>$data
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Data tidak ditemukan',
            
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $databooks = books::find($id);
        if(empty($databooks)){
            return response()->json([
                'status'=>false,
                'message'=>'Data tidak ditemukan',

            ],404);
        }

        $rules = [
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'gambar' => 'required',
            'tahun_terbit' => 'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
            'status'=>false,
            'message'=>'Gagal update data',
            'data'=>$validator->errors()
            ]);
        }

        
        $databooks->judul = $request->judul;
        $databooks->penulis = $request->penulis;
        $databooks->penerbit = $request->penerbit;
        $databooks->gambar = $request->gambar;
        $databooks->tahun_terbit = $request->tahun_terbit;

        $post = $databooks->save();

        return response()->json([
            'status'=>true,
            'message'=>'Sukses update data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $databooks = books::find($id);
        if(empty($databooks)){
            return response()->json([
                'status'=>false,
                'message'=>'Data tidak ditemukan',

            ],404);
        }


        $post = $databooks->delete();

        return response()->json([
            'status'=>true,
            'message'=>'Sukses delete data',
        ]);
    }
}
