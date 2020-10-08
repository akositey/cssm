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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Offices/Index', [
            'filters' => $request->all('search', 'trashed'),
            'offices' => Office::when($request->search ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('nick', 'like', '%' . $search . '%');
                });
            })->when($request->trashed ?? null, function ($query, $trashed) {
                if ($trashed === 'with') {
                    $query->withTrashed();
                } elseif ($trashed === 'only') {
                    $query->onlyTrashed();
                }
            })->paginate(10)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Offices/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Office::create($request->validate([
            'name' => 'required',
            'nick' => 'required'
        ]));
        return redirect(route('offices.index'))->with('success', 'Office Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office          $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office          $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        return Inertia::render('Offices/Edit', ['office' => $office]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  \App\Models\Office          $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $office->update(
            $request->validate([
                'name' => 'required',
                'nick' => 'required'
            ])
        );
        return redirect(route('offices.index'))->with('success', 'Office Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office          $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return redirect(route('offices.index'))->with('success', 'Office Successfully Deleted');

    }
}
