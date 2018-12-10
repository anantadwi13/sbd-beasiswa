<?php

namespace App\Http\Controllers;

use App\Persyaratan;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPersyaratan = Persyaratan::all();
        return view('dashboard.persyaratan_index')->with(compact('dataPersyaratan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.persyaratan_create');
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
            'persyaratan' => 'required'
        ],[
            'persyaratan.required' => 'Persyaratan harus diisi'
        ]);

        $persyaratan = new Persyaratan();
        $persyaratan->nama = $request->input('persyaratan');

        try{
            if($persyaratan->save())
                return redirect()->back()->with('success', 'Persyaratan berhasil dimasukkan!');
            else
                return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persyaratan  $persyaratan
     * @return \Illuminate\Http\Response
     */
    public function show(Persyaratan $persyaratan)
    {
        return view('dashboard.persyaratan_show')->with(compact('persyaratan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persyaratan  $persyaratan
     * @return \Illuminate\Http\Response
     */
    public function edit(Persyaratan $persyaratan)
    {
        if (empty($persyaratan) || !$persyaratan->exists)
            return redirect()->back()->withErrors(['Data persyaratan tidak ditemukan']);

        return view('dashboard.persyaratan_edit')->with(compact('persyaratan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Persyaratan $persyaratan
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Persyaratan $persyaratan)
    {
        if (empty($persyaratan) || !$persyaratan->exists)
            return redirect()->back()->withErrors(['Data persyaratan tidak ditemukan']);

        $this->validate($request,[
            'persyaratan' => 'required'
        ],[
            'persyaratan.required' => 'Persyaratan harus diisi'
        ]);

        $persyaratan->nama = $request->input('persyaratan');
        try{
            if($persyaratan->save())
                return redirect(route("dashboard.persyaratan.index"))->with('success', 'Persyaratan berhasil diupdate!');
            else
                return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persyaratan  $persyaratan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persyaratan $persyaratan)
    {
        if (empty($persyaratan) || !$persyaratan->exists)
            return redirect()->back()->withErrors(['Persyaratan tidak ditemukan!']);

        if ($persyaratan->beasiswa()->count()>0)
            return redirect()->back()->withErrors(['Gagal menghapus! Persyaratan masih tercantum di data beasiswa']);

        try {
            if($persyaratan->delete())
                return redirect()->back()->with('success',"Persyaratan berhasil dihapus!");
            else
                return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
    }
}
