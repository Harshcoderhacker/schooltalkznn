<?php

namespace App\Http\Controllers\Web\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Helper;
use Auth;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminauthController extends Controller
{
    public function homeloginpage($panel = null)
    {
        if ($panel === null) {
            $panel = "adminlogin";
        }
        return view('website.homeloginpage.homeloginpage', [
            'layout' => 'login',
            'panel' => $panel,
        ]);
    }

    public function verifyotp(Request $request)
    {
        if ($request->panel && $request->type) {
            $showword =  basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            return view('website.homeloginpage.homeloginpage', ['panel' => ['email' => $showword, 'panel' => $request->panel, 'type' => $request->type]]);
        }
    }

    public function adminlogout()
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            Helper::trackmessage($user, 'Admin Logout', 'admin_web_adminlogout', session()->getId(), 'WEB');
            toast('Logged Out Successfully!', 'success');
            Auth::logout();
            DB::commit();
            return redirect('/');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: admin_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: admin_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error("SessionID: " . session()->getId() . ' Exception one: admin_web_logout  Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
