<?php

namespace App\Traits;

use App\Http\Requests\OrderRequest;
use App\Models\Invitation;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

trait PaymentTrait
{
    public $mfObj;

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * create MyFatoorah object
     */
    public function initializeTrait() {
        $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
    }

    public function checkout($orderId ,$paymentMethodId ){

        $order = Order::find($orderId);

//        try {
              //$paymentMethodId 0 for MyFatoorah invoice or 1 for Knet in test mode 2 vies

            $curlData = $this->getPayLoadData($order->id);
            $dataUrl = $this->mfObj->getInvoiceURL($curlData, $paymentMethodId);

            $response = ['IsSuccess' => 'true',
                'Message' => 'Invoice created successfully.',
                'URL' => $dataUrl['invoiceURL'],
                'orderID' => $order->id
            ];

//        } catch (\Exception $e) {
//            $response = ['IsSuccess' => 'false', 'Message' => $e->getMessage()];
//        }
        return $response;


    }

    private function getPayLoadData($orderId = null) {

        $callbackURL = route('success.callback');
        $callbackURLError = route('error.callback');
        $order = Order::find($orderId);
//        $supplier_code=Settings::where('key_id','supplier_code')->first()->value;


        return [
            'CustomerName'       => $order->user->name,
            'InvoiceValue'       => $order->total,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => 'test@test.com',
            'CallBackUrl'        => $callbackURL.'?order='.$orderId,
            'ErrorUrl'           => $callbackURLError.'?order='.$orderId,
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => $order->phone,
            'Language'           => 'en',
            'CustomerReference'  => $orderId,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION ,
//            'Suppliers' =>[
//               [
//                'SupplierCode' => '$supplier_code',
//                'ProposedShare' => null,
//                "InvoiceShare" => $order->total ,
//               ]
//             ],
        ];
    }

    public function successCallback(Request $request){
        $orderId = $request->order;
        $order =Order::find($orderId);
        $order->status = 1 ;
        $order->save();
        echo 'success';
    }

    public function errorCallback(Request $request){
        $orderId = $request->order;
        $order =Order::find($orderId);
        Invitation::destroy($order->invitation_id);
        Order::destroy($orderId);

        echo 'error';
    }
}
