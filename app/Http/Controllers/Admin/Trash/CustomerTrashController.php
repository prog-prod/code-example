<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;

class CustomerTrashController extends Controller
{
    public function index()
    {
        $deletedCustomers = Customer::onlyTrashed()->paginate(10);

        return view('admin.trash.customers', compact('deletedCustomers'));
    }

    public function restore(Customer $customer)
    {
        $customer->restore();
        return redirect()->route('admin.trash.customers.index')->with(
            'success',
            'Customer has been restored.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->forceDelete();

        return redirect()->route('admin.trash.customers.index')->with(
            ['success' => 'Customer has been destroyed.']
        );
    }
}
