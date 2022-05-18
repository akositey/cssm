<?php

namespace App\Http\Controllers;

use App\Models\SignatorySettings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SignatorySettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $signatory = SignatorySettings::first()->get();
        $settings = [
            'reviewerName' => $signatory[0]->reviewer_name,
            'reviewerPosition' => $signatory[0]->reviewer_position,
            'noterName' => $signatory[0]->noter_name,
            'noterPosition' => $signatory[0]->noter_position
        ];

        return Inertia::render('SignatorySettings/Index', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $signatory = SignatorySettings::first();
        $signatory->update([
            'reviewer_name' => $request->get('reviewerName'),
            'reviewer_position' => $request->get('reviewerPosition'),
            'noter_name' => $request->get('noterName'),
            'noter_position' => $request->get('noterPosition')
        ]);

        return redirect(route('signatories.index'))->with('success', 'Successfully Updated');
    }
}
