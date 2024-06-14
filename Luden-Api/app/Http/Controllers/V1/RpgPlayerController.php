<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\RpgPlayerService;
use Illuminate\Http\Request;

class RpgPlayerController extends Controller
{
    private RpgPlayerService $playerService;

    function __construct(RpgPlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function index()
    {
        return $this->playerService->getList();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->playerService->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->playerService->get($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return $this->playerService->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->playerService->delete($id);
    }
}
