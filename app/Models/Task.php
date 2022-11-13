<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'Draft';
    public const STATUS_TO_DO = 'To do';
    public const STATUS_ONGOING = 'Ongoing';
    public const STATUS_DONE = 'Done';

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => self::STATUS_DRAFT,
            self::STATUS_TO_DO => self::STATUS_TO_DO,
            self::STATUS_ONGOING => self::STATUS_ONGOING,
            self::STATUS_DONE => self::STATUS_DONE,
        ];
    }

    protected $fillable = [
        'title',
        'content',
        'status',
    ];
}
