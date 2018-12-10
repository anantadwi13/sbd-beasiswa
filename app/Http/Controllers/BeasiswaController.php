<?php

namespace App\Http\Controllers;

use App\Beasiswa;
use App\Fasilitas;
use App\Persyaratan;
use App\Perusahaan;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataBeasiswa = Beasiswa::all();
        return view('dashboard.beasiswa_index')->with(compact('dataBeasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $perusahaan = Perusahaan::all();
        $persyaratan = Persyaratan::all();
        $fasilitas = Fasilitas::all();
        return view('dashboard.beasiswa_create')->with(compact('request','perusahaan','persyaratan','fasilitas'));
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
            'nama' => 'required',
            'perusahaan' => 'required',
        ],[
            'nama.required' => 'Nama Beasiswa harus diisi!',
            'perusahaan.required' => 'Instansi/Perusahaan harus diisi!'
        ]);

        $beasiswa = new Beasiswa();
        $beasiswa->nama = $request->input('nama');
        $beasiswa->deskripsi = $request->input('deskripsi');
        $beasiswa->id_perusahaan = $request->input('perusahaan');
        $beasiswa->tgl_dibuka = $request->input('tglbuka');
        $beasiswa->tgl_ditutup = $request->input('tgltutup');
        $beasiswa->info_tambahan = $request->input('infotambahan');

        $persyaratan = $request->input('persyaratan');
        $fasilitas = $request->input('fasilitas');

        if (!empty($request->input('laststep')) && $request->input('laststep')==true)
        {
            try{
                if($beasiswa->save()){
                    if (!empty($persyaratan))
                        foreach ($persyaratan as $key=>$item)
                            $beasiswa->persyaratan()->attach($item['id'], ['keterangan'=>$item['keterangan']?$item['keterangan']:""]);

                    if (!empty($fasilitas))
                        foreach ($fasilitas as $key=>$item)
                            $beasiswa->fasilitas()->attach($item['id'], ['keterangan'=>$item['keterangan']?$item['keterangan']:""]);

                    return redirect(route('dashboard.beasiswa.index'))->with('success','Beasiswa berhasil dimasukkan!');
                }
                else
                    return redirect()->back()->withInput()->withErrors(['Gagal menyimpan!']);
            }
            catch (\Exception $e){
                return redirect()->back()->withInput()->withErrors(['Gagal menyimpan!']);
            }
        }
        else {
            if (!empty($persyaratan))
                foreach ($persyaratan as $key=>$item)
                    $persyaratan[$key]['nama'] = Persyaratan::find($item['id'])->nama;

            if (!empty($fasilitas))
                foreach ($fasilitas as $key=>$item)
                    $fasilitas[$key]['nama'] = Fasilitas::find($item['id'])->nama;

            return view('dashboard.beasiswa_store')->with(compact('beasiswa', 'persyaratan', 'fasilitas'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beasiswa  $beasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Beasiswa $beasiswa)
    {
        if (empty($beasiswa) || !$beasiswa->exists)
            return redirect()->back()->withErrors(['Data beasiswa tidak ditemukan!']);

        return view('dashboard.beasiswa_show')->with(compact('beasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beasiswa  $beasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Beasiswa $beasiswa)
    {
        if (empty($beasiswa) || !$beasiswa->exists)
            return redirect()->back()->withErrors(['Data beasiswa tidak ditemukan']);

        $temp = $beasiswa->persyaratan()->get();
        $persyaratan_select = array();
        $fasilitas_select = array();

        foreach ($temp as $item)
            $persyaratan_select[$item->id] = true;

        $temp = $beasiswa->fasilitas()->get();

        foreach ($temp as $item)
            $fasilitas_select[$item->id] = true;

        $perusahaan = Perusahaan::all();
        $persyaratan = Persyaratan::all();
        $fasilitas = Fasilitas::all();
        return view('dashboard.beasiswa_edit_firststep')->with(compact('beasiswa','perusahaan','persyaratan','fasilitas', 'persyaratan_select','fasilitas_select'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Beasiswa $beasiswa
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Beasiswa $beasiswa)
    {
        $this->validate($request,[
            'nama' => 'required',
            'perusahaan' => 'required',
        ],[
            'nama.required' => 'Nama Beasiswa harus diisi!',
            'perusahaan.required' => 'Instansi/Perusahaan harus diisi!'
        ]);

        $beasiswa->nama = $request->input('nama');
        $beasiswa->deskripsi = $request->input('deskripsi');
        $beasiswa->id_perusahaan = $request->input('perusahaan');
        $beasiswa->tgl_dibuka = $request->input('tglbuka');
        $beasiswa->tgl_ditutup = $request->input('tgltutup');
        $beasiswa->info_tambahan = $request->input('infotambahan');

        $persyaratan = $request->input('persyaratan');
        $fasilitas = $request->input('fasilitas');

        $persyaratan_select = array();
        $fasilitas_select = array();

        foreach ($beasiswa->persyaratan()->get() as $item)
            $persyaratan_select[$item->id] = $item->pivot->keterangan;

        foreach ($beasiswa->fasilitas()->get() as $item)
            $fasilitas_select[$item->id] = $item->pivot->keterangan;

        if (!empty($request->input('laststep')) && $request->input('laststep')==true)
        {
            try{
                if($beasiswa->save()){
                    if (!empty($persyaratan)) {
                        $attachPersyaratan = [];
                        foreach ($persyaratan as $key => $item)
                            $attachPersyaratan[$item['id']] = ['keterangan' => $item['keterangan'] ? $item['keterangan'] : ""];

                        $beasiswa->persyaratan()->sync($attachPersyaratan);
                    }
                    if (!empty($fasilitas)) {
                        $atachFasilitas = [];
                        foreach ($fasilitas as $key => $item)
                            $attachFasilitas[$item['id']] = ['keterangan' => $item['keterangan'] ? $item['keterangan'] : ""];

                        $beasiswa->fasilitas()->sync($atachFasilitas);
                    }

                    return redirect(route('dashboard.beasiswa.index'))->with('success','Beasiswa berhasil diupdate!');
                }
                else
                    return redirect()->back()->withInput()->withErrors(['Gagal menyimpan!']);
            }
            catch (\Exception $e){
                return redirect()->back()->withInput()->withErrors(['Gagal menyimpan!']);
            }
        }
        else {
            if (!empty($persyaratan))
                foreach ($persyaratan as $key=>$item) {
                    $persyaratan[$key]['nama'] = Persyaratan::find($item['id'])->nama;
                    $persyaratan[$key]['keterangan'] = !empty($persyaratan_select[$item['id']])?$persyaratan_select[$item['id']]:"";
                }

            if (!empty($fasilitas))
                foreach ($fasilitas as $key=>$item) {
                    $fasilitas[$key]['nama'] = Fasilitas::find($item['id'])->nama;
                    $fasilitas[$key]['keterangan'] = !empty($fasilitas_select[$item['id']])?$fasilitas_select[$item['id']]:"";
                }

            return view('dashboard.beasiswa_edit_secondstep')->with(compact('beasiswa', 'persyaratan', 'fasilitas'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beasiswa  $beasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beasiswa $beasiswa)
    {
        if (empty($beasiswa) || !$beasiswa->exists)
            return redirect()->back()->withErrors(['Data beasiswa tidak ditemukan!']);

        try {
            if($beasiswa->delete())
                return redirect()->back()->with('success',"Beasiswa berhasil dihapus!");
            else
                return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['Gagal menghapus!']);
        }
    }
}
