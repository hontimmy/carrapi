<?php


namespace App\Repositories;

use App\Models\Experience;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method Experience findWithoutFail($id, $columns = ['*'])
 * @method Experience find($id, $columns = ['*'])
 * @method Experience first($columns = ['*'])
 */
class ExperienceRepository extends BaseRepository
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
        return Experience::class;
    }
}
