<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;
use Validator;

class CategoryController extends Controller {
    //

    public function index() {
        $data               = [];
        $data['site_title'] = "RioTheme";
        $data['categories'] = Category::select( 'id', 'name', 'slug', 'status' )->paginate( 10 );
        return view( 'backend.category.index', $data );
    }

    public function create() {
        $data               = [];
        $data['site_title'] = "RioTheme";

        return view( 'backend.category.create', $data );
    }

    public function store( Request $request ) {
        //validation
        $Validator = Validator::make( $request->all(), [
            'name' => 'required|min:4|unique:categories,name',
            'status' => 'required',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }
        //data send
        Category::create( [
            'name' => trim( $request->input( 'name' ) ),
            'slug' => Str::slug( trim( $request->input( 'name' ) ) ),
            'status' => $request->input( 'status' ),

        ] );

        //redirect
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Category Added' );
        return redirect()->back();
    }

    public function show( $id ) {
        $data               = [];
        $data['site_title'] = "RioTheme";
        $data['category']   = Category::select( 'id', 'name', 'slug', 'status', 'created_at' )->find( $id );
        return view( 'backend.category.show', $data );
    }

    public function edit( $id ) {
        $data               = [];
        $data['site_title'] = "RioTheme";
        $data['category']   = Category::with('posts','posts.user')->select( 'id', 'name', 'slug', 'status', 'created_at' )->find( $id );

        return view( 'backend.category.edit', $data );
    }

    public function update( $id, Request $request ) {
        //validation

        $Validator = Validator::make( $request->all(), [
            'name' => 'required|min:4|unique:categories,name,' . $id,
            'status' => 'required',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }
        //data update
        $category = Category::find( $id );

        $category->update( [
            'name' => trim( $request->input( 'name' ) ),
            'slug' => Str::slug( trim( $request->input( 'name' ) ) ),
            'status' => $request->input( 'status' ),
        ] );

        //redirect
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Category Updated' );
        return redirect()->back();
    }

    public function delete($id){
        $category = Category::find( $id );
        $category->delete();
        //redirect
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Category Deleted' );
        return redirect()->route('categories.index');
    }

}
