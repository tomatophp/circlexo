<?php

namespace Modules\TomatoCms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class TestimonialController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoCms\App\Models\Testimonial::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-cms::testimonials.index',
            table: \Modules\TomatoCms\App\Tables\TestimonialTable::class
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
            model: \Modules\TomatoCms\App\Models\Testimonial::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-cms::testimonials.create',
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
            model: \Modules\TomatoCms\App\Models\Testimonial::class,
            validation: [
                'service_id' => 'nullable|exists:services,id',
                'name' => 'required|array',
                'name*' => 'required|max:255|string',
                'position' => 'required|array',
                'position*' => 'required|max:255|string',
                'company' => 'required|array',
                'company*' => 'required|max:255|string',
                'comment' => 'required|array',
                'comment*' => 'required|max:65535',
                'rate' => 'required'
            ],
            message: __('Testimonial created successfully'),
            redirect: 'admin.testimonials.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Testimonial $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoCms\App\Models\Testimonial $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::testimonials.show',
        );
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Testimonial $model
     * @return View
     */
    public function edit(\Modules\TomatoCms\App\Models\Testimonial $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::testimonials.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoCms\App\Models\Testimonial $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoCms\App\Models\Testimonial $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'service_id' => 'nullable|exists:services,id',
                'name' => 'sometimes|array',
                'name*' => 'sometimes|max:255|string',
                'position' => 'sometimes|array',
                'position*' => 'sometimes|max:255|string',
                'company' => 'sometimes|array',
                'company*' => 'sometimes|max:255|string',
                'comment' => 'sometimes|array',
                'comment*' => 'sometimes|max:65535',
                'rate' => 'sometimes'
            ],
            message: __('Testimonial updated successfully'),
            redirect: 'admin.testimonials.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Testimonial $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoCms\App\Models\Testimonial $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Testimonial deleted successfully'),
            redirect: 'admin.testimonials.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
