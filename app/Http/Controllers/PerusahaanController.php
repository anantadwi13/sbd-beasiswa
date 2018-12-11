<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * PerusahaanController constructor.
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
        $dataPerusahaan = Perusahaan::all();
        return view('dashboard.perusahaan_index')->with(compact('dataPerusahaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.perusahaan_create');
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
            'perusahaan' => 'required'
        ],[
            'perusahaan.required' => 'Nama perusahaan harus diisi'
        ]);

        $perusahaan = new Perusahaan();
        $perusahaan->nama = $request->input('perusahaan');

        try{
            if($perusahaan->save())
                return redirect()->back()->with('success', 'Perusahaan berhasil dimasukkan!');
            else
                return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        return view('dashboard.perusahaan_show')->with(compact('perusahaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        if (empty($perusahaan) || !$perusahaan->exists)
            return redirect()->back()->withErrors(['Data perusahaan tidak ditemukan']);

        return view('dashboard.perusahaan_edit')->with(compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Perusahaan $perusahaan
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        if (empty($perusahaan) || !$perusahaan->exists)
            return redirect()->back()->withErrors(['Data perusahaan tidak ditemukan']);

        $this->validate($request,[
            'perusahaan' => 'required'
        ],[
            'perusahaan.required' => 'Nama perusahaan harus diisi'
        ]);

        $perusahaan->nama = $request->input('perusahaan');
        try{
            if($perusahaan->save())
                return redirect(route("dashboard.perusahaan.index"))->with('success', 'Perusahaan berhasil diupdate!');
            else
                return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        if (empty($perusahaan) || !$perusahaan->exists)
            return redirect()->back()->withErrors(['Perusahaan tidak ditemukan!']);

        if ($perusahaan->beasiswa()->count()>0)
            return redirect()->back()->withErrors(['Gagal menghapus! Perusahaan masih tercantum di data beasiswa']);

        try {
            if($perusahaan->delete())
                return redirect()->back()->with('success',"Perusahaan berhasil dihapus!");
            else
                return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
    }
}
