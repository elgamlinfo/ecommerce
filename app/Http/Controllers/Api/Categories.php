<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Categories extends Controller
{
    //
    use ApiResponseTrait;
    public $data = [];
    public function store(Request $request){
        $data = $request->only('nameEn','nameAr','parentId');
        //dd($data);

        $validator = Validator::make($data, [
            'parentId' => 'nullable|numeric',
            'nameEn' => 'required|string|unique:categories',
            'nameAr' => 'required|string|unique:categories',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null ,$validator->messages(),200);
        }
        if(isset($request->parentId)){
            $catparent = Category::find($request->parentId);
            if(!$catparent){
                return $this->apiResponse(null,'Could not find Parent Row.',200);
            }
        }
        try{
            Category::create($data);
            return $this->apiResponse(null , null ,200);
        }catch(Exception $e){
            return $this->apiResponse(null,'Could not create Row.',200);
        }
    }
    public function update(Request $request ,$id){
        $data = $request->only('nameEn','nameAr','parentId');
        //dd($data);
        $row = Category::find($id);
        if(!$row){
            return $this->apiResponse(null,'Could not find Row.',200);
        }
        $validator = Validator::make($data, [
            'parentId' => 'nullable|numeric',
            'nameEn' => 'required|string|unique:categories,nameEn,'.$row->id,
            'nameAr' => 'required|string|unique:categories,nameAr,'.$row->id,
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null ,$validator->messages(),200);
        }
        if(isset($request->parentId)){
            $catparent = Category::find($request->parentId);
            if(!$catparent){
                return $this->apiResponse(null,'Could not find Parent Row.',200);
            }
        }
        try{
            $row->update($data);
            return $this->apiResponse(null , null ,200);
        }catch(Exception $e){
            return $this->apiResponse(null,'Could not create Row.',200);
        }
    }
    public function delete($id){
        $row = Category::find($id);
        $data = [];
        if(!$row){
             return $this->apiResponse(null,'Could not find Row.',200);
        }
        $row->subcategory()->delete();
        $this->delete($row->id);
        return $this->apiResponse(null , null ,200);
    }



}
