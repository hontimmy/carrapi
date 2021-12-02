<?php


namespace App\Repositories;

use App\Models\EProviderType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method EProviderType findWithoutFail($id, $columns = ['*'])
 * @method EProviderType find($id, $columns = ['*'])
 * @method EProviderType first($columns = ['*'])
 */
class EProviderTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'commission',
        'disabled'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EProviderType::class;
    }
}
