<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    use ApiResponseTrait;
    public function mainData($lang){
        $mainCategories = Category::get();
        $data = [
            'mainCategories' => $mainCategories,
        ];
        return $this->apiResponse($data);

    }
}
