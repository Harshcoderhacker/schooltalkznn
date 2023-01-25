<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="font-bold text-white text-lg mr-auto mx-auto">Payroll Summary</p>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label class="form-label font-semibold">Basic Salary</label><br>
                    <input type="text" wire:model="basic_salary" readonly
                        class="form-control border-0 border-b-2 w-full">
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Earnings</label><br>
                    <input type="text" wire:model="total_earning" readonly
                        class="form-control border-0 border-b-2 w-full">
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Deduction</label><br>
                    <input type="text" wire:model="total_deducton" readonly
                        class="form-control border-0 border-b-2 w-full">
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Gross Salary (Rs)</label><br>
                    <input type="text" wire:model="gross_salary" readonly
                        class="form-control border-0 border-b-2 w-full">
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Tax</label><br>
                    <input type="number" wire:model="tax" wire:change="netsalary" wire:keyup="netsalary"
                        class="form-control border-0 border-b-2 w-full">
                </div>
                <div class="col-span-12">
                    <label class="form-label font-semibold">Net Salary</label><br>
                    <input type="text" wire:model="net_salary" readonly class="form-control border-0 border-b-2 w-full">
                </div>
            </div>
        </div>
    </div>
</div>