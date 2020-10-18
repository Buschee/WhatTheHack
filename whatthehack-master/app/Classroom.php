<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //relation between users and classrooms
    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }

    //relation between challenges and classrooms
    public function challenges()
    {
        return $this
            ->belongsToMany('App\Challenge')
            ->withTimestamps();
    }

    //get members of a specific classroom
    public function getMembers($id)
    {
        foreach ($this->users as $u)
        {
            if($u->id == $id)
                return true;
        }
        return false;
    }

    //get all challenges of a specific classroom
    public function getClassroomChallenges($id)
    {
        foreach ($this->challenges as $challenge)
        {
            if($challenge->id == $id)
                return true;
        }
        return false;
    }

    //get the classroom owner
    public function isOwner($id)
    {
        if($this->classroom_owner == $id)
            return true;
        return false;
    }

    //get a list of all users of a specific classroom
    public function getRankedUsers()
    {
        $users = $this->users;
        $ranked = array();
        $rank = 1;
        $sorted = collect($users)->sortBy('points', 1, true);
        foreach ($sorted as $value){
            $ranked[$rank] = $value;
            $rank++;
        }
        return $ranked;
    }

    //number of active classrooms
    static function countActiveClassrooms()
    {
        $classrooms = Classroom::all();
        $counter = 0;
        foreach ($classrooms as $classroom)
        {
            if($classroom->active == 1)
            {
                $counter++;
            }
        }
        return $counter;
    }

    //number of disabled classrooms
    static function countDisabledClassrooms()
    {
        $classrooms = Classroom::all();
        $counter = 0;
        foreach ($classrooms as $classroom)
        {
            if(!$classroom->active)
            {
                $counter++;
            }
        }
        return $counter;
    }

    static function getClassRoom($name)
    {
        return Classroom::where('classroom_name', $name)->first();
    }

    static function createClassroom($name, $users, $addAll = false)
    {
        $admin = User::getUser("Admin");

        $classroom = new Classroom();
        $classroom->classroom_name = $name;
        $classroom->classroom_owner = $admin->id;
        $classroom->save();

        //Creator of a classroom is automatically a member
        $classroom->users()->attach($admin->id);

        //Add specified users to classroom
        if($users != null && sizeof($users) > 0)
        {
            foreach ($users as $user)
            {
                $classroom->users()->attach($user);
            }
        }

        //Check if all challenges should be added to the classroom
        if($addAll)
        {
            foreach (Challenge::all() as $c)
            {
                if ($c->active == true)
                    $classroom->challenges()->attach($c);
            }
        }
    }
}
