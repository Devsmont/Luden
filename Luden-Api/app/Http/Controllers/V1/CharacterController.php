<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\CharacterService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    use HttpResponses;

    private CharacterService $characterService;

    function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->characterService->getList();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->characterService->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->characterService->get($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return $this->characterService->update($request->all(), $id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->characterService->delete($id);
    }
}
