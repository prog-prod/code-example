<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RequisitesFieldsEnum;
use App\Enums\SmsTemplateVariables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SmsTemplateRequest;
use App\Models\SmsTemplate;

class SmsTemplateController extends Controller
{
    private string $smsParams;

    public function __construct()
    {
        $this->smsParams = collect([...RequisitesFieldsEnum::cases(), ...SmsTemplateVariables::cases()])->map(
            function ($item) {
                return "<b>{" . $item->value . "}</b> - " . $item->getLabel();
            }
        )->join(', ');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smsTemplates = SmsTemplate::all();
        return view('admin.sms-templates.index', compact('smsTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sms-templates.create', [
            'smsParams' => $this->smsParams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SmsTemplateRequest $request)
    {
        $validatedData = $request->validated();

        $smsTemplate = SmsTemplate::create($validatedData);
        $smsTemplate->addTranslations($validatedData);

        return redirect()->route('admin.sms-templates.index')
            ->with('success', 'Sms template created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SmsTemplate $smsTemplate)
    {
        return view('admin.sms-templates.show', compact('smsTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SmsTemplate $smsTemplate)
    {
        return view('admin.sms-templates.edit', [
            'smsParams' => $this->smsParams,
            'smsTemplate' => $smsTemplate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SmsTemplateRequest $request, SmsTemplate $smsTemplate)
    {
        $validatedData = $request->validated();

        $smsTemplate->update($validatedData);
        $smsTemplate->addTranslations($validatedData);

        return redirect()->route('admin.sms-templates.index')
            ->with('success', 'Sms template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SmsTemplate $smsTemplate)
    {
        $smsTemplate->delete();

        return redirect()->route('admin.sms-templates.index')
            ->with('success', 'Sms template deleted successfully.');
    }
}
