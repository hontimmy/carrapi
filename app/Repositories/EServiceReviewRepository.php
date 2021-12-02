<?php

namespace App\Repositories;

use App\Models\EServiceReview;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method EServiceReview findWithoutFail($id, $columns = ['*'])
 * @method EServiceReview find($id, $columns = ['*'])
 * @method EServiceReview first($columns = ['*'])
 */
class EServiceReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review',
        'rate',
        'user_id',
        'e_service_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EServiceReview::class;
    }
}
