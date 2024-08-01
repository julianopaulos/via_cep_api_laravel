<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZipCodeApiService {
    public function makeRequest(string $zipCode) {
        return Http::get(
            $this->getUrl() . $zipCode . '/json',
        )
        ->json();
    }

    private function getUrl() {
        return config('app.zip_code_api_base_url') . '/ws/';
    }
}