<?php

namespace App\Http\Controllers\Web\Parent\Auth;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Settings\Mobile\Parentappactivestudent;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ParentauthController extends Controller
{
    public function parentlogout()
    {
        try {
            DB::beginTransaction();
            $user = auth()->guard('aparent')->user();
            Helper::trackmessage($user, 'Parent Logout', 'parent_web_parentlogout', session()->getId(), 'WEB');
            toast('Hi ' . $user->name . ' You Have Logged Out Successfully!', 'success');
            Parentappactivestudent::where('parenttokenid', session()->getId() . $user->uuid)->delete();
            Parentappactivestudent::whereDate('created_at', '<=', now()->subDays(365))->delete();
            Auth::guard('aparent')->logout();

            DB::commit();
            return redirect('/');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: parent_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: parent_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: parent_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
