<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(Service::all());
    }

    public function show($id)
    {
        return response()->json(Service::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string','price' => 'required|numeric']);
        $service = Service::create($request->all());
        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return response()->json($service);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
