<?php

    namespace App\Exports;

    use App\Models\Loan;
    use Illuminate\Support\Collection;
    use Maatwebsite\Excel\Concerns\FromCollection;
    use Maatwebsite\Excel\Concerns\FromQuery;
    use Maatwebsite\Excel\Concerns\ShouldAutoSize;
    use Maatwebsite\Excel\Concerns\WithHeadings;
    use Maatwebsite\Excel\Concerns\WithMapping;

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
                'Götürdüyü Məbləğ','Maraq Faizi'
            ];
        }

        protected function reformatLoansForCorrectExport() {
            $this->loans = $this->loans->map(function($item) {
                $data = [];
                $customer = $item->customer;

                $data['id'] = $item->id;
                $data['customer_name'] = $customer->name.' '. $customer->surname.' '. $customer->fathername;
                $data['customer_id'] = $customer->id;
                $data['user'] = $item->user->name;
                $data['admin_unit'] = @$customer->adminUnit->name;
                $data['pay_from_where'] = '';
                $data['product_name'] = $item->product->name;
                $data['price'] = $item->price;
                $data['interest_sum'] = $item->loanReports->sum('percentDept');

                return $data;
            });
            
        }
    }


?>