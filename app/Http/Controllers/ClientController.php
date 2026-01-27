<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::with('appointments')->get());
    }

    public function show($id)
    {
        return response()->json(Client::with('appointments')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surnames' => 'required|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'home_client' => 'nullable|boolean'
        ]);

        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return response()->json($client);
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
