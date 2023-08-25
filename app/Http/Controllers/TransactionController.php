<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use Illuminate\Http\Request;
use App\Imports\TransactionImport;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:isAdmin')->except('index');
    }

    public function create()
    {
        return view('admin.transaction.create');
    }

    public function import(Request $request) {
        // setting rules validasi data
        $rules = [
            'excel' => 'required'
        ];

        $messages = [
            'excel.required' => 'File excel tidak boleh kosong'
        ];

        // validasi data
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            // jika data tidak valid
            return redirect('admin/trx/create')
                ->withErrors($validator);
        }
        else {
            // ambil file excel yg diupload
            $excel = $request->file('excel');

            // load dan import file excel
            Excel::import(new TransactionImport, $excel);

            // redirect ke halaman index transaction
            return redirect('admin/trx',)->with('message','Transaction successfully import');
        }
    }

    public function export()
    {
        return Excel::download(new TransactionExport, 'data transaksi-' . date('Y-m-d') . '.xlsx');
    }

    public function index()
    {
        $transactions = Transaction::all();
        $data = [
            'transactions' => $transactions,
        ];

        return view('admin.transaction.index', $data);
    }
}
