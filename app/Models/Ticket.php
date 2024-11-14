<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    
    protected $primaryKey = 'ticket_id';

    protected $fillable = ['event_id', 'type', 'price', 'quantity'];

    // Relationship to event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function scopeSearch($query, $value) {
		if(!empty(trim($value))) {
			$value = trim($value);
			$query->where(function($query) use ($value) {
				$query->Where('tickets.price', 'LIKE', "%$value%");
			});
		}
		$query->latest('tickets.ticket_id');
		return $query;
	}
}
