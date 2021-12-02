<?php


namespace App\Repositories;

use App\Models\Favorite;
use InfyOm\Generator\Common\BaseRepository;

/**
 * @method Favorite findWithoutFail($id, $columns = ['*'])
 * @method Favorite find($id, $columns = ['*'])
 * @method Favorite first($columns = ['*'])
 */
class FavoriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'e_service_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Favorite::class;
    }
}
