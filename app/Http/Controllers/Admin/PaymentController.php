<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\District;
use App\Models\Instamojo;
use App\Models\PaymentValue;
use App\Models\User;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function userPaymentDetails($userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['transaction'] = Instamojo::select('*')->where('user_id', $userId)->orderBy('updated_at', 'DESC')->get();

        return view('admin.pages.users.payment')->with($data);
    }

    public function allTransactions()
    {
        $user = Auth::user();
        $data['auth'] = $user;
        if ($user->type_of_user == 'Head Office') {
            $data['states'] = State::orderBy('name', 'asc')->get();
            if (request()->has('state') && request('state') != null) {
                $data['districts'] = District::where('state_id', request('state'))->orderBy('name', 'asc')->get();
                if (request()->has('district') && request('district') != null) {
                    $data['blocks'] = Block::where('district_id', request('district'))->orderBy('name', 'asc')->get();
                    if (request()->has('block') && request('block') != null) {
                        $users = User::select('id')->where('block', request('block'))->get()->toArray();
                        $data['transaction'] = Instamojo::select('*')->whereIn('user_id', $users)->orderBy('updated_at', 'DESC')->get();
                    } else {
                        $users = User::select('id')->where('district', request('district'))->get()->toArray();
                        $data['transaction'] = Instamojo::select('*')->whereIn('user_id', $users)->orderBy('updated_at', 'DESC')->get();
                    }
                } else {
                    $users = User::select('id')->where('state', request('state'))->get()->toArray();
                    $data['transaction'] = Instamojo::select('*')->whereIn('user_id', $users)->orderBy('updated_at', 'DESC')->get();
                }
            } else {
                $data['transaction'] = Instamojo::select('*')->orderBy('updated_at', 'DESC')->get();
            }

            if (request()->has('from') && request()->has('to') && request('from') != null && request('to') != null) {
                $data['transaction'] = $data['transaction']->intersect(Instamojo::where('staus', 'Credit')->whereBetween('created_at', [request('from'), request('to')])->orderBy('updated_at', 'DESC')->get());
            }

            $total = 0;
            foreach ($data['transaction'] as $trans) {
                if ($trans->staus === 'Credit') {
                    $total += (int) $trans->amount;
                }
            }

            $data['total'] = $total;
        } elseif ($user->type_of_user == 'State Office') {
            $users = User::select('id')->where('state', $user->access_level_id)->get()->toArray();
            $data['transaction'] = Instamojo::select('*')->whereIn('user_id', $users)->orderBy('updated_at', 'DESC')->get();
        } elseif ($user->type_of_user == 'District Office') {
            $users = User::select('id')->where('district', $user->access_level_id)->get()->toArray();
            $data['transaction'] = Instamojo::select('*')->whereIn('user_id', $users)->orderBy('updated_at', 'DESC')->get();
        } else {
            $users = User::select('id')->where('block', $user->access_level_id)->get()->toArray();
            $data['transaction'] = Instamojo::select('*')->whereIn('user_id', $users)->orderBy('updated_at', 'DESC')->get();
        }

        return view('admin.pages.payment.history.transactions')->with($data);
    }

    public function updateFormValue(Request $request)
    {
        $form = PaymentValue::where('id', $request->id)->update([
            'value' => $request->value,
        ]);

        return $form;
    }

    public function showFormValue()
    {
        $data['values'] = PaymentValue::select('*')->orderBy('updated_at', 'DESC')->get();
        // $documents = Documents::select('*')->get();
        // $pre = 'a';
        // foreach($documents as $doc)
        // {
        //     $type = $doc->gst_type_val;
        //     if($type != $pre)
        //     {
        //         $pre = $type;
        //         $forms = PaymentValue::firstOrCreate([
        //             'form_type' => $doc->for_multiple
        //         ],[
        //             'form' => $doc->for_multiple,
        //             'value' => 80,
        //         ]);
        //     }
        // }
        return view('admin.pages.payment.formValue.list')->with($data);
    }
}
