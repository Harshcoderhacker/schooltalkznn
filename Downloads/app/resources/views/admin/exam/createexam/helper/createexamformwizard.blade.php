<div
    class="wizard w-full mx-0 flex flex-col lg:flex-row justify-center px-5 sm:px-20 mt-8 sm:mx-auto sm:w-3/5 2xl:w-2/5">
    <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
        <a
            class="w-10 h-10 rounded-full btn {{ $active == 'configureclass' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">1</a>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'configureclass' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Configure Classes</div>
    </div>
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <a
            class="w-10 h-10 rounded-full btn {{ $active == 'subjectmarks' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">2</a>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'subjectmarks' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Enter Subject Marks</div>
    </div>
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <a
            class="w-10 h-10 rounded-full btn {{ $active == 'classexamschedule' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">3</a>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'classexamschedule' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Confirm Exam Schedule</div>
    </div>
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <a
            class="w-10 h-10 rounded-full btn {{ $active == 'examconfig' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">4</a>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'examconfig' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Exam Confirmation</div>
    </div>
    <div class="wizard__line hidden lg:block w-96 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
</div>
