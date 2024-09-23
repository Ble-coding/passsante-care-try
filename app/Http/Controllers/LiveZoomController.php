<?php

namespace App\Http\Controllers;

use App\Models\LiveZoom;
use App\Http\Requests\StoreLiveZoomRequest;
use App\Http\Requests\UpdateLiveZoomRequest;

class LiveZoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLiveZoomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LiveZoom $liveZoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LiveZoom $liveZoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLiveZoomRequest $request, LiveZoom $liveZoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiveZoom $liveZoom)
    {
        //
    }

    public function createMeeting(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'consultation_title' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'duration_in_minute' => 'required|integer|min:0|max:720',
            'description' => 'nullable|string',
            'host_video' => 'required|boolean',
            'participant_video' => 'required|boolean',
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->generateToken(),
                'Content-Type' => 'application/json',
            ])->post("https://api.zoom.us/v2/users/me/meetings", [
                'topic' => $validated['consultation_title'], // corrected key
                'type' => 2, // 2 for scheduled meeting
                'start_time' => $validated['consultation_date'], // corrected key
                'duration' => $validated['duration_in_minute'],
            ]);

            // Save meeting details to the database
            $meeting = new LiveZoom();
            $meeting->fill($validated);
            $meeting->meeting_id = $response->json()['id'];
            $meeting->user_id = Auth::id(); // Save the authenticated user's ID
            $meeting->save();

            return $meeting->toArray(); // Return the created meeting details

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function generateToken(): string
    {
        try {
            $base64String = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
            $accountId = env('ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type"=> "application/x-www-form-urlencoded",
                "Authorization"=> "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            return $responseToken->json()['access_token'];

        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
