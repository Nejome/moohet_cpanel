@extends('layout.master')

@push('styles')
    <link href="{{asset('argon/assets/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link href="{{asset('argon/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('argon/assets/css/argon.css?v=1.0.0')}}" rel="stylesheet">
@endpush

@section('content')

    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">

            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">لوحة التحكم</a>

            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">

                            @if(isset(Auth::user()->image) && Auth::user()->image != '')

                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="{{asset('images/'.Auth::user()->image)}}">

                                </span>

                            @else

                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="{{asset('images/man2.png')}}">

                                </span>

                            @endif

                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->customer->name}}</span>
                            </div>

                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right text-right">

                        <a href="{{url('/customers/'.Auth::user()->customer->id.'/edit')}}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>ملفي الشخصي</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="{{url('/logout')}}" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>تسجيل الخروج</span>
                        </a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 mb-5">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">

                    <div class="col-xl-4 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">مجموع مشترياتي</h5>
                                        <span class="h2 font-weight-bold mb-0">{{number_format($wallet->purchases_total, 2)}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-cyan text-white rounded-circle shadow">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">مجموع مبيعاتي</h5>
                                        <span class="h2 font-weight-bold mb-0">{{number_format($wallet->sales_total, 2)}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-store-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">رصيدي الحالي</h5>
                                        <span class="h2 font-weight-bold mb-0">{{number_format($public_wallet->current_balance, 2)}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row mt-5">

            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">عمليات الشراء</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">المنتج</th>
                                <th scope="col">نوع الدفع</th>
                                <th scope="col">سعر المنتج</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">المجموع</th>
                                <th scope="col">تاريخ العميلة</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $row)

                                <tr>

                                    <td>{{$row->order->product->name}}</td>

                                    <td>
                                        @if($row->payment_type == 0)
                                            دفع من محفظتي
                                        @elseif($row->payment_type == 1)
                                            دفع جديد
                                        @endif
                                    </td>

                                    <td>{{$row->order->product->price}} ريال سعودي</td>

                                    <td>{{$row->amount}}</td>

                                    <td>{{$row->total}} ريال سعودي</td>

                                    <td>{{$row->created_at->toDayDateTimeString()}}</td>

                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">معاملات شحن الرصيد</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">المبلغ</th>
                                <th scope="col">الحالة</th>
                                <th scope="col">رقم الفاتورة</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($paytabs as $row)

                                <tr>

                                    <td>{{$row->amount}} ريال سعودي</td>

                                    <td>

                                        @if($row->status == 0)
                                            <span class="text-danger">فشلت المعامله</span>
                                        @elseif($row->status == 1)
                                            <span class="text-success">تمت العميلة بنجاح</span>
                                        @elseif($row->status == 01)
                                            <span class="text-warning">المعاملة تحت المعالجة</span>
                                        @endif

                                    </td>

                                    <td>{{$row->pt_invoice_id}}</td>

                                    <td>

                                        @if($row->status == 1)

                                            <a href="#" class="text-info" data-toggle="modal" data-target="#myModal">طلب الإستعادة</a>

                                        @else

                                            -

                                        @endif

                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">إدخل سبب الإستعادة</h4>
                                                    </div>

                                                    <form method="POST" action="{{url('/my_wallet/'.$row->customer_id.'/refund_transaction/'.$row->id)}}">

                                                        {{csrf_field()}}

                                                        <div class="modal-body">

                                                            <div class="form-group row">

                                                                <label class="col-md-3" style="text-align: left !important; padding-top: 7px;">سبب الإستعادة</label>

                                                                <input type="text" name="refund_reason" class="col-md-7 form-control" placeholder="أدخل سبب الإستعادة">

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                                                            <input type="submit" class="btn btn-primary" value="ارسال">
                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{asset('argon/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
    <script src="{{asset('argon/assets/js/argon.js?v=1.0.0')}}"></script>
@endpush