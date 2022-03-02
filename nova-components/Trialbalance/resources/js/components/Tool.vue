<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
<template>
    <div>
        <heading class="mb-6">Sınaq balansı</heading>
        <div class="flex flex-wrap -mx-3">
            <div class="px-3 mb-6 w-full">
                <div class="bg-30 border-b border-60" lens="">
                    <div class="scroll-wrap overflow-x-hidden overflow-y-auto" style="max-height: 350px;">
                        <div class="py-2 w-full block text-xs uppercase tracking-wide text-center text-80 dim font-bold focus:outline-none">
                            Filter Menu
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Başlanğıc tarixi
                                </h3>
                                <div class="p-2">
                                    <input type="date" v-model="begin_date" v-on="getRows" placeholder="Başlanğıc tarixi" class="block w-full form-control-sm form-input border-60">
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Bitmə tarixi
                                </h3>
                                <div class="p-2">
                                    <input type="date" v-model="end_date" v-on="getRows" placeholder="Bitmə tarix" class="block w-full form-control-sm form-input border-60">
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Mühasibatlıq kodu
                                </h3>
                                <div class="p-2">
                                    <select name="" v-model="dc_account_id" v-on="getRows" class="block w-full form-control-sm form-input border-60">
                                        <option value="0">Seçin</option>
                                        <option v-for="(code,id) in codes" :value="id">{{ code }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Filial
                                </h3>
                                <div class="p-2">
                                    <select name="" v-model="branch_id" class="block w-full form-control-sm form-input border-60">
                                        <option value="0">Seçin</option>
                                        <option v-for="(branch,id) in branches" :value="id">{{ branch }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Hesabdan
                                </h3>
                                <div class="p-2">
                                    <select name="" v-model="account_id" class="block w-full form-control-sm form-input border-60">
                                        <option value="0">Seçin</option>
                                        <option v-for="(account,id) in accounts" :value="id">{{ account }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Hesaba
                                </h3>
                                <div class="p-2">
                                    <select name="" v-model="account_to" class="block w-full form-control-sm form-input border-60">
                                        <option value="0">Seçin</option>
                                        <option v-for="(account,id) in accounts" :value="id">{{ account }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Təchizatçı
                                </h3>
                                <div class="p-2">
                                    <select name="" v-model="supplier_id" class="block w-full form-control-sm form-input border-60">
                                        <option value="0">Seçin</option>
                                        <option v-for="(supplier,id) in suppliers" :value="id">{{ supplier }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    Seçim
                                </h3>
                                <div class="p-2">
                                    <select name="" v-model="check_null" class="block w-full form-control-sm form-input border-60">
                                        <option value="0" selected>Hamısı görünsün</option>
                                        <option value="1">0 olanlar görünməsin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-left nova-big-filter-col">
                            <div>
                                <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                                    &nbsp;
                                </h3>
                                <div class="p-2">
                                    <input type="submit" @click="getRows" class="btn btn-default btn-primary" value="Axtar">
                                    <button @click="exportTableToExcel('tblData', 'Trial-Balance-Data')" class="btn btn-default btn-danger float-right">Excel</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <card
            class="flex flex-col items-center justify-center"
            style="min-height: 300px"
        >



            <table class="border-collapse border border-gray-400 table w-full table-default" id="tblData">
                <thead>
                <tr >
                    <th class="border border-gray-300 ..."></th>
                    <th class="border border-gray-300  text-center" colspan="2">İLKİN</th>
                    <th class="border border-gray-300  text-center" colspan="2">DÖVR ÜZRƏ</th>
                    <th class="border border-gray-300  text-center" colspan="2">QALIQ</th>
                </tr>
                <tr>
                    <th class="border border-gray-300 text-center">Kod</th>
                    <th class="border border-gray-300  text-center">DEBET</th>
                    <th class="border border-gray-300  text-center">KREDİT</th>
                    <th class="border border-gray-300  text-center">DEBET</th>
                    <th class="border border-gray-300  text-center">KREDİT</th>
                    <th class="border border-gray-300  text-center">DEBET</th>
                    <th class="border border-gray-300  text-center">KREDİT</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="row in rows">
                    <td class="border border-gray-300 ...">{{ row.code}} <br /> {{ row.name}}</td>
                    <td class="border border-gray-300 ...">{{ row.operations.debet.first}}</td>
                    <td class="border border-gray-300 ...">{{ row.operations.credit.first}}</td>
                    <td class="border border-gray-300 ...">{{ row.operations.debet.current}}</td>
                    <td class="border border-gray-300 ...">{{ row.operations.credit.current}}</td>
                    <td class="border border-gray-300 ...">{{ row.operations.debet.last}}</td>
                    <td class="border border-gray-300 ...">{{ row.operations.credit.last}}</td>
                </tr>

                </tbody>
            </table>

        </card>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'Trialbalance',
        }
    },
    data(){
        return {
            begin_date:new Date().toISOString().slice(0,10),
            end_date:new Date().toISOString().slice(0,10),
            branches: [],
            codes: [],
            accounts : [],
            suppliers : [],
            rows : [],
            dc_account_id: 0,
            branch_id: 0,
            account_id: 0,
            account_to: 0,
            supplier_id: 0,
            check_null: 0
        }
    },
    mounted() {
        this.getRows();
        this.getBranches();
        this.getCodes();
        this.getSuppliers();
        this.getAccounts();
    },
    methods: {
        currentDate() {
            const current = new Date();
            const today =(current.getMonth())+'/'+current.getDate()+'/'+current.getFullYear();
            return today;
        },

        submitFilter(){
            alert("eee")
        },
        getRows(){
            axios.get('/nova-vendor/trialbalance/data',{
                params: {
                    begin_date: this.begin_date, //'begin_date',
                    end_date : this.end_date,
                    dc_account_id: this.dc_account_id,
                    branch_id: this.branch_id,
                    supplier_id: this.supplier_id,
                    account_id: this.account_id,
                    account_to: this.account_to,
                    check_null : this.check_null
                }
            }).then(data => {
                this.rows = data.data
                console.log(this.rows)
            }).catch(er => {
                console.log(er)
            })
        },
        getBranches(){
            axios.get('/nova-vendor/trialbalance/branches'
            ).then(data => {
                this.branches = data.data
            }).catch(er => {
                console.log(er)
            })
        },

        getCodes(){
            axios.get('/nova-vendor/trialbalance/codes'
            ).then(data => {
                this.codes = data.data
            }).catch(er => {
                console.log(er)
            })
        },
        getSuppliers(){
            axios.get('/nova-vendor/trialbalance/suppliers'
            ).then(data => {
                this.suppliers = data.data
            }).catch(er => {
                console.log(er)
            })
        },
        getAccounts(){
            axios.get('/nova-vendor/trialbalance/accounts'
            ).then(data => {
                this.accounts = data.data
            }).catch(er => {
                console.log(er)
            })
        },
        exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel;charset=UTF-8';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: 'text/csv,charset=UTF-8'
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>



