<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZipCodeRequest;
use App\Services\ZipCodeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class ZipCodeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function findLocationsByZipCodes(ZipCodeRequest $request) : string {
        $data = $request->validated();
        $service = new ZipCodeService();
        $locations = $service->findLocationsByZipCodes($data['zip_codes']);

        // return Response::json($locations, 200, [], JSON_PRETTY_PRINT);
        return response()
            ->json($locations, 200, [], JSON_PRETTY_PRINT)
            ->getContent();
    }
}
