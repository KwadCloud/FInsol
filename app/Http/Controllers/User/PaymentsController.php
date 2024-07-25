<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Instamojo;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public $payment_type;
    public function __construct()
    {
        $this->payment_type = '';
        $this->middleware('auth');
    }
    public function index()
    {
        $data['payment_history'] = Instamojo::where('user_id', auth()->user()->id)->orderBy('updated_at', 'DESC')->get();

        return view('user.pages.payments.history')->with($data);
    }
}
