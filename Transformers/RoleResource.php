<?php

namespace Maxcelos\Acl\Transformers;

//use Maxcelos\Acl\Transformers\SimpleRoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'id' => $this->id,
			'name' => $this->name,
			'display_name' => $this->display_name,
            'permissions' => $this->permissions
		];
    }
}
