<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'categories.view', 'group' => 'Category']);
        Permission::create(['name' => 'categories.create', 'group' => 'Category']);
        Permission::create(['name' => 'categories.edit', 'group' => 'Category']);
        Permission::create(['name' => 'categories.delete', 'group' => 'Category']);
        Permission::create(['name' => 'categories.view.trash', 'group' => 'Category']);
        Permission::create(['name' => 'categories.restore', 'group' => 'Category']);
        Permission::create(['name' => 'categories.force.delete', 'group' => 'Category']);

        Permission::create(['name' => 'brands.view', 'group' => 'Brand']);
        Permission::create(['name' => 'brands.create', 'group' => 'Brand']);
        Permission::create(['name' => 'brands.edit', 'group' => 'Brand']);
        Permission::create(['name' => 'brands.delete', 'group' => 'Brand']);
        Permission::create(['name' => 'brands.view.trash', 'group' => 'Brand']);
        Permission::create(['name' => 'brands.restore', 'group' => 'Brand']);
        Permission::create(['name' => 'brands.force.delete', 'group' => 'Brand']);

        Permission::create(['name' => 'products.view', 'group' => 'Product']);
        Permission::create(['name' => 'products.create', 'group' => 'Product']);
        Permission::create(['name' => 'products.edit', 'group' => 'Product']);
        Permission::create(['name' => 'products.delete', 'group' => 'Product']);
        Permission::create(['name' => 'products.view.trash', 'group' => 'Product']);
        Permission::create(['name' => 'products.restore', 'group' => 'Product']);
        Permission::create(['name' => 'products.force.delete', 'group' => 'Product']);

        Permission::create(['name' => 'blog-categories.view', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-categories.create', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-categories.edit', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-categories.delete', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-categories.view.trash', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-categories.restore', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-categories.force.delete', 'group' => 'Blog Management']);

        Permission::create(['name' => 'blog-contents.view', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-contents.create', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-contents.edit', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-contents.delete', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-contents.view.trash', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-contents.restore', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-contents.force.delete', 'group' => 'Blog Management']);
    }
}
