<?php
use Botble\ACL\Models\Role;

$role = Role::where('slug', 'author')->first();

if (!$role) {
    $role = new Role();
    $role->name = 'Author';
    $role->slug = 'author';
    $role->description = 'Can manage blog posts, categories and tags.';
    $role->created_by = 1;
    $role->updated_by = 1;
}

$permissions = [
    'plugins.blog' => true,
    'posts.index' => true,
    'posts.create' => true,
    'posts.edit' => true,
    'posts.destroy' => true,
    'categories.index' => true,
    'tags.index' => true,
    'media.index' => true,
    'media.create' => true,
    'media.edit' => true,
    'media.trash' => true,
];

$role->permissions = $permissions;
$role->save();

echo "Role 'Author' has been created/updated successfully.\n";
