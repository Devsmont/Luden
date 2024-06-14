<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\RpgSessionService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class   RpgSessionController extends Controller
{
    use HttpResponses;

    private RpgSessionService $rpgSessionService;

    function __construct(RpgSessionService $rpgSessionService)
    {
        $this->rpgSessionService = $rpgSessionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->rpgSessionService->getList();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->rpgSessionService->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->rpgSessionService->get($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return $this->rpgSessionService->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->rpgSessionService->delete($id);
    }
}
