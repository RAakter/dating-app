<?php

namespace App\Http\Controllers;

use App\Repositories\MutualRepositoryInterface;
use App\Repositories\UserlistRepositoryInterface;
use Illuminate\Http\Request;

class MutualController extends Controller
{
    /**
     * @var MutualRepositoryInterface
     */
    private $mutualRepository;
    private $like;
    private $dislike;
    private $userlistRepository;

    /**
     * @var UserlistRepositoryInterface
     */
    /**
     * @var UserlistRepositoryInterface
     */

    public function __construct(MutualRepositoryInterface $mutualRepository, UserlistRepositoryInterface $userlistRepository)
    {
        $this->mutualRepository = $mutualRepository;
        $this->like = 'like';
        $this->dislike = 'dislike';
        $this->userlistRepository = $userlistRepository;
    }

    public function like(Request $request)
    {
        $response =  $this->mutualRepository->update($this->like, $request->id);
        return json_encode($response);
    }


    public function dislike(Request $request)
    {
        $response =  $this->mutualRepository->update($this->dislike, $request->id);
        return json_encode($response);
    }

    public function map()
    {
        $users =  $this->userlistRepository->nearestUserList('map');
        dd($users->select('name'));
        return view('map', compact('users'));

    }

}
