<?php

    namespace App\Exports;

    use App\Helpers\LoanHelper;
    use App\Models\Loan;
    use Carbon\Carbon;
    use Illuminate\Support\Collection;
    use Maatwebsite\Excel\Concerns\FromCollection;
    use Maatwebsite\Excel\Concerns\ShouldAutoSize;
    use Maatwebsite\Excel\Concerns\WithHeadings;

    class PortfelExport implements FromCollection,WithHeadings,ShouldAutoSize
    {
        protected $loans;

        function __construct($loans) {
            $this->loans = $loans;

            $this->reformatLoansForCorrectExport();
        }

        public function collection()
        {
            return $this->loans;
        }

        public function headings(): array
        {
            return [
                'id', 'Müştəri','Müştəri nömrəsi', 'Kredit Əməkdaşı',
                'Iqtisadi Rayon','Maliyyə mənbəyi','Kredit Məhsulunun adı',
                'Götürdüyü Məbləğ','Maraq Faizi', 'Bitmə tarixi', 'Xidmət haqqı','Qalıq Əsas Məbləğ',
                'Qalıq Faiz Məbləği', 'Gözlənilən Cərimə','Cəm', 'Ödənilmiş Əsas Məbləğ','Ödənilmiş Faiz Məbləğ',
                'Ödənilmiş Cərimə', 'Kreditin Götürülmə Tarixi','Kreditinin Müddəti', 'Cins','Ünvan',"Tel", "Fin",
                "Ş/V Nömrəsi","Son Ödəniş Tarixi"
            ];
        }

        protected function reformatLoansForCorrectExport() {
            $this->loans = $this->loans->map(function($item) {
                $data = [];
                $customer = $item->customer;
                $loanReports = $item->loanReports;
                $activeLoanReports = $item->loanReports()->active()->get();

                $data['id'] = $item->id;
                $data['customer_name'] = $customer->name.' '. $customer->surname.' '. $customer->fathername;
                $data['customer_id'] = $customer->id;
                $data['user'] = $item->user->name;
                $data['admin_unit'] = @$customer->adminUnit->name;
                $data['pay_from_where'] = '';
                $data['product_name'] = $item->product->name;
                $data['price'] = $item->price;
                $data['interest_sum'] = $loanReports->sum('percentDept');
                $data['ended_time'] = $loanReports->last()->shouldPay;
                $data['service_fee'] = $loanReports->first()->service_fee;
                $data['main_price_remainder'] = LoanHelper::findMainDept($item);
                $data['percentage_price_remainder'] = LoanHelper::findPercentDept($item);
                $data['penalty'] = $activeLoanReports->first()->penalty;
                $data['total'] = round($data['service_fee'] + $data['main_price_remainder'] + $data['percentage_price_remainder'] + $data['penalty'],'2');
                $data['payed_main'] = LoanHelper::findPayedMainAndPercent($item);
                $data['payed_percentage'] = LoanHelper::findPayedMainAndPercent($item, 'interest');
                $data['payed_penalty'] = LoanHelper::findPayedMainAndPercent($item, 'penalty');
                $data['created_at'] = Carbon::parse($item->created_at)->toDateString();
                $data['month'] = $item->month;
                $data['gender'] = $customer->gender == 'male' ? 'Kişi' : 'Qadın';
                $data['address'] = $customer->residential_address;
                $data['contact_phones'] = $customer->contact_phone .','.$customer->contact_phone_1.','.$customer->contact_phone_2.','.$customer->contact_phone_3;
                $data['fin'] = $customer->fin;
                $data['identity_number'] = $customer->identity_number;
                $data['last_payed_date'] = $item->transactions ? Carbon::parse($item->transactions->first()->created_at)->toDateString() : '';
                return $data;
            });

        }

        protected function isRescheduled(Loan $loan) {
            return $loan->rescheduled;
        }
    }


?>
