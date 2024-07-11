<?php

namespace App\Http\Controllers;

use App\Models\portfolios;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PortofolioController extends Controller
{
    //
    public function index(Request $request){
        $portofolios = portfolios::All();

        if($request->ajax()) {
            $data = portfolios::select('*')
            ->orderBy('dateCreate', 'desc');

            if($request->filled('form_date') && $request->filled('end_date')){
                $data = $data->whereBetween(DB::raw('CONVERT(DATE, dateCreate)'), [$request->form_date, $request->end_date]);
            }

            return DataTables::of($data->get())->addIndexColumn()
            ->addColumn('image', function($data) {
                return '<img src="'.url("assets/images/{$data->image}").'" alt="img_'.$data->title.'" width="100px" height="auto">';
            })
            // ->addColumn('image', function($data) {
            //     return '<img src="data:image/jpeg;base64,'. $data->image . '" alt="img_' . $data->title . '" width="100px" height="auto">';
            // })
            ->editColumn('dateCreate', function($data) {
                return $data->formatdateCreate();
            })
            ->editColumn('lastUpdate', function($data) {
                return $data->formatlastUpdate();
            })
            ->addColumn('action', function($data) {
                $actionButton = 
                '<button class="btn btn-warning btn-sm shadow-sm rounded mt-1" title="Edit" data-bs-toggle="modal" 
                    data-bs-target="#ModalEdit' . $data->id_portf . '">
                    <i class=\'bx bx-message-square-edit\'></i>
                 </button>
                 
                 <button class="btn btn-danger btn-sm shadow-sm rounded mt-1" title="Delete" data-bs-toggle="modal" 
                    data-bs-target="#ModalDelete' . $data->id_portf . '">
                    <i class=\'bx bx-trash\'></i>
                 </button>'
                ;

                return $actionButton;
            })
            ->rawColumns(['action', 'image'])
            ->make();            
        }
        return view('auth.portofolio', compact('request', 'portofolios'));
    }

    public function store(Request $request) {
        try{
            $this->validate($request, [
                'title' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            ]);

            $checkTitle = portfolios::where('title', $request->title)->count() > 0;
            if($checkTitle) {
                return redirect('/portofolio')->with('alert', ['bg' => 'warning', 'message' => 'Title Sudah ada men']);
            }

             // Menyimpan Foto
            $fileNames = $request->image->getClientOriginalName();
            $request->image->move(public_path('assets/images'), $fileNames);

            // // Ambil gambar dari request
            // $image = $request->file('image');
            // // Encode gambar ke base64
            // $base64Image = base64_encode(file_get_contents($image));

            $data = portfolios::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $fileNames,
                'dateCreate' => now()->format('Y/m/d H:i:m'),
                'lastUpdate' => now()->format('Y/m/d H:i:m'),
            ]);

            $data->save();
            return redirect('/portofolio')->with('alert', ['bg' => 'success', 'message' => 'Title ' . $data->title . ' berhasil ditambah!']);
        }catch(\Exception $e){
            return redirect('/portofolio')->with('alert', ['bg'=> 'danger', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, Portfolios $portofolios) {
        try{
            $this->validate($request, [
                'image' => 'nullable|mimes:png,jpg,jpeg|max:2000', // Optional untuk mengganti gambar
            ]);

            $portofolios->title = $request->title;
            $portofolios->description = $request->description;
            $portofolios->lastUpdate = now()->format('Y/m/d H:i:m');

            // Cek apakah ada gambar yang diunggah untuk diganti
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = $image->getClientOriginalName();
                $image->move(public_path('assets/images'), $fileName);
                $portofolios->image = $fileName;
            }

            $portofolios->save();
            return redirect('/portofolio')->with('alert', ['bg' => 'success', 'message' => 'Portofolio ' . $portofolios->title . ' Berhasil diperbarui']);
        } catch(\Exception $e){
            return redirect('/portofolio')->with('alert', ['bg' => 'danger', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function destroy(Portfolios $portofolios) {
        try{
            $portofolios->delete();
            return redirect('/portofolio')->with('alert', ['bg' => 'success', 'message' =>'Data ' . $portofolios->title . ' Berhasil dihapus!']);
        }catch(\Exception $e) {
            return redirect('/portofolio')->with('alert', ['bg' => 'danger', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function welcome(Request $request) {
        $portofolios = Portfolios::all();
        return view('welcome', compact('portofolios'));
    }
}
