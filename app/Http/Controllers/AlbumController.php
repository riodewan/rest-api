<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class AlbumController extends Controller
{
    public function index()
    {
        $data = Album::all();

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
                'title' => 'required',
            ]);

            $image = null;
            if($request->file)
            {
                $extension = $request->file('file')->getClientOriginalExtension();
                $newName = $request->title . '-' . now()->timestamp. '.' . $extension;
                $request->file('file')->move(public_path('/storage/'), $newName);
            }
            $request['image'] = $newName;
            $create = Album::create($request->all());

            $data = Album::where('id', '=', $create->id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, 'succsess', $data);
            }else{
                return ApiFormatter::createApi(400, 'failed');
            }
        }
        catch(Exception $error){
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }
}
