<?php

namespace App\Http\Requests;

use App\Enums\UserRoleEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole( UserRoleEnum::ADMIN );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6|confirmed',
            'password_confirmation'=> 'required|same:password|min:6',
            'role'           => ['required', Rule::enum( UserRoleEnum::class )],
            // 'corporate_name' => 'required_if:role,Cliente|string',
            /**
             * CNPJ Formatado.
             * @var string
             * @example 00.000.000/0000-00
             */
            // 'cnpj'           => 'required_if:role,Cliente|formato_cnpj|unique:clients,cnpj',
            /**
             * Telefone celular formatado.
             * @var string
             * @example "(11) 91234-5678"
             */
            // 'contact_phone'  => 'required_if:role,Cliente|celular_com_ddd',
            /**
             * CEP formatado.
             * @var string
             * @example "83560-333"
             */
            // 'zip_code'       => 'required_if:role,Cliente|formato_cep',
            // 'address'        => 'required_with:zip_code|string',
            // 'number'         => 'required_with:zip_code|string',
            // 'complement'     => 'nullable|string',
            // 'district'       => 'required_with:zip_code|string',
            // 'city'           => 'required_with:zip_code|string',
            // 'state'          => 'required_with:zip_code|string',
            // 'lat'            => 'nullable|string',
            // 'long'           => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'A senha é obrigatória.',
            'password_confirmation.required' => 'A confirmação de senha precisa ser preenchida .',
            'password.confirmed' => 'As senhas não iguais.',
            'password_confirmation.same' => 'As senhas não iguais.',
            'email.required' => 'O email é obrigatório.',
            'name.required' => 'O nome de usuário é obrigatório.',
            'role.required' => 'A Permissão é obrigatória.',
            'password.min' => 'A senha deve conter pelo menos :min caracteres.',
        ];
    }
}