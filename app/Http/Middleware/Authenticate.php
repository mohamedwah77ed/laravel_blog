<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
{
    
        return route('login'); 
    

}
}
  /*  abort(response()->json([
        'message' => 'Unauthenticated or Token Expired. Please login again.'
    ], 401)); // ✅ إرجاع JSON فقط لو الطلب API
}*/
