<?php


namespace App\Repositories;

use App\Models\CustomFieldValue;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method CustomFieldValue findWithoutFail($id, $columns = ['*'])
 * @method CustomFieldValue find($id, $columns = ['*'])
 * @method CustomFieldValue first($columns = ['*'])
 */
class CustomFieldValueRepository extends BaseRepository
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
        return CustomFieldValue::class;
    }
}
