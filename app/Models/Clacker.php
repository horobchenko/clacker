<?php

namespace App\Models;

use App\Events\ClackerCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Database\Factories\ClackerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Clacker extends Model
{

	 /** @use HasFactory<\Database\Factories\ClackerFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'message',
    ];

     protected $dispatchesEvents = [
        'created' => ClackerCreated::class,
    ];

    //protected static function newFactory()
    //{
    //	return ClackerFactory::new();
    //}

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
