<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * FasilitasController constructor.
     */
    public function __construct()
    {
        $this->middleware('IsAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataFasilitas = Fasilitas::all();
        return view('dashboard.fasilitas_index')->with(compact('dataFasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.fasilitas_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'fasilitas' => 'required'
        ],[
            'fasilitas.required' => 'Fasilitas harus diisi'
        ]);

        $fasilitas = new Fasilitas();
        $fasilitas->nama = $request->input('fasilitas');

        try{
            if($fasilitas->save())
                return redirect()->back()->with('success', 'Fasilitas berhasil dimasukkan!');
            else
                return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function show(Fasilitas $fasilitas)
    {
        return view('dashboard.fasilitas_show')->with(compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Fasilitas $fasilitas)
    {
        if (empty($fasilitas) || !$fasilitas->exists)
            return redirect()->back()->withErrors(['Data fasilitas tidak ditemukan']);

        return view('dashboard.fasilitas_edit')->with(compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Fasilitas $fasilitas
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        if (empty($fasilitas) || !$fasilitas->exists)
            return redirect()->back()->withErrors(['Data fasilitas tidak ditemukan']);

        $this->validate($request,[
            'fasilitas' => 'required'
        ],[
            'fasilitas.required' => 'Fasilitas harus diisi'
        ]);

        $fasilitas->nama = $request->input('fasilitas');
        try{
            if($fasilitas->save())
                return redirect(route("dashboard.fasilitas.index"))->with('success', 'Fasilitas berhasil diupdate!');
            else
                return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fasilitas $fasilitas)
    {
        if (empty($fasilitas) || !$fasilitas->exists)
            return redirect()->back()->withErrors(['Fasilitas tidak ditemukan!']);

        if ($fasilitas->beasiswa()->count()>0)
            return redirect()->back()->withErrors(['Gagal menghapus! Fasilitas masih tercantum di data beasiswa']);

        try {
            if($fasilitas->delete())
                return redirect()->back()->with('success',"Fasilitas berhasil dihapus!");
            else
                return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
    }
}
