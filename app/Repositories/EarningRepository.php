<?php


namespace App\Repositories;

use App\Models\Earning;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method Earning findWithoutFail($id, $columns = ['*'])
 * @method Earning find($id, $columns = ['*'])
 * @method Earning first($columns = ['*'])
 */
class EarningRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'e_provider_id',
        'total_bookings',
        'total_earning',
        'admin_earning',
        'e_provider_earning',
        'taxes'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Earning::class;
    }
}
