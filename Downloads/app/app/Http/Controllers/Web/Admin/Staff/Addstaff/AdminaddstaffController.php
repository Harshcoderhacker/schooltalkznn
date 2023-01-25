<?php

namespace App\Http\Controllers\Web\Admin\Staff\Addstaff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Auth\Staff;
use Illuminate\Support\Facades\Storage;

class AdminaddstaffController extends Controller
{
    public function index()
    {
        return view('admin.staff.index');
    }

    public function adminstaffprofileinfo(Staff $staff)
    {
        return view('admin.staff.staffinfo', compact('staff'));
    }

    public function adminstaffpayrollinfo(Staff $staff)
    {
        return view('admin.staff.staffpayrollinfo', compact('staff'));
    }

    public function adminstaffleaveinfo(Staff $staff)
    {
        return view('admin.staff.staffleaveinfo', compact('staff'));
    }

    public function adminstaffdocumentsinfo(Staff $staff)
    {
        return view('admin.staff.staffdocumentsinfo', compact('staff'));
    }

    public function adminstaffclassroutineinfo(Staff $staff)
    {
        return view('admin.staff.staffclassroutineinfo', compact('staff'));
    }

    public function staffdetailsdownload()
    {
        return Storage::download(request('downloadpath'));
    }

    public function addstaffinfromation(Staff $staff)
    {
        $show = 1;
        return view('admin.staff.addstaff.staffinfromation', compact('staff', 'show'));
    }

    public function createoreditstaff(Staff $staff, $show)
    {
        return view('admin.staff.addstaff.staffinfromation', compact('staff', 'show'));
    }

    public function staffbulkupload()
    {
        return view('admin.staff.bulkuploadstaff.staffbulkupload');
    }
}
