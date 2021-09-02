<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\IndexClientModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class IndexAccountRequest extends FormRequest implements IndexClientModel
{
    protected const SORT_FIELDS = [
        'id',
        'name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'zipCode',
        'latitude',
        'longitude',
        'phoneNo1',
        'phoneNo2',
        'startValidity',
        'endValidity',
        'status',
        'createdAt',
        'updatedAt',
    ];

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
        return [
            'sort' => [
                'string',
                'in:'.implode(',', self::SORT_FIELDS),
            ],
            'order' => [
                'string',
                'in:ASC,DESC,asc,desc',
            ],
        ];
    }

    public function getSort(): string
    {
        return $this->input('sort', Arr::first(self::SORT_FIELDS));
    }

    public function getOrder(): string
    {
        return $this->input('order', 'ASC');
    }
}
