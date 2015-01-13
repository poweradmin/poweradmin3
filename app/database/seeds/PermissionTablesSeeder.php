<?php

class PermissionTablesSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create([
            'name' => 'Administrator',
            'description' => 'Administrator template with full rights',
        ]);

        Permission::create(['name' => 'search', 'display_name' => 'User is allowed to perform searches']);
        Permission::create(['name' => 'supermaster_add', 'display_name' => 'User is allowed to add new supermaster']);
        Permission::create(['name' => 'supermaster_edit', 'display_name' => 'User is allowed to edit supermasters']);
        Permission::create(['name' => 'supermaster_view', 'display_name' => 'User is allowed to view supermasters']);
        Permission::create(['name' => 'templ_perm_add', 'display_name' => 'User is allowed to add new permission templates']);
        Permission::create(['name' => 'templ_perm_edit', 'display_name' => 'User is allowed to edit permission templates']);
        Permission::create(['name' => 'user_add_new', 'display_name' => 'User is allowed to add new users.']);
        Permission::create(['name' => 'user_edit_others', 'display_name' => 'User is allowed to edit other users.']);
        Permission::create(['name' => 'user_edit_own', 'display_name' => 'User is allowed to edit their own details']);
        Permission::create(['name' => 'user_edit_templ_perm', 'display_name' => 'User is allowed to change the permission template that is assigned to a user']);
        Permission::create(['name' => 'user_passwd_edit_others', 'display_name' => 'User is allowed to edit the password of other users']);
        Permission::create(['name' => 'user_view_others', 'display_name' => 'User is allowed to see other users and their details']);
        Permission::create(['name' => 'zone_content_edit_others', 'display_name' => 'User is allowed to edit the content of zones he does not own']);
        Permission::create(['name' => 'zone_content_edit_own', 'display_name' => 'User is allowed to edit the content of zones he owns']);
        Permission::create(['name' => 'zone_content_view_others', 'display_name' => 'User is allowed to see the content and meta data of zones he does not own']);
        Permission::create(['name' => 'zone_content_view_own', 'display_name' => 'User is allowed to see the content and meta data of zones he owns']);
        Permission::create(['name' => 'zone_master_add', 'display_name' => 'User is allowed to add new master zones']);
        Permission::create(['name' => 'zone_meta_edit_others', 'display_name' => 'User is allowed to edit the meta data of zones he does not own']);
        Permission::create(['name' => 'zone_meta_edit_own', 'display_name' => 'User is allowed to edit the meta data of zones he owns']);
        Permission::create(['name' => 'zone_slave_add', 'display_name' => 'User is allowed to add new slave zones']);

        $admin->perms()->sync(Permission::all());

        $user = User::where('username', '=', 'admin')->first();
        $user->attachRole($admin);

        $this->command->info('Permission tables seeded!');
    }
}
