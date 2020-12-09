<?php

namespace App\Http\Controllers;
use App\Picture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserResource;


class PictureController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if(auth()->user()->picture)
		{
			$picture= auth()->user()->picture;
			$picture->path=$request['file']->storeAs('images/users', $request['file']->getClientOriginalName(), 'public');
			$picture->save();
		}else
		{
			$picture= Picture::create([
			'name' => $request['file']->getClientOriginalName(),
			'path'=>$request['file']->storeAs('images/users', $request['file']->getClientOriginalName(), 'public'),
			'extension'=>'png',
			'user_id'=> auth()->id()
		]);
	}
		return new UserResource($picture->user);
	}
	
	function download(){
		$picture = Picture::first();
		
			return response()->download(storage_path('app/public/'.$picture->path));
		
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Picture $picture)
    {
        //
    }
}
