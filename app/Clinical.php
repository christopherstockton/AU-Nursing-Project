<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $courseID
 * @property int $siteID
 * @property int $instructorID
 * @property int $instructorID2
 * @property string $startDate
 * @property string $endDate
 * @property string $startTime
 * @property string $endTime
 * @property string $days
 * @property boolean $capacity
 * @property boolean $flag
 * @property int $roomNumber
 * @property string $created_at
 * @property string $updated_at
 * @property Person $person
 * @property Course $course
 * @property Site $site
 * @property Person $person
 * @property Assignment[] $assignments
 */
class Clinical extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['courseID', 'siteID', 'instructorID', 'instructorID2', 'startDate', 'endDate', 'startTime', 'endTime', 'days', 'capacity', 'flag', 'roomNumber', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor1()
    {
        return $this->belongsTo('App\Person', 'instructorID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Course', 'courseID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo('App\Site', 'siteID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor2()
    {
        return $this->belongsTo('App\Person', 'instructorID2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany('App\Assignment', 'clinicalID');
    }
}
