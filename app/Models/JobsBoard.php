<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobsBoard extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'location', 'department', 'employment_type'];

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isSpam()
    {
        return $this->status === 'spam';
    }

    /**
     * Get the user who posted the job.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

