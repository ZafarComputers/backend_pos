<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class City
 *
 * Represents a City entity in the application.
 * Each city belongs to a state and has attributes like title and status.
 */
class City extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * Explicitly defined for clarity, though Laravel would infer 'cities' by default.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * Protects against mass assignment vulnerabilities by specifying fillable fields.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'state_id',
        'status',
    ];

    /**
     * Define the relationship with the State model.
     *
     * A city belongs to a single state, linked via the state_id foreign key.
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}