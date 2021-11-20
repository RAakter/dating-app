<?php


namespace App\Repositories;

use App\Models\Mutual;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MutualRepository implements MutualRepositoryInterface
{
    public function update($action, $userId)
    {
        $loginuser = Auth::user();

        $mutual = new Mutual();

        $alreadyOccurred = $mutual->alreadyOccurred($action, $userId);

        $data['type'] = 'like';
        $data['matched'] = false;

        if ($action == 'like')
        {
            if (Mutual::where([
                    'type' => 'dislike',
                    'action_on' => $userId,
                    'action_by' => $loginuser->id
                ])->get()->count() == 1)
            {
                Mutual::where([
                    'type' => 'dislike',
                    'action_on' => $userId,
                    'action_by' => $loginuser->id
                ])->delete();
            }


            $checkMatched =  $this->checkMatched($action, $loginuser->id, $userId );

            if ( $checkMatched == 1 )
            {
                $data['matched'] = true;
            }
        }
        else if( $action == 'dislike' )
        {
            if (Mutual::where([
                    'type' => 'like',
                    'action_on' => $userId,
                    'action_by' => $loginuser->id
                ])->get()->count() == 1)
            {
                Mutual::where([
                    'type' => 'like',
                    'action_on' => $userId,
                    'action_by' => $loginuser->id
                ])->delete();
            }
        }

        /*
         *
         * If no like or dislike for the clicked user, then create a like or dislike mapping
         *
        */
        if ($alreadyOccurred == 0 )
        {
            Mutual::create([
                'type' => $action,
                'action_on' => $userId,
                'action_by' => $loginuser->id
            ]);

            $data['message'] = 'you '.$action. ' ' .  User::findOrFail($userId)->name;

        }
        else
        {

            $data['message'] = 'you already '.$action. ' ' .  User::findOrFail($userId)->name;
            $data['matched'] = false;
        }

        return $data;

    }

    private function checkMatched($action, $loginUserId, $userId)
    {
        return Mutual::where([
            'type' => $action,
            'action_on' => $loginUserId,
            'action_by' => $userId
        ])->get()->count();
    }


}
