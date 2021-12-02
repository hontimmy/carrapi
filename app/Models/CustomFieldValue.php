<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 @property CustomField customField
 * @property string value
 * @property integer custom_field_id
 * @property string customizable_type
 * @property integer customizable_id
 */
class CustomFieldValue extends Model
{

    public $table = 'custom_field_values';
    


    public $fillable = [
        'value',
        'view',
        'custom_field_id',
        'customizable_type',
        'customizable_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'string',
        'view' => 'string',
        'custom_field_id' => 'integer',
        'customizable_type' => 'string',
        'customizable_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'custom_field_id' => 'required|exists:custom_fields,id',
        'customizable_type' => 'required',
        'customizable_id' => 'required'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        
    ];

    /**
     * @return BelongsTo
     **/
    public function customField()
    {
        return $this->belongsTo(CustomField::class, 'custom_field_id', 'id');
    }

    public function customizable()
    {
        return $this->morphTo();
    }
}
