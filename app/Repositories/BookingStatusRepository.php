<?php

namespace App\Repositories;

use App\Models\BookingStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
   @method BookingStatus findWithoutFail($id, $columns = ['*'])
 * @method BookingStatus find($id, $columns = ['*'])
 * @method BookingStatus first($columns = ['*'])
 */
class BookingStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'order'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BookingStatus::class;
    }
}
