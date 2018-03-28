<?php

namespace Partymeister\Core\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Core\Models\EventType;
use Partymeister\Core\Http\Requests\Backend\EventTypeRequest;
use Partymeister\Core\Services\EventTypeService;
use Partymeister\Core\Grids\EventTypeGrid;
use Partymeister\Core\Forms\Backend\EventTypeForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class EventTypesController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = new EventTypeGrid(EventType::class);

        $service = EventTypeService::collection($grid);
        $grid->filter = $service->getFilter();
        $paginator    = $service->getPaginator();

        return view('partymeister-core::backend.event_types.index', compact('paginator', 'grid'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(EventTypeForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.event_types.store',
            'enctype' => 'multipart/form-data'
        ]);

        return view('partymeister-core::backend.event_types.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EventTypeRequest $request)
    {
        $form = $this->form(EventTypeForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        EventTypeService::createWithForm($request, $form);

        flash()->success(trans('partymeister-core::backend/event_types.created'));

        return redirect('backend/event_types');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(EventType $record)
    {
        $form = $this->form(EventTypeForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.event_types.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('partymeister-core::backend.event_types.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EventTypeRequest $request, EventType $record)
    {
        $form = $this->form(EventTypeForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        EventTypeService::updateWithForm($record, $request, $form);

        flash()->success(trans('partymeister-core::backend/event_types.updated'));

        return redirect('backend/event_types');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventType $record)
    {
        EventTypeService::delete($record);

        flash()->success(trans('partymeister-core::backend/event_types.deleted'));

        return redirect('backend/event_types');
    }
}