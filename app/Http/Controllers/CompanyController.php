<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // go to index view admin.company.index
        $company = Company::first();
        return view("admin.company.index", compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // go to create view admin.company.create
        return view("admin.company.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the input
    $request->validate([
        "name" => "required",
        "email" => "required",
        "phone" => "required",
        "address" => "required",
        "logo" => "required|max:2048",
    ]);

    // Handle file upload
    $file = $request->logo;
    if ($file) {
        $newName = time() . "." . $file->getClientOriginalExtension();
        $file->move('images', $newName);
    }

    // Create a new instance of the Company model
    $company = new Company();
    $company->name = $request->name;
    $company->email = $request->email;
    $company->phone = $request->phone;
    $company->address = $request->address;
    $company->facebook = $request->facebook;
    $company->youtube = $request->youtube;
    $company->logo = "images/" . $newName;

    // Save the company record
    $company->save();

    // Redirect to the company index page
    return redirect()->route("admin.company.index");
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "logo" => "required|max:2048"
        ]);

        $company = Company::find($id);
        $file = $request->logo;
        if ($file) {
            $newName = time().".".$file->getClientOriginalExtension();
            $file->move('images', $newName);
            unlink($company->logo);
        }

        if ($file) {
            $company->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
                "logo" => "images/".$newName,
            ]);
        } else {
            $company->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        unlink($company->logo);
        $company->delete();
        return redirect()->back();
    }

}
