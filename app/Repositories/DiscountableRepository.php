<?php

namespace App\Repositories;

use App\Models\Discountable;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method Discountable findWithoutFail($id, $columns = ['*'])
 * @method Discountable find($id, $columns = ['*'])
 * @method Discountable first($columns = ['*'])
 */
class DiscountableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'custom_field_id',
        'customizable_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Discountable::class;
    }
}
