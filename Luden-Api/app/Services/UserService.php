<?php

namespace App\Services;

use App\Http\Resources\V1\UserResource;
use App\Interfaces\Repositories\IUserRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class UserService
{
    use HttpResponses;

    private IUserRepository $userRepository;

    function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get(int $id)
    {
        $user = $this->userRepository->get($id);
        return new UserResource($user);
    }

    public function store(array $data)
    {

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return $this->errors('Data invalid', 422, $validator->errors());
        }

        $validatedData = $validator->validated();
        $filteredData = Arr::only($validatedData, ['name', 'email', 'password']);

        $userCreated = $this->userRepository->store($filteredData);

        if ($userCreated) {
            return $this->success('User created', 200, new UserResource($userCreated));
        }

        return $this->errors('User not created', 400);
    }

    public function getList()
    {
        $users = $this->userRepository->getList();
        return UserResource::collection($users);
    }

    public function update(array $data, int $id)
    {

        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errors('Data invalid', 422, $validator->errors());
        }

        $update = $this->userRepository->Update($validator->validated(), $id);

        if ($update) {
            return $this->success('User updated', 200, new UserResource($update));
        }

        return $this->errors('User not updated', 400);
    }

    public function delete(int $id)
    {
        $deleted = $this->userRepository->delete($id);

        if ($deleted) {
            return $this->success('User deleted', 200);
        }

        return $this->errors('User not deleted', 400);
    }
}
