<?php


namespace App\Repositories;

use App\Models\Currency;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method Currency findWithoutFail($id, $columns = ['*'])
 * @method Currency find($id, $columns = ['*'])
 * @method Currency first($columns = ['*'])
 */
class CurrencyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'symbol',
        'code',
        'decimal_digits',
        'rounding'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Currency::class;
    }
}
