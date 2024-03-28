<?php

namespace Modules\TomatoSupport\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoSupport\App\Transformers\FAQResource;

class QuestionController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoSupport\App\Models\Question::class;
    }

    /**
     * FAQ List
     *
     * You can show all questions or filter by type_id
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $request->validate([
           "type_id" => "nullable|exists:types,id"
        ]);
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-support::questions.index',
            table: \Modules\TomatoSupport\App\Tables\QuestionTable::class,
            resource: config('tomato-support.resources.faq.index'),
            filters: ['type_id']
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
            model: \Modules\TomatoSupport\App\Models\Question::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-support::questions.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoSupport\App\Models\Question::class,
            validation: [
                'type_id' => 'nullable|exists:types,id',
                'qa' => 'required|array',
                'qa*' => 'required|string|max:255',
                'answer' => 'nullable|array'
            ],
            message: __('Question created successfully'),
            redirect: 'admin.questions.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoSupport\App\Models\Question $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoSupport\App\Models\Question $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-support::questions.show',
            resource:  config('tomato-support.resources.faq.show')
        );
    }

    /**
     * @param \Modules\TomatoSupport\App\Models\Question $model
     * @return View
     */
    public function edit(\Modules\TomatoSupport\App\Models\Question $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-support::questions.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoSupport\App\Models\Question $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoSupport\App\Models\Question $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'type_id' => 'nullable|exists:types,id',
                'qa' => 'sometimes|array',
                'qa*' => 'sometimes|string|max:255',
                'answer' => 'nullable'
            ],
            message: __('Question updated successfully'),
            redirect: 'admin.questions.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoSupport\App\Models\Question $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoSupport\App\Models\Question $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Question deleted successfully'),
            redirect: 'admin.questions.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
