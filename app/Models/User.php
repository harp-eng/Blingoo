<?php

namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Models\Traits\HasHashedMediaTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use App\Models\VendorDB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory;
    use HasHashedMediaTrait;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use UserPresenter;
    use HasApiTokens;

    protected $guarded = [
        'id',
        'updated_at',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'datetime',
            'last_login' => 'datetime',
            'deleted_at' => 'datetime',
            'social_profiles' => 'array',
        ];
    }

    /**
     * Boot the model.
     *
     * Register the model's event listeners.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($table) {
            $table->created_by = Auth::id();
        });

        // create a event to happen on updating
        static::updating(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on saving
        static::saving(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            $table->deleted_by = Auth::id();
            $table->save();
        });
    }

    /**
     * Retrieve the providers associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany('App\Models\UserProvider');
    }

    /**
     * Get the list of users related to the current User.
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    public function createVendorDatabase()
    {
        Log::info("===== Vendor creation initiated for user: {$this->id}");

        $user = User::find($this->id);

        if (!$user || !$user->hasRole('administrator')) {
            Log::warning("User {$this->id} does not have administrator role.");
            return;
        }

        Log::info("===== Creating vendor database for user: {$this->id}");

        $databaseName = "vendor_{$user->id}";

        try {
            // Create database if it does not exist
            DB::statement("CREATE DATABASE IF NOT EXISTS `{$databaseName}`");

            // Store database details
            VendorDB::updateOrCreate(
                ['domain' => $user->email],
                ['database' => $databaseName]
            );
        } catch (\Exception $e) {
            Log::error("Error creating vendor database for user {$this->id}: {$e->getMessage()}");
        }
    }
}
