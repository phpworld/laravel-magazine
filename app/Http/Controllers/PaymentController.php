<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    private $razorpayApi;

    public function __construct()
    {
        $this->middleware('auth');
        $this->razorpayApi = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function createOrder(Request $request)
    {
        try {
            $request->validate([
                'magazine_id' => 'required|exists:magazines,id'
            ]);

            $magazine = Magazine::findOrFail($request->magazine_id);
            
            // Check if user already purchased this magazine
            if (Auth::user()->hasPurchased($magazine)) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already purchased this magazine'
                ], 400);
            }

            // Create Razorpay order
            $orderData = [
                'receipt' => 'magazine_' . $magazine->id . '_' . Auth::id() . '_' . time(),
                'amount' => $magazine->price * 100, // Razorpay expects amount in paise
                'currency' => 'INR',
                'notes' => [
                    'magazine_id' => $magazine->id,
                    'user_id' => Auth::id(),
                    'magazine_title' => $magazine->title
                ]
            ];

            $razorpayOrder = $this->razorpayApi->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'magazine' => [
                    'id' => $magazine->id,
                    'title' => $magazine->title,
                    'price' => $magazine->price
                ],
                'user' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'contact' => Auth::user()->phone ?? ''
                ],
                'is_development' => false
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment order. Please try again.'
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        try {
            $request->validate([
                'razorpay_payment_id' => 'required',
                'razorpay_order_id' => 'required',
                'razorpay_signature' => 'required',
                'magazine_id' => 'required|exists:magazines,id'
            ]);

            $magazine = Magazine::findOrFail($request->magazine_id);

            // Verify payment signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $this->razorpayApi->utility->verifyPaymentSignature($attributes);

            // Payment verified, create purchase record
            $purchase = Purchase::create([
                'user_id' => Auth::id(),
                'magazine_id' => $magazine->id,
                'amount' => $magazine->price,
                'transaction_id' => 'txn_' . time() . '_' . rand(1000, 9999),
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'payment_status' => 'completed'
            ]);

            // Update magazine download count
            $magazine->increment('download_count');

            return response()->json([
                'success' => true,
                'message' => 'Payment successful! You can now download the magazine.',
                'purchase_id' => $purchase->id,
                'redirect_url' => route('magazines.show', $magazine)
            ]);

        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            Log::error('Payment signature verification failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Please contact support.'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Payment verification error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed. Please try again.'
            ], 500);
        }
    }

    public function downloadMagazine($magazine_id)
    {
        try {
            $magazine = Magazine::findOrFail($magazine_id);
            
            // Check if user has purchased this magazine
            $purchase = Auth::user()->purchases()
                ->where('magazine_id', $magazine->id)
                ->where('payment_status', 'completed')
                ->first();

            if (!$purchase) {
                return response()->json([
                    'success' => false,
                    'message' => 'You need to purchase this magazine first.'
                ], 403);
            }

            if (!$magazine->pdf_file || !file_exists(storage_path('app/public/' . $magazine->pdf_file))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Magazine file not found. Please contact support.'
                ], 404);
            }

            // Update download tracking
            $purchase->increment('download_count');
            $purchase->update(['last_downloaded_at' => now()]);

            $filePath = storage_path('app/public/' . $magazine->pdf_file);
            $fileName = $magazine->title . '.pdf';

            return response()->download($filePath, $fileName);

        } catch (\Exception $e) {
            Log::error('Magazine download error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Download failed. Please try again.'
            ], 500);
        }
    }
}