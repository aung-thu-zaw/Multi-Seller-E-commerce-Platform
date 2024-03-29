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

        Permission::create(['name' => 'collections.view', 'group' => 'Collection']);
        Permission::create(['name' => 'collections.create', 'group' => 'Collection']);
        Permission::create(['name' => 'collections.edit', 'group' => 'Collection']);
        Permission::create(['name' => 'collections.delete', 'group' => 'Collection']);
        Permission::create(['name' => 'collections.view.trash', 'group' => 'Collection']);
        Permission::create(['name' => 'collections.restore', 'group' => 'Collection']);
        Permission::create(['name' => 'collections.force.delete', 'group' => 'Collection']);

        Permission::create(['name' => 'flash-sales.edit', 'group' => 'Flash Sale']);

        Permission::create(['name' => 'slider-banners.view', 'group' => 'Banner']);
        Permission::create(['name' => 'slider-banners.create', 'group' => 'Banner']);
        Permission::create(['name' => 'slider-banners.edit', 'group' => 'Banner']);
        Permission::create(['name' => 'slider-banners.delete', 'group' => 'Banner']);
        Permission::create(['name' => 'slider-banners.view.trash', 'group' => 'Banner']);
        Permission::create(['name' => 'slider-banners.restore', 'group' => 'Banner']);
        Permission::create(['name' => 'slider-banners.force.delete', 'group' => 'Banner']);

        Permission::create(['name' => 'campaign-banners.view', 'group' => 'Banner']);
        Permission::create(['name' => 'campaign-banners.create', 'group' => 'Banner']);
        Permission::create(['name' => 'campaign-banners.edit', 'group' => 'Banner']);
        Permission::create(['name' => 'campaign-banners.delete', 'group' => 'Banner']);
        Permission::create(['name' => 'campaign-banners.view.trash', 'group' => 'Banner']);
        Permission::create(['name' => 'campaign-banners.restore', 'group' => 'Banner']);
        Permission::create(['name' => 'campaign-banners.force.delete', 'group' => 'Banner']);

        Permission::create(['name' => 'product-banners.view', 'group' => 'Banner']);
        Permission::create(['name' => 'product-banners.create', 'group' => 'Banner']);
        Permission::create(['name' => 'product-banners.edit', 'group' => 'Banner']);
        Permission::create(['name' => 'product-banners.delete', 'group' => 'Banner']);
        Permission::create(['name' => 'product-banners.view.trash', 'group' => 'Banner']);
        Permission::create(['name' => 'product-banners.restore', 'group' => 'Banner']);
        Permission::create(['name' => 'product-banners.force.delete', 'group' => 'Banner']);

        Permission::create(['name' => 'coupons.view', 'group' => 'Coupon']);
        Permission::create(['name' => 'coupons.create', 'group' => 'Coupon']);
        Permission::create(['name' => 'coupons.edit', 'group' => 'Coupon']);
        Permission::create(['name' => 'coupons.delete', 'group' => 'Coupon']);
        Permission::create(['name' => 'coupons.view.trash', 'group' => 'Coupon']);
        Permission::create(['name' => 'coupons.restore', 'group' => 'Coupon']);
        Permission::create(['name' => 'coupons.force.delete', 'group' => 'Coupon']);

        Permission::create(['name' => 'orders.view', 'group' => 'Order Management']);
        Permission::create(['name' => 'orders.edit', 'group' => 'Order Management']);
        Permission::create(['name' => 'orders.delete', 'group' => 'Order Management']);
        Permission::create(['name' => 'orders.view.trash', 'group' => 'Order Management']);
        Permission::create(['name' => 'orders.restore', 'group' => 'Order Management']);
        Permission::create(['name' => 'orders.force.delete', 'group' => 'Order Management']);

        Permission::create(['name' => 'return-orders.view', 'group' => 'Order Management']);
        Permission::create(['name' => 'return-orders.edit', 'group' => 'Order Management']);
        Permission::create(['name' => 'return-orders.delete', 'group' => 'Order Management']);
        Permission::create(['name' => 'return-orders.view.trash', 'group' => 'Order Management']);
        Permission::create(['name' => 'return-orders.restore', 'group' => 'Order Management']);
        Permission::create(['name' => 'return-orders.force.delete', 'group' => 'Order Management']);

        Permission::create(['name' => 'cancel-orders.view', 'group' => 'Order Management']);
        Permission::create(['name' => 'cancel-orders.edit', 'group' => 'Order Management']);
        Permission::create(['name' => 'cancel-orders.delete', 'group' => 'Order Management']);
        Permission::create(['name' => 'cancel-orders.view.trash', 'group' => 'Order Management']);
        Permission::create(['name' => 'cancel-orders.restore', 'group' => 'Order Management']);
        Permission::create(['name' => 'cancel-orders.force.delete', 'group' => 'Order Management']);

        Permission::create(['name' => 'regions.view', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'regions.create', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'regions.edit', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'regions.delete', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'regions.view.trash', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'regions.restore', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'regions.force.delete', 'group' => 'Geographic Hierarchy']);

        Permission::create(['name' => 'cities.view', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'cities.create', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'cities.edit', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'cities.delete', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'cities.view.trash', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'cities.restore', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'cities.force.delete', 'group' => 'Geographic Hierarchy']);

        Permission::create(['name' => 'townships.view', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'townships.create', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'townships.edit', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'townships.delete', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'townships.view.trash', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'townships.restore', 'group' => 'Geographic Hierarchy']);
        Permission::create(['name' => 'townships.force.delete', 'group' => 'Geographic Hierarchy']);

        Permission::create(['name' => 'shipping-areas.view', 'group' => 'Shipping Area']);
        Permission::create(['name' => 'shipping-areas.create', 'group' => 'Shipping Area']);
        Permission::create(['name' => 'shipping-areas.edit', 'group' => 'Shipping Area']);
        Permission::create(['name' => 'shipping-areas.delete', 'group' => 'Shipping Area']);
        Permission::create(['name' => 'shipping-areas.view.trash', 'group' => 'Shipping Area']);
        Permission::create(['name' => 'shipping-areas.restore', 'group' => 'Shipping Area']);
        Permission::create(['name' => 'shipping-areas.force.delete', 'group' => 'Shipping Area']);

        Permission::create(['name' => 'shipping-methods.view', 'group' => 'Shipping Method']);
        Permission::create(['name' => 'shipping-methods.create', 'group' => 'Shipping Method']);
        Permission::create(['name' => 'shipping-methods.edit', 'group' => 'Shipping Method']);
        Permission::create(['name' => 'shipping-methods.delete', 'group' => 'Shipping Method']);
        Permission::create(['name' => 'shipping-methods.view.trash', 'group' => 'Shipping Method']);
        Permission::create(['name' => 'shipping-methods.restore', 'group' => 'Shipping Method']);
        Permission::create(['name' => 'shipping-methods.force.delete', 'group' => 'Shipping Method']);

        Permission::create(['name' => 'shipping-rates.view', 'group' => 'Shipping Rate']);
        Permission::create(['name' => 'shipping-rates.create', 'group' => 'Shipping Rate']);
        Permission::create(['name' => 'shipping-rates.edit', 'group' => 'Shipping Rate']);
        Permission::create(['name' => 'shipping-rates.delete', 'group' => 'Shipping Rate']);
        Permission::create(['name' => 'shipping-rates.view.trash', 'group' => 'Shipping Rate']);
        Permission::create(['name' => 'shipping-rates.restore', 'group' => 'Shipping Rate']);
        Permission::create(['name' => 'shipping-rates.force.delete', 'group' => 'Shipping Rate']);

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

        Permission::create(['name' => 'automated-filter-words.view', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.create', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.edit', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.delete', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.view.trash', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.restore', 'group' => 'Rating Management']);
        Permission::create(['name' => 'automated-filter-words.force.delete', 'group' => 'Rating Management']);

        Permission::create(['name' => 'product-reviews.view', 'group' => 'Rating Management']);
        Permission::create(['name' => 'product-reviews.edit', 'group' => 'Rating Management']);
        Permission::create(['name' => 'product-reviews.delete', 'group' => 'Rating Management']);
        Permission::create(['name' => 'product-reviews.view.trash', 'group' => 'Rating Management']);
        Permission::create(['name' => 'product-reviews.restore', 'group' => 'Rating Management']);
        Permission::create(['name' => 'product-reviews.force.delete', 'group' => 'Rating Management']);

        Permission::create(['name' => 'store-reviews.view', 'group' => 'Rating Management']);
        Permission::create(['name' => 'store-reviews.edit', 'group' => 'Rating Management']);
        Permission::create(['name' => 'store-reviews.delete', 'group' => 'Rating Management']);
        Permission::create(['name' => 'store-reviews.view.trash', 'group' => 'Rating Management']);
        Permission::create(['name' => 'store-reviews.restore', 'group' => 'Rating Management']);
        Permission::create(['name' => 'store-reviews.force.delete', 'group' => 'Rating Management']);

        Permission::create(['name' => 'claims-as-a-seller.view', 'group' => 'Seller Management']);
        Permission::create(['name' => 'claims-as-a-seller.edit', 'group' => 'Seller Management']);
        Permission::create(['name' => 'claims-as-a-seller.delete', 'group' => 'Seller Management']);
        Permission::create(['name' => 'claims-as-a-seller.view.trash', 'group' => 'Seller Management']);
        Permission::create(['name' => 'claims-as-a-seller.restore', 'group' => 'Seller Management']);
        Permission::create(['name' => 'claims-as-a-seller.force.delete', 'group' => 'Seller Management']);

        Permission::create(['name' => 'store-manage.view', 'group' => 'Seller Management']);
        Permission::create(['name' => 'store-manage.edit', 'group' => 'Seller Management']);
        Permission::create(['name' => 'store-manage.delete', 'group' => 'Seller Management']);
        Permission::create(['name' => 'store-manage.view.trash', 'group' => 'Seller Management']);
        Permission::create(['name' => 'store-manage.restore', 'group' => 'Seller Management']);
        Permission::create(['name' => 'store-manage.force.delete', 'group' => 'Seller Management']);

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

        Permission::create(['name' => 'roles.view', 'group' => 'Authority Management']);
        Permission::create(['name' => 'roles.create', 'group' => 'Authority Management']);
        Permission::create(['name' => 'roles.edit', 'group' => 'Authority Management']);
        Permission::create(['name' => 'roles.delete', 'group' => 'Authority Management']);
        Permission::create(['name' => 'roles.view.trash', 'group' => 'Authority Management']);
        Permission::create(['name' => 'roles.restore', 'group' => 'Authority Management']);
        Permission::create(['name' => 'roles.force.delete', 'group' => 'Authority Management']);

        Permission::create(['name' => 'permissions.view', 'group' => 'Authority Management']);

        Permission::create(['name' => 'assign-role-permissions.view', 'group' => 'Authority Management']);
        Permission::create(['name' => 'assign-role-permissions.create', 'group' => 'Authority Management']);
        Permission::create(['name' => 'assign-role-permissions.edit', 'group' => 'Authority Management']);
        Permission::create(['name' => 'assign-role-permissions.delete', 'group' => 'Authority Management']);

        Permission::create(['name' => 'subscribers.view', 'group' => 'Subscribers And Newsletters']);
        Permission::create(['name' => 'subscribers.delete', 'group' => 'Subscribers And Newsletters']);
        Permission::create(['name' => 'subscribers.view.trash', 'group' => 'Subscribers And Newsletters']);
        Permission::create(['name' => 'subscribers.restore', 'group' => 'Subscribers And Newsletters']);
        Permission::create(['name' => 'subscribers.force.delete', 'group' => 'Subscribers And Newsletters']);

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

        Permission::create(['name' => 'general-settings.edit', 'group' => 'Settings']);

        Permission::create(['name' => 'seo-settings.edit', 'group' => 'Settings']);

        Permission::create(['name' => 'database-backups.view', 'group' => 'Database Backup']);
        Permission::create(['name' => 'database-backups.download', 'group' => 'Database Backup']);
        Permission::create(['name' => 'database-backups.create', 'group' => 'Database Backup']);
        Permission::create(['name' => 'database-backups.delete', 'group' => 'Database Backup']);
    }
}
