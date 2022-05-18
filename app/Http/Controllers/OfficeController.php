<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $offices = Office::filter($request->only('search', 'trashed'))->paginate(10)->withQueryString();
        $offices->transform(function ($office) {
            return [
                'id' => $office->id,
                'name' => $office->name,
                'abbr' => $office->abbr,
                'parent_id' => $office->parent_id,
                'parent_office' => $office->parent_id ? $office->parent->abbr : null,
                'deleted_at' => $office->deleted_at
            ];
        });

        return Inertia::render('Offices/Index', [
            'filters' => $request->all('search', 'trashed'),
            'offices' => $offices
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Offices/Create', ['offices' => Office::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Office::create($request->validate([
            'name' => 'required',
            'abbr' => 'required',
            'parent_id' => 'nullable|exists:offices,id'
        ]));

        return redirect(route('offices.index'))->with('success', 'Office Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Office $office
     * @return void
     */
    public function show(Office $office): void
    {
        // N/A
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Office $office
     * @return \Inertia\Response
     */
    public function edit(Office $office): \Inertia\Response
    {
        return Inertia::render('Offices/Edit', [
            'office' => $office,
            'offices' => Office::whereNotIn('id', [$office->id])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Office $office)
    {
        $office->update(
            $request->validate([
                'name' => 'required',
                'abbr' => 'required',
                'parent_id' => 'nullable|exists:offices,id'
            ])
        );

        return redirect(route('offices.index'))->with('success', 'Office Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Office $office
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect(route('offices.index'))->with('success', 'Office Successfully Deleted');
    }

    /**
     * @param Office $office
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore(Office $office)
    {
        $office->restore();

        return redirect(route('offices.index'))->with('success', 'Office Successfully Restored');
    }
}
