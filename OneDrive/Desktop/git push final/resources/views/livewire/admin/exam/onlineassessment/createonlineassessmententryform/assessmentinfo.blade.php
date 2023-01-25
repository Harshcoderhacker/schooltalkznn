<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4">
    @include('admin.exam.assessment.helper.createassessmentformwizard', ['active' => 'onlineassement'])
    <div class="mx-auto w-full sm:w-5/6">
        <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-12">
                    <label for="input-wizard-1" class="form-label font-semibold">Exam Name</label>
                    <input id="input-wizard-1" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Class Name</label>
                    <input id="input-wizard-2" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Section</label>
                    <input id="input-wizard-3" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Subject</label>
                    <input id="input-wizard-2" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Question Group</label>
                    <input id="input-wizard-3" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <a href="{{ route('adminexam') }}" class="btn btn-danger w-24">Cancel</a>
                    <a href="{{ route('assessmentexamschedule') }}" class="btn btn-primary w-24 ml-2">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>