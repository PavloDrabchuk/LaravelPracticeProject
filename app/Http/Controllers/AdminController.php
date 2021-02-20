<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return Application|Factory|View|Response
     */
    public function show(Admin $admin)
    {
        return view('account', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $admin
     * @return Application|Factory|View|Response
     */
    public function edit(Admin $admin)
    {
        return view('account.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'password' => 'required|string|confirmed|min:8'
        ]);

        $admin->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('account')
            ->with('ok', 'Account successfully updated.');
    }
}
