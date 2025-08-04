<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use App\Http\Requests\AppNotificationStoreRequest;
use App\Http\Requests\AppNotificationUpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AppNotificationController extends Controller
{
    public function index(Request $request)
    {
        return AppNotification::searchPaginate($request->all());
    }

    public function store(AppNotificationStoreRequest $request)
    {
        $entity = AppNotification::create($request->validated());
        return compact(['entity']);
    }

    public function show($id)
    {
        $entity = AppNotification::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        return compact(['entity']);
    }

    public function update(AppNotificationUpdateRequest $request, $id)
    {
        $entity = AppNotification::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        $entity->update($request->validated());
        return compact(['entity']);
    }

    public function destroy($id)
    {
        $entity = AppNotification::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        $entity->delete();
        return compact(['entity']);
    }
}
