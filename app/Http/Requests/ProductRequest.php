<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Route;


class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => Route::currentRouteName() == 'products.store' ? 'required|file|mimetypes:application/json' : '',
            'title' => Route::currentRouteName() == 'products.update' ? 'required|' : '',
            'type' => Route::currentRouteName() == 'products.update' ? 'required|' : '',
            'price' => Route::currentRouteName() == 'products.update' ? 'required|' : '',
        ];
    }
}
