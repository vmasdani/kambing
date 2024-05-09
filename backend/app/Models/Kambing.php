<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $uuid
 * @property string|null $deleted_at
 * @property int|null $ordering
 * @property string|null $name
 * @property string|null $address
 * @property int|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kambing whereUuid($value)
 * @mixin \Eloquent
 */
class Kambing extends Model
{

    protected $fillable = [
        'id',
        'name',
        'price',
        'category'
    ];
}
