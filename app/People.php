<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $phoneNumber
 * @property string $emailAddress
 * @property string $notes
 * @property boolean $flag
 * @property string $created_at
 * @property string $updated_at
 * @property Assignment[] $assignments
 * @property Clinical[] $clinicals
 * @property Clinical[] $clinicals
 * @property Site[] $sites
 */
class People extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['firstName', 'lastName', 'phoneNumber', 'emailAddress', 'notes', 'flag', 'created_at', 'updated_at'];

    public function getList($flag) 
    {
        return $this->where('flag', $flag)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany('App\Assignment', 'studentID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instructor1()
    {
        return $this->hasMany('App\Clinical', 'instructorID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instructor2()
    {
        return $this->hasMany('App\Clinical', 'instructorID2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites()
    {
        return $this->hasMany('App\Site', 'contactID');
    }
}
