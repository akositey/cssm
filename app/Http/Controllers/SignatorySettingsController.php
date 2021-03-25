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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signatory = SignatorySettings::first()->get();
        // dd($signatory[0]);
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
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $signatory = SignatorySettings::first();
        $signatory->update([
            'reviewer_name' => $request->reviewerName,
            'reviewer_position' => $request->reviewerPosition,
            'noter_name' => $request->noterName,
            'noter_position' => $request->noterPosition
        ]);

        return redirect(route('signatories.index'))->with('success', 'Successfully Updated');
    }
}
