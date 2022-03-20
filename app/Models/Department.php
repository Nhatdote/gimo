<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function scopeFilters($query, $data)
    {
        if (!empty($data['parent_id'])) {
            $query->where('parent_id', $data['parent_id']);
        }

        return $query;
    }

    public static function parse($items)
    {
        foreach ($items as $a) {
            if ($a->parent) {
                $a->title = $a->parent->name . ' > ' . $a->name;
                $a->parent_title = $a->parent->name;
            } else {
                $a->title = $a->name;
            }
        }

        return $items;
    }

    public static function fields()
    {
        return [
            'name' => [
                'type' => 'text',
                'label' => __('Title')
            ],
            'parent_id' => [
                'type' => 'model',
                'label' => __('Parent'),
                'display' => 'parent_title'
            ]
        ];
    }
}
