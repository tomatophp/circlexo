<?php

namespace Modules\TomatoCms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class PostController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoCms\App\Models\Post::class;
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
            view: 'tomato-cms::posts.index',
            table: \Modules\TomatoCms\App\Tables\PostTable::class
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
            model: \Modules\TomatoCms\App\Models\Post::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-cms::posts.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->merge([
            "author_id" => auth('web')->user()->id
        ]);

        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoCms\App\Models\Post::class,
            validation: [
                'type' => 'required|max:255|string',
                'title' => 'required|max:65535',
                'slug' => 'nullable|max:255|string',
                'short_description' => 'required|max:65535',
                'keywords' => 'nullable|max:65535',
                'body' => 'required',
                'activated' => 'required',
                'trend' => 'required'
            ],
            message: __('Post created successfully'),
            redirect: 'admin.posts.index',
            hasMedia: true,
            collection: [
                "feature" => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        $response->record->categories()->attach($request->get('categories'));

        if($response->record->type === 'open-source' && $response->record->meta_url){
            $github = Http::get('https://api.github.com/repos/' . $response->record->meta_url)->json();
            $response->record->meta = $github;
            $response->record->save();
        }

        if($response->record->type === 'videos' && $response->record->meta_url){
            if(config('tomato-cms.youtube_key')){
                $videoID = Str::of($response->record->meta_url)->replace('https://www.youtube.com/watch?v=', '');
                $youtube = Http::get('https://www.googleapis.com/youtube/v3/videos?part=player&id='.$videoID.'&key='.config('tomato-cms.youtube_key').'&part=snippet,contentDetails,statistics,status')->json();
                $response->record->meta = $youtube;
                $response->record->save();
            }
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Post $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoCms\App\Models\Post $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::posts.show',
            hasMedia: true,
            collection: [
                "feature" => false
            ]
        );
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Post $model
     * @return View
     */
    public function edit(\Modules\TomatoCms\App\Models\Post $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::posts.edit',
            hasMedia: true,
            collection: [
                "feature" => false
            ]
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoCms\App\Models\Post $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoCms\App\Models\Post $model): RedirectResponse|JsonResponse
    {
        $request->merge([
            "author_id" => auth('web')->user()->id
        ]);


        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'author_id' => 'sometimes|exists:users,id',
                'type' => 'sometimes|max:255|string',
                'title' => 'sometimes|max:65535',
                'slug' => 'nullable|max:255|string',
                'short_description' => 'sometimes|max:65535',
                'keywords' => 'nullable|max:65535',
                'body' => 'sometimes',
                'activated' => 'sometimes',
                'trend' => 'sometimes',
                'likes' => 'sometimes',
                'views' => 'sometimes',
                'meta_url' => 'nullable|max:255|string',
                'meta' => 'nullable',
                'meta_redirect' => 'nullable|max:65535'
            ],
            message: __('Post updated successfully'),
            redirect: 'admin.posts.index',
            hasMedia: true,
            collection: [
                "feature" => false
            ]
        );

         if($response instanceof JsonResponse){
             return $response;
         }

        $response->record->categories()->sync($request->get('categories'));

        if($response->record->type === 'open-source' && $response->record->meta_url){
            $github = Http::get('https://api.github.com/repos/' . $response->record->meta_url)->json();
            $response->record->meta = $github;
            $response->record->save();
        }

        if($response->record->type === 'videos' && $response->record->meta_url){
            if(config('tomato-cms.youtube_key')){
                $videoID = Str::of($response->record->meta_url)->replace('https://www.youtube.com/watch?v=', '');
                $youtube = Http::get('https://www.googleapis.com/youtube/v3/videos?part=player&id='.$videoID.'&key='.config('tomato-cms.youtube_key').'&part=snippet,contentDetails,statistics,status')->json();
                $response->record->meta = $youtube;
                $response->record->save();
            }
        }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Post $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoCms\App\Models\Post $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Post deleted successfully'),
            redirect: 'admin.posts.index',
            hasMedia: true,
            collection: [
                "feature" => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
