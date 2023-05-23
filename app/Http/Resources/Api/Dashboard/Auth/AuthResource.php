<?php

namespace App\Http\Resources\Api\Dashboard\Auth;

use App\Http\Resources\Api\Dashboard\RoleAndPermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public $token;

    public function __construct($resource, $token)
    {
        parent::__construct($resource);

        $this->token = $token;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'token' => $this->token,
            'user' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'role' => RoleAndPermissionResource::make($this->roles[0]),
                'permission' => RoleAndPermissionResource::collection($this->getAllPermissions())
            ]
        ];
    }
}
