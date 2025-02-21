<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZipcodeService
{
    // APIのURL
        private const ZIPCLOUD_API_URL = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';

    // 郵便番号を元に住所情報を取得するメソッド
    public function getAddressByZipcode($zipcode)
    {
        // API側にリクエスト
        $response = Http::get(self::ZIPCLOUD_API_URL . $zipcode);

        if ($response->successful()) {
            // リクエストが成功すれば、jsonでデータを取得
            $data = $response->json();

            // 取得できれば、取得したデータを分類に合わせて分ける
            if ($data['status'] === 200 && !empty($data['results'])) {
                $result = $data['results'][0];
                return [
                    'address1' => $result['address1'], // 都道府県
                    'address2' => $result['address2'], // 市区町村
                    'address3' => $result['address3'], // 丁目・番地
                ];
            }
        }

        return null;
    }
}
