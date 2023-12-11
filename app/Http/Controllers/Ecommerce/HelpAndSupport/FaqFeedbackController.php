<?php

namespace App\Http\Controllers\Ecommerce\HelpAndSupport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\FaqFeedbackRequest;
use App\Models\FaqContent;
use App\Models\FaqFeedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FaqFeedbackController extends Controller
{
    public function __invoke(Request $request, FaqContent $faqContent): RedirectResponse
    {
        $existingFeedback = FaqFeedback::where('faq_content_id', $faqContent->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingFeedback && $existingFeedback->is_helpful === $request->is_helpful) {
            $existingFeedback->update([
                'is_helpful' => null,
            ]);

            $request->is_helpful ? $faqContent->decrement('helpful_count') : $faqContent->decrement('not_helpful_count');

            return back();
        }

        if (!$existingFeedback) {
            FaqFeedback::create([
                'faq_content_id' => $faqContent->id,
                'user_id' => auth()->id(),
                'is_helpful' => $request->is_helpful,
            ]);

            if ($request->is_helpful) {
                $faqContent->increment('helpful_count');
            } else {
                $faqContent->increment('not_helpful_count');
            }
        } else {
            $existingFeedback->update([
                'is_helpful' => $request->is_helpful,
            ]);

            if ($request->is_helpful) {
                $faqContent->increment('helpful_count');
                $faqContent->not_helpful_count > 0 ? $faqContent->decrement('not_helpful_count') : 0;
            } else {
                $faqContent->increment('not_helpful_count');
                $faqContent->helpful_count > 0 ? $faqContent->decrement('helpful_count') : 0;
            }
        }

        return back()->with('success', 'Thank you for your feedback.');
    }

}
