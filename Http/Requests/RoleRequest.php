<?php

namespace SavageGlobalMarketing\Acl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SavageGlobalMarketing\Foundation\Traits\ValidPagination;

class RoleRequest extends FormRequest
{
    use ValidPagination;

    protected array $tableNames;

    protected $internID;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->internID = $this->route('role');

        $this->tableNames = config('permission.table_names');

        $method = strtolower($this->method()) . 'Rules';  // postRules

        return $this->$method();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    private function postRules()
    {
        return [
            'name' => [
                'required',
                'max:255',
                "unique:{$this->tableNames['roles']},name,{$this->internID},id,deleted_at,NULL"
            ],
            'type' => [
                'in:permissive,prohibitive'
            ],
            'display_name' => [
                'required',
                'max:255'
            ],
            'permissions' => 'required',
            'permissions.*' => 'exists:' . $this->tableNames['permissions'] . ',id'
        ];
    }

    private function putRules()
    {
        return [
            'name' => [
                'max:255',
                "unique:{$this->tableNames['roles']},name,{$this->internID},id,deleted_at,NULL"
            ],
            'type' => [
                'in:permissive,prohibitive'
            ],
            'display_name' => [
                'max:255'
            ],
            'permissions.*' => 'exists:' . $this->tableNames['permissions'] . ',id'
        ];
    }
}
