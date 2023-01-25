<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4">
    @include('admin.exam.assessment.helper.createassessmentformwizard', ['active' => 'assessmentexamconfiguration'])
    <div class="mx-auto w-full sm:w-2/3">
        <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-1" class="form-label font-semibold">Examination: English Grammer
                        Exam</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-3">
                    <label for="input-wizard-2" class="form-label font-semibold">Class: I</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-3">
                    <label for="input-wizard-3" class="form-label font-semibold">Sections: A,B</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Subject: English</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Question Group: Lesson 1, Lesson
                        2</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-12">
                    <label for="input-wizard-3" class="form-label font-semibold text-green-700">Schedule Type: Always
                        Active</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Date: 23-11-2021</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Time: 12:00 PM</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Number of Questions: 8</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Marks: 16</label>
                </div>
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <a href="{{ route('adminexam') }}" class="btn btn-primary w-24 ml-2">Submit</a>
                </div>
            </div>
        </div>
    </div>
</div>