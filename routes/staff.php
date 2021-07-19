<?php
use Illuminate\Support\Facades\Route;

Route::get('jobs/{jobId}/applications', 'JobApplicationController@index')->name('job-applications');
Route::group(['middleware' => ['auth', 'role:Moderator', 'xss', 'verified.user']], function () {
    // Companies
    Route::get('companies/verify', 'CompanyController@verify')->name('staff.company.verify');
    Route::post('companies/verify/{id}', 'CompanyController@verifySave')->name('staff.company.verify.save');
    Route::post('companies/verify/{id}/revoke', 'CompanyController@verifyRevoke')->name('staff.company.verify.revoke');
    Route::post('companies/reject/{id}', 'CompanyController@verificationReject')->name('staff.company.verification.reject');
    Route::get('companies/{company}/edit', 'CompanyController@edit')->name('staff.company.edit');
    Route::put('companies/{company}', 'CompanyController@update')->name('staff.company.update');
    Route::delete('companies/{company}', 'CompanyController@destroy')->name('staff.company.destroy');
    Route::post('companies/{company}/change-is-active', 'CompanyController@changeIsActive');
    Route::post('companies/{company}/mark-as-featured',
        'CompanyController@markAsFeatured')->name('staff.mark-as-featured');
    Route::post('companies/{company}/mark-as-unfeatured',
        'CompanyController@markAsUnFeatured')->name('staff.mark-as-featured');

    // Jobs
    Route::delete('jobs/{job}', 'JobController@delete')->name('staff.jobs.destroy');
    Route::post('jobs/{job}/change-is-suspend', 'JobController@changeIsSuspended');
    Route::post('jobs/{job}/make-job-featured', 'JobController@makeFeatured');
    Route::post('jobs/{job}/make-job-unfeatured', 'JobController@makeUnFeatured');

    // Candidate Routes
    Route::delete('candidates/{candidate}', 'CandidateController@destroy')->name('staff.candidates.destroy');
    Route::post('candidates/{id}/change-status', 'CandidateController@changeStatus');

    // Post Routes
    Route::get('posts', 'PostController@index')->name('staff.posts.index');
    Route::get('posts/create', 'PostController@create')->name('staff.posts.create');
    Route::post('posts', 'PostController@store')->name('staff.posts.store');
    Route::get('posts/{post}', 'PostController@show')->name('staff.posts.show');
    Route::get('posts/{post}/edit', 'PostController@edit')->name('staff.posts.edit');
    Route::put('posts/{post}', 'PostController@update')->name('staff.posts.update');
    Route::delete('posts/{post}', 'PostController@destroy')->name('staff.posts.destroy');

    // Reported Job Listing
    Route::get('reported-jobs', 'JobController@showReportedJobs')->name('staff.reported.jobs');
    Route::get('reported-jobs/{reportedJob}', 'JobController@showReportedJobNote')->name('staff.reported.jobs.show');
    Route::delete('reported-jobs/{reportedJob}', 'JobController@deleteReportedJobs')->name('staff.delete.reported.jobs');

    //Reported company
    Route::get('reported-company', 'CompanyController@showReportedCompanies')->name('staff.reported.companies');
    Route::get('reported-company/{reportedToCompany}',
        'CompanyController@showReportedCompanyNote')->name('staff.reported.companies.show');
    Route::delete('reported-company/{reportedToCompany}',
        'CompanyController@deleteReportedCompany')->name('staff.delete.reported.company');

    //Reported candidate
    Route::get('reported-candidate', 'CandidateController@showReportedCandidates')->name('staff.reported.candidates');
    Route::get('reported-candidate/{reportedToCandidate}',
        'CandidateController@showReportedCandiateNote')->name('staff.reported.candidates.show');
    Route::delete('reported-candidate/{reportedToCandidate}',
        'CandidateController@deleteReportedCandidate')->name('staff.delete.reported.candidate');

    // Job Category routes
    Route::get('job-categories', 'JobCategoryController@index')->name('staff.job-categories.index');
    Route::post('job-categories', 'JobCategoryController@store')->name('staff.job-categories.store');
    Route::get('job-categories/{jobCategory}/edit', 'JobCategoryController@edit')->name('staff.job-categories.edit');
    Route::get('job-categories/{jobCategory}', 'JobCategoryController@show')->name('staff.job-categories.show');
    Route::put('job-categories/{jobCategory}', 'JobCategoryController@update')->name('staff.job-categories.update');
    Route::delete('job-categories/{jobCategory}', 'JobCategoryController@destroy')->name('staff.job-categories.destroy');
    Route::post('job-categories/{jobCategory}/change-status', 'JobCategoryController@changeStatus');

    // Post Category Routes
    Route::get('post-categories', 'PostCategoryController@index')->name('staff.post-categories.index');
    Route::post('post-categories', 'PostCategoryController@store')->name('staff.post-categories.store');
    Route::get('post-categories/{postCategory}', 'PostCategoryController@show')->name('staff.post-categories.show');
    Route::get('post-categories/{postCategory}/edit', 'PostCategoryController@edit')->name('staff.post-categories.edit');
    Route::put('post-categories/{postCategory}', 'PostCategoryController@update')->name('staff.post-categories.update');
    Route::delete('post-categories/{postCategory}', 'PostCategoryController@destroy')->name('staff.post-categories.destroy');

});

Route::group(['middleware' => ['auth', 'role:Moderator|Recruiter', 'xss', 'verified.user']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('staff.dashboard');

    // Companies
    Route::get('/companies', 'CompanyController@index')->name('staff.company.index');

    // jobs route
    Route::get('jobs', 'JobController@getJobs')->name('staff.jobs.index');
    Route::get('jobs/create', 'JobController@createJob')->name('staff.job.create');
    Route::post('jobs', 'JobController@storeJob')->name('staff.job.store');
    Route::get('jobs/{job}/edit', 'JobController@editJob')->name('staff.job.edit');
    Route::put('jobs/{job}', 'JobController@updateJob')->name('staff.job.update');
    Route::get('jobs/{job}', 'JobController@showJobs')->name('staff.jobs.show');

    // candidate routes
    Route::get('candidates', 'CandidateController@index')->name('staff.candidates.index');
    Route::get('candidates/{candidate}/edit', 'CandidateController@edit')->name('staff.candidates.edit');
    Route::get('candidates/{candidate}', 'CandidateController@show')->name('staff.candidates.show');
    Route::put('candidates/{candidate}', 'CandidateController@update')->name('staff.candidates.update');

    // plans routes
    Route::get('plans', 'PlanController@index')->name('staff.plans.index');
});

Route::group(['middleware' => ['auth', 'role:Moderator|Admin', 'xss', 'verified.user']], function () {
    Route::get('jobs/{jobId}/applications', 'JobApplicationController@index')->name('staff.job-applications');
});
