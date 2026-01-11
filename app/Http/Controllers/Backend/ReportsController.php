<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    // ===== Sales =====
    public function index()
    {
        return view('backend.reports.index');
    }

    public function sales()
    {
        return view('backend.reports.sales.sales');
    }

    public function transactions()
    {
        return view('backend.reports.sales.transactions');
    }

    public function customerSales()
    {
        return view('backend.reports.sales.customer_sales');
    }

    public function productSales()
    {
        return view('backend.reports.sales.product_sales');
    }

    public function scheduleSales()
    {
        return view('backend.reports.sales.schedule_sales');
    }

    public function areaSales()
    {
        return view('backend.reports.sales.area_sales');
    }

    public function productPerformance()
    {
        return view('backend.reports.sales.product_performance');
    }

    public function reconciliation()
    {
        return view('backend.reports.sales.reconciliation');
    }

    // ===== Payments =====
    public function paymentsReceived()
    {
        return view('backend.reports.payments.received');
    }

    public function failedPayments()
    {
        return view('backend.reports.payments.failed');
    }

    public function monthlyBilling()
    {
        return view('backend.reports.payments.monthly_billing');
    }

    public function driverCash()
    {
        return view('backend.reports.payments.driver_cash');
    }

    public function revenuePerCustomer()
    {
        return view('backend.reports.payments.revenue_customer');
    }

    public function downloads()
    {
        return view('backend.reports.payments.downloads');
    }

    // ===== Inventory =====
    public function inventory()
    {
        return view('backend.reports.inventory.inventory');
    }

    public function futureInventory()
    {
        return view('backend.reports.inventory.future_inventory');
    }

    public function dispatch()
    {
        return view('backend.reports.inventory.dispatch');
    }

    // ===== Customer =====
    public function containers()
    {
        return view('backend.reports.customer.containers');
    }

    public function customersByDrivers()
    {
        return view('backend.reports.customer.customers_by_drivers');
    }

    // ===== Delivery =====
    public function deliverySales()
    {
        return view('backend.reports.delivery.delivery_sales');
    }

    public function deliverySummary()
    {
        return view('backend.reports.delivery.delivery_summary');
    }

    public function ordersByDriver()
    {
        return view('backend.reports.delivery.orders_by_driver');
    }

    public function rejectedOrders()
    {
        return view('backend.reports.delivery.rejected_orders');
    }

    public function areaDeliverySummary()
    {
        return view('backend.reports.delivery.area_summary');
    }

    public function areaDeliveryDetail()
    {
        return view('backend.reports.delivery.area_detail');
    }
}
