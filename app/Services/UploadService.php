<?php

namespace App\Services;

use App\Helpers\Common;

class UploadService
{
    public function store($request)
    {
        try{
            $name = $request->getClientOriginalName();
            $fullPath = 'uploads/' . date("Y/m/d");
            $request->storeAs(
                'public/'. $fullPath, $name
            );
            return '/storage/' . $fullPath . '/' . $name;
        }catch (\Exception $exception){
            return false;
        }
    }
}
