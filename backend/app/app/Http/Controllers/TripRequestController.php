<?php

namespace App\Http\Controllers;

use App\Models\TripRequest;
use App\Http\Requests\TripRequestStoreRequest;
use App\Http\Requests\TripRequestUpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TripRequestController extends Controller
{
    public function index(Request $request)
    {
        return TripRequest::searchPaginate($request->all());
    }

    public function store(TripRequestStoreRequest $request)
    {
        $entity = TripRequest::create($request->validated());
        return compact(['entity']);
    }

    public function show($id)
    {
        $entity = TripRequest::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        return compact(['entity']);
    }

    public function update(TripRequestUpdateRequest $request, $id)
    {
        $entity = TripRequest::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        $entity->update($request->validated());
        return compact(['entity']);
    }

    public function destroy($id)
    {
        $entity = TripRequest::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        $entity->delete();
        return compact(['entity']);
    }

    public function approve($id)
    {
        $entity = TripRequest::find($id);
        $entity->status = 'approved';
        $entity->save();
        return compact(['entity']);
    }
}
