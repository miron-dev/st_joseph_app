<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    // show form
    public function index() {
        return view('images/upload');
    }

    // file upload
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'files' => 'required'
        ])->validate();

        $total_files = count($request->file('files'));
        // dd($request->file('files'));
        foreach ($request->file('files') as $file) {
            // rename & upload files to uploads folder
            $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/uploads';
            $file->move($path, $name);

            // store in db
            $fileUpload = new Image();
            $fileUpload->filename = $name;
            $fileUpload->user_id = Auth::id();
            // $fileUpload->save();

            // $user = User::find(Auth::id());
            // $user->images()->save($fileUpload);
        }

        // return back()->with("success", $total_files . " files uploaded successfully");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
