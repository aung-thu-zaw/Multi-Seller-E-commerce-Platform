<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Actions\Seller\StoreSettings\UpdateStoreInformationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\StoreSettings\BankAccountRequest;
use App\Http\Requests\Dashboard\Seller\StoreSettings\BusinessInformationRequest;
use App\Http\Requests\Dashboard\Seller\StoreSettings\StoreInformationRequest;
use App\Models\BankAccount;
use App\Models\BusinessInformation;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreSettingController extends Controller
{
    public function edit(): Response|ResponseFactory
    {
        $businessInformation = BusinessInformation::where('seller_id', auth()->id())->first();

        $bankAccount = BankAccount::where('seller_id', auth()->id())->first();

        return inertia('Seller/StoreSettings/Edit', compact('businessInformation', 'bankAccount'));
    }

    public function updateStoreInformation(StoreInformationRequest $request, int $storeId): RedirectResponse
    {
        $store = Store::find($storeId);

        (new UpdateStoreInformationAction())->handle($request->validated(), $store);

        return to_route('seller.store-settings.edit', ['tab' => 'store-information'])->with('success', 'Your store information is updated successfully.');
    }

    public function updateBusinessInformation(BusinessInformationRequest $request, int $businessInformationId): RedirectResponse
    {
        $businessInformation = BusinessInformation::find($businessInformationId);

        $businessInformation->update([
            'business_name' => $request->business_name,
            'business_registration_number' => $request->business_registration_number,
            'tax_number' => $request->tax_number,
            'industry' => $request->industry,
            'additional_information' => $request->additional_information,
            'website' => $request->website,
            'products_or_services' => $request->products_or_services,
            'business_description' => $request->business_description,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
        ]);

        return to_route('seller.store-settings.edit', ['tab' => 'business-information'])->with('success', 'Your business information is updated successfully.');
    }

    public function updateBankAccount(BankAccountRequest $request, int $bankAccountId): RedirectResponse
    {
        $bankAccount = BankAccount::find($bankAccountId);

        $bankAccount->update([
            'account_title' => $request->account_title,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'branch_code' => $request->branch_code,
        ]);

        return to_route('seller.store-settings.edit', ['tab' => 'bank-account'])->with('success', 'Your bank account information is updated successfully.');
    }
}
