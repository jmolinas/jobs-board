<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobsBoard extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'company', 'status', 'location', 'department', 'employment_type', 'schedule'];

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isSpam()
    {
        return $this->status === 'spam';
    }

    public function scopePublished($query)
    {
        return $query->where('status',  'published');
    }

    /**
     * Get the user who posted the job.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

