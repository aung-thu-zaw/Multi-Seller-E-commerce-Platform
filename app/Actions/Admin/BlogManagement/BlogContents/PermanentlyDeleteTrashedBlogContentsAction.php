<?php

namespace App\Actions\Admin\BlogManagement\BlogContents;

use App\Models\BlogCategory;
use App\Models\BlogContent;
use App\Models\Category;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedBlogContentsAction
{
    /**
     * @param  Collection<int,BlogContent>  $blogContents
     */
    public function handle(Collection $blogContents): void
    {
        $blogContents->each(function ($blogContent) {

            BlogContent::deleteImage($blogContent->thumbnail);

            $blogContent->forceDelete();
        });
    }
}
