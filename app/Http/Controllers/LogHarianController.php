<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogHarianRequest;
use App\Http\Requests\UpdateLogHarianRequest;
use App\Models\LogHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LogHarianController extends Controller
{
    /**
     * Menampilkan daftar log harian.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Direktur')) {
            $logHarians = LogHarian::all();
        } else if ($user->hasRole('Manager')) {
            $logHarians = LogHarian::where('id_pegawai', $user->id)->get();
        } else {
            $logHarians = LogHarian::where('id_pegawai', $user->id)->where('status', '<>', 'Direktur')->get();
        }

        return Inertia::render('LogHarian.index', compact('logHarians'));
    }

    /**
     * Menampilkan formulir untuk membuat log harian baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('LogHarian.create');
    }

    /**
     * Menyimpan log harian baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogHarianRequest $request)
    {


        $logHarian = LogHarian::create($request->all());

        return redirect()->route('LogHarian.index')->with('success', 'Log Harian berhasil dibuat.');
    }

    /**
     * Menampilkan detail log harian.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logHarian = LogHarian::findOrFail($id);

        return Inertia::render('LogHarian.show', compact('logHarian'));
    }

    /**
     * Menampilkan formulir untuk mengedit log harian.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logHarian = LogHarian::findOrFail($id);

        return Inertia::render('LogHarian.edit', compact('logHarian'));
    }

    /**
     * Memperbarui log harian di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogHarianRequest $request, $id)
    {
        $logHarian = LogHarian::findOrFail($id);


        $logHarian->update($request->all());

        return redirect()->route('LogHarian.index')->with('success', 'Log Harian berhasil diperbarui.');
    }

    /**
     * Menghapus log harian dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logHarian = LogHarian::findOrFail($id);

        $logHarian->delete();

        return redirect()->route('LogHarian.index')->with('success', 'Log Harian berhasil dihapus.');
    }
}
