<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAdminRequest;
use App\Jobs\UpdateAdminJob;
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
     * @param UpdateAdminRequest $request
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $request->validated();

        UpdateAdminJob::dispatchSync($request->all(), $admin);

        return redirect()
            ->route('account')
            ->with('ok', 'Account successfully updated.');
    }
}
