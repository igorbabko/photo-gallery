<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Photo::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photos = $this->save($request->image);

        return response()->json($photos, 201);
    }

    protected function save($images)
    {
        return collect($images)->map(function ($image) {
            $filename = microtime() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);

            return Photo::create([
                'user_id' => auth()->id(),
                'path' => $filename
            ]);
        });
    }
}
