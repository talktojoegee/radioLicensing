<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function getPermissionModule(){
        return $this->belongsTo(ModuleManager::class, 'module_id');
    }

    public function addPermission($data){
        $permission = new Permission();
        $permission->name = $data['permissionName'];
        $permission->guard_name = 'web';
        $permission->module_id = $data['module'];
        $permission->save();
    }
    public function editPermission($data){
        $permission =  Permission::find($data['permissionId']);
        $permission->name = $data['permissionName'];
        $permission->guard_name = 'web';
        $permission->module_id = $data['module'];
        $permission->save();
    }

    public function getPermissions(){
        return Permission::all();
    }
}
