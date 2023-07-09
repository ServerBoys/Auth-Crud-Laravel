<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws BindingResolutionException
     */
    public function getCredentials(): array
    {
        $username = $this->get('username');

        if ($this->isEmail($username))
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        return $this->only('username', 'password');
    }

    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws BindingResolutionException
     */
    private function isEmail($param): bool
    {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();
    }
}
