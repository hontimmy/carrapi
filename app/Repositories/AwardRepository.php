<?php


namespace App\Repositories;

use App\Models\Award;
use InfyOm\Generator\Common\BaseRepository;

/**
   @method Award findWithoutFail($id, $columns = ['*'])
 * @method Award find($id, $columns = ['*'])
 * @method Award first($columns = ['*'])
 */
class AwardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'e_provider_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Award::class;
    }
}
