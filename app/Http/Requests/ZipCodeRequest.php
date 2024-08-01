<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ZipCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'zip_codes' => ['string', 'required', 'min:1'],
        ];
    }

    private function sanitizedZipCodes(): string {
        $zipCodeArray = explode(',', $this->input('zip_codes'));
        $sanitizedZipCodes = [];
        if (count($zipCodeArray) > 1) {
            foreach ($zipCodeArray as $zipCode) {
                $sanitizedZipCode = preg_replace('/[^0-9]/i', '', $zipCode);
                if ($sanitizedZipCode) {
                    $sanitizedZipCodes[] = $sanitizedZipCode;
                }
            }
        } else {
            $sanitizedZipCode = preg_replace('/[^0-9]/i', '', $this->input('zip_codes'));
            if ($sanitizedZipCode) {
                $sanitizedZipCodes[] = $sanitizedZipCode;
            }
        }

        return $sanitizedZipCodes ? json_encode($sanitizedZipCodes) : '';
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                $zipCodes = $this->sanitizedZipCodes();
                if (empty($zipCodes)) {
                    $validator->errors()->add(
                        'zip_codes',
                        'Something is wrong with this field!'
                    );
                } else {
                    $data = $validator->getData();

                    $validator->setData(
                        ['zip_codes' => $this->sanitizedZipCodes()] + $data
                    );
                }
            }
        ];
    }

}
