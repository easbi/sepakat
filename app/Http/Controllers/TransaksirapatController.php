<?php

namespace App\Http\Controllers;

use App\Models\Transaksirapat;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TransaksirapatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rapats = DB::table('transaksi_rapat')
            ->leftjoin('users AS A', 'A.id', 'transaksi_rapat.pimpinan_rapat')
            ->leftjoin('users AS B', 'B.id', 'transaksi_rapat.notulis')
            ->select('transaksi_rapat.*', 'A.fullname as nama_pimpinan', 'B.fullname as nama_notulis')
            ->get();
        return view('rapat.index', compact('rapats'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $rapats = DB::table('transaksi_rapat')
            ->leftjoin('users AS A', 'A.id', 'transaksi_rapat.pimpinan_rapat')
            ->leftjoin('users AS B', 'B.id', 'transaksi_rapat.notulis')
            ->select('transaksi_rapat.*', 'A.fullname as nama_pimpinan', 'B.fullname as nama_notulis')
            ->get();
        return view('rapat.dashboard', compact('rapats'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = DB::table('users')->pluck('fullname', 'id');
        return view('rapat.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
           'nama_rapat' => 'required|min:10',
           'notulis' => 'required',
        ]);

        $undangan = NULL;
        if($request->hasFile('undangan')) {
            $file = $request->file('undangan');
            $filename = 'undangan_rapat-'.$request->tgl.'.'.$file->getClientOriginalExtension();
            $file->move('public/rapat/undangan', $filename);
            $undangan = $filename;
        } 

        $result = Transaksirapat::create([
                'nama_rapat' => $request->nama_rapat, 
                'tgl' => $request->tgl, 
                'waktu' => $request->waktu, 
                'tempat' => $request->tempat, 
                'pimpinan_rapat' => $request->pimpinan_rapat,
                'notulis' => $request->notulis,
                'undangan' => $undangan
            ]);

        // redirect 
        return redirect()->route('rapat.index')
                        ->with('success','Data Rapat Successfuly inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksirapat  $transaksirapat
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Transaksirapat::selectRaw('COUNT(*) as count, YEAR(tgl) year, MONTH(tgl) month1')
                ->groupBy('year', 'month1')
                ->get();
        $data = $data;
        return response()->json($data);
    }

    public function chart()
    {
        $data = Transaksirapat::selectRaw('COUNT(*) as count, YEAR(tgl) year, MONTHNAME(tgl) month, MONTH(tgl) month1, CONCAT(MONTHNAME(tgl)," " ,YEAR(tgl)) as bulan_tahun')
                ->groupBy('year', 'month1')
                ->get();
        $data = $data;
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksirapat  $transaksirapat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rapat = DB::table('transaksi_rapat')->where('id', $id)->first();
        return view('rapat.edit',compact('rapat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksirapat  $transaksirapat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rapat = Transaksirapat::find($id);

        // dd($request->file('undangan'));

        if($request->hasFile('undangan')) {
            $file = $request->file('undangan');
            $filename = 'undangan_rapat-'.$rapat->tgl.'-'.$rapat->id.'.'.$file->getClientOriginalExtension();
            $file->move('public/rapat/undangan', $filename);
            $rapat->undangan = $filename;    
        } else {
            $rapat->undangan = $rapat->undangan;
        }

        if($request->file('daftar_hadir')) {
            $file = $request->file('daftar_hadir');
            $filename = 'daftar_hadir_rapat-'.$rapat->tgl.'-'.$rapat->id.'.'.$file->getClientOriginalExtension();
            $file->move('public/rapat/daftar_hadir', $filename);
            $rapat->daftar_hadir = $filename;                
        } else {
            $rapat->daftar_hadir = $rapat->daftar_hadir;
        }

        if($request->file('notulen')) {
            $file = $request->file('notulen');
            $filename = 'notulen_rapat-'.$rapat->tgl.'-'.$rapat->id.'.'.$file->getClientOriginalExtension();
            $file->move('public/rapat/notulen', $filename);
            $rapat->notulen = $filename;                
        } else {
            $rapat->notulen = $rapat->notulen;
        }

        if($request->file('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = 'dokumentasi_rapat-'.$rapat->tgl.'-'.$rapat->id.'.'.$file->getClientOriginalExtension();
            $file->move('public/rapat/dokumentasi', $filename);
            $rapat->dokumentasi = $filename;                
        } else {
            $rapat->dokumentasi = $rapat->dokumentasi;
        }

        if($rapat) {
            $rapat->nama_rapat = $request->nama_rapat;
            $rapat->tgl = $request->tgl;
            $rapat->waktu = $request->waktu;
            $rapat->tempat = $request->tempat;
            $rapat->pimpinan_rapat = $request->pimpinan_rapat;
            $rapat->notulis = $request->notulis;
            $rapat->undangan = $rapat->undangan;
            $rapat->daftar_hadir = $rapat->daftar_hadir;
            $rapat->notulen = $rapat->notulen;
            $rapat->dokumentasi = $rapat->dokumentasi;
            $rapat->updated_at = now();
            $rapat->save();
        }
        return redirect()->route('rapat.index')->with('success', 'The rapat updated successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function arsip()
    {
        $rapats = DB::table('transaksi_rapat')
            ->leftjoin('users AS A', 'A.id', 'transaksi_rapat.pimpinan_rapat')
            ->leftjoin('users AS B', 'B.id', 'transaksi_rapat.notulis')
            ->select('transaksi_rapat.*', 'A.fullname as nama_pimpinan', 'B.fullname as nama_notulis')
            ->get();
        return view('rapat.arsip', compact('rapats'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksirapat  $transaksirapat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
