<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = users::orderBy('id')->get();
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
         $datausers = new users;

        $rules = [
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'telp' => 'required',
            'alamat' => 'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>true,
            'message'=>'Gagal memasukan data',
            'data'=>$validator->errors()
            ]);
        }

        
        $datausers->nama = $request->nama;
        $datausers->username = $request->username;
        $datausers->telp = $request->telp;
        $datausers->alamat = $request->alamat;
        $datausers->password = $request->password;

        $post =  $datausers->save();

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
    public function login()
    {
        try {
            $username = $this->postField('username');
            $password = $this->postField('password');

            $user = Users::with([])
                ->where('username', '=', $username)
                ->where('role', '=', 'PEMINJAM')
                ->first();
            if (!$user) {
                return $this->jsonNotFoundResponse('user not found');
            }

            $isPasswordValid = Hash::check($password, $user->password);
            if (!$isPasswordValid) {
                return $this->jsonUnauthorizedResponse('password did not match');
            }

            return $this->jsonSuccessResponse('Login Success',$user);
        }catch (\Throwable $e) {
            return $this->jsonErrorResponse('internal server error '.$e->getMessage());
        }
    }
    public function loginPetugas()
    {
        try {
            $username = $this->postField('username');
            $password = $this->postField('password');

            $user = Users::with([])
                ->where('username', '=', $username)
                ->where('role', '!=', 'PEMINJAM')
                ->first();
            if (!$user) {
                return $this->jsonNotFoundResponse('user not found');
            }

            $isPasswordValid = Hash::check($password, $user->password);
            if (!$isPasswordValid) {
                return $this->jsonUnauthorizedResponse('password did not match');
            }

            return $this->jsonSuccessResponse('Login Success',$user);
        }catch (\Throwable $e) {
            return $this->jsonErrorResponse('internal server error '.$e->getMessage());
        }
    }
}
