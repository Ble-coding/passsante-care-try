<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServicesAssistantRequest;
use App\Http\Requests\UpdateServicesAssistantRequest;
use App\Models\AppointmentAssistant;
use App\Models\ServiceAssistant;
use App\Repositories\ServicesAssistantRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class ServiceAssistantController extends AppBaseController
{
    /** @var ServicesAssistantRepository */
    private $servicesAssistantRepository;

    public function __construct(ServicesAssistantRepository $servicesRepo)
    {
        $this->servicesAssistantRepository = $servicesRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $status = ServiceAssistant::STATUS;

        return view('services_assistants.index', compact('status'));
    }

    /**
     * Show the form for creating a new Services.
     *
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->servicesAssistantRepository->prepareData();

        return view('services_assistants.create', compact('data'));
    }

    /**
     * Store a newly created Services in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateServicesAssistantRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->servicesAssistantRepository->store($input);

        Flash::success(__('messages.flash.service_create'));

        return redirect(route('services-assistant.index'));
    }

    /**
     * Show the form for editing the specified Services.
     *
     * @return Application|Factory|View
     */
    public function edit(ServiceAssistant $service): \Illuminate\View\View
    {
        $data = $this->servicesAssistantRepository->prepareData();
        $selectedAssistant = $service->serviceAssistants()->pluck('assistant_id')->toArray();

        return view('services_assistants.edit', compact('service', 'data', 'selectedAssistant'));
    }

    /**
     * Update the specified Services in storage.
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateServicesAssistantRequest $request, ServiceAssistant $service): RedirectResponse
    {
        $this->servicesAssistantRepository->update($request->all(), $service);

        Flash::success(__('messages.flash.service_update'));

        return redirect(route('services-assitant.index'));
    }

    /**
     * Remove the specified Services from storage.
     */
    public function destroy(ServiceAssistant $service): JsonResponse
    {
        $checkRecord = AppointmentAssistant::whereServiceId($service->id)->exists();

        if ($checkRecord) {
            return $this->sendError(__('messages.flash.service_use'));
        }
        $service->delete();

        return $this->sendSuccess(__('messages.flash.service_delete'));
    }

    public function getService(Request $request) 
    {
        $assistant_id = $request->appointmentAssistantId;
        $service = ServiceAssistant::with('serviceAssistants')->whereHas('serviceAssistants', function ($q) use ($assistant_id) {
            $q->where('assistant_id', $assistant_id)->whereStatus(ServiceAssistant::ACTIVE);
        })->get();

        return $this->sendResponse($service, __('messages.flash.retrieve'));
    }

    public function getCharge(Request $request): JsonResponse
    {
        $chargeId = $request->chargeId;
        $charge = ServiceAssistant::find($chargeId);

        return $this->sendResponse($charge, __('messages.flash.retrieve'));
    }

    /**
     * @return mixed
     */
    public function changeServiceStatus(Request $request)
    {
        $status = ServiceAssistant::findOrFail($request->id);
        $status->update(['status' => ! $status->status]);

        return $this->sendResponse($status, __('messages.flash.status_update'));
    }
}
