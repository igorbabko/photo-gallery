<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Photo::latest()
            ->offset($request->input('offset', 0))
            ->limit($request->input('limit', 10))
            ->get();
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
            $filename = str_replace(' ', '', microtime())
                . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images'), $filename);

            return Photo::create([
                'user_id' => auth()->id(),
                'path' => '/images/' . $filename
            ]);
        });
    }
}
