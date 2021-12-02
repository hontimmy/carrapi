<?php


namespace App\Repositories;

use App\Models\OptionGroup;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method OptionGroup findWithoutFail($id, $columns = ['*'])
 * @method OptionGroup find($id, $columns = ['*'])
 * @method OptionGroup first($columns = ['*'])
 */
class OptionGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'allow_multiple'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OptionGroup::class;
    }
}
