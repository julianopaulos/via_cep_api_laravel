<?php

namespace App\Services;

class ZipCodeService {
    public function findLocationsByZipCodes(string $zipCodes): array {
        $zipCodesArray = json_decode($zipCodes, true);
        $locations = [];
        $zipCodeApiService = new ZipCodeApiService();

        foreach ($zipCodesArray as $zipCode) {
           $locations[] =  $zipCodeApiService->makeRequest($zipCode);
        }

        return $locations;
    }
}