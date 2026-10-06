<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user(); 

        if ($authUser->id === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        $existingFollow = $authUser->followings()->where('following_id', $user->id)->first();

        if ($existingFollow) {
            $authUser->followings()->detach($user->id);
            
            $message = $existingFollow->pivot->request_approved 
                ? "You have unfollowed {$user->name}." 
                : "Your follow request to {$user->name} was cancelled.";

            return back()->with('status', $message);
        }

        $authUser->followings()->attach($user->id, [
            'request_approved' => false
        ]);

        return back()->with('status', "Follow request sent to {$user->name}!");
    }
    
    public function requestsList()
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user(); 

        $requests = $authUser->followers()->where('request_approved', false)->get();

        return view('post.follow_requests', compact('requests'));
    }

    public function approve(User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user(); 

        $authUser->followers()->updateExistingPivot($user->id, [
            'request_approved' => true
        ]);

        return back()->with('status', "You approved {$user->name}'s follow request.");
    }

    public function reject(User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user(); 
        
        $authUser->followers()->detach($user->id);

        return back()->with('status', "You rejected {$user->name}'s follow request.");
    }
}
