<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 'columns', 'menu_items'
    ];

    public function users(): HasMany {

        return $this->hasMany(User::class, 'user_group_id');
    }

    public function getColumnsListAttribute(): array {

        return $this->columns ? json_decode($this->columns, true) ?? [] : [];
    }
    public function setPermission(string $column, string $key, string $value, bool $save = false): self {
        $storedValue = json_decode($this[$column] ?? "{}");

        $storedValue[$key] = $value;

        $this->{$column} = $storedValue;

        if ($save) {
            $this->save();
        }

        return $this;
    }
}
