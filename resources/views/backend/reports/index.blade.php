@extends('backend.reports.layout')

@section('title', 'Reports Dashboard')

@section('body')
<div class="container-fluid">

    <div class="row">

        <!-- ===== Left Column: Sales, Inventory & Delivery ===== -->
        <div class="col-lg-4">

            <!-- Sales -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Sales</strong>
                    <span class="text-muted small">Help ⓘ</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-chart-line me-2"></i>
                        <a href="{{ route('backend.reports.sales') }}">Sales</a>
                        <small class="text-muted d-block">Analyse your overall sales by payment types</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-receipt me-2"></i>
                        <a href="{{ route('backend.reports.transactions') }}">All Transactions</a>
                        <small class="text-muted d-block">Analyse all transactions</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-people-group me-2"></i>
                        <a href="{{ route('backend.reports.customerSales') }}">Customer Sales</a>
                        <small class="text-muted d-block">Analyse your best paying customers</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-box me-2"></i>
                        <a href="{{ route('backend.reports.productSales') }}">Product Sales</a>
                        <small class="text-muted d-block">Analyse your products' sales performance</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-calendar-days me-2"></i>
                        <a href="{{ route('backend.reports.scheduleSales') }}">Schedule Sales</a>
                        <small class="text-muted d-block">Analyse schedule-wise sales performance</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-location-dot me-2"></i>
                        <a href="{{ route('backend.reports.areaSales') }}">Area Sales</a>
                        <small class="text-muted d-block">Analyse area-wise sales performance</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-cart-shopping me-2"></i>
                        <a href="{{ route('backend.reports.productPerformance') }}">Product Performance</a>
                        <small class="text-muted d-block">Analyse which products get most orders</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-file-lines me-2"></i>
                        <a href="{{ route('backend.reports.reconciliation') }}">Reconciliation Report</a>
                        <small class="text-muted d-block">Analyse the combined sales report</small>
                    </li>
                </ul>
            </div>

            <!-- Inventory -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Inventory</strong>
                    <span class="text-muted small">Help ⓘ</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-boxes-stacked me-2"></i>
                        <a href="{{ route('backend.reports.inventory') }}">Inventory Report</a>
                        <small class="text-muted d-block">Track lowest inventory products</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-chart-bar me-2"></i>
                        <a href="{{ route('backend.reports.futureInventory') }}">Future Inventory Demand</a>
                        <small class="text-muted d-block">Analyse future inventory demand</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-truck me-2"></i>
                        <a href="{{ route('backend.reports.dispatch') }}">Dispatch Report</a>
                        <small class="text-muted d-block">Review driver dispatch report per route</small>
                    </li>
                </ul>
            </div>

           

        </div>
        <div class="col-lg-4">
             <!-- Delivery -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Delivery</strong>
                    <span class="text-muted small">Help ⓘ</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-cart-plus me-2"></i>
                        <a href="{{ route('backend.reports.deliverySales') }}">Sales From Product Deliveries</a>
                        <small class="text-muted d-block">Analyse sales from delivered products</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-clipboard-list me-2"></i>
                        <a href="{{ route('backend.reports.deliverySummary') }}">Deliveries Summary</a>
                        <small class="text-muted d-block">Analyse delivery status of orders</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-truck me-2"></i>
                        <a href="{{ route('backend.reports.ordersByDriver') }}">Order Delivered By Driver</a>
                        <small class="text-muted d-block">Review driver-wise deliveries</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-xmark me-2"></i>
                        <a href="{{ route('backend.reports.rejectedOrders') }}">Rejected Orders</a>
                        <small class="text-muted d-block">Analyse rejected orders</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-location-dot me-2"></i>
                        <a href="{{ route('backend.reports.areaDeliverySummary') }}">Area-wise Delivery Summary</a>
                        <small class="text-muted d-block">Summary report by area</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-list-check me-2"></i>
                        <a href="{{ route('backend.reports.areaDeliveryDetail') }}">Area-wise Detailed Delivery Report</a>
                        <small class="text-muted d-block">Detailed area-wise report</small>
                    </li>
                </ul>
            </div>
             <!-- Customer -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Customer</strong>
                    <span class="text-muted small">Help ⓘ</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-box me-2"></i>
                        <a href="{{ route('backend.reports.containers') }}">Containers Report</a>
                        <small class="text-muted d-block">Track driver-wise collected containers</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-user-plus me-2"></i>
                        <a href="{{ route('backend.reports.customersByDrivers') }}">Customers Created By Drivers</a>
                        <small class="text-muted d-block">Analyse customers created by drivers</small>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ===== Right Column: Payments & Customer ===== -->
        <div class="col-lg-4">

            <!-- Payments -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Payments</strong>
                    <span class="text-muted small">Help ⓘ</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-money-bill-wave me-2"></i>
                        <a href="{{ route('backend.reports.paymentsReceived') }}">Payments Received</a>
                        <small class="text-muted d-block">Analyse payments received by methods</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-xmark me-2"></i>
                        <a href="{{ route('backend.reports.failedPayments') }}">Failed Payments</a>
                        <small class="text-muted d-block">Analyse failed payments</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-calendar-days me-2"></i>
                        <a href="{{ route('backend.reports.monthlyBilling') }}">Monthly Billing</a>
                        <small class="text-muted d-block">Analyse monthly billing per customer</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-wallet me-2"></i>
                        <a href="{{ route('backend.reports.driverCash') }}">Driver Cash Report</a>
                        <small class="text-muted d-block">Review cash collected by drivers</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-people-group me-2"></i>
                        <a href="{{ route('backend.reports.revenuePerCustomer') }}">Revenue per Customer</a>
                        <small class="text-muted d-block">Track per customer revenue</small>
                    </li>
                    <li class="list-group-item">
                        <i class="nav-icon fa-solid fa-download me-2"></i>
                        <a href="{{ route('backend.reports.downloads') }}">Downloaded Files</a>
                        <small class="text-muted d-block">Track generated files</small>
                    </li>
                </ul>
            </div>

           

        </div>

    </div>
</div>
@endsection
