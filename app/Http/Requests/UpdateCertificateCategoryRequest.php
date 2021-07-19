<?php

namespace App\Http\Requests;

use App\Models\CertificateCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateCategoryRequest extends FormRequest
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
        $category = $this->route('certificate_category');
        $rules = CertificateCategory::$rules;
        $rules['name'] = 'required|unique:certificate_categories,name,'.$category->id;

        return $rules;
    }
}
