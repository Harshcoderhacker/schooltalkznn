 @if ($nonparticipantmodel)
     <div class="fixed inset-0  z-50 transition-opacity">
         <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
     </div>
     <div
         class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
         <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-1/3 shadow-2xl">
             <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                 <h3 class="text-lg font-semibold text-white">
                     Non - Attendees List
                 </h3>
                 <button wire:click="closenonparticipantmodel"
                     class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                     data-modal-toggle="defaultModal">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd"
                             d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                             clip-rule="evenodd"></path>
                     </svg>
                 </button>
             </div>
             <div class="p-6 space-y-6">
                 <table>
                     <tr>
                         <th class="p-3">
                             S.No
                         </th>
                         <th class="p-3">
                             Student Name
                         </th>
                     </tr>
                     @php
                         $count = 1;
                     @endphp
                     @foreach ($onlineassessment->onlineassessmentstudentlist as $key => $eachstudent)
                         @if ($eachstudent->assessment_status == 0)
                             <tr>
                                 <td class="p-3">
                                     {{ $count }}
                                 </td>
                                 <td class="p-3">
                                     {{ $eachstudent->student->name }}
                                 </td>
                             </tr>
                             @php
                                 $count += 1;
                             @endphp
                         @endif
                     @endforeach
                 </table>
             </div>
             <div
                 class="flex justify-center items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                 <button class="btn btn-primary">Send Notification</button>
             </div>
         </div>
     </div>
 @endif
