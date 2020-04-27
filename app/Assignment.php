<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $studentID
 * @property int $clinicalID
 * @property int $courseID
 * @property Person $person
 * @property Clinical $clinical
 * @property Course $course
 */
class Assignment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['studentID', 'clinicalID', 'courseID'];

    public function retrieve($id)
    {
        return $this
        ->join('clinicals', 'assignments.clinicalID', '=', 'clinicals.id')
        ->join('courses', 'clinicals.courseID', '=', 'courses.id')
        ->where('assignments.studentID', $id)
        ->select('assignments.studentID', 'clinicals.id', 'courses.courseName')
        ->get();
    }

    public function retrieveStudents($id) {
        return $this
        ->join('people', 'assignments.studentID', '=', 'people.id')
        ->where('assignments.clinicalID', $id)
        ->select('people.firstName', 'people.lastName', 'people.id', 'assignments.Studentid')
        ->get();
    }

    public function isEmpty($id) 
    {
        if ($this->where('studentID', $id)->get()->isEmpty())
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo('App\Person', 'studentID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinical()
    {
        return $this->belongsTo('App\Clinical', 'clinicalID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Course', 'courseID');
    }
}
