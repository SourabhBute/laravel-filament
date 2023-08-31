<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'student_id',
        'address_1',
        'address_2',
        'standard_id'
    ];

    /**
     * @return BelongsTo
     */
    public function standard(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }
}
