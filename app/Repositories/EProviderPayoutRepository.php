<?php

namespace App\Repositories;

use App\Models\EProviderPayout;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method EProviderPayout findWithoutFail($id, $columns = ['*'])
 * @method EProviderPayout find($id, $columns = ['*'])
 * @method EProviderPayout first($columns = ['*'])
 */
class EProviderPayoutRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'e_provider_id',
        'method',
        'amount',
        'paid_date',
        'note'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EProviderPayout::class;
    }
}
