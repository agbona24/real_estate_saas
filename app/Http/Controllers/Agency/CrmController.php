<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrmController extends Controller
{
    /**
     * Display leads listing.
     */
    public function leads()
    {
        return view('agency.crm.leads');
    }

    /**
     * Display clients listing.
     */
    public function clients()
    {
        return view('agency.crm.clients');
    }

    /**
     * Display follow-ups.
     */
    public function followUps()
    {
        return view('agency.crm.follow-ups');
    }

    /**
     * Display tasks.
     */
    public function tasks()
    {
        return view('agency.crm.tasks');
    }

    /**
     * Display appointments.
     */
    public function appointments()
    {
        return view('agency.crm.appointments');
    }
}
