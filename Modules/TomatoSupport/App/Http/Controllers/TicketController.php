<?php

namespace Modules\TomatoSupport\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoCategory\Models\Type;
use Modules\TomatoSupport\App\Transformers\TicketsResource;
use Modules\TomatoSupport\App\Transformers\TicketResource;

/**
 *
 */
class TicketController extends Controller
{
    /**
     * @var string
     */
    public string $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = \Modules\TomatoSupport\App\Models\Ticket::class;
    }

    /**
     * List Of My Tickets
     *
     * List of tickets that created by the user
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());

        if(!$isAPIRequest){
            $request->merge([
                "accountable_type" => config('tomato-crm.model'),
                "accountable_id" => auth()->user()->id
            ]);
        }


        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-support::tickets.index',
            table: \Modules\TomatoSupport\App\Tables\TicketTable::class,
            filters: [
                'accountable_type',
                'accountable_id',
            ],
            resource: config('tomato-support.resources.tickets.index')
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \Modules\TomatoSupport\App\Models\Ticket::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-support::tickets.create',
        );
    }

    /**
     * Open New Ticket
     *
     * You Can Open a New ticket with this API
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->merge([
           "code" => explode('-', Str::uuid())[0]
        ]);

        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());

        if(!$isAPIRequest){
            $request->merge([
                "accountable_type" => config('tomato-crm.model'),
                "accountable_id" => auth()->user()->id,
                "type_id" => Type::where('key', 'pending')->first()?->id,
                "is_closed" => false
            ]);

            $request->validate([
                'name' => 'nullable|max:255|string',
                'phone' => 'nullable|max:255|min:12',
                'subject' => 'required|max:255|string',
                'message' => 'nullable',
            ]);
        }
        else {
            $request->validate([
                'type_id' => 'nullable|exists:types,id',
                'accountable_type' => 'required|max:255|string',
                'accountable_id' => 'required',
                'name' => 'nullable|max:255|string',
                'phone' => 'nullable|max:255|min:12',
                'subject' => 'required|max:255|string',
                'message' => 'nullable',
                'is_closed' => 'nullable'
            ]);
        }


        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoSupport\App\Models\Ticket::class,
            message: __('Ticket created successfully'),
            redirect: 'admin.tickets.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * Show Ticket Details
     *
     * You Can View Ticket with Comments with this API
     *
     * @param \Modules\TomatoSupport\App\Models\Ticket $model
     * @return View|JsonResponse
     */
    public function show($model): View|JsonResponse
    {
        $model = \Modules\TomatoSupport\App\Models\Ticket::find($model);
        return Tomato::get(
            model: $model,
            view: 'tomato-support::tickets.show',
            resource: config('tomato-support.resources.tickets.show')

        );
    }

    /**
     * @param \Modules\TomatoSupport\App\Models\Ticket $model
     * @return View
     */
    public function edit(\Modules\TomatoSupport\App\Models\Ticket $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-support::tickets.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoSupport\App\Models\Ticket $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoSupport\App\Models\Ticket $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'type_id' => 'nullable|exists:types,id',
                'accountable_type' => 'sometimes|max:255|string',
                'accountable_id' => 'sometimes',
                'name' => 'nullable|max:255|string',
                'phone' => 'nullable|max:255|min:12',
                'subject' => 'sometimes|max:255|string',
                'message' => 'nullable',
                'is_closed' => 'nullable'
            ],
            message: __('Ticket updated successfully'),
            redirect: 'admin.tickets.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoSupport\App\Models\Ticket $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoSupport\App\Models\Ticket $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Ticket deleted successfully'),
            redirect: 'admin.tickets.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoSupport\App\Models\Ticket $model
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function comments(\Modules\TomatoSupport\App\Models\Ticket $model){
        return view('tomato-support::tickets.comments', [
            "model" => $model
        ]);
    }

    /**
     * Send Ticket Comment
     *
     * You can Send A comment on the ticket by use this API
     *
     * @param Request $request
     * @param $model
     * @return JsonResponse|RedirectResponse
     */
    public function send(Request $request, $model){
        $model = \Modules\TomatoSupport\App\Models\Ticket::find($model);
        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());

        if(!$isAPIRequest){
            $request->merge([
                "accountable_type" => config('tomato-crm.model'),
                "accountable_id" => auth()->user()->id,
            ]);
        }

        $request->validate([
           "response" => "required|string"
        ]);

        if($model->is_closed){
            if(!$isAPIRequest){
                return response()->json([
                    "status" => false,
                    "message" => "Ticket is closed"
                ]);
            }
            else {
                Toast::error(__('Ticket is closed'))->autoDismiss(2);
                return redirect()->back();
            }
        }

        $model->ticketComments()->create([
            "accountable_type" => $request->get('accountable_type'),
            "accountable_id" => $request->get('accountable_id'),
            "response" => $request->get('response')
        ]);

        if($request->get('is_closed') == true){
            $model->update([
                "is_closed" => true
            ]);
        }

        if(!$isAPIRequest){
            return response()->json([
               "status" => true,
               "message" => "Comment has been sent"
            ]);
        }
        else {
            Toast::success(__('Comment has been sent'))->autoDismiss(2);
            return redirect()->back();
        }
    }
}
