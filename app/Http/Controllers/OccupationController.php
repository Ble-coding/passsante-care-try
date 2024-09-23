<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOccupationRequest;
use App\Http\Requests\UpdateOccupationRequest;
use App\Models\Occupation;
use App\Repositories\OccupationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class OccupationController extends AppBaseController
{
    /** @var OccupationRepository */
    private $occupationRepository;

    public function __construct(OccupationRepository $occupationRepo)
    {
        $this->occupationRepository = $occupationRepo;
    }

    /**
     * Display a listing of the Occupation.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('occupations.index');
    }

    /**
     * Store a newly created Occupation in storage.
     */
    public function store(CreateOccupationRequest $request): JsonResponse
    {
        $input = $request->all();

        $this->occupationRepository->create($input);

        return $this->sendSuccess(__('messages.flash.occupation_create'));
    }

    /**
     * Show the form for editing the specified Occupation.
     */
    public function edit(Occupation $occupation): JsonResponse
    {
        return $this->sendResponse($occupation, __('messages.occupation.retrieved_successfully'));
    }

    /**
     * Update the specified Occupation in storage.
     */
    public function update(UpdateOccupationRequest $request, Occupation $occupation): JsonResponse
    {
        $this->occupationRepository->update($request->all(), $occupation->id);

        return $this->sendSuccess(__('messages.flash.occupation_update'));
    }

    /**
     * Remove the specified Occupation from storage.
     */
    public function destroy(Occupation $occupation): JsonResponse
    {
        if ($occupation->assistants()->count()) {
            return $this->sendError(__('messages.flash.occupation_used_some_where'));
        }
        $occupation->delete();

        return $this->sendSuccess(__('messages.flash.occupation_delete'));
    }
}
