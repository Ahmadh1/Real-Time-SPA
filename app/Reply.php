<?php

namespace App;
use Auth;
use App\User;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function($reply){
            $reply->user_id = Auth::id();
        });
    }
    /**
     * Reply belongs to Question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()  {
    	// belongsTo(RelatedModel, foreignKey = question_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Question::class);
    } // end question

    /**
     * Reply belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class);
    } // end user

    /**
     * Reply has many Likes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function like() {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = reply_id, localKey = id)
    	return $this->hasMany(Like::class);
    }
}
