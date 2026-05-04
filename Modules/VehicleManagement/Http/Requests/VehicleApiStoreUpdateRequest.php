<?php

namespace Modules\VehicleManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VehicleApiStoreUpdateRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if (!$this->hasFile('other_documents')) {
            return;
        }
        $files = $this->file('other_documents');
        if ($files === null) {
            return;
        }
        if (!is_array($files)) {
            $files = [$files];
        }
        $valid = array_values(array_filter($files, static function ($f) {
            return $f instanceof UploadedFile && $f->isValid();
        }));
        $this->merge(['other_documents' => $valid]);
    }

    public function rules()
    {
        $id = $this->id;

        return [
            'brand_id' => 'required',
            'model_id' => 'required',
            'category_id' => 'required',
            'driver_id' => Rule::requiredIf(empty($id)),
            'ownership' => Rule::requiredIf(empty($id)),
            'licence_plate_number' => 'required',
            'licence_expire_date' => 'required|date',
            'vin_number' => 'sometimes',
            'transmission' => 'sometimes',
            'parcel_weight_capacity' => 'sometimes',
            'fuel_type' => Rule::requiredIf(empty($id)),
            'other_documents' => array_merge(
                [Rule::requiredIf(empty($id)), 'array'],
                empty($id) ? ['min:1'] : []
            ),
            'other_documents.*' => ['file', 'max:20480', 'mimes:jpg,jpeg,png,webp,pdf'],
        ];
    }

    public function messages(): array
    {
        return [
            'other_documents.required' => 'يجب إرفاق مستند واحد على الأقل.',
            'other_documents.min' => 'يجب إرفاق مستند واحد على الأقل.',
            'other_documents.*.file' => 'أحد المرفقات غير صالح أو لم يكتمل الرفع.',
            'other_documents.*.max' => 'حجم كل مرفق يجب ألا يتجاوز 20 ميجابايت.',
            'other_documents.*.mimes' => 'يُسمح بصور (jpg, png, webp) أو PDF فقط.',
        ];
    }

    public function authorize()
    {
        return Auth::check();
    }
}
