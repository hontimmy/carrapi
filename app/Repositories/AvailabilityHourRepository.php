<?php

namespace App\Repositories;

use App\Models\AvailabilityHour;
use InfyOm\Generator\Common\BaseRepository;

/**
   @method AvailabilityHour findWithoutFail($id, $columns = ['*'])
 * @method AvailabilityHour find($id, $columns = ['*'])
 * @method AvailabilityHour first($columns = ['*'])
 */
class AvailabilityHourRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'day',
        'start_at',
        'end_at',
        'data',
        'e_provider_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AvailabilityHour::class;
    }
}
