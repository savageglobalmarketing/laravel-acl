<?php

return [
    'name' => 'Acl',


    /* ---------------------------------------------------------------------------------------
     | Super admin user setup
     | ---------------------------------------------------------------------------------------
     | Identify a super admin to be used on permissions migration.
     | This user will be updated every time a the migration command is executed, to get all permissions
     |
     */
    /*'admin' => [
        'class' => \SavageGlobalMarketing\Auth\Models\User::class,

        'username_field' => 'email',

        'username' => 'admin@email.com',
    ],*/

    'admin_role' => 'admin',

    /* ---------------------------------------------------------------------------------------
     | Default actions
     | ---------------------------------------------------------------------------------------
     | This list of actions will be attached to all permissions listed below if that isn't
     | defined as "strict"
     |
     */
    'default_actions' => ['create', 'read', 'update', 'destroy'],

    /* ---------------------------------------------------------------------------------------
     | List of permissions
     | ---------------------------------------------------------------------------------------
     | List all system permissions you want to create.
     |
     |
     | You can create more actions to a specific permission by adding this like a index on
     | the permissions array, then another array inside named "actions".
     | The "post" permission in the example below will create four permissions just like
     | the "role" plus another two: "post_deactivate" and "post_publish"
     |
     | If by any reason you dont want a permission to be created with the default actions,
     | just add a second parameter on the intern array. Check the "user" permission below.
     | Only "user_deactivate" and "user_edit" will be created.
     |
     | Obs.: The permissions below are just examples and can be replaced freely
     */
    'permissions' => [
        /* Strict actions example
        'user' => [
            'actions' => ['deactivate', 'edit'],
            'strict' => true
        ],
        */
        'role',
    ],

    /* ---------------------------------------------------------------------------------------
     | List of roles and permissions to seed
     | ---------------------------------------------------------------------------------------
     | Place the default permissions to system default roles.
     |
     | It will be seeded running the command permissions:migrate
     */
    'seed_roles' => [
//        'some_role' => [
//            'some_permission_name',
//            'some_permission_name_2',
//        ]
    ]
];
