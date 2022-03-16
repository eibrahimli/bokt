<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $id
 * @property string|null $name Ad
 * @property float|null $balance Balance
 * @property string|null $last_operation_date Sonuncu əməliyyat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $branch_id Filial id-si
 * @property-read \App\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeOperation[] $incomeOperations
 * @property-read int|null $income_operations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AssetCategory
 *
 * @property int $id
 * @property string|null $name Ad
 * @property float|null $depreciation_percent Amortizasiya faizi
 * @property float|null $depreciation_price Düz xətt üzrə amortizasiya məbləği
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssetInner[] $assetInner
 * @property-read int|null $asset_inner_count
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory whereDepreciationPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory whereDepreciationPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetCategory whereUpdatedAt($value)
 */
	class AssetCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AssetInner
 *
 * @property int $id
 * @property int $asset_id Aktivin id-si
 * @property string|null $name Ad
 * @property string|null $type Malların iş və xidmətlərin növü
 * @property int|null $measure Ölçü vahidi
 * @property float|null $unit_price Qiyməti
 * @property float|null $quantity Miqdar
 * @property float|null $price Məbləği
 * @property float|null $edv ƏDV
 * @property float|null $total_price Tam qiyməti
 * @property float|null $debet Debet
 * @property float|null $credit Kredit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\MainAsset $asset
 * @property-read \App\Models\AssetCategory|null $assetCategory
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereDebet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereEdv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetInner whereUpdatedAt($value)
 */
	class AssetInner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Branch
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $director Fillial müdürü
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contract[] $contracts
 * @property-read int|null $contracts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExpenseOperation[] $expenseOperations
 * @property-read int|null $expense_operations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeOperation[] $incomeOperations
 * @property-read int|null $income_operations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Work[] $works
 * @property-read int|null $works_count
 * @method static \Database\Factories\BranchFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 */
	class Branch extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Collateral
 *
 * @property int $id
 * @property string $collateral_name Girov adi
 * @property int $trick_id Əyyar
 * @property int $loan_id Kredit
 * @property float $gram Girov qram
 * @property float $collateral_price Girov Dəyər
 * @property string|null $files
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Loan $loan
 * @property-read \App\Models\Options\Trick $trick
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral query()
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereCollateralName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereCollateralPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereGram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereTrickId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collateral whereUpdatedAt($value)
 */
	class Collateral extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Common
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Common newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Common newQuery()
 * @method static \Illuminate\Database\Query\Builder|Common onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Common query()
 * @method static \Illuminate\Database\Query\Builder|Common withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Common withoutTrashed()
 */
	class Common extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contract
 *
 * @property int $id
 * @property int $branch_id Alıcının id-si
 * @property int $supplier_id Təçhizatçının id-si
 * @property string|null $contract_number Müqavilə nömrəsi
 * @property float|null $price Müqavilə məbləği
 * @property float|null $advance_price Avans məbləği
 * @property string|null $currency_type Valyuta
 * @property \Illuminate\Support\Carbon|null $contract_date Müqavilə müddəti
 * @property \Illuminate\Support\Carbon|null $contract_begin
 * @property \Illuminate\Support\Carbon|null $contract_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MainAsset[] $assets
 * @property-read int|null $assets_count
 * @property-read \App\Models\Branch $branch
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExpenseOperation[] $expenseOperations
 * @property-read int|null $expense_operations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeOperation[] $incomeOperations
 * @property-read int|null $income_operations_count
 * @property-read \App\Models\Supplier $supplier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Work[] $works
 * @property-read int|null $works_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereAdvancePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedAt($value)
 */
	class Contract extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string|null $name Ad
 * @property string $isset_supplier Techizatcida varmi
 * @property string $status Status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Supplier[] $suppliers
 * @property-read int|null $suppliers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIssetSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string|null $name Valyutanın adı
 * @property string|null $fullname Valyutanın tam adı
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contract[] $contracts
 * @property-read int|null $contracts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string|null $name Ad
 * @property string|null $surname Soyad
 * @property string|null $fathername Ata Adı
 * @property string|null $fin Fin
 * @property string|null $identity_number Ş.V. Seriya №
 * @property string|null $registration_address Qeydiyyat ünvanı
 * @property string|null $residential_address Yaşayış ünvanı
 * @property string|null $gender Cins
 * @property string|null $contact_phone Contact number
 * @property string|null $contact_phone_1 Contact number #1
 * @property string|null $contact_phone_2 Contact number #2
 * @property string|null $contact_phone_3 Contact number #3
 * @property int $is_immigrant Məcburi Köçkün
 * @property string $maritial_status Ailə Vəziyyəti
 * @property string|null $attachments Attachments
 * @property \Illuminate\Support\Carbon|null $date_of_birth Doğum tarixi
 * @property string|null $birthplace Doğum yeri
 * @property int|null $user_id Əlavə edən
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $admin_unit_id Iqtisadi rayon
 * @property int|null $legal_status_id Hüquqi fiziki
 * @property int|null $branch_id Müştərinin aid olduğu filial
 * @property int|null $voen
 * @property int $penalty_day Müştərinin gecikmə günlərinin sayı
 * @property-read \App\Models\Options\AdminUnit|null $adminUnit
 * @property-read string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Guarantor[] $guarantors
 * @property-read int|null $guarantors_count
 * @property-read \App\Models\Options\LegalStatus|null $legalStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\KirschbaumDevelopment\NovaChartjs\Models\NovaChartjsMetricValue[] $novaChartjsMetricValue
 * @property-read int|null $nova_chartjs_metric_value_count
 * @property-write mixed $nova_chartjs_metric_value
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\CustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAdminUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereContactPhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereContactPhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereContactPhone3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFathername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIsImmigrant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLegalStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMaritialStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePenaltyDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRegistrationAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereResidentialAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereVoen($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \KirschbaumDevelopment\NovaChartjs\Contracts\Chartable {}
}

namespace App\Models{
/**
 * App\Models\CustomerType
 *
 * @property int $id
 * @property string|null $name Təçhizatçının tipi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Supplier[] $suppliers
 * @property-read int|null $suppliers_count
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerType whereUpdatedAt($value)
 */
	class CustomerType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DcAccount
 *
 * @property int $id
 * @property string|null $name Ad
 * @property string|null $code Kod
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkInner[] $workInnerDebet
 * @property-read int|null $work_inner_debet_count
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DcAccount whereUpdatedAt($value)
 */
	class DcAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepreciationAccount
 *
 * @property int $id
 * @property string|null $name Ad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MainAsset[] $assets
 * @property-read int|null $assets_count
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepreciationAccount whereUpdatedAt($value)
 */
	class DepreciationAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpenseOperation
 *
 * @property int $id
 * @property int|null $branch_id Alıcının id-si
 * @property int|null $account_id Hesab id-si
 * @property int|null $customer_id Müştərinin id-si
 * @property int|null $contract_id Müqavilə id-si
 * @property int|null $supplier_id Techizatci id-si
 * @property float|null $price Odenisin meblegi
 * @property string|null $purpose_payment Ödənişin təyinatı
 * @property float|null $debet Debet
 * @property float|null $credit Kredit
 * @property int|null $operation_method Əməliyyat növü
 * @property \Illuminate\Support\Carbon|null $payment_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property float|null $edv_percent ƏDV dərəcəsi
 * @property float|null $edv_price ƏDV məbləği
 * @property int|null $asset_category_id
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Branch|null $branch
 * @property-read \App\Models\DcAccount|null $creditAccount
 * @property-read \App\Models\DcAccount|null $debetAccount
 * @property-read \App\Models\Supplier|null $supplier
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Work|null $work
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereAssetCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereDebet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereEdvPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereEdvPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereOperationMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation wherePurposePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseOperation whereUpdatedAt($value)
 */
	class ExpenseOperation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Guarantor
 *
 * @property int $id
 * @property string|null $name Ad
 * @property string|null $surname Soyad
 * @property string|null $fathername Ata Adı
 * @property string|null $fin Fin
 * @property string|null $identity_number Ş.V. Seriya №
 * @property string|null $registration_address Qeydiyyat ünvanı
 * @property string|null $residential_address Yaşayış ünvanı
 * @property string|null $contact_phone Contact number
 * @property string|null $contact_phone_1 Contact number #1
 * @property string|null $contact_phone_2 Contact number #2
 * @property string|null $contact_phone_3 Contact number #3
 * @property string|null $attachments Attachments
 * @property \Illuminate\Support\Carbon|null $date_of_birth Doğum tarixi
 * @property string|null $birthplace Doğum yeri
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Guarantor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereContactPhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereContactPhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereContactPhone3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereFathername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereRegistrationAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereResidentialAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Guarantor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Guarantor withoutTrashed()
 */
	class Guarantor extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\IncomeOperation
 *
 * @property int $id
 * @property int|null $branch_id Alıcının id-si
 * @property int|null $account_id Hesab id-si
 * @property int|null $supplier_id Təçhizatçının id-si
 * @property int|null $contract_id Müqavilə id-si
 * @property float|null $edv_percent ƏDV dərəcəsi
 * @property float|null $edv_price ƏDV meblegi
 * @property float|null $price Odenisin meblegi
 * @property string|null $purpose_payment Ödənişin təyinatı
 * @property float|null $debet Debet
 * @property float|null $credit Kredit
 * @property int|null $operation_method Əməliyyat növü
 * @property \Illuminate\Support\Carbon|null $payment_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Account|null $accountFrom
 * @property-read \App\Models\Account|null $accountTo
 * @property-read \App\Models\Branch|null $branch
 * @property-read \App\Models\Contract|null $contract
 * @property-read \App\Models\DcAccount|null $creditAccount
 * @property-read \App\Models\DcAccount|null $debetAccount
 * @property-read \App\Models\Supplier|null $supplier
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereDebet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereEdvPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereEdvPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereOperationMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation wherePurposePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeOperation whereUpdatedAt($value)
 */
	class IncomeOperation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Loan
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $percentage Faiz
 * @property int $month Ay (Müddət)
 * @property int|null $user_id User (Credit officer
 * @property int $customer_id Müştəri
 * @property float $price Məbləğ
 * @property int $service_id Xidmetler
 * @property int $consumption_id Istehlak
 * @property int $agriculture_id Kənd Təsərüffatı
 * @property int $production_id İstehsal
 * @property int $trade_id Ticaret
 * @property int $transportation_id Nəqliyyat
 * @property int $approved Təsdiq
 * @property int $status Supervisor tesdiq etdi
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $credit_report Kredit reportu
 * @property float $credit_balance Müştəri borcu
 * @property float $payed_balance Müştərinin ödədiyi kredit məbləğ miqdarı
 * @property float $whole_payable_balance Müştərinin ödəməli olduğu ümumi məbləğ
 * @property int|null $branch_id
 * @property float|null $whole_percentage_price Umumi ödəniləcək faiz məbləği
 * @property float|null $current_main_price Hal hazırkı qalıq əsas məbləğ
 * @property float|null $current_percentage_price Hal hazırkı qalıq faiz məbləği
 * @property int $rescheduled Yenidən cədvəl yarıdıldımı
 * @property float|null $rescheduled_price Yenidən cədvəlin yarandığındakı əsas məbləğ
 * @property mixed|null $rescheduled_report Yeni cədvəl
 * @property float|null $rescheduled_payed_balance Yeni cədvəl ödənilən məbləğ
 * @property float|null $rescheduled_whole_payable_balance Yeni cədvəl ödəniləcək məbləğ
 * @property int|null $rescheduled_month Yeni cədvəl ay
 * @property int $closed Kredit ödəndi
 * @property string|null $approved_date Kreditin təsdiq olunduğu vaxt
 * @property int $serviceFeePayed Kredit üzrə xidmət haqqı ödənilibmi?
 * @property-read \App\Models\Options\Agriculture $agriculture
 * @property-read \App\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Collateral[] $collaterals
 * @property-read int|null $collaterals_count
 * @property-read \App\Models\Options\Consumption $consumption
 * @property-read \App\Models\Customer $customer
 * @property-read string $formatted
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LoanPenalty[] $loanPenalties
 * @property-read int|null $loan_penalties_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LoanReport[] $loanReports
 * @property-read int|null $loan_reports_count
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Options\Production $production
 * @property-read \App\Models\Options\Service $service
 * @property-read \App\Models\Options\Trade $trade
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\Options\Transportation $transportation
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Loan active()
 * @method static \Database\Factories\LoanFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newQuery()
 * @method static \Illuminate\Database\Query\Builder|Loan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan unclosed()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereAgricultureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereApprovedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereConsumptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCreditBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCreditReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCurrentMainPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCurrentPercentagePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePayedBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereProductionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRescheduled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRescheduledMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRescheduledPayedBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRescheduledPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRescheduledReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRescheduledWholePayableBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereServiceFeePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereTransportationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereWholePayableBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereWholePercentagePrice($value)
 * @method static \Illuminate\Database\Query\Builder|Loan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Loan withoutTrashed()
 */
	class Loan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LoanPenalty
 *
 * @property int $id
 * @property float|null $price Ümumi cərimə miqdarı
 * @property float|null $price_remainder Ödənilən cərimə miqdarı
 * @property int|null $day Gecikmə günlərinin sayı
 * @property int $paid Gecikmə ödənilmişdir
 * @property int $loan_id
 * @property string|null $paid_at Cərimə bu taridə ödənilmişdir
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Loan|null $loans
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty wherePriceRemainder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanPenalty whereUpdatedAt($value)
 */
	class LoanPenalty extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LoanReport
 *
 * @property int $id
 * @property string $termInMonth Ay
 * @property float $totalDept Aylıq ödəniləcək məbləğ
 * @property float $percentDept Aylıq ödəniləcək faiz üzrə məbləğ
 * @property float $mainDept Aylıq ödəniləcək əsas üzrə məbləğ
 * @property float $indebtedness Qalıq son məbləğ
 * @property float $penalty Gecikməyə görə ödəniş
 * @property float $percentage_remainder Faiz üzrə qalıq
 * @property float $main_remainder Əsas üzrə qalıq
 * @property int $paid Aylıq ödəniş statusu
 * @property string|null $paid_at Ödəniş tarixi
 * @property int $loan_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $shouldPay Odəməli olduğu tarix
 * @property string|null $service_fee
 * @property int $not_paid_percentage_interest Krediti öncədən bağlayıbsa true
 * @property int $penalty_day Müştərinin kreditinin ay görə gecikməsi
 * @property int $stopPenalty
 * @property-read \App\Models\Loan $loan
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport active()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport newQuery()
 * @method static \Illuminate\Database\Query\Builder|LoanReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport stopPenalty()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereIndebtedness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereMainDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereMainRemainder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereNotPaidPercentageInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport wherePenalty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport wherePenaltyDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport wherePercentDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport wherePercentageRemainder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereServiceFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereShouldPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereStopPenalty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereTermInMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereTotalDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LoanReport withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LoanReport withoutTrashed()
 */
	class LoanReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MainAsset
 *
 * @property int $id
 * @property int|null $branch_id Alıcının id-si
 * @property int|null $supplier_id Təchizatçının id-si
 * @property int|null $contract_id Müqavilə id-si
 * @property string|null $invoice_number Hesab faktura nömrəsi
 * @property string|null $einvoice_number EQF nömrəsi
 * @property \Illuminate\Support\Carbon|null $einvoice_date EQF Tarixi
 * @property int|null $dep_account_id Amortizasiya hesabı
 * @property int|null $user_id Məsul şəxs
 * @property string|null $asset_location Əsas vəsaitin yerləşdiyi yer
 * @property mixed|null $total_result Umumi qiymət , ədv nəticəsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssetInner[] $assetInner
 * @property-read int|null $asset_inner_count
 * @property-read \App\Models\Branch|null $branch
 * @property-read \App\Models\Contract|null $contract
 * @property-read \App\Models\DepreciationAccount|null $depAccount
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereAssetLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereDepAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereEinvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereEinvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereTotalResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainAsset whereUserId($value)
 */
	class MainAsset extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Measure
 *
 * @property int $id
 * @property string|null $name Ad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkInner[] $workInner
 * @property-read int|null $work_inner_count
 * @method static \Illuminate\Database\Eloquent\Builder|Measure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Measure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Measure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Measure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Measure whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Measure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Measure whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Measure whereUpdatedAt($value)
 */
	class Measure extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\AdminUnit
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUnit whereUpdatedAt($value)
 */
	class AdminUnit extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\Agriculture
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture newQuery()
 * @method static \Illuminate\Database\Query\Builder|Agriculture onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agriculture whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Agriculture withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Agriculture withoutTrashed()
 */
	class Agriculture extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\Consumption
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption newQuery()
 * @method static \Illuminate\Database\Query\Builder|Consumption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption query()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Consumption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Consumption withoutTrashed()
 */
	class Consumption extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\LegalStatus
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalStatus whereUpdatedAt($value)
 */
	class LegalStatus extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\Production
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Production newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Production newQuery()
 * @method static \Illuminate\Database\Query\Builder|Production onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Production query()
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Production withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Production withoutTrashed()
 */
	class Production extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\Service
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Query\Builder|Service onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Service withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Service withoutTrashed()
 */
	class Service extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\Trade
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Trade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trade newQuery()
 * @method static \Illuminate\Database\Query\Builder|Trade onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trade query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Trade withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Trade withoutTrashed()
 */
	class Trade extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\Transportation
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation newQuery()
 * @method static \Illuminate\Database\Query\Builder|Transportation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Transportation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Transportation withoutTrashed()
 */
	class Transportation extends \Eloquent {}
}

namespace App\Models\Options{
/**
 * App\Models\Options\Trick
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Collateral[] $collaterals
 * @property-read int|null $collaterals_count
 * @method static \Illuminate\Database\Eloquent\Builder|Trick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trick newQuery()
 * @method static \Illuminate\Database\Query\Builder|Trick onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trick query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trick whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trick whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trick whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Trick withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Trick withoutTrashed()
 */
	class Trick extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name Ad
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $percentage Məhsul faizi
 * @property int $status
 * @property int|null $min_price
 * @property int|null $max_price
 * @property int|null $min_date
 * @property int|null $max_date
 * @property float|null $service_fee
 * @property float|null $delay_percentage Gecikmə faizi
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDelayPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMaxDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMaxPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereServiceFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Registry
 *
 * @property int $id
 * @property float|null $amount Mebleg
 * @property int|null $debet Debet
 * @property int|null $credit Kredit
 * @property string|null $reg_type Emeliyyat
 * @property int|null $reg_id Emeliyyat id
 * @property string|null $product_id Xerc tipi
 * @property string|null $product_name Xercin adi
 * @property int|null $branch_id Alıcının id-si
 * @property int|null $account_id Hesab id-si
 * @property int|null $customer_id Müştərinin id-si
 * @property int|null $contract_id Müqavilə id-si
 * @property int|null $supplier_id Techizatci id-si
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Account|null $accountTo
 * @property-read \App\Models\Branch|null $branch
 * @property-read \App\Models\DcAccount|null $creditAccount
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\DcAccount|null $debetAccount
 * @property-read \App\Models\Supplier|null $supplier
 * @property-read \App\Models\Work|null $work
 * @method static \Illuminate\Database\Eloquent\Builder|Registry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereDebet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereRegId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereRegType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereUpdatedAt($value)
 */
	class Registry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $name Təçhizatçının adı
 * @property string $voen VÖEN
 * @property string $status Status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $country_id Qeydiyyatda olduğu ölkə
 * @property int $customer_type Təçhizatçının növü
 * @property float|null $paid_amount Ödənilən məbləğ
 * @property float|null $rest_amount Qalıq məbləğ
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contract[] $contracts
 * @property-read int|null $contracts_count
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\CustomerType $customerType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExpenseOperation[] $expenseOperations
 * @property-read int|null $expense_operations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeOperation[] $incomeOperations
 * @property-read int|null $income_operations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Work[] $works
 * @property-read int|null $works_count
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereRestAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereVoen($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property float|null $price
 * @property int $is_civil Digər vətandaş tərəfindən ödəniş
 * @property string|null $name Ad
 * @property string|null $surname Soyad
 * @property string|null $fathername Ata Adı
 * @property string|null $identity_number Ş.V. Seriya №
 * @property string|null $fin Fin
 * @property float|null $main_price Əsas məbləğ üzrə
 * @property float|null $interested_price Marağ faizi üzrə
 * @property float|null $calculated_price Hesablanmış cərimə
 * @property int|null $user_id Elave eden
 * @property int|null $loan_id Kredit
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $expected_price Ödəmə olunmalı məbləğ
 * @property string|null $shouldPay Müştərinin o ay üçün ödəməli olduğu tarix
 * @property int $service_fee Service haqqı ödənildimi
 * @property string|null $description Xidmət haqqı ödənişi
 * @property int $penalty_day Müştərinin gecikmə günlərinin sayı
 * @property-read \App\Models\Loan|null $loan
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCalculatedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereExpectedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFathername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereInterestedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsCivil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereMainPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePenaltyDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereServiceFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShouldPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Transaction withoutTrashed()
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $surname Soyad
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role istifadəçi ümumi rolu
 * @property int|null $user_group_id
 * @property int|null $branch_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MainAsset[] $assets
 * @property-read int|null $assets_count
 * @property-read \App\Models\Branch|null $branch
 * @property-read \App\Models\UserGroup|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserGroupId($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $columns
 * @property int $priority Lesser the value, more import is the group
 * @property string|null $menu_items
 * @property string|null $access_mode
 * @property string|null $view_mode
 * @property string|null $edit_mode
 * @property string|null $delete_mode
 * @property string|null $create_mode
 * @property string|null $approve_mode
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $columns_list
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereAccessMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereApproveMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereCreateMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereDeleteMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereEditMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereMenuItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereViewMode($value)
 * @method static \Illuminate\Database\Query\Builder|UserGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserGroup withoutTrashed()
 */
	class UserGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Work
 *
 * @property int $id
 * @property int $branch_id Alıcının id-si
 * @property int $supplier_id Təchizatçının id-si
 * @property string|null $invoice_number Hesab faktura nömrəsi
 * @property string|null $einvoice_number EQF nömrəsi
 * @property string|null $einvoice_date EQF Tarixi
 * @property mixed|null $total_result Umumi qiymət , ədv nəticəsi
 * @property int $status Status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $contract_number Müqavilə nömrəsi
 * @property \Illuminate\Support\Carbon|null $contract_date Müqavilə müddəti
 * @property \Illuminate\Support\Carbon|null $contract_begin
 * @property \Illuminate\Support\Carbon|null $contract_end
 * @property-read \App\Models\Branch $branch
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\Supplier $supplier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkInner[] $workInner
 * @property-read int|null $work_inner_count
 * @method static \Illuminate\Database\Eloquent\Builder|Work newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Work newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Work query()
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereContractBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereContractDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereContractEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereContractNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereEinvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereEinvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereTotalResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereUpdatedAt($value)
 */
	class Work extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WorkInner
 *
 * @property int $id
 * @property int|null $work_id WORK id-si
 * @property string|null $name Ad
 * @property string|null $type Malların iş və xidmətlərin növü
 * @property int|null $measure Ölçü vahidi
 * @property float|null $quantity Miqdar
 * @property float|null $unit_price Qiyməti
 * @property float|null $price Məbləği
 * @property float|null $edv ƏDV
 * @property float|null $total_price Tam qiyməti
 * @property float|null $debet Debet
 * @property float|null $credit Kredit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\AssetCategory|null $assetCategory
 * @property-read \App\Models\DcAccount|null $creditAccount
 * @property-read \App\Models\DcAccount|null $debetAccount
 * @property-read \App\Models\Measure|null $measures
 * @property-read \App\Models\Work|null $work
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereDebet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereEdv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkInner whereWorkId($value)
 */
	class WorkInner extends \Eloquent {}
}

