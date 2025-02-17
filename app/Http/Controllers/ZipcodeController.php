<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZipcodeService;

class ZipcodeController extends Controller
{
    protected $zipcodeService;

    public function __construct(ZipcodeService $zipcodeService)
    {
        $this->zipcodeService = $zipcodeService;
    }

    public function search(Request $request)
    {
        $zipcode = $request->input('zipcode');

        if (!preg_match('/^\d{7}$/', $zipcode)) {
            return response()->json(['error' => '郵便番号は7桁の数字で入力してください。'], 400);
        }

        $address = $this->zipcodeService->getAddressByZipcode($zipcode);

        if ($address) {
            return response()->json($address);
        }

        return response()->json(['error' => '住所が見つかりません。'], 404);
    }
}
