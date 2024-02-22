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
        // dd($user);
        if ($user->is_director) {
            $logHarian = LogHarian::with(['user'])->paginate(10);
        } else if ($user->is_manager) {
            $logHarian = LogHarian::with(['user'])->where('id_pegawai', $user->id)->paginate(20);
        } else {
            $logHarian = LogHarian::with(['user'])->where('id_pegawai', $user->id)->paginate(20);
        }

        // dd($logHarian);

        return Inertia::render('LogHarian/Index', [
            'LogHarian'=> $logHarian
        ]);
    }

    /**
     * Menampilkan formulir untuk membuat log harian baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('LogHarian/create');
    }

    /**
     * Menyimpan log harian baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogHarianRequest $request)
    {

        $data = $request->all();
        $data['id_pegawai'] = Auth::user()->id;
        $logHarian = LogHarian::create($data);

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

        return Inertia::render('LogHarian/show', compact('logHarian'));
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

        return Inertia::render('LogHarian/edit', compact('logHarian'));
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
