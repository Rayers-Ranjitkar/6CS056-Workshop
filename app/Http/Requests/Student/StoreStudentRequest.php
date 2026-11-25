<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest //FormReq is built-in class
{
    public function authorize(): bool //authorize -> inbuilt so, laravel always calls //authorizing only admins to create
    {
        return true;
    }

    public function rules(): array //same for this
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email', //table,col
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
        ];
    }
}