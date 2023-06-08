<?php

namespace App\Models;

use App\Constants\GeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *   description="User model",
 *   title="User",
 *   required={},
 *   @OA\Property(type="integer",description="id of User",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of User",title="name",property="name",example="Macbook Pro"),
 *   @OA\Property(type="string",description="sku of User",title="sku",property="sku",example="MCBPRO2022"),
 *   @OA\Property(type="integer",description="price of User",title="price",property="price",example="99"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 *
 *
 *
 *
 *
 * @OA\Schema (
 *   schema="Users",
 *   title="Users list",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/User"),
 *   ),
 *   @OA\Property(type="string", title="first_page_url",property="first_page_url",example="http://localhost:8080/api/merchant-customers?page=1"),
 *   @OA\Property(type="string", title="last_page_url",property="last_page_url",example="http://localhost:8080/api/merchant-customers?page=3"),
 *   @OA\Property(type="string", title="prev_page_url",property="prev_page_url",example="null"),
 *   @OA\Property(type="string", title="next_page_url",property="next_page_url",example="http://localhost:8080/api/merchant-customers?page=2"),
 *   @OA\Property(type="integer", title="current_page",property="current_page",example="1"),
 *   @OA\Property(type="integer", title="from",property="from",example="1"),
 *   @OA\Property(type="integer", title="last_page",property="last_page",example="3"),
 *   @OA\Property(type="string", title="path",property="path",example="http://localhost:8080/api/merchant-customers"),
 *   @OA\Property(type="integer", title="per_page",property="per_page",example="1"),
 *   @OA\Property(type="integer", title="total",property="total",example="3"),
 *   @OA\Property(title="links",property="links",type="array",
 *     @OA\Items(type="object",
 *          @OA\Property(type="string",title="url",property="url",example="http://localhost:8080/api/merchant-customers?page=2"),
 *          @OA\Property(type="string",title="label",property="label",example="1"),
 *          @OA\Property(type="bool",title="active",property="active",example="true"),
 *      ),
 *   )
 * )
 *
 * @OA\Parameter(
 *      parameter="User--id",
 *      in="path",
 *      name="User_id",
 *      required=true,
 *      description="Id of User",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class User extends BaseModel
{
    use HasFactory;

    public array $translatable = [];
    protected $fillable = [

        'firstname',
        'lastname',
        'adress',
        'email',
        'phonenumber',
        'password',
        'photo',
        'country_id',
        'email_verified_at',

    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $hidden = [
        'password',
        'remeber_token'
    ];

    protected $with = [
        'roles'
    ];

    public function getActiveRole()
    {
        return $this->roles()->where('status', GeneralStatus::STATUS_ACTIVE)->first();
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['status']))
        {
            $query->whereHas('roles', function ($q) use ($data) {
                $q->where('status', $data['status']);
            });
        }

        if (isset($data['role']))
        {
            $query->whereHas('roles', function ($q) use ($data) {
                $q->where('role_code', $data['role']);
            });
        }

        return $query;
    }

    public function countries()
    {
        return $this->belongsTo(Country::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function Userroles(): HasMany
    {
        return $this->hasMany(UserRoles::class);
    }


}