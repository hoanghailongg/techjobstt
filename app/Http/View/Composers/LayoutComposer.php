<?php

namespace App\Http\View\Composers;

use App\Models\Admin;
use App\Models\City;
use App\Models\Company;
use App\Models\Job;
use App\Models\Language;
use App\Models\Post;
use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view)
    {

        // get list company
        $dataCompany = Company::active()->limit(8)->get();
        // get random 3 posts
        $dataPost = Post::latest()->limit(3)->get();
        // get all jobs
        $dataJob = Job::active()->limit(16)->get();
        // get attractive job
        $attractiveJob = Job::active()->orderBy('count')->limit(16)->get();
        // get high-paying job
        $highPayingJob = Job::active()->orderBy('salary_end')->limit(16)->get();
        // get cities
        $dataCities = City::all();
        // get languages
        $dataLanguages = Language::pluck('name', 'id')->toArray();
        // array id admin
        $adminArr = Admin::pluck('id')->toArray();

        $view->with([
            'jobComposer' => $dataJob,
            'highPayJobComposer' => $highPayingJob,
            'attractiveJobComposer' => $attractiveJob,
            'postComposer' => $dataPost,
            'companyComposer' => $dataCompany,
            'citiesComposer' => $dataCities,
            'languagesComposer' => $dataLanguages,
            'adminArr' => $adminArr
        ]);
    }
}
