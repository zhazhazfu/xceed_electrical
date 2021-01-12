<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuoteTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quoteterms', function (Blueprint $table) {
            $table->id('pk_term_id');
            $table->text('term_name');
            $table->longText('term_body');
            $table->tinyInteger('term_archived')->default(0);
            $table->timestamps();
        });

        $quoteterms = new App\QuoteTerm();
        $quoteterms->term_name = 'Default';
        $quoteterms->term_body = '-  Our tender is based on Xceed Electrical entering into a mutually agreeable contract for all stages of the works, should this project be broken into separate portions then additional costs will apply.
        - Our tender is subject to our acceptance of a mutually agreeable contract and work program.
        - GST is shown as a separate line item in our tender price & schedules
        - Our price is based on copper indices as of the date of this tender. Any increases shall be subject to a contract variation.
        - Our offer is valid for a period of 30 days from date of tender.
        - We have made no allowances within our tender for back charges of cost offsetting. No claim for back charges or cost offsetting will be accepted by our company unless the full details are received in writing within 2 days of a back charge or cost offsetting event occurring, and our company have been given the opportunity to repair or remedy any event which may result in a back charge.
        - Liquidated damages if applicable are to be limited to 2. 5% of the contract value.
        - 10% Payment is required upfront on acceptance of quotation unless otherwise stated deposited required and installments required and accepted by client
        - Outstanding amount is to be paid at the end of job completion or instalments depending on agreement with client
        - On acceptance of this quotation, should the client decide to Decline or Pull Out of the following quotation they will be liable for payment of Non-Refundable/Returnable items and pay a Re stocking fee which is incurred by suppliers to us 
        - On acceptance of this quotation, should the client cancel within 3 days of acceptance a service charge of $165 will apply on top of Re stocking fee.
        - If any fees are not paid for and overdue, client is liable for any extra charges associated with debt collection services and legal services as well as any additional late charge fees. This also includes any solicitor fees and client accepts that they will be liable to pay for any legal costs at their expense.
        - We may charge Interest fees onto invoices overdue charged at 5% extra per day per everyday beyond the payment terms.';
        $quoteterms->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
