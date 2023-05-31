<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Http\Requests\StorepeopleRequest;
use App\Http\Requests\UpdatepeopleRequest;
use Illuminate\Http\JsonResponse;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(People::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepeopleRequest $request): JsonResponse
    {
        $people = People::create($request->all());
        return reposnse()->json($people->id, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        return response()->json(People::query()->findorfail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepeopleRequest $request): JsonResponse
    {
        People::query()->findorfail($request->route('id')) ->update($request->all());
        return response()->noContent(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResposne
    {
        People::query()->findorfail($id)->delete();
        return response()-noContent(200);
    }
}
