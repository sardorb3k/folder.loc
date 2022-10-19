<?php

namespace App\Repository;

use App\Interfaces\ReceptionRepositoryInterface;
use App\Interfaces\TeachersServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reception;

class ReceptionRepository implements ReceptionRepositoryInterface
{
    private $reception;
    public function __construct(Reception $reception)
    {
        $this->reception = $reception;
    }
    /**
     * Inxdexx
     */
    public function indexReception()
    {
        return abort(404);
    }
    /**
     * Create Reception
     */
    public function createReception()
    {
        return view('reception.create');
    }
    /**
     * Store Reception
     */
    public function storeReception(Request $request)
    {
        $request['phone'] = '998' . str_replace(["(", ")", "-", " ", "+"], "", $request->phone);
        $request['phone_contact'] = '998' . str_replace(["(", ")", "-", " ", "+"], "", $request->phone_contact);
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required',
            'phone_contact' => 'required',
            'birthday' => 'required|date',
            'gender' => 'required',
            'homeaddress' => 'required',
            'reasontostudy' => 'required',
            'interests' => 'required',
            'hear_about' => 'required',
            'course' => 'required',
        ]);
        $reception = $this->reception->create([
            'last_name' => $request->lastname,
            'first_name' => $request->firstname,
            'phone' => $request->phone,
            'phone_contact' => $request->phone_contact,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'homeaddress' => $request->homeaddress,
            'reasontostudy' => $request->reasontostudy,
            'interests' => $request->interests,
            'hear_about' => $request->hear_about,
            'course' => json_encode($request->course) ?? [],
        ]);
        return redirect()->back()->with('success', 'Successfully created!');
    }

}
