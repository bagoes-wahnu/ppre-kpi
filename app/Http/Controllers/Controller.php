<?php

namespace App\Http\Controllers;

use App\Helpers\HelperPublic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $responseCode = Response::HTTP_OK;
    protected $responseStatus = '';
    protected $responseMessage = '';
    protected $responseData = [];
    protected $responseRequest = [];

    public function getResponse()
    {
        return HelperPublic::helpResponse($this->responseCode, $this->responseData, $this->responseMessage, $this->responseStatus, $this->responseRequest);
    }

    public function pageNotFound()
    {
        return response()->view('errors.404', [], 404);
    }

    public function accessForbidden()
    {
    	return response()->view('errors.403', [], 403);
    }
}
