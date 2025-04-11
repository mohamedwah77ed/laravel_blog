<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditUserControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    // التحقق من البيانات المدخلة
    $validatedData = $request->validate([
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:users,email,' . auth()->id(),
    ]);

    // تحديث بيانات المستخدم المصادق عليه
    $user = auth()->user();
    $user->fill($validatedData);

    if ($request->has('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return response()->json([
        'message' => 'Profile updated successfully',
        'user' => $user
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
