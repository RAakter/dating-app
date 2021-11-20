<?php


namespace App\Repositories;

use App\Models\Mutual;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserlistRepository implements UserlistRepositoryInterface
{

    public function nearestUserList($mode)
    {
        $from = Auth::user();
        $fromLatitude = $from->latitude;
        $fromLongitude = $from->longitude;
        $users = User::where('id','!=',$from->id)->get();

        $limit = 5;
        $nearestuserlist = array();

        if ($users != '')
        {
            $i = 0;
            foreach($users as $user)
            {
                $distance = $this->get_distance($fromLatitude, $fromLongitude, $user->latitude,$user->longitude , $unit = 'Km' );
                $user->distance = $distance;

                if ($user->gender == 0){
                    $user->gender = 'Male';
                }
                elseif ($user->gender == 1){
                    $user->gender = 'Female';
                }

                $user->age = Carbon::parse($user->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');

                $mutual = Mutual::where(['action_on' => $user->id, 'action_by' => Auth::user()->id])->first();
                if ($mutual)
                {
                    $user->type = $mutual->name;
                }
                else
                {
                    $user->type = 'None';
                }

            if ($mode != 'map')
               {
                    if ($distance <= $limit)
                    {
                        $nearestuserlist[$i] = $user;
                    }

               }
            else
            {
                if ($distance <= $limit)
                {
                    $nearestuserlist[$i] = (array)$user;
                }
            }
                $i++;
            }

        }
        return array_values($nearestuserlist);
    }


    protected function get_distance($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km')
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) +
            (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
                cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch($unit) {
            case 'Mi':
                break;
            case 'Km' :
                $distance = $distance * 1.609344;
        }
        return (round($distance,2));
    }

}
