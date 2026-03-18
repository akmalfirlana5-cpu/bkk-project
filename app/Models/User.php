<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'photo',
        'password',
        'nisn',
        'birth_place',
        'address',
        'no_hp',
        'major',
        'CVuser',
        'certificate',
        'status',
        'graduation_year',
        'role',
        'nik',
    ];

    protected static function booted(): void
    {
        static::creating(function ($user) {
            if (empty($user->password)) {
                $user->password = 'pass00'.$user->nisn;
            }
        });
    }

    public function getFilamentName(): string
    {
        return $this->full_name ?? 'Admin';
    }

    public function workFill()
    {
        return $this->hasOne(WorkFill::class, 'id_user');
    }

    public function collegeFill()
    {
        return $this->hasOne(CollegeFill::class, 'id_user');
    }

    public function entrepreneurFill()
    {
        return $this->hasOne(EntrepreneurFill::class, 'id_user');
    }

    public function unemployedFill()
    {
        return $this->hasOne(UnemployedFill::class, 'id_user');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function hasAdminPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->adminPermissions()
            ->where('permission', $permission)
            ->exists();
    }

    public function adminPermissions(): HasMany
    {
        return $this->hasMany(AdminPermission::class);
    }

    public const MAJORS = [
        'Animasi' => 'Animasi',
        'Desain Komunikasi Visual' => 'Desain Komunikasi Visual',
        'Logistik' => 'Logistik',
        'Perhotelan' => 'Perhotelan',
        'Teknik Grafika' => 'Teknik Grafika',
        'Teknik Komputer dan Jaringan' => 'Teknik Komputer dan Jaringan',
        'Rekayasa Perangkat Lunak' => 'Rekayasa Perangkat Lunak',
    ];

    public const ROLES = [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'user' => 'User',
    ];

    public const STATUSES = [
        'bekerja' => 'Bekerja',
        'kuliah' => 'Kuliah',
        'wiraswasta' => 'Wiraswasta',
        'menganggur' => 'Menganggur',
    ];

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
}
