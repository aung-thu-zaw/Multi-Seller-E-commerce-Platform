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

        Permission::create(['name' => 'blog-comments.view', 'group' => 'Blog Management']);
        Permission::create(['name' => 'blog-comments.delete', 'group' => 'Blog Management']);

        Permission::create(['name' => 'faq-categories.view', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-categories.create', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-categories.edit', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-categories.delete', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-categories.view.trash', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-categories.restore', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-categories.force.delete', 'group' => 'FAQs']);

        Permission::create(['name' => 'faq-subcategories.view', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-subcategories.create', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-subcategories.edit', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-subcategories.delete', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-subcategories.view.trash', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-subcategories.restore', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-subcategories.force.delete', 'group' => 'FAQs']);

        Permission::create(['name' => 'faq-contents.view', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-contents.create', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-contents.edit', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-contents.delete', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-contents.view.trash', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-contents.restore', 'group' => 'FAQs']);
        Permission::create(['name' => 'faq-contents.force.delete', 'group' => 'FAQs']);

        Permission::create(['name' => 'help-pages.edit', 'group' => 'Help Pages']);

        Permission::create(['name' => 'roles.view', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'roles.create', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'roles.edit', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'roles.delete', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'roles.view.trash', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'roles.restore', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'roles.force.delete', 'group' => 'Authority Managements']);

        Permission::create(['name' => 'permissions.view', 'group' => 'Authority Managements']);

        Permission::create(['name' => 'assign-role-permissions.view', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'assign-role-permissions.create', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'assign-role-permissions.edit', 'group' => 'Authority Managements']);
        Permission::create(['name' => 'assign-role-permissions.delete', 'group' => 'Authority Managements']);

        Permission::create(['name' => 'registered-accounts.view', 'group' => 'Account Management']);
        Permission::create(['name' => 'registered-accounts.edit', 'group' => 'Account Management']);
        Permission::create(['name' => 'registered-accounts.delete', 'group' => 'Account Management']);
        Permission::create(['name' => 'registered-accounts.view.trash', 'group' => 'Account Management']);
        Permission::create(['name' => 'registered-accounts.restore', 'group' => 'Account Management']);
        Permission::create(['name' => 'registered-accounts.force.delete', 'group' => 'Account Management']);

        Permission::create(['name' => 'admin-manage.view', 'group' => 'Account Management']);
        Permission::create(['name' => 'admin-manage.create', 'group' => 'Account Management']);
        Permission::create(['name' => 'admin-manage.edit', 'group' => 'Account Management']);
        Permission::create(['name' => 'admin-manage.delete', 'group' => 'Account Management']);
        Permission::create(['name' => 'admin-manage.view.trash', 'group' => 'Account Management']);
        Permission::create(['name' => 'admin-manage.restore', 'group' => 'Account Management']);
        Permission::create(['name' => 'admin-manage.force.delete', 'group' => 'Account Management']);

        Permission::create(['name' => 'automated-filter-words.view', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.create', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.edit', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.delete', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.view.trash', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.restore', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.force.delete', 'group' => 'Rating Management']);

        Permission::create(['name' => 'general-settings.edit', 'group' => 'Settings']);
        
        Permission::create(['name' => 'seo-settings.edit', 'group' => 'Settings']);
    }
}
