<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $studentID
 * @property int $clinicalID
 * @property Person $person
 * @property Clinical $clinical
 */
class Assignment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['studentID', 'clinicalID'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
        ->select('people.firstName', 'people.lastName', 'assignments.Studentid')
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
    public function clinical()
    {
        return $this->belongsTo('App\Clinical', 'clinicalID');
    }
}