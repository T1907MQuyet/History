<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vnpayController extends Controller
{
    public function indexx()
    {
        return view("index");
    }
    public function create(Request $request)
    {
        $vnp_TmnCode = "U03SV3E4"; //Mã website tại VNPAY ở gmail khi đăng ký
        $vnp_HashSecret = "GBQVSBOISXIJJUTZBDQMOXOGFETSIJME"; //Chuỗi bí mật ở gmail khi đăng ký tài khoản
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnp-returnpay";

        $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $_POST['order_desc'];
        $vnp_OrderType = $_POST['order_type'];
        $vnp_Amount = $_POST['amount'] * 100;
        $vnp_Locale = $_POST['language'];
        $vnp_BankCode = $_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        return redirect()->to($returnData['data']);
    }
    //code thuc tế khi gửi từ form checkout lên

//        $total_price = str_replace(',','',\Cart::subtotal(00));
//        $request->validate([
//        "order_name"=>"required|min:3",
//        "phone_number"=>"required|max:11",
//        "address"=>"required",
//        ]);
//
//        $orders = Orders::create([
//        "order_name"=>$request->order_name,
//        "email"=>$request->email,
//        "phone_number"=>$request->phone_number,
//        "city_id"=>$request->city_id,
//        "address"=>$request->address,
//        "payment"=>$request->payment,
//        "note"=>$request->note,
//        "status"=>0,
//        "customer_id"=>$cus_id,
//        "total_price"=>$total_price
//        ]);
//        foreach ($carts as $value)
//        {
//        Order_detail::create([
//        "product_id"=>$value->id,
//        "order_id"=>$orders->id,
//        "quantity"=>$value->qty,
//        "price"=>$value->price,
//        "size"=>$value->options->size?$value->options->size:"",
//        ]);
//        }
//
//        session(['url_prev' => url()->previous()]);
//        $vnp_TmnCode = ""; //Mã website tại VNPAY
//        $vnp_HashSecret = ""; //Chuỗi bí mật
//        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
//        $vnp_Returnurl = "http://127.0.0.1:8000/return-vnpay";
//        $vnp_TxnRef = $orders->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
//        $vnp_OrderInfo = "Thanh Toán ";
//        $vnp_OrderType = 'billpayment';
//        $vnp_Amount = $total_price*100;
//        $vnp_Locale = 'vn';
//        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//        $inputData = array(
//            "vnp_Version" => "2.0.0",
//            "vnp_TmnCode" => $vnp_TmnCode,
//            "vnp_Amount" => $vnp_Amount,
//            "vnp_Command" => "pay",
//            "vnp_CreateDate" => date('YmdHis'),
//            "vnp_CurrCode" => "USD",
//            "vnp_IpAddr" => $vnp_IpAddr,
//            "vnp_Locale" => $vnp_Locale,
//            "vnp_OrderInfo" => $vnp_OrderInfo,
//            "vnp_OrderType" => $vnp_OrderType,
//            "vnp_ReturnUrl" => $vnp_Returnurl,
//            "vnp_TxnRef" => $vnp_TxnRef,
//        );
//        //            dd($inputData);
//        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
//            $inputData['vnp_BankCode'] = $vnp_BankCode;
//        }
//        ksort($inputData);
//        $query = "";
//        $i = 0;
//        $hashdata = "";
//        foreach ($inputData as $key => $value) {
//            if ($i == 1) {
//                $hashdata .= '&' . $key . "=" . $value;
//            } else {
//                $hashdata .= $key . "=" . $value;
//                $i = 1;
//            }
//            $query .= urlencode($key) . "=" . urlencode($value) . '&';
//        }
//        $vnp_Url = $vnp_Url . "?" . $query;
//        if (isset($vnp_HashSecret)) {
//            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
//            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
//        }
//        $returnData = array(
//            'code' =>'00',
//            'message' =>'success',
//            'data' => $vnp_Url
//        );
//        return redirect()->to($returnData['data']);
//

    //kết thúc



    public function returnpay(Request $request)
    {

        $url = session('url_prev','/');
//        dd($request->all());
        if($request->vnp_ResponseCode == "00") {
//            Orders::where("id",$request->vnp_TxnRef)->update([
//                "status" => 2,
//            ]);
//            $carts = \Cart::content();
//            $total_price = str_replace(',','',\Cart::subtotal(00));
            return redirect()->route("user.home")->with("success")->with('message', 'Complete Order!');
        }
        session()->forget('url_prev');
        return redirect($url)->with('error' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

    //code thuc te


//        $url = session('url_prev','/');
//        if($request->vnp_ResponseCode == "00") {
//        Orders::where("id",$request->vnp_TxnRef)->update([
//        "status" => 2,
//        ]);
//
//
//        \Cart::destroy(); xoa session gio hang
//        return redirect()->route("Home")->with("success")->with('message', 'Complete Order!');
//        }
//        session()->forget('url_prev');
//        return redirect($url)->with('error' ,'Lỗi trong quá trình thanh toán phí dịch vụ');


    //end code thuc te
}
