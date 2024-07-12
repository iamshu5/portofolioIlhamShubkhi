<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request) {
        $users = User::all();

        if($request->ajax()) {
            $data = User::select('*');
            return datatables()->of($data->get())->addIndexColumn()
            ->editColumn('action', function($data) {
                $actionButton =
                '<button class="btn btn-warning btn-sm shadow-sm rounded mt-1" title="Edit" data-bs-toggle="modal" 
                    data-bs-target="#ModalEdit' . $data->id_user . '">
                    <i class=\'bx bx-message-square-edit\'></i>
                 </button>
                 
                 <button class="btn btn-danger btn-sm shadow-sm rounded mt-1" title="Delete" data-bs-toggle="modal" 
                    data-bs-target="#ModalDelete' . $data->id_user . '">
                    <i class=\'bx bx-trash\'></i>
                 </button>'
                ;

                return $actionButton;
            })->rawColumns(['action'])->make();
        }
        return view('auth.user', compact('request', 'users'));
    }

    public function store(Request $request) {
        try{
            $this->validate($request, [
                'username' => 'required',
                'passwordHash' => 'required|min:10|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'nama' => 'required'
            ]);
            
            $checkUsername = User::where('username', $request->username)->count() > 0;

            if($checkUsername) {
                return redirect('/user')->with('alert', ['bg' => 'warning', 'message' => 'Username sudah tersedia!']);
            }

            $data = User::create([
                'username' => $request->username,
                'passwordHash' => Hash::make($request->passwordHash),
                'nama' => $request->nama,
            ]);

            $data->save();

            return redirect('/user')->with('alert', ['bg' => 'success', 'message' => 'Username ' . $data->username . ' Berhasil ditambahkan']);
        }catch(\Exception $e) {
            return redirect('/user')->with('alert', ['bg' => 'danger', 'message' =>'Terjadi Kesalahan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, User $user) {
        try{
            // $this->validate($request, [
            //     'username' => 'required',
            //     'nama' => 'required'
            // ]);

            $user->username = $request->username;
            $user->passwordHash = !empty($request->passwordHash) ? Hash::make($request->passwordHash) : $user->passwordHash;
            $user->nama = $request->nama;

            $user->save();

            return redirect('/user')->with('alert', ['bg' => 'success', 'message' => ' ' . $user->nama . 'berhasil diperbarui!']);
        }catch(\Exception $e) {
            return redirect('/user')->with('alert', ['bg' => 'danger', 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()]);
        }

    }

    public function destroy(User $user) {
        try{
            $user->delete();
            return redirect('/user')->with('alert', ['bg' => 'success', 'message' => 'Data' . $user->nama . ' Berhasil di hapus']);
        }catch(\Exception $e) {
            return redirect('/user')->with('alert', ['bg' => 'danger', 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()]);
        }
    }
}
