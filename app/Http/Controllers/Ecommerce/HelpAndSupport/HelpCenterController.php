<?php

namespace App\Http\Controllers\Ecommerce\HelpAndSupport;

use App\Http\Controllers\Controller;
use App\Models\FaqContent;
use App\Models\FaqSubcategory;
use Inertia\Response;
use Inertia\ResponseFactory;

class HelpCenterController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $topQuestions = FaqContent::select('id', 'question', 'slug')
            ->orderBy('helpful_count', 'desc')
            ->take(12)
            ->get();

        $faqSubCategories = FaqSubcategory::select('id', 'icon', 'name', 'slug')->get();

        return inertia('E-commerce/HelpAndSupport/HelpCenter', compact('topQuestions', 'faqSubCategories'));
    }
}
