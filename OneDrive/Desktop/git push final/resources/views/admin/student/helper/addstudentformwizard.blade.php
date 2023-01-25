<div class="wizard w-full mx-0 flex flex-col lg:flex-row justify-center px-5 sm:px-20 mt-8 sm:mx-auto sm:w-3/5 2xl:w-2/5">
    <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
        <button class="w-10 h-10 rounded-full btn {{ $active == 'personal' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">1</button>
        <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'personal' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Personal</div>
    </div>
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <button class="w-10 h-10 rounded-full btn {{ $active == 'parents' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}" {{ $studentid != null ? '' : 'disabled' }}>2</button>
        <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'parents' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Parents</div>
    </div>
    <!-- <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <button
            class="w-10 h-10 rounded-full btn {{ $active == 'transport' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}"
            {{ $studentid != null ? '' : 'disabled' }}>3</button>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'transport' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Transport</div>
    </div> -->
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <button class="w-10 h-10 rounded-full btn {{ $active == 'documents' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}" {{ $studentid != null ? '' : 'disabled' }}>3</button>
        <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'documents' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Documents</div>
    </div>
    <div class="wizard__line hidden lg:block w-96 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
</div>