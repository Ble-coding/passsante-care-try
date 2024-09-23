<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewAssistantRequest;
use App\Http\Requests\UpdateReviews_assistantRequest;
use App\Models\Appointment;
use App\Models\AppointmentAssistant;
use App\Models\Assistant;
use App\Models\Notification;
use App\Models\NotificationAssistant;
use App\Models\Patient;
use App\Models\Review_assistant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReviewsAssistantController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $patient = Patient::whereUserId(getLogInUserId())->first();
        $assistantIds = AppointmentAssistant::wherePatientId($patient['id'])->whereStatus(AppointmentAssistant::CHECK_OUT)->pluck('assistant_id')->toArray();
        $assistants = Assistant::with('user', 'specializations', 'reviews_assistants')
            ->whereIn('id', $assistantIds)
            ->get();

        return view('reviews_assistant.index', compact('assistants'));
    }

    /**
     * @return mixed
     */
    public function store(CreateReviewAssistantRequest $request)
    {
        $canReview = AppointmentAssistant::wherePatientId(getLogInUser()->patient->id)->whereAssistantId($request->assistant_id);
        if (! $canReview->exists()) {
            return $this->sendError(__('messages.common.not_allow__assess_record'));
        }
        $input = $request->all();
        $patient = Patient::whereUserId(getLogInUserId())->first();
        $input['patient_id'] = $patient['id'];
        Review_assistant::create($input);
        Notification::create([
            'title' => getLogInUser()->full_name.' just added '.$input['rating'].' star review for you.',
            'type' => NotificationAssistant::REVIEW,
            'user_id' => Assistant::whereId($input['assistant_id'])->first()->user_id,
        ]);

        return $this->sendSuccess(__('messages.flash.review_add'));
    }

    /**
     * @return mixed
     */
    public function edit(CreateReviewAssistantRequest $review)
    {
        $canEditReview = Review_assistant::whereId($review->id)->wherePatientId(getLogInUser()->patient->id);
        if (! $canEditReview->exists()) {
            return $this->sendError(__('messages.common.not_allow__assess_record'));
        }

        return $this->sendResponse($review, __('messages.flash.review_retrieved'));
    }

    /**
     * @return mixed
     */
    public function update(UpdateReviews_assistantRequest $request, Review_assistant $review)
    {
        $data = $request->all();
        $review->update($data);

        return $this->sendSuccess(__('messages.flash.review_edit'));
    }
}
