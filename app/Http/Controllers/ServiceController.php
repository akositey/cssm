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
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $services = Service::with('office')
            ->filter($request->only('search', 'filter'))->paginate(10)->withQueryString();
        $services->transform(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'office' => $service->office->abbr,
                'is_active' => $service->is_active,
                'deleted_at' => $service->deleted_at
            ];
        });

        return Inertia::render('Services/Index', [
            'filters' => $request->all('search', 'trashed'),
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Services/Create', [
            'offices' => Office::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Service::create($request->validate(
            [
                'name' => 'required',
                'office_id' => 'required',
                'is_active' => 'required'
            ]
        ));

        return redirect(route('services.' . ($request->only('another') ? 'create' : 'index')))->with('success', 'Successfully Created New Service');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Service $service
     * @return void
     */
    public function show(Service $service): void
    {
        // N/A
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Service $service
     * @return \Inertia\Response
     */
    public function edit(Service $service): \Inertia\Response
    {
        return Inertia::render('Services/Edit', [
            'service' => $service,
            'offices' => Office::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Service $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->validate(
            [
                'name' => 'required',
                'office_id' => 'required',
                'is_active' => 'required'
            ]
        ));

        return redirect(route('services.index'))->with('success', 'Successfully Updated Service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Service $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect(route('services.index'))->with('success', 'Successfully Deleted Service');
    }
}
