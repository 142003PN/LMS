<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const HEAD_TEACHER = 'head_teacher';

    public const LEARNER = 'learner';

    public const HOD = 'hod';

    public const DEPUTY_HEAD_TEACHER = 'deputy_head_teacher';

    public const TEACHER = 'teacher';

    public const ROLES = [
        self::HEAD_TEACHER,
        self::DEPUTY_HEAD_TEACHER,
        self::LEARNER,
        self::TEACHER,
        self::HOD,
    ];

    private const DASHBOARD_ROUTES = [
        'head_teacher' => 'head_teacher.dashboard',
        'hod' => 'hod.dashboard',
        'teacher' => 'teacher.dashboard',
        'learner' => 'learners.dashboard',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nrc',
        'phone_number',
        'role',
        'email',
        'password',
    ];

    public function isHod(): bool
    {
        return $this->role === self::HOD;
    }

    public function isHeadTeacher(): bool
    {
        return $this->role === self::HEAD_TEACHER;
    }

    public function isDeputyHeadTeacher(): bool
    {
        return $this->role === self::DEPUTY_HEAD_TEACHER;
    }

    public function canManageStaff(): bool
    {
        return in_array($this->role, [self::HEAD_TEACHER, self::DEPUTY_HEAD_TEACHER], true);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function resolve_dashboard_key(): string
    {
        return array_key_exists($this->role, self::DASHBOARD_ROUTES) ? $this->role : 'default';
    }

    public function dashboard_route_name(): string
    {
        return self::DASHBOARD_ROUTES[$this->resolve_dashboard_key()] ?? 'dashboard';
    }
}
