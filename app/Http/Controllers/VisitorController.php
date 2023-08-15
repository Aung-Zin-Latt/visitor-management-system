<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Visitor;
use App\Contracts\VisitorInterface;
use App\Http\Requests\VisitorRequest;
use App\Http\Resources\VisitorResource;

class VisitorController extends Controller
{
    private VisitorInterface $visitorInterface;
    public function __construct(VisitorInterface $visitorInterface)
    {
        $this->visitorInterface = $visitorInterface;
    }

    public function index()
    {
        $visitors = $this->visitorInterface->all();
        return VisitorResource::collection($visitors);
    }


    public function create()
    {
        //
    }


    public function store(VisitorRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['check_in_time'] = Carbon::parse($validatedData['check_in_time'])->format('Y-m-d H:i:s');
        $validatedData['check_out_time'] = Carbon::parse($validatedData['check_out_time'])->format('Y-m-d H:i:s');

        $visitor = $this->visitorInterface->store($validatedData);
        // return $visitor;

        if (!$visitor) 
        {
            return response()->json([
                'message' => 'Failed to create visitor'
            ], 401);
        }
        return new VisitorResource($visitor);
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(VisitorRequest $request, string $id)
    {
        $validatedData = $request->validate();

        $validatedData['check_in_time'] = Carbon::parse($validatedData['check_in_time'])->format('Y-m-d H:i:s');
        $validatedData['check_out_time'] = Carbon::parse($validatedData['check_out_time'])->format('Y-m-d H:i:s');

        // $visitor = Visitor::find($id);
        $visitor = $this->visitorInterface->model::find($id);

        if (!$visitor) 
        {
            return response()->json([
               'message' => 'Failed to update visitor'
            ], 401);
        }
        $visitor = $this->visitorInterface->update($validatedData, $id);

        return new VisitorResource($visitor);
    }


    public function destroy(string $id)
    {
        // $visitor = Visitor::find($id);
        $visitor = $this->visitorInterface->model::find($id);

        if (!$visitor) 
        {
            return response()->json([
              'message' => 'Could not find visitor'
            ], 401);
        }
        $visitor = $this->visitorInterface->delete($id);

        return new VisitorResource($visitor);
    }


    public function checkout($id)
    {
        $visitor = Visitor::find($id);

        if (!$visitor) {
            return response()->json([
                'message' => 'Visitor not found'
            ], 404);
        }

        if ($visitor->status === 0) {
            return response()->json([
                'message' => 'Visitor has already checked out'
            ], 400);
        }

        $visitor->update(['status' => 0]);

        return response()->json([
            'message' => 'Visitor checked out successfully'
        ]);
    }


}
