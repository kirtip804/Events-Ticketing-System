<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'event_id';

    protected $fillable = ['title', 'description', 'event_date', 'location', 'ticket_availability'];

    // Relationship to tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'event_id', 'event_id');
    }

    // Relationship to the organizer (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function scopeSearch($query, $value) {
		if(!empty(trim($value))) {
			$value = trim($value);
			$query->where(function($query) use ($value) {
				$query->Where('events.title', 'LIKE', "%$value%")
					  ->orWhere('events.location', 'LIKE', "%$value%");
			});
		}
		$query->latest('events.event_id');
		return $query;
	}
}
