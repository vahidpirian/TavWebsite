<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CompanyStatisticRequest;
use App\Models\Content\CompanyStatistic;
use Illuminate\Http\Request;

class CompanyStatisticController extends Controller
{
    public function index()
    {
        $statistics = CompanyStatistic::all();
        return view('admin.content.company-statistic.index', compact('statistics'));
    }

    public function create()
    {
        if(CompanyStatistic::count() >= 4) {
            return redirect()->route('admin.content.company-statistic.index')
                ->with('swal-error', 'حداکثر تعداد آمار مجاز 4 عدد می‌باشد');
        }
        return view('admin.content.company-statistic.create');
    }

    public function store(CompanyStatisticRequest $request)
    {
        $inputs = $request->all();

        if(CompanyStatistic::count() >= 4) {
            return redirect()->back()
                ->withInput()
                ->with('swal-error', 'حداکثر تعداد آمار مجاز 4 عدد می‌باشد');
        }

        CompanyStatistic::create($inputs);

        return redirect()->route('admin.content.company-statistic.index')
            ->with('swal-success', 'آمار جدید با موفقیت ثبت شد');
    }

    public function edit(CompanyStatistic $companyStatistic)
    {
        return view('admin.content.company-statistic.edit', compact('companyStatistic'));
    }

    public function update(CompanyStatisticRequest $request, CompanyStatistic $companyStatistic)
    {
        $inputs = $request->all();

        $companyStatistic->update($inputs);

        return redirect()->route('admin.content.company-statistic.index')
            ->with('swal-success', 'آمار با موفقیت ویرایش شد');
    }

    public function destroy(CompanyStatistic $companyStatistic)
    {
        $companyStatistic->delete();

        return redirect()->route('admin.content.company-statistic.index')
            ->with('swal-success', 'آمار با موفقیت حذف شد');
    }
}
