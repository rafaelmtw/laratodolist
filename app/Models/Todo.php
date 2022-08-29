<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    use HasFactory, Notifiable;
    /**
     * Inverse one-to-many relationship to define who this model belongs to.
     * https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse
     * 
     * @var string
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'priority',
        'completed'
    ];

    /**
     * The event map for the model.
     * https://laravel.com/docs/9.x/eloquent#events
     * 
     * @var array
     */
    protected $dispatchesEvents = [
        // 'created' => TeamCreated::class,
        // 'updated' => TeamUpdated::class,
        // 'deleted' => TeamDeleted::class,
    ];
}
