<?php

namespace App\Constants;

class PermissionConstant
{
    const LIST = [
        ['label' => 'View Dashboard', 'name' => 'view-dashboard'],

        ['label' => 'Create User', 'name' => 'create-user'],
        ['label' => 'Update User', 'name' => 'update-user'],
        ['label' => 'View User', 'name' => 'view-user'],
        ['label' => 'Delete User', 'name' => 'delete-user'],

        ['label' => 'Create Role', 'name' => 'create-role'],
        ['label' => 'Update Role', 'name' => 'update-role'],
        ['label' => 'View Role', 'name' => 'view-role'],
        ['label' => 'Delete Role', 'name' => 'delete-role'],

        ['label' => 'View Setting', 'name' => 'view-setting'],
        ['label' => 'View Shortlink', 'name' => 'view-shortlink'],


        // #Add New Permission Below!
        ['label' => 'Edit Page Persyaratan', 'name' => 'view-page'],
        ['label' => 'Edit Page Pengumuman', 'name' => 'view-publication'],
        ['label' => 'Delete Pendaftaran', 'name' => 'delete-registrant'],
        ['label' => 'Update Pendaftaran', 'name' => 'update-registrant'],
        ['label' => 'Create Pendaftaran', 'name' => 'create-registrant'],
        ['label' => 'View Pendaftaran', 'name' => 'view-registrant'],
    ];
}
