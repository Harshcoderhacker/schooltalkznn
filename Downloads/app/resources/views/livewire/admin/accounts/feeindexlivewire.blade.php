<div class="col-span-12">
    <div class="intro-y flex items-center h-10">
        <a href="#" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
        </a>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-2">
        <a href="{{ route('feedue') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5 rounded-lg bg-primary">
                    <div class="flex flex-row text-white">
                        <div class="text-lg mt-auto mb-auto">
                            <span class="font-light">Fee Due</span><br>
                            <span class="font-bold mt-4">Rs.
                                {{ round($feeassignstudent->sum('due_amount'), 2) }}</span>
                        </div>
                        <span class="ml-auto mt-auto mb-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="105" height="97" viewBox="0 0 105 97">
                                <image id="Fee_Icon_White-02" data-name="Fee Icon_White-02" width="105" height="97"
                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALwAAAC0CAYAAAAuGkbGAAAACXBIWXMAAAsSAAALEgHS3X78AAAMzElEQVR4nO2d4ZHjNhKF4Sv/H14EK0cw3AhOjmB0EYwcweoiWG0EOxuBNRFYE4GlCE6KwFIEliLQFasaVX0oEAQIkATY76tCrb07IjnUY7PR3Wj89Hg8FABS+Ae+aSAJCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSh+xtedHZVSqqaLutAAiYDgp2ehlFqy8clyRR9Kqb1Saift5qQGW89Pw4oJ/DngCs70WVj9nkDw41CTuBux/ivyjHel1JosPggEgh8G7qY0In8a4CzflFLbHH7ZkoDg01AZfniImxLDkR6oW6b3JTsg+P7UzBePdVMUibdxUw5KqRP93YLcl6+Oz13pOk6OnwEEBO/PgrkoywRuypnEffDwx5f0M65z/kcp9RZ5TbMHgm+nMgRuCxeGcGUCP/SItFQketfb5F0ptYGL0w4E///wiWYKP/yDCTyVy9FY8S+Ofz+TGwQXx4J0wdfGZDOVm6J98aFYURKq7XoRumxBmuArI+mT0k3Zj+xK1CR615voB7k4gJAg+L5ZTRt3Q+BTZzwrcnFeHT9zpt9dvF+vZir41OHCM3NRhnRTYmjcl98dn7/TPcn1+kdjDoJfGFY81g+/GgIvxTLWdN0uN0186LJEwaf2w+/GRLPkwiyf0OUHvRFEujilCD6lH65asppzYovsrJ1cBc+Lr1wTMl9CsppzoSs7e6cIjqga+1wEr+Ph9QzChTmxoN/f9VZ8JxdHBGMLfk1fgiJhV4lclNzChbmx8whdilhYMqbgD4nChJojEzjS6N00xuZNenZ2LME3rsp/I48h0Q9PjU92dtYLS8YSfOO+/NnjczqaAjclHRWJ/sVxxNkuLMlJ8FdyTQ7sTzAcTYTme8f3MbvQ5dSC/40s9wm1HpMgbmHJ1IL/aYyTAyeiFpag1R64kUH64bgTr+Ri1qXfLQgeaBoL/m8KT9p4JtGvSr5jcGnyh1eDVuxqT+Rbp45ezXphCQSfH5WxtrarzGKIuLnPwpIiQ5cQfB7EtuIbauH27BaWQPDTwGv6U7Xiu5OlTx1CnNXCEgh+PPTSw1QtQNo4kmVO6dvPZmEJBD8cKa04rwa90ITRJb6hCsG6FpZk3xMHgk9LSivetXi8S3xqIKvr0xMn24UlEHwcKftN3pnAfRet+IQQh5hYFruwBIIPhws81or3XVurHzT9p09kp4mdbxNb++IWlkDwflQklnWkFb8aHRJCxLcgVyHmQRuiAtJnYUk+octG8COM5cPOWOePGdXj8Ti1XL8Ph8fjsXk8HnXPa1jSMVKyTXyPmt/t0nF9qc/Za8DCu6nIMoVY1BgrzlnSW6XLXTnTOXiJdd2xwEMNEFHxWVgyfbweFt453jyt6p6s+CLRG8V13gv9+4p+tu04zb/fPK59k/iebTrO1/dNl2RA8O2jdnxpJya61Odscw0OPc638HSHDokeVv59tz1sBwg+z7FruebUFlGPtUMgy8hjbzys/Y2uIdXv45r7pHy4IPhEwyaQ/UDn2o4gwObt4TP53ne4SiFj0XKOoYxG55h6AYhZ450LdUuYbYga8J0lY3pmSaVUNJPTmsqJXbxQ3DzFQo8LJaBMJltEMrXgm8jN33RjdhmtprE9hNcBEigbS+LmnYQ5VLKmifx8poeqjeZh/4MiKrEGKavS4VyW+H2iL/4PCq1tWUu+XEgtwLWlTUZsOt7cs6qNk8c6VkWbp506jtWF7b5NtzZ2RP+pD28J/cmQYZtzXBL70+YcYRd5PFt0x2cesPRIGj0iEkcry7Emi9SMaeGPPT7zhZXDjoktWfQpoWUyqw0/Ii37jq7vTvf5SP/95OGW6G4EHx3n+ErWPvTNG/N2SM/IT9ianu5Dj3R96lhx1xgqSmNGZE4J3mIabs35W8Q3rOmTrLoFHK9qOd7bVBZ+kpMaY0k3wOe1ehsg2dM22uLwMa6HLUy3p4dgFfFAP1rcBP1whcTxK89klY+L03YPJ8u25rYDiG/9yBi11s2r+6+WfzuSGxE6kd141rhsPVYr6RVVG6r1OVrcB71IRF9vSJhzQ593VYe2dS5w1dVcJw1ITPWkdQyfidRpBBfHt5ZmCNreJBVZV+4q3FrcBDN7ewl8Qy48XE997i2NfYdbNNYb2jpyFbwetgykebNj0+6uEVsaHIspelOAO0/3YGW4KaFuWaoHP8YdFCF45VlrPWSqemrR699twSznqacfzCeloaFBW3gxhBSTcxGC16Lbd9zclDUgtmG6EWNxMyaSscLh0ZvQ2HrbJLSLyS27HqVtTDx1E/+KJsspSyDa6nY4R5rIX+nnY9el6i2IQieQK8qG+3KkiW825QUl7sTt08S/tH2KuhZDa35LVFBWsQhTaK3MhXUhu9L18OjQiX4mz22KCnFpzOETPTgNPKFNPXzyEK5z2koIlhb3h0fA+sx9TLdmcr88ZJTaH/5Cr2Vb6anmmaox9xkWotnosoau0oxNS15iScdds47Af5KFPvdcX2rmB/IqHeig9A0R1vSab2viryj58Rd9UTk38495KF3zmifqANyUYX+hv/sWURdk+uNF7Qoyhx1AdnTTu4rTXmjCxWvvc7H8W48+8C5f+9rx2TP9zDvVwsfMb27G+Yqy8D9ncA0puNCN90mH69p7PUm8T9z8c+EhdkUuWtUSoVl1vL2eSfSnRBNJPnHNccVaKyVGabrw2b2iJHTn4Jce0SdtBGom0Dvdnxgr/8bcI1VSy8Q5bmp2I9/+l45JbSm8scnlJtANOzDX7Ve6H09UUHaIsM7Fbl855138Lkz43zz83Bw5s8SNFuu+p1CbY6xJ+HdKZInb7VzCtpUXtkb2M4m/z+qrsTHLfTf0ADxHdhU40L240rFKStBFM0cfPoSFMXzx3Sq/7ggZ2rgabgzHrDM/0//3yWrq8oI73YMQN8XcjKEYH1664IfGbCL73iHMtt0+TNaWUKZtAcii43y6pCG0ZKFYwc8lLFkKu0i/eUFiW7JNFGpHRGrNNm+wWfADfbb4LeV9wdbzw2LG92OSNFs63ivLJXz3eICeHV0ftPUPFTz/PVwNnbIDgh8W06r2zezqdnxP1Dzpn9RrXXVsHKxJbcH571FUiBKCHx4eEeojPO2yXCmkuCGRvZHv7UPXWyBkwlsZc4eiQpsQ/PBwt+a5Rwxdhw03FnHtKNTqyjEcHVWROrQZInjTLct2T1YbEPzwxPrxWuRtbUlObMMzE3NxhokWfMgGxhA8cGKKKTRhtKdY+UtHy0Gb8FyWW4c1j4Gi5dc/REflQYHgh+dmRDJWgW7NhVn374kyo2sWRw8tRuP+e+qt7QcHgh8HntR56mnl9QT1a0Q9jaK3hI7sfAucdJpuVZbby7tApnUcKlpxpOnbbo4vYL+zEgSf0GAj1g3bgjO01NhsPXguMmFV0gLcwoe5+Lnv/k2V5VgHxyJus/Xdpefi9lTXP+mAhR8P00LGNhWtyWKvyOK7mqmqng1VNamvfTLgw4+HucHXp8gJ6Il1I+jiV3oY+vrc5ueKLSmGhR8XWwvuzwli2fpL5FWPNU1In0jwfTOiZre3Yq27guAnwSytPTuqGX05sJ76upShZpPb0Hp3DX9oNDEPz+RA8NNwYtESlWCDhwVFb56Nv4/ptVmRsPkxf0yw31ZSIPhpsFnOFLuaLJi7cYnIgtrEnuJNNDkQ/HSsLaW9Y2zl04VN7HcSe1F1MzYQpZmOHatp17xOnL20iV0N3IJ8VCD4aXmz9M55JXGN3dGrtswtFEV+ZtPOA4KfnrVlC/jYVhyhbKmDgdnyL1U/+myAD58PNp9eUZhxM5BLsaK3jCn02fjsJhB8XtQUXrQ1V/0gcaZwL8xCMs6ZHoSi6tx9geDzo6sZ7JUein2A+Cuy2CtWe2OjtK2CgoHg82VJwrdZYc6ZYuOm+Ct6Y/i04/4giz9Lq86B4PNnTaNrO/4+vCdoDlUUEHw51KyTmM8GCm3E9KMsHgi+TGpjtLkt3N1pIi6pdgApFggeiAKJJyAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAKCB6IAoIHooDggSggeCAHpdT/AJ9RQ0XKro5BAAAAAElFTkSuQmCC" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('feecollected') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5 rounded-lg bg-primary">
                    <div class="flex flex-row text-white">
                        <div class="text-lg mt-auto mb-auto">
                            <span class="font-light">Fee Collected</span><br>
                            <span class="font-bold mt-4">Rs.
                                {{ round($feestudentpayment->sum('total_paid_amount'), 2) }}</span>
                        </div>
                        <span class="ml-auto mt-auto mb-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="105" height="97" viewBox="0 0 105 97">
                                <image id="Fee_Icon_White-04" data-name="Fee Icon_White-04" width="105" height="97"
                                    xlink:href="data:image/png;base64,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" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('feewaived') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5 rounded-lg bg-primary">
                    <div class="flex flex-row text-white">
                        <div class="text-lg mt-auto mb-auto">
                            <span class="font-light">Fee Waived</span> <br>
                            <span class="font-bold mt-4">Rs.
                                {{ round($feestudentpayment->sum('discount_amount'), 2) }}</span>
                        </div>
                        <span class="ml-auto mt-auto mb-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="105" height="97" viewBox="0 0 105 97">
                                <defs>
                                    <pattern id="pattern" preserveAspectRatio="none" width="100%" height="100%"
                                        viewBox="0 0 192 183">
                                        <image width="192" height="183"
                                            xlink:href="data:image/png;base64,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" />
                                    </pattern>
                                </defs>
                                <rect id="Fee_Icon_White-03" data-name="Fee Icon_White-03" width="115" height="110"
                                    fill="url(#pattern)" />
                            </svg>

                        </span>
                    </div>
                </div>
            </div>
        </a>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            {{-- <a type="button" class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8">Accounts</a> --}}
            <a href="{{ route('createadminfeeindex') }}" type="button"
                class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8">View/Edit
                Fee Data</a>
            <button wire:click="opensetremindermodal" type="button"
                class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8">Set
                Reminders</button>
        </div>
    </div>

    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Fee Data</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-11/12 mx-auto">
            <div class="col-span-12 sm:col-span-4 intro-y">
                <select wire:model="classmasterid" class="form-select w-full mt-5">
                    <option value="0">Select Class </option>
                    @foreach ($classmaster as $eachclassmaster)
                        <option value="{{ $eachclassmaster->id }}">
                            {{ $eachclassmaster->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-4 intro-y">
                <select wire:model="sectionid" class="form-select w-full mt-5">
                    <option value="0">Select Section </option>
                    @foreach ($section as $eachsection)
                        <option value="{{ $eachsection->id }}">
                            {{ $eachsection->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="intro-y col-span-12 sm:col-span-4 flex flex-wrap sm:flex-nowrap items-center mt-5 w-full">
                <div class="mt-3 sm:mt-0">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <input wire:model="searchTerm" type="text" class="form-control pr-10 placeholder-theme-13"
                            placeholder="Search...">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($studentlist->isNotEmpty())
        <div class="flex flex-col mt-8 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        <div class="flex">
                                            Student Name
                                            @include('helper.datatable.sorting', [
                                                'method' => 'sortBy',
                                                'value' => 'name',
                                            ])
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Class
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Section
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Admission Number
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Phone
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Paid Fee
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Due Fee
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Collect Data
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentlist as $index => $eachstudent)
                                    <tr class="intro-x">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudent->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudent->classmaster->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudent->section->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudent->addmission_number }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                +91 {{ $eachstudent->phone_no }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                Rs.
                                                {{ round($eachstudent->feeassignstudent->sum('total_paid_amount'), 2) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                Rs.
                                                {{ round($eachstudent->feeassignstudent->sum('due_amount'), 2) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('feestudentinfo', $eachstudent->id) }}"
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                                style="color:rgb(0, 221, 0)">
                                                View Data
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('helper.datatable.pagination', [
                'pagination' => $studentlist,
            ])
        </div>
    @else
        @include('helper.datatable.norecordfound')
    @endif
    @if ($showsetremindermodal)
        <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
            style="z-index:52;">
            <div type="button" wire:click="clossetreminderemodal" class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative md:w-2/5 w-full">
                <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                    <div
                        class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-lg font-medium text-white">
                            Fee Reminder
                        </h3>
                        <button type="button" wire:click="clossetreminderemodal"
                            class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto h-5/6">
                        <form wire:submit.prevent="setreminder">
                            @foreach ($feereminderlist as $eachfeereminderlist)
                                @if ($eachfeereminderlist->feeassignstudent->sum('due_amount') != 0 && $eachfeereminderlist->feeassignstudent->count() != 0)
                                    <div class="grid grid-cols-12 gap-4 my-3">
                                        <div class="col-span-2 place-self-center">
                                            <input type="checkbox" value="{{ $eachfeereminderlist->id }}"
                                                wire:model="selected_feemaster"
                                                class="form-control h-5 w-5 shadow ml-6">
                                        </div>
                                        <div class="col-span-10 bg-gray-200 dark:bg-darkmode-600 rounded-lg px-6 py-3">
                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-5">
                                                    <div class="font-bold p-1">{{ $eachfeereminderlist->name }}
                                                    </div>
                                                    <div class="p-1">
                                                        {{ $eachfeereminderlist->classmaster->name }}
                                                        -
                                                        {{ $sectionlist->whereIn('id', $eachfeereminderlist->section)->pluck('name')->implode(', ') }}
                                                    </div>
                                                </div>
                                                <div class="col-span-7 text-gray-600 dark:text-gray-300">
                                                    <div class="float-right">
                                                        <div class="p-1">Rs.
                                                            {{ round($eachfeereminderlist->feeassignstudent->sum('due_amount'), 2) }}
                                                            pending({{ $eachfeereminderlist->feeassignstudent->count() }}
                                                            students)
                                                        </div>
                                                        <div class="text-danger dark:font-bold p-1">Due Date:
                                                            {{ $eachfeereminderlist->due_date }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if ($selected_feemaster)
                                <div class="my-10 text-center">
                                    <button type="submit" class="btn btn-primary">Send Notification Reminder</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
