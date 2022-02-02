<?php

namespace App\Http\Controllers\Api;

use App\Coupon;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Coupons extends Controller
{
    //
    use ApiResponseTrait;
    public function store(Request $request){

        $data = $request->only('key','startDate','endDate','usersCount');
        //dd($data);
        $validator = Validator::make($data, [
            'key' => 'required|string|max:20|unique:coupons',
            'startDate' => 'required|string',
            'endDate' => 'required|string',
            'usersCount' => 'nullable|numeric',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null ,$validator->messages(),200);
        }
        $data['active'] = 1;
        try{
            Coupon::create($data);
            return $this->apiResponse(null , null ,200);
        }catch(Exception $e){
            return $this->apiResponse(null,'Could not create Row.',200);
        }
    }
    public function update(Request $request , $id){
        $data = $request->only('key','startDate','endDate','usersCount');
        $row = Coupon::find($id);
        if(!$row){
            return $this->apiResponse(null ,'Could not find Row.',200);
        }
        $validator = Validator::make($data, [
            'key' => 'required|string|max:20|unique:coupons,key,'.$row->id,
            'startDate' => 'required|string',
            'endDate' => 'required|string',
            'usersCount' => 'nullable|numeric',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null ,$validator->messages(),200);
        }
        $data['active'] = 1;
        try{
            $row->update($data);
            return $this->apiResponse($row , null ,200);
        }catch(Exception $e){
            return $this->apiResponse(null,'Could not create Row.',200);
        }
    }
    public function delete($id){
        $row = Coupon::find($id);
        if(!$row){
             return $this->apiResponse(null,'Could not find Row.',200);
        }
        $row->delete();
        return $this->apiResponse(null , null ,200);
    }

}
