<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="font-bold text-white text-lg mr-auto mx-auto">Earnings</p>
            </div>
            <div class="modal-body gap-4 gap-y-3">
                <table class="table">
                    <tbody>
                        @foreach ($show_earings as $earningskey => $earningvalue)
                        <tr>
                            <td class="text-sm">
                                {{$earningvalue['name']}}
                            </td>
                            <td class="text-primary font-semibold text-sm">
                                {{$earningvalue['value']}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>