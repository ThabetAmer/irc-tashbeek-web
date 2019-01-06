<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        $isUpdate = $this->getMethod() == 'POST' ? false : true;

        if ($this->getMethod() == 'POST' or $this->getMethod() == 'PUT') {
            $rules = [
                'name' => 'required|string',
                'email' => $this->emailValidation($isUpdate),
                'password' => $this->passwordValidation($isUpdate),
                'profile_picture' => 'image|nullable',
            ];
        }

        return $rules ?? [];
    }


    private function emailValidation($isUpdate)
    {
        if ($isUpdate) {
            $user = $this->route('user');
            return 'required|email|unique:users,email,' . $user->id;
        }

        return 'required|email|unique:users';
    }

    private function passwordValidation($isUpdate)
    {
        if ($isUpdate) {
            if ($this->get('password', null)) {
                return 'confirmed';
            }
            return '';
        }

        return 'required|confirmed';

    }

}
