<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Http\Requests\AppUserStoreRequest;
use App\Http\Requests\AppUserUpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AppUserController extends Controller
{
    public function index()
    {
        return AppUser::all();
    }

    public function store(AppUserStoreRequest $request)
    {
        $entity = AppUser::create($request->validated());
        return compact(['entity']);
    }

    public function show($id)
    {
        $entity = AppUser::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        return compact(['entity']);
    }

    public function update(AppUserUpdateRequest $request, $id)
    {
        $entity = AppUser::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        $entity->update($request->validated());
        return compact(['entity']);
    }

    public function destroy($id)
    {
        $entity = AppUser::find($id);
        if (!$entity) throw new NotFoundHttpException('User not found');
        $entity->delete();
        return compact(['entity']);
    }
}
