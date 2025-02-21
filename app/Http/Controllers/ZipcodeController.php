<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZipcodeService;

// 郵便番号検索API用コントローラー
class ZipcodeController extends Controller
{

    // ZipcodeServiceを依存性注入
    protected $zipcodeService;
    public function __construct(ZipcodeService $zipcodeService)
    {
        $this->zipcodeService = $zipcodeService;
    }

    // 郵便番号検索
    public function search(Request $request)
    {
        // リクエストより郵便番号取得
        $zipcode = $request->input('zipcode');

        // 取得した郵便番号が7桁の数字なのかを確認し、エラーであれば、400エラーを返す
        if (!preg_match('/^\d{7}$/', $zipcode)) {
            return response()->json(['error' => '郵便番号は7桁の数字で入力してください。'], 400);
        }

        // 郵便番号を元に住所を検索
        $address = $this->zipcodeService->getAddressByZipcode($zipcode);

        // 住所が存在する場合、json形式でデータを返す
        if ($address) {
            return response()->json($address);
        }

        // 住所がない場合、400エラーを返す
        return response()->json(['error' => '住所が見つかりません。'], 404);
    }
}
