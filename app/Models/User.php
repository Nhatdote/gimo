<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'verified',
        'active',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function scopeFilters($query, $data)
    {
        //có thể làm tổng quát bàng cách foreach và check theo field type
        if (!empty($data['first_name'])) {
            $query->where('first_name', 'like', "%{$data['first_name']}%");
        }

        if (!empty($data['last_name'])) {
            $query->where('last_name', 'like', "%{$data['last_name']}%");
        }

        if (!empty($data['department_id'])) {
            $query->where('department_id', $data['department_id']);
        }

        if (isset($data['active'])) {
            $query->where('active', $data['active']);
        }

        if (isset($data['verified'])) {
            $query->where('verified', $data['verified']);
        }

        return $query;
    }

    public static function fields()
    {
        return [
            'first_name' => [
                'type' => 'text',
                'label' => __('First name')
            ],
            'last_name' => [
                'type' => 'text',
                'label' => __('Last name')
            ],
            'department_id' => [
                'type' => 'model',
                'label' => __('Department'),
                'relation' => 'department',
                'field' => 'name'
            ],
            'verified' => [
                'type' => 'enum',
                'display' => [
                    1 => __('Yes'),
                    0 => __('No')
                ],
                'label' => __('Verified')
            ],
            'active' => [
                'type' => 'enum',
                'display' => [
                    1 => __('Active'),
                    0 => __('Inactive')
                ],
                'label' => __('Status')
            ],
            'created_at' => [
                'type' => 'date',
                'label' => 'Created at'
            ]
        ];
    }
}
