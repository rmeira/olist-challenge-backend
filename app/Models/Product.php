<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type_id',
        'value',
    ];

    /**
     * List Model Relations
     *
     * @var array
     */
    protected $relations = [
        'type'
    ];

    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     title="ID",
     * )
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     description="name",
     *     title="name",
     *     required=true
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     description="type_id",
     *     title="type_id",
     *     required=true
     * )
     *
     * @var integer
     */
    private $type_id;

    /**
     * @OA\Property(
     *     description="value",
     *     title="value",
     *     required=true
     * )
     *
     * @var float
     */
    private $value;

    /**
     * @OA\Property(
     *     format="datetime",
     *     description="Created At",
     *     title="Created At",
     * )
     *
     * @var \Datetime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     format="datetime",
     *     description="Update At",
     *     title="Update At",
     * )
     *
     * @var \Datetime
     */
    private $updated_at;

    /**
     * Type relation
     *
     * @return void
     */
    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }
}
