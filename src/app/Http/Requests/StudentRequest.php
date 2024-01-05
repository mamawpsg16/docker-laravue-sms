<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'image' => ['sometimes', 'image','nullable','mimes:jpeg,jpg,png'],
            'student_information' => ['required','array'],
            'student_information.email' => ['required', 'email'],
            'student_information.first_name' => 'required',
            'student_information.last_name' => 'required',
            'student_information.phone_number_1' => ['required','min:11', 'max:13'],
            'student_information.date_of_birth' => 'required',
            'student_information.gender_id' => 'required',
            'student_information.school_year_id' => 'required',

            'guardians' => ['required','array'],
            'guardians.*.first_name' => 'required',
            'guardians.*.last_name' => 'required',
            'guardians.*.email' => ['required', 'email'],
            'guardians.*.phone_number_1' => ['required','min:11', 'max:13'],
            'guardians.*.guardian_type_id' => 'required',

            'address_information' => ['required','array'],
            'address_information.address' => 'required',
            'address_information.landmark' => 'required',
            'address_information.contact_person' => 'required',
            'address_information.phone_number' => ['required','min:11', 'max:13'],

            'health_information' => ['required','array'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'student_information' => json_decode($this->student_information,true),
            'guardians' => json_decode($this->guardians,true),
            'address_information' => json_decode($this->address_information,true),
            'health_information' => json_decode($this->health_information,true),
        ]);
    }
}
