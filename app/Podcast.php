<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{

    use SoftDeletes;

    const STATUS_REVIEW = 0;
    const STATUS_PUBLISHED = 1;

    const PAGINATION_PER_PAGE = 12;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'marketing_url', 'feed_url', 'image', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            'published' => self::STATUS_PUBLISHED,
            'review' => self::STATUS_REVIEW,
        ];
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public static function getStatusIdByName($name)
    {
        return self::getStatuses()[$name] ?? null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }


}
