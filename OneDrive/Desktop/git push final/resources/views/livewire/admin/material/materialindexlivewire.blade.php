<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        @if ($platform != 'student')
            <div class="col-span-3">
                <select wire:model="classmaster_id" class="form-select w-full">
                    @foreach ($classmaster as $eachclassmaster)
                        @if ($platform == 'admin')
                            <option value="{{ $eachclassmaster->id }}">{{ $eachclassmaster->name }}</option>
                        @elseif($platform == 'staff')
                            <option value="{{ $eachclassmaster->classmaster->id }}">
                                {{ $eachclassmaster->classmaster->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-span-12 gap-6 mt-8 grid grid-cols-12">
            <div class="col-span-12 lg:col-span-2">
                <div class="flex justify-center items-center">
                    <h2 class="intro-y text-lg font-medium mr-auto mt-2">Materials</h2>
                    <div wire:loading class="ml-auto">
                        @include('helper.loadingicon.loadingicon')
                    </div>
                </div>
                @include('helper.material.materialsidenav')
            </div>
            <div class="col-span-12 lg:col-span-10">

                <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
                    @if ($materialselected)
                        <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700 dark:text-gray-300">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <input type="text" wire:model="searchTerm"
                                class="form-control w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-13"
                                placeholder="Search files">
                        </div>
                    @endif
                    <div class="w-full sm:w-auto flex ml-auto">
                        @if ($materialselected)
                            <button wire:click="backfrommateriallist"
                                class="btn bg-black text-white shadow-md mr-2">Back</button>
                        @endif
                        @if ($platform != 'student')
                            <button wire:click="uploadmaterial" class="btn btn-primary shadow-md mr-2">Upload New
                                Files</button>
                        @endif
                    </div>
                </div>
                {{-- Material List --}}
                @if ($materialselected)
                    @if (count($materilist) > 0)
                        <div class="intro-y grid grid-cols-12 gap-3 lg:gap-6 mt-5">
                            @foreach ($materilist as $eachmateriallist)
                                <div class="intro-y col-span-6 lg:col-span-3">
                                    <div class="zoom-in">
                                        <div class="file box rounded-md pt-8 pb-5 px-3 sm:px-5 relative">
                                            @if ($eachmateriallist->document_type == 'pdf')
                                                <img alt="pdf" class="w-16 mx-auto"
                                                    src="{{ asset('image/material/pdf.png') }}">
                                            @elseif ($eachmateriallist->document_type == 'doc')
                                                <img alt="doc" class="w-16 mx-auto"
                                                    src="{{ asset('image/material/doc.png') }}">
                                            @elseif ($eachmateriallist->document_type == 'docx')
                                                <img alt="docx" class="w-16 mx-auto"
                                                    src="{{ asset('image/material/docx.png') }}">
                                            @elseif ($eachmateriallist->document_type == 'jpg')
                                                <img alt="jpg" class="w-16 mx-auto"
                                                    src="{{ asset('image/material/jpg.png') }}">
                                            @elseif ($eachmateriallist->document_type == 'png')
                                                <img alt="png" class="w-16 mx-auto"
                                                    src="{{ asset('image/material/png.png') }}">
                                            @elseif ($eachmateriallist->document_type == 'ppt')
                                                <img alt="ppt" class="w-16 mx-auto"
                                                    src="{{ asset('image/material/ppt.png') }}">
                                            @else
                                                <p class="w-16 file__icon file__icon--empty-directory mx-auto"></p>
                                            @endif
                                            <p class="block font-medium mt-4 text-center truncate">
                                                {{ $eachmateriallist->title }}</p>
                                            <p class="block font-medium text-center truncate">
                                                {{ $eachmateriallist->created_at->diffForhumans() }}</p>
                                            @if ($platform != 'student')
                                                <div class="absolute top-0 right-0 mr-2 mt-3 dropdown ml-auto">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false" data-tw-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-more-vertical w-5 h-5 text-slate-500">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="12" cy="5" r="1"></circle>
                                                            <circle cx="12" cy="19" r="1"></circle>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu w-40">
                                                        <ul class="dropdown-content">
                                                            <li>
                                                                <button data-tw-dismiss="dropdown"
                                                                    wire:click="deleteconfirmation({{ $eachmateriallist->id }})"
                                                                    class="dropdown-item w-full">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2 w-4 h-4 mr-2 text-danger">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg>
                                                                    Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <button wire:click="downloadmaterial('{{ $eachmateriallist->id }}')"
                                            class="bg-primary p-2 text-white flex gap-2 justify-center items-center w-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-download w-4 h-4">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="7 10 12 15 17 10"></polyline>
                                                <line x1="12" y1="15" x2="12" y2="3"></line>
                                            </svg>
                                            <span class="font-bold">Download</span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @include('helper.datatable.pagination', [
                            'pagination' => $materilist,
                        ])
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
                @else
                    {{-- Material --}}
                    @if ($materials->isNotEmpty())
                        <div class="intro-y grid grid-cols-12 gap-3 lg:gap-6 mt-5">
                            @foreach ($materials as $eachmaterial)
                                <button class="intro-y col-span-6 lg:col-span-3" type="button"
                                    wire:click="selecthisdoc('{{ $eachmaterial->id }}')">
                                    <div class="file box rounded-md pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                        <img alt="folder" class="w-16 mx-auto"
                                            src="{{ asset('image/material/folder.png') }}">
                                        <p class="block font-medium mt-4 text-center truncate">
                                            {{ $eachmaterial->subject ? $eachmaterial->subject->name : 'Other Document' }}
                                        </p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
                @endif
            </div>
        </div>
    </div>
    @if ($createmodal)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-3/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Upload Material
                    </h3>
                    <button wire:click="closecreatemodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="createmateriallist">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label for="title" class="form-label font-medium">Title</label>
                                <input autocomplete="off" wire:model.lazy="title" name="title" id="title" type="text"
                                    class="form-control">
                                @error('title')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium" for="creatematerial_type">Material Type</label>
                                <select name="creatematerial_type" wire:model.lazy="creatematerial_type"
                                    id="creatematerial_type" class="form-select">
                                    <option>Select A Material Type</option>
                                    @foreach (config('archive.material_type') as $key => $value)
                                        <option value={{ $key }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('creatematerial_type')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Class</label>
                                <select wire:model="createclassmaster_id" class="form-select w-full">
                                    <option>Select a Class</option>
                                    @foreach ($createclassmasterlist as $eachclassmaster)
                                        @if ($platform == 'admin')
                                            <option value="{{ $eachclassmaster->id }}">
                                                {{ $eachclassmaster->name }}</option>
                                        @elseif($platform == 'staff')
                                            <option value="{{ $eachclassmaster->classmaster->id }}">
                                                {{ $eachclassmaster->classmaster->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('createclassmaster_id')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            @if($creatematerial_type!=3)
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Subject</label>
                                <select wire:model="subject_id" class="form-select w-full">
                                    <option>Select a Subject</option>
                                    @foreach ($subjectlist as $eachsubject)
                                        @if ($platform == 'admin')
                                            <option value="{{ $eachsubject->id }}">{{ $eachsubject->name }}
                                            </option>
                                        @elseif($platform == 'staff')
                                            <option value="{{ $eachclassmaster->subject->id }}">
                                                {{ $eachclassmaster->subject->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Document</label>
                                <input wire:model.lazy="document" type="file" id="document"
                                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                @error('document')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium" for="description">Description</label>
                                <textarea autocomplete="off" wire:model.lazy="description" name="description" id="description" type="text"
                                    class="form-control"></textarea>
                                @error('description')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="button" wire:click="closecreatemodal"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($deletemodal)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/12 shadow-2xl px-4 py-3 text-center">
                <h1 class="text-2xl"> Are you sure? </h1>
                <div class="text-xl"> Do you really want to delete this record?</div>
                <div class="text-lg"> This process cannot be Revoke.</div>
                <div class="flex gap-2 mt-4 justify-center">
                    <button type="button" wire:click="closedeletemodal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-1.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button wire:click="deletethismateriallist" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    @endif
</div>
