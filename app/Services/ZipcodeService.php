<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZipcodeService
{
    private const ZIPCLOUD_API_URL = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';

    public function getAddressByZipcode($zipcode)
    {
        $response = Http::get(self::ZIPCLOUD_API_URL . $zipcode);

        if ($response->successful()) {
            $data = $response->json();

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
