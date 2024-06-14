<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\RpgSystemService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class RpgSystemController extends Controller
{

    use HttpResponses;

    private RpgSystemService $userService;

    /**
     * Display a listing of the resource.
     */
    function __construct(RpgSystemService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getList();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->userService->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->userService->get($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return $this->userService->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->userService->delete($id);
    }
}
