<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $CourseSection
 * @property string $CourseName
 * @property string $created_at
 * @property string $updated_at
 * @property Clinical[] $clinicals
 */
class Course extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['CourseSection', 'CourseName', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clinicals()
    {
        return $this->hasMany('App\Clinical', 'courseID');
    }
}
