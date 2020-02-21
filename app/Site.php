<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $siteName
 * @property int $contactID
 * @property string $address
 * @property string $unit
 * @property string $created_at
 * @property string $updated_at
 * @property Person $person
 * @property Clinical[] $clinicals
 */
class Site extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['siteName', 'contactID', 'address', 'unit', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo('App\Person', 'contactID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clinicals()
    {
        return $this->hasMany('App\Clinical', 'siteID');
    }
}
