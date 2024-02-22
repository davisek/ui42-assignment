<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mayor_name',
        'city_hall_address',
        'phone',
        'fax',
        'email',
        'web_address',
        'lat',
        'lng',
        'district_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
