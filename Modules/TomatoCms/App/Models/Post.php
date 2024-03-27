<?php

namespace Modules\TomatoCms\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Modules\TomatoCategory\App\Models\Category;

/**
 * @property integer $id
 * @property integer $author_id
 * @property string $type
 * @property string $title
 * @property string $slug
 * @property string $short_description
 * @property string $keywords
 * @property string $body
 * @property boolean $activated
 * @property boolean $trend
 * @property string $published_at
 * @property float $likes
 * @property float $views
 * @property string $meta_url
 * @property string $meta_redirect
 * @property array $meta
 * @property string $created_at
 * @property string $updated_at
 * @property Comment[] $comments
 * @property User $user
 * @property Category[] $categories
 */
class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    public $translatable = [
        'title',
        'short_description',
        'keywords',
        'body'
    ];

    protected $casts = [
        'activated' => 'boolean',
        'trend' => 'boolean',
        'likes' => 'float',
        'views' => 'float',
        'meta'=> 'array'
    ];

    /**
     * @var array
     */
    protected $fillable = ['meta_redirect','meta','meta_url','author_id', 'type', 'title', 'slug', 'short_description', 'keywords', 'body', 'activated', 'trend', 'published_at', 'likes', 'views', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_has_category', 'post_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Category::class, 'posts_has_tags', null, 'tag_id');
    }

    public function postMeta()
    {
        return $this->hasMany('Modules\TomatoCms\App\Models\PostMeta');
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return Model|string
     */
    public function meta(string $key, mixed $value=null): mixed
    {
        if($value){
            return $this->postMeta()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->postMeta()->where('key', $key)->first()?->value;
        }
    }
}
