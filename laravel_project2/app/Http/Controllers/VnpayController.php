<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class VnpayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://fraud.com/vnpay_return";
        $vnp_TmnCode = "HNQ1GJFL";
        $vnp_HashSecret = "PVLWJACQV73RGU3FTI44ZKE7HUMDIT21";

        $vnp_TxnRef = $request->appointment_id;
        $vnp_OrderInfo = "Thanh toán đơn hàng ";
        $vnp_OrderType = "Bill Payment";
        $vnp_Amount = 150000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version

        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }

        $inputData = array(
            "vnp_Version" => "2.1.0",
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

        // Lưu thông tin vào session
        session(['vnp_TxnRef' => $vnp_TxnRef, 'vnp_Amount' => $vnp_Amount]);

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }


        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function vnpayReturn(Request $request, Appointment $appointment)
    {
        $returnData = array();
        $inputData = $request->all();
        $vnp_HashSecret = "PVLWJACQV73RGU3FTI44ZKE7HUMDIT21";

        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            // Lấy thông tin từ session
            $vnp_TxnRef = session('vnp_TxnRef');
            $vnp_Amount = session('vnp_Amount');

            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công
                $array = [];
                $array = Arr::add($array, 'payment_status', 1);
                $array = Arr::add($array, 'payment_method', 4);
                Appointment::where('id', $vnp_TxnRef)->update($array);

                return Redirect::route('index')->with('success', 'Appointment created successfully!');
            } else {
                // Thanh toán thất bại
                return view('customer.payment.failure', ['txnRef' => $vnp_TxnRef, 'amount' => $vnp_Amount]);
            }
        } else {
            // Sai chữ ký
            return view('customer.payment.error');
        }
    }
}
