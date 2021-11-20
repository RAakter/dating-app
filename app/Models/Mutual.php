<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mutual extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function alreadyOccurred($action, $userId)
    {
        $user = Auth::user()->id;

        return Mutual::where([
            'type' => $action,
            'action_on' => $userId,
            'action_by' => $user
        ])->get()->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
