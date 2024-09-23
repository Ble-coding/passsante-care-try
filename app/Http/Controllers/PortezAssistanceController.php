<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVisitPrescriptionRequest;
use App\Http\Requests\StorePortezAssistanceRequest;
use App\Http\Requests\UpdatePortezAssistanceRequest;
use App\Http\Requests\UpdateVisitRequest;
use App\Models\PortezAssistance;
use App\Models\Visit;
use App\Models\VisitNote;
use App\Models\VisitObservation;
use App\Models\VisitPrescription;
use App\Models\VisitProblem;
use App\Repositories\PortezAssistanceRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PortezAssistanceController extends AppBaseController
{
    /** @var assistanceRepository */
    private $assistanceRepository;

    public function __construct(PortezAssistanceRepository $assistancetRepo)
    {
        $this->assistanceRepository = $assistancetRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('portez_assistance.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->assistanceRepository->getData();

        return view('portez_assistance.create', compact('data'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StorePortezAssistanceRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->assistanceRepository->store($input);

        Flash::success(__('messages.flash.assistance_created'));

        if (getLoginUser()->hasRole('assistant')) {
            return redirect(route('assistants.assistances.index'));
        }

        return redirect(route('assistances.index'));
    }





    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function show($id)
    {
        if (getLogInUser()->hasRole('assistant')) {
            $assistant = PortezAssistance::whereId($id)->whereAssistantId(getLogInUser()->assistant->id);
            if (! $assistant->exists()) {
                return redirect()->back();
            }
        }
        $assistance = $this->assistanceRepository->getShowData($id);

        return view('portez_assistance.show', compact('assistance'));
    }


    /**
     * @return Application|Factory|View
     */
    public function edit(PortezAssistance $assistance)
    {
        if (getLogInUser()->hasRole('assistant')) {
            $assistant = PortezAssistance::whereId($assistance->id)->whereAssistantId(getLogInUser()->assistant->id);
            if (! $assistant->exists()) {
                return redirect(route('assistants.assistances.index'));
            }
        }
        $data = $this->assistanceRepository->getData();
        return view('portez_assistance.edit', compact('data', 'assistance'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function update(PortezAssistance $assistance, UpdatePortezAssistanceRequest $request): RedirectResponse
    {
        $input = $request->all();
        $assistance->update($input);

        Flash::success(__('messages.flash.assistance_update'));

        if (getLoginUser()->hasRole('assistant')) {
            return redirect(route('assistants.assistances.index'));
        }

        return redirect(route('assistances.index'));
    }



    public function destroy(PortezAssistance $assistance): mixed
    {
        if (getLogInUser()->hasrole('assistant')) {
            if ($assistance->assistant_id !== getLogInUser()->assistant->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }
        $assistance->delete();

        return $this->sendSuccess(__('messages.flash.assistance_delete'));
    }

}
