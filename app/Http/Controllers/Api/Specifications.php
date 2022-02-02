<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Specification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class Specifications extends Controller
{
    use ApiResponseTrait;
    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            '*.titleEn' => 'required|string',
            '*.titleAr' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null ,$validator->messages(),200);
        }
        Specification::truncate();
        try{
            foreach($data as $row){
                 Specification::create([
                    'titleEn' => $row['titleEn'],
                    'titleAr' => $row['titleAr'],
                ]);
            }
            return $this->apiResponse(null , null ,200);
        }catch(Exception $e){
            return $this->apiResponse(null,'Could not create Row.',200);
        }
    }
    public function delete($id){
        $row = Specification::find($id);
        if(!$row){
             return $this->apiResponse(null,'Could not find Row.',200);
        }
        $row->delete();
        return $this->apiResponse(null , null ,200);
    }
}
