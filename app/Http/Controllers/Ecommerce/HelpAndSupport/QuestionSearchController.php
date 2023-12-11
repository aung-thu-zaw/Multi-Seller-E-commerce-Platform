<?php

namespace App\Http\Controllers\Ecommerce\HelpAndSupport;

use App\Http\Controllers\Controller;
use App\Models\FaqContent;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class QuestionSearchController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $faqContents = FaqContent::filterBy(request(["search_question"]))
                   ->orderBy("id", "desc")
                   ->paginate(15)
                   ->withQueryString();

        return inertia('E-commerce/HelpAndSupport/QuestionSearchResult', compact('faqContents'));
    }
}
