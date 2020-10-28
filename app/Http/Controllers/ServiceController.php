<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Services/Index', [
            'filters' => $request->all('search', 'trashed'),
            'services' => Service::with('office')
                ->filter($request->only('search', 'filter'))
                ->paginate(10)
                ->transform(function ($service) {
                    return [
                        'id' => $service->id,
                        'name' => $service->name,
                        'office' => $service->office->abbr,
                        'deleted_at' => $service->deleted_at
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Services/Create', [
            'offices' => Office::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Service::create($request->validate(
            [
                'name' => 'required',
                'office_id' => 'required'
            ]
        ));
        return redirect(route('services.' . ($request->only('another') ? 'create' : 'index')))->with('success', 'Successfully Created New Service');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service         $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service         $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return Inertia::render('Services/Edit', [
            'service' => $service,
            'offices' => Office::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  \App\Models\Service         $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->validate(
            [
                'name' => 'required',
                'office_id' => 'required'
            ]
        ));
        return redirect(route('services.index'))->with('success', 'Successfully Updated Service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service         $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect(route('services.index'))->with('success', 'Successfully Deleted Service');
    }
}
