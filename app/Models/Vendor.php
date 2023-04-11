<?php

namespace App\Models;

use Database\Factories\VendorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Talanov\Nanoid\HasNanoId;
use Talanov\Nanoid\NanoIdOptions;

/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property string $nano_id
 * @property string $name
 * @property string|null $about
 * @property string|null $address
 * @property string $employees
 * @property float|null $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, ChatRoom> $chatRooms
 * @property-read int|null $chat_rooms_count
 * @property-read Collection<int, Feedback> $feedback
 * @property-read int|null $feedback_count
 * @property-read Collection<int, Order> $orders
 * @property-read int|null $orders_count
 * @property-read Collection<int, Service> $services
 * @property-read int|null $services_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @property-read Collection<int, Vehicle> $vehicles
 * @property-read int|null $vehicles_count
 *
 * @method static VendorFactory factory($count = null, $state = [])
 * @method static Builder|Vendor newModelQuery()
 * @method static Builder|Vendor newQuery()
 * @method static Builder|Vendor query()
 * @method static Builder|Vendor whereAbout($value)
 * @method static Builder|Vendor whereAddress($value)
 * @method static Builder|Vendor whereCreatedAt($value)
 * @method static Builder|Vendor whereEmployees($value)
 * @method static Builder|Vendor whereId($value)
 * @method static Builder|Vendor whereName($value)
 * @method static Builder|Vendor whereNanoId($value)
 * @method static Builder|Vendor whereRating($value)
 * @method static Builder|Vendor whereScope($value)
 * @method static Builder|Vendor whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Vendor extends Model
{
    use HasFactory, HasNanoId;

    protected $fillable = [
        'name',
        'about',
        'address',
        'employees',
        'rating',
    ];

    public function getNanoIdOptions(): NanoIdOptions
    {
        return NanoIdOptions::make();
    }

    /* Relationships */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'joined_at')
            ->using(UserVendor::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function chatRooms(): HasMany
    {
        return $this->hasMany(ChatRoom::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class)->withPivot('quantity');
    }

    public function feedback(): HasManyThrough
    {
        return $this->hasManyThrough(Feedback::class, Order::class);
    }
}
