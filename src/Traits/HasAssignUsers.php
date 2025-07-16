<?php
namespace Thunderkiss52\LaravelPermission\Traits;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Thunderkiss52\LaravelPermission\Models\Role;
use Thunderkiss52\LaravelPermission\Permission;
use App\Models\User;
trait HasAssignUsers {
    public function roles(): Collection {
        return Role::where('model_name', app(Permission::class)->getClassName($this::class))->get();
    }
    public function users(): Arrayable {
        $roles = $this->roles();
        return $roles && $roles->count() > 0 ? User::whereBelongsTo($roles)->get() : collect();
    }
}