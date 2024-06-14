<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\RpgService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class RpgController extends Controller
{
    use HttpResponses;

    private RpgService $rpgService;

    public function __construct(RpgService $rpgService)
    {
        $this->rpgService = $rpgService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->rpgService->getList();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->rpgService->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->rpgService->get($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return $this->rpgService->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->rpgService->delete($id);
    }
}
