<div
    class="wizard w-full mx-0 flex flex-col lg:flex-row justify-center px-5 sm:px-20 mt-8 sm:mx-auto sm:w-3/5 2xl:w-2/5">
    <div class="intro-x lg:text-center flex  items-center lg:block flex-1 z-10">
        <div
            class="w-10 h-10 rounded-full cursor-default btn {{ $active == 'createfee' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">
            1</div>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'createfee' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Create Fee</div>
    </div>
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <div
            class="w-10 h-10 rounded-full cursor-default btn {{ $active == 'addparticulars' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">
            2</div>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'addparticulars' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Add Particulars</div>
    </div>
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <div
            class="w-10 h-10 rounded-full cursor-default btn {{ $active == 'assignfee' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">
            3</div>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'assignfee' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Assign Fee</div>
    </div>
    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <div
            class="w-10 h-10 rounded-full cursor-default btn {{ $active == 'feeconfirmation' ? 'btn btn-primary' : 'text-gray-600 bg-gray-200 dark:bg-dark-1' }}">
            4</div>
        <div
            class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto  {{ $active == 'feeconfirmation' ? 'font-medium' : 'text-base text-gray-700 dark:text-gray-500 disable' }}">
            Fee Confirmation</div>
    </div>
    <div class="wizard__line hidden lg:block w-96 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
</div>
