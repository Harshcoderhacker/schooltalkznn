<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="font-bold text-white mx-auto">Payroll Summary</h2>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label class="form-label font-semibold">Basic Salary</label><br>
                    <label class="form-label font-semibold text-primary">{{$basic_salary}}</label>
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Earnings</label><br>
                    <label class="form-label font-semibold text-primary">{{$total_earning}}</label>
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Deduction</label><br>
                    <label class="form-label font-semibold text-primary">{{$total_deducton}}</label>
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Gross Salary (Rs)</label><br>
                    <label class="form-label font-semibold text-primary">{{$gross_salary}}</label>
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Tax</label><br>
                    <label class="form-label font-semibold text-primary">{{$tax}}</label>
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Net Salary</label><br>
                    <label class="form-label font-semibold text-primary">{{$net_salary}}</label>
                </div>
            </div>
        </div>
    </div>
</div>