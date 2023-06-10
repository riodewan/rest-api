<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class RentalController extends Controller
{
    public function index()
    {
        $data = Rental::all();

        if ($data) {
            return ApiFormatter::createApi(200, 'succsess', $data);
        }else{
            return ApiFormatter::createApi(400, 'failed');
        }

    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'type' => 'required',
                'waktu_jam' => 'required',
                'jam_mulai' => 'required',
                'supir' => 'required',
            ]);

            $total_harga =  $request->waktu_jam * 150000;
            $rental = Rental::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'type' => $request->type,
                'waktu_jam' => $request->waktu_jam,
                'total_harga' => $total_harga,
                'jam_mulai' => $request->jam_mulai,
                'supir' => $request->supir,
            ]);

            $test = Rental::where('id', '=', $rental->id)->get();
            if ($test) {
                return ApiFormatter::createApi(200, 'succsess', $test);
            }else{
                return ApiFormatter::createApi(400, 'failed');
            }
        }
        catch(Exception $error){
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function show(Rental $rental,$id)
    {
        try{
            $rentalDetail = Rental::where('id', $id)->first();
            if ($rentalDetail) {
                return ApiFormatter::createApi(200, 'succsess', $rentalDetail);
            }else{
                return ApiFormatter::createApi(400, 'failed');
            }

        }
        catch(Exception $error){
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'jam_selesai' => 'required',
                'tempat_tujuan' => 'required',
            ]);

            $rental = Rental::findOrFail($id);
            $riwayat = 'Dimulai pada jam ' . $rental->jam_mulai . ' dengan titik penjemputan di ' . $rental->alamat . ' Dan selesai pada jam ' . $request->jam_selesai . ' dengan titik akhir di ' . $request->tempat_tujuan;

            $rental->update([
                'jam_selesai' => $request->jam_selesai,
                'tempat_tujuan' => $request->tempat_tujuan,
                'status' => 'selesai',
                'riwayat_perjalanan' => $riwayat,
            ]);

            $updateRental = Rental::where('id', $rental->id)->first();
            if ($updateRental) {
                return ApiFormatter::createApi(200, 'succsess', $updateRental);
            }else{
                return ApiFormatter::createApi(400, 'failed');
            }

        }
        catch(Exception $error){
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function destroy(Rental $rental, $id)
    {
        try{
            $getdata = Rental::findOrFail($id);
            $delete = $getdata->delete();
            if ($delete) {
                return ApiFormatter::createApi(200, 'succsess');
            }else{
                return ApiFormatter::createApi(400, 'failed');
            }
        }catch(Exception $error){
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }
}
