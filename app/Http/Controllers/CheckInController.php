<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Contracts\CheckinInterface;
use App\Http\Requests\CheckinRequest;
use App\Http\Resources\CheckinResource;

class CheckInController extends Controller
{
    private CheckinInterface $checkinInterface;
    public function __construct(CheckinInterface $checkinInterface)
    {
        $this->checkinInterface = $checkinInterface;
    }

    public function index()
    {
        $check_ins = $this->checkinInterface->all();
        return CheckinResource::collection($check_ins);
    }


    public function create()
    {
        //
    }


    public function store(CheckinRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['check_in_time'] = Carbon::parse($validatedData['check_in_time'])->format('Y-m-d H:i:s');
        $validatedData['check_out_time'] = Carbon::parse($validatedData['check_out_time'])->format('Y-m-d H:i:s');

        $check_ins = $this->checkinInterface->store($validatedData);

        if (!$check_ins) 
        {
            return response()->json([
                'message' => 'Failed to create check in'
            ], 401);
        }
        return new CheckinResource($check_ins);
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(CheckinRequest $request, string $id)
    {
        $validatedData = $request->validate();

        $validatedData['check_in_time'] = Carbon::parse($validatedData['check_in_time'])->format('Y-m-d H:i:s');
        $validatedData['check_out_time'] = Carbon::parse($validatedData['check_out_time'])->format('Y-m-d H:i:s');

        $check_in = $this->checkinInterface->model::find($id);

        if (!$check_in) 
        {
            return response()->json([
               'message' => 'Failed to update checkin'
            ], 401);
        }
        $check_in = $this->checkinInterface->update($validatedData, $id);

        return new CheckinResource($check_in);
    }


    public function destroy(string $id)
    {
        $check_in = $this->checkinInterface->model::find($id);

        if (!$check_in) 
        {
            return response()->json([
              'message' => 'Could not find check in'
            ], 401);
        }
        $check_in = $this->checkinInterface->delete($id);

        return new CheckinResource($check_in);
    }
}
