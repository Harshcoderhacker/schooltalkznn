<?php

namespace App\Http\Controllers\Web\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Helper;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StaffauthController extends Controller
{
    public function stafflogout()
    {
        try {
            DB::beginTransaction();
            $user = auth()->guard('staff')->user();
            Helper::trackmessage($user, 'Staff Logout', 'staff_web_stafflogout', session()->getId(), 'WEB');
            toast('Hi! You Have Logged Out Successfully!', 'success');
            Auth::guard('staff')->logout();
            DB::commit();
            return redirect('/');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: staff_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: staff_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: staff_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
