<?php namespace Conner\Tagging\Model;

use Conner\Tagging\TaggingUtility;
use Illuminate\Database\Eloquent\Model;

/**
 * @package Conner\Tagging\Model
 *
 * @property integer id
 * @property string taggable_id
 * @property string taggable_type
 * @property string tag_name
 * @property string tag_slug
 * @property Tag tag
 */
class Tagged extends Model
{
    protected $table = 'tagged';
    public $timestamps = false;
    protected $fillable = ['tag_name', 'tag_slug'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('tagging.connection');
    }

    public static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->created_at = $model->freshTimestamp();
		});
    }

    /**
     * Morph to the tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function taggable()
    {
        return $this->morphTo();
    }

    /**
     * Get instance of tag linked to the tagged value
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        $model = TaggingUtility::tagModelString();
        return $this->belongsTo($model, 'tag_slug', 'slug');
    }

}
