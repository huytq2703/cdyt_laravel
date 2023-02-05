<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'gso_id',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function districts()
    {
        return $this->hasMany(District::class,  'province_id');
    }

    public function getAll(array $filters)
    {
        $pagination = config('constants.pagination');
        $pageSize = $pagination['pageSize'];
        $builder = $this;

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $builder->where(function ($searchQuery) use ($search) {
                $searchQuery->where('name', 'like', "%{$search}%");
            });
        }

        if (isset($filters['sortField'])) {
            $sortField = $filters['sortField'];
            $sortOrder = isset($filters['sortOrder']) && $filters['sortOrder'] == -1 ? 'desc' : 'asc';
            $builder = $builder->orderBy($sortField, $sortOrder);
        }
        return $builder->latest('provinces.created_at')->paginate($pageSize);
    }
}
