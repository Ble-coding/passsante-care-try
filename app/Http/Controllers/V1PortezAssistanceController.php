<?php

namespace App\Http\Controllers;

use App\Models\PortezAssistance;
use App\Http\Requests\StorePortezAssistanceRequest;
use App\Http\Requests\UpdatePortezAssistanceRequest;

class V1PortezAssistanceController extends Controller
{

    /** @var VisitRepository */
    private $visitRepository;

    public function __construct(PortezAssistanceRepository $visitRepo)
    {
        $this->visitRepository = $visitRepo; 
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\View\View
    {
        return view('portez_assistance.index'); 
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortezAssistanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PortezAssistance $portezAssistance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortezAssistance $portezAssistance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortezAssistanceRequest $request, PortezAssistance $portezAssistance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortezAssistance $portezAssistance)
    {
        //
    }
}
