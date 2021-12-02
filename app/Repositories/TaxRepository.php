<?php


namespace App\Repositories;

use App\Models\Tax;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method Tax findWithoutFail($id, $columns = ['*'])
 * @method Tax find($id, $columns = ['*'])
 * @method Tax first($columns = ['*'])
 */
class TaxRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'value',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tax::class;
    }
}
