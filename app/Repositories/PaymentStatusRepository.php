<?php


namespace App\Repositories;

use App\Models\PaymentStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method PaymentStatus findWithoutFail($id, $columns = ['*'])
 * @method PaymentStatus find($id, $columns = ['*'])
 * @method PaymentStatus first($columns = ['*'])
 */
class PaymentStatusRepository extends BaseRepository
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
        return PaymentStatus::class;
    }
}
