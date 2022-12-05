<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $this->responseCode = 200;
        $this->responseMessage = 'Notifikasi';
        $this->responseData['notifications'] = [
            'all' => NotificationResource::collection($user->notifications),
            'unread' => NotificationResource::collection($user->unreadNotifications)
        ];

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Tandai notifikasi sudah terbaca
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
        $notification = Auth::user()->unreadNotifications->find($request->id);

        if (!empty($notification)) {
            $notification->markAsRead();
        }

        $this->responseCode = 200;
        $this->responseMessage = 'READ';

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Tandai semua notifikasi sudah terbaca
     *
     * @return \Illuminate\Http\Response
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        $this->responseCode = 200;
        $this->responseMessage = 'MARK_ALL_AS_SREAD';

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 
    }
}
