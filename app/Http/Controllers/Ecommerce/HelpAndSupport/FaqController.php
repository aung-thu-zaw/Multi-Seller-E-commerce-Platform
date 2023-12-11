<?php

namespace App\Http\Controllers\Ecommerce\HelpAndSupport;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqContent;
use App\Models\FaqSubcategory;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class FaqController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $faqCategories = FaqCategory::with('faqSubcategories')->get();

        $faqContents = FaqContent::filterBy(request(['search_question', 'category']))
                   ->orderBy('id', 'desc')
                   ->paginate(15)
                   ->withQueryString();

        $faqSubcategory = FaqSubcategory::with('faqCategory')->where('slug', request('category'))->first();

        return inertia('E-commerce/HelpAndSupport/Faqs/Index', compact('faqCategories', 'faqContents', 'faqSubcategory'));
    }

    public function show(FaqContent $faqContent): Response|ResponseFactory
    {
        $faqContent->load(['faqSubcategory.faqCategory']);

        $faqCategories = FaqCategory::with('faqSubcategories')->get();

        $relatedFaqContents = FaqContent::where('faq_subcategory_id', $faqContent->faq_subcategory_id)
                          ->where('slug', '!=', $faqContent->slug)
                          ->take(5)
                          ->get();

        return inertia('E-commerce/HelpAndSupport/Faqs/Show', compact('faqContent', 'faqCategories', 'relatedFaqContents'));
    }
}
