<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Models\Invitation;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class PaymentController extends Controller
{
    public $mfObj;

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * create MyFatoorah object
     */
    public function __construct() {
        $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
    }

//-----------------------------------------------------------------------------------------------------------------------------------------
    /**
     * Create MyFatoorah invoice
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $data = PaymentMethod::query()->where('status',1)->get();
        $msg = __('lang.done');

        return sendResponse($msg,PaymentMethodResource::collection($data));
    }

    public function checkout(OrderRequest $request){
        $user_id= Auth::user()->id;
        $data = $request->validated();
        $invitation = Invitation::find($request->invitation_id);

        if (str_starts_with($invitation->user->phone , '00') ) {
            $phone = substr($invitation->user->phone, 2);
        } else if(str_starts_with($invitation->user->phone , '+')){
            $phone = substr($invitation->user->phone, 1);
        } else{
            $phone =$invitation->user->phone;
        }

        $data['user_id'] = $user_id;
        $data['coupon_id'] = @$invitation->coupon_id ;
        $data['total'] = $invitation->total;
        $data['status'] = 0;
//        $data['phone'] = 0;
        //order checkout
        $order = Order::create($data);


        try {
            $paymentMethodId = $request->payment_method_id; // 0 for MyFatoorah invoice or 1 for Knet in test mode 2 vies

            $curlData = $this->getPayLoadData($order->id);
            $dataUrl = $this->mfObj->getInvoiceURL($curlData, $paymentMethodId);

            $response = ['IsSuccess' => 'true',
                'Message' => 'Invoice created successfully.',
                'URL' => $dataUrl['invoiceURL'],
                'orderID' => $order->id
            ];

                    } catch (\Exception $e) {
            $response = ['IsSuccess' => 'false', 'Message' => $e->getMessage()];
        }
        return response()->json($response);


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
            'CustomerMobile'     => $order->user->phone,
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

    public function successCallback(){
        echo 'success';
    }

    public function errorCallback(){
        echo 'error';
    }


}
