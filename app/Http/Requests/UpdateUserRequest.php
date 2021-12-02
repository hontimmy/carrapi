<?php


namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        User::$rules['email'] = 'required|max:255|email|unique:users,email,' . $this->route('user');
        User::$rules['phone'] = 'required|max:255|unique:users,phone,' . $this->route('user');
        User::$rules['password'] = 'nullable';
        return User::$rules;
    }
}
