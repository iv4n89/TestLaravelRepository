<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = $this->repository->getAllUsers();
        return response($allUsers, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new User($request->all());
        $newUser = $this->repository->save($newUser);
        return response($newUser, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->getOneUser($id);
        if(!$user instanceof User) {
            return response($user, 500);
        }
        return response($user, 200);
    }

    public function showByName(Request $request)
    {
        $user = $this->repository->getUserByName($request->input('name'));
        if(!$user instanceof User)
        {
            return response($user, 500);
        }
        return response($user, 200);
    }

    public function showByEmail(Request $request)
    {
        $user = $this->repository->getUserByEmail($request->email);
        if(!$user instanceof User)
        {
            return response($user, 500);
        }
        return response($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userToUpdate = new User($request->all());
        $userToUpdate = $this->repository->update($id, $userToUpdate);
        if(!$userToUpdate instanceof User)
        {
            return response($userToUpdate, 500);
        }
        return response($userToUpdate, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->repository->delete($id);
        if($result)
        {
            return response($result, 500);
        }
    }
}