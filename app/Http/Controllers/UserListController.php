<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserlistRepositoryInterface;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    /**
     * @var UserlistRepositoryInterface
     */
    private $UserlistRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserlistRepositoryInterface $UserlistRepository
     */
    public function __construct(UserlistRepositoryInterface $UserlistRepository)
    {
        $this->middleware('auth');
        $this->UserlistRepository = $UserlistRepository;
    }

    public function index(){
        return view('dashboard');
    }

    public function userlist(){
        $list = $this->UserlistRepository->nearestUserList('list');

        if ($list)
        {
            $data['list_size'] = count($list);
            $data['data'] = $list;
        }
        else
        {
            $data['list_size'] = 0;
            $data['data'] = [];
        }

        $response = json_encode($data);
        return $response;
    }
}
