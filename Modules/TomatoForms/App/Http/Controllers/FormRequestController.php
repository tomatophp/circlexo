<?php

namespace Modules\TomatoForms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoForms\App\Models\FormRequest;

class FormRequestController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoForms\App\Models\FormRequest::class;
    }

    /**
     *  Form Requests Index.
     *
     *  You Can View All Requests Come to Selected Form.
     *
     * @tags Form Requests
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $request->validate([
            "user_id" => "nullable",
            "form_id" => "nullable|exists:forms,id",
        ]);

        $request->merge([
            "model_id" => $request->get('user_id')
        ]);

        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-forms::form-requests.index',
            table: \Modules\TomatoForms\App\Tables\FormRequestTable::class,
            resource: config('tomato-forms.requests_index_resource', null) ?: null,
            filters: ['form_id', 'model_id']
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
            model: \Modules\TomatoForms\App\Models\FormRequest::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-forms::form-requests.create',
        );
    }

    /**
     *  Form Requests Store.
     *
     *  You can use this endpoint to store the form requests.
     *
     * @tags Form Requests
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $rules = [];
        $userModel = get_class(auth()->user()->getModel());
        $request->merge([
           "model_type" => $userModel,
           "model_id" => auth()->user()->id,
           "payload" => $request->has('payload') ? $request->get('payload') : $request->all(),
        ]);

        if($request->has('service_id') && config('tomato-forms.service_type', null)){
            $request->merge([
                "service_type" => config('tomato-forms.service_type'),
                "service_id" => $request->get('service_id'),
            ]);
        }

        $getFromFields = \Modules\TomatoForms\App\Models\Form::find($request->get('form_id'))?->fields;
        if($getFromFields){
            foreach ($getFromFields as $field){

                $validations = [];

                if($field->is_required){
                    $validations[] = "required";
                }

                if($field->has_validation){
                    if($field->validations){
                        foreach ($field->validations as $key=>$validation){
                            if($key === 'max'){
                                $validations[] = "max:{$validation}";
                            }
                            if($key === 'min'){
                                $validations[] = "min:{$validation}";
                            }
                            if($key === 'type'){
                                $validations[] = "{$validation}";
                            }
                        }
                    }
                }

                $rules["payload.{$field->name}"] = $validations;
            }
        }

        $request->validate([
            "form_id" => "required|exists:forms,id",
            "payload" => "nullable|array"
        ]);

        $request->validate($rules);


        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoForms\App\Models\FormRequest::class,
            message: __('FormRequest updated successfully'),
            redirect: 'admin.form-requests.index',
            hasMedia: true,
            collection: [
                "images" => true
            ]
        );


        if($response instanceof JsonResponse){
            $record = json_decode($response->getContent(), true);
            $record = FormRequest::find($record['data']['id']);
            if($request->has('meta')){
                foreach ($request->get('meta') as $key=>$value){
                    $record->meta($key, $value);
                }
            }

            return $response;
        }
        else {
            if($request->has('meta')){
                foreach ($request->get('meta') as $key=>$value){
                    $response->record->meta($key, $value);
                }
            }
        }

        return $response->redirect;
    }

    /**
     *  Form Requests Show.
     *
     *  You Can Show A Selected Request.
     *
     * @tags Form Requests
     *
     * @param \Modules\TomatoForms\App\Models\FormRequest $model
     * @return View|JsonResponse
     */
    public function show($model): View|JsonResponse
    {
        $model = FormRequest::find($model);
        $model->images = $model->getMedia('images')->map(function ($item){
            return $item->getUrl();
        });
        $model->meta = $model->formRequestsMetas()->get()->map(function ($item){
            return [
                "key" => $item->key,
                "value" => $item->value
            ];
        });

        return Tomato::get(
            model: $model,
            view: 'tomato-forms::form-requests.show',
            resource: config('tomato-forms.requests_show_resource') ?: null,
            hasMedia: true,
            collection: [
                "images" => true
            ]
        );
    }

    /**
     * @param \Modules\TomatoForms\App\Models\FormRequest $model
     * @return View
     */
    public function edit(\Modules\TomatoForms\App\Models\FormRequest $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-forms::form-requests.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoForms\App\Models\FormRequest $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoForms\App\Models\FormRequest $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'form_id' => 'sometimes|exists:forms,id',
                'model_type' => 'nullable|max:255|string',
                'model_id' => 'nullable',
                'status' => 'nullable|max:255|string',
                'payload' => 'nullable'
            ],
            message: __('FormRequest updated successfully'),
            redirect: 'admin.form-requests.index',
            hasMedia: true,
            collection: [
                "images" => true
            ]
        );

         if($response instanceof JsonResponse){
             $record = json_decode($response->getContent(), true);
             $record = FormRequest::find($record['data']['id']);
             if($request->has('meta')){
                 foreach ($request->get('meta') as $key=>$value){
                     $record->meta($key, $value);
                 }
             }
             return $response;
         }
         else {
             if($request->has('meta')){
                 foreach ($request->get('meta') as $key=>$value){
                     $response->record->meta($key, $value);
                 }
             }
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoForms\App\Models\FormRequest $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoForms\App\Models\FormRequest $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('FormRequest deleted successfully'),
            redirect: 'admin.form-requests.index',
            hasMedia: true,
            collection: [
                "images" => true
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
