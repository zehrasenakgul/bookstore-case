<?php

namespace App\Http\Controllers\Admin;

use App\Enums\noImagePath;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $languages = Language::all();
        return view( 'admin.languages.index', compact( 'languages' ) );
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.languages.add' );
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $filePath = noImagePath::PATH;
        if ( $request->hasFile( 'icon' ) ) {
            $filePath = Storage::disk( 'storage' )->put( 'languages', $request->file( 'icon' ), 'public' );
        }
        Language::create( [
            'name' => $request->input( 'name' ),
            'code' => $request->input( 'code' ),
            'icon' => $filePath
        ] );
        Session::flash( 'alertSuccessMessage', 'Dil Kaydı Başarılı!' );
        return redirect()->route( 'admin.languages.index' );
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Language  $language
    * @return \Illuminate\Http\Response
    */

    public function show( Language $language ) {
        return view( 'admin.languages.update', compact( 'language' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Language  $language
    * @return \Illuminate\Http\Response
    */

    public function edit( Language $language ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Language  $language
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Language $language ) {
        $filePath = $language->icon;
        if ( $request->hasFile( 'icon' ) ) {
            if ( $language->icon != noImagePath::PATH ) {
                Storage::disk( 'storage' )->delete( $language->icon );
            }
            $filePath = Storage::disk( 'storage' )->put( 'languages', $request->file( 'icon' ), 'public' );
        }
        $language->update( [
            'name' => $request->input( 'name' ),
            'code' => $request->input( 'code' ),
            'icon' => $filePath,
        ] );
        Session::flash( 'alertSuccessMessage', 'Dil Güncelleme Başarılı!' );
        return redirect()->route( 'admin.languages.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Language  $language
    * @return \Illuminate\Http\Response
    */

    public function destroy( Language $language ) {
        $language->delete();
        Session::flash( 'alertSuccessMessage', 'Dil Silme Başarılı!' );
        return redirect()->route( 'admin.languages.index' );
    }
}
