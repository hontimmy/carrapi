<?php


namespace App\Repositories;

use App\Models\EProvider;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method EProvider findWithoutFail($id, $columns = ['*'])
 * @method EProvider find($id, $columns = ['*'])
 * @method EProvider first($columns = ['*'])
 */
class EProviderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
		'user_id',
        'e_provider_type_id',
        'description',
		'phone',
		'email',        
		'availability_range',
        'available',
        'featured'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EProvider::class;
    }
}
