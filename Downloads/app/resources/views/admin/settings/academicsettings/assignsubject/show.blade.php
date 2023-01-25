<div id="header-footer-modal-preview-TEST" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="font-bold text-white	 mr-auto">Assign Subject</h2>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                @include('helper.show.show',
                ['label'=> 'ID',
                'divid' => '',
                'valueid'=> 'show_uniqid'])

                @include('helper.show.show',
                ['label'=> 'NAME',
                'divid' => '',
                'valueid'=> 'show_name'])

                @include('helper.show.show',
                ['label'=> 'CREATED BY',
                'divid' => '',
                'valueid'=> 'show_created_by'])

                @include('helper.show.show',
                ['label'=> 'CREATED AT',
                'divid' => '',
                'valueid'=> 'show_created_at'])

                @include('helper.show.show',
                ['label'=> 'UPDATED BY',
                'divid' => 'updated_by',
                'valueid'=>
                'show_updated_by'])

                @include('helper.show.show',
                ['label'=> 'UPDATED AT',
                'divid' => 'updated_at',
                'valueid'=>'show_updated_at'])

            </div>
            <div class="modal-footer text-right">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
            </div>
        </div>
    </div>
</div>
