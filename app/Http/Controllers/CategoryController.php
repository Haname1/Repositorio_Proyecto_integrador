<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class categoryController extends Controller
{
    use ApiResponser;

    public function index(){
        $categories=Category::all();
        return $this->successResponse($categories);
    }

    public function store(Request $request){
        $rules=[
            'name'=>'required|mas:255',
            'slug'=>'required|mas:255'
        ];
        $this->validate($request,$rules);
        $category=Category::create($request->all());
        return $this->successResponse($category,Response::HTTP_CREATED);
    }

    public function show($category){
        $category=Category::findOrFail($category);
        return $this->successResponse($category);
    }


    public function update(Request $request,$category){
        $rules=[
            'name'=>'required|mas:255',
            'slug'=>'required|mas:255'
        ];
        $this->validate($request,$rules);
        $category=Category::findOrFail($category);
        $category->fill($request->all());
        if($category->isClean()){
            return $this->errorResponse('Al menos un campo debe cambiar',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $category->save();
            return $this->successResponse($category,Response::HTTP_CREATED);
    }

    public function destroy($category){
        $category=Category::find($category);
        $category->delete();
        return response()->json([
            'message'=>"Registro eliminado satisfactoriamente"
        ],Response::HTTP_OK);
    }
}