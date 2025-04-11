<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class AdminProfileController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', true)->get();  
        return view('admin.admins', compact('users'));
}
public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.adminsedit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    if (!$user->is_admin) {
        return redirect()->route('adminsprofile.index')->withErrors(['error' => 'هذا المستخدم ليس أدمن']);
    }

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
    ]);

    return redirect()->route('adminsprofile.index')->with('status', 'Admin data updated successfully');
}
    public function destroy(Request $request, User $admin): RedirectResponse
    {
        if (!$admin->is_admin) {
            return redirect()->route('adminsprofile.index')->withErrors(['error' => 'this account not admin']);
        }
    
        $currentUser = $request->user();
        $otherAdminsCount = User::where('is_admin', 1)->where('id', '!=', $admin->id)->count();
        if ($otherAdminsCount == 0 && $currentUser->id == $admin->id) {
            return redirect()->route('adminsprofile.index')->withErrors(['error' => 'You can delete yourself because you are the last admin in the system.']);
        }
    
        $admin->delete();
        return redirect()->route('adminsprofile.index')->with('status', 'delet don');
    }
}