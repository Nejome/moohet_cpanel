@extends('layout.master')

@section('content')

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">سحب رصيد</h1>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">

                @if(session()->has('order_created')) <div class="alert alert-info">{{session()->get('order_created')}}</div> @endif

                @if(session()->has('updated_success')) <div class="alert alert-warning">{{session()->get('updated_success')}}</div> @endif

                @if(session()->has('deleted_success')) <div class="alert alert-danger">{{session()->get('deleted_success')}}</div> @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        طلباتي
                    </div>

                    <div class="panel-body">

                        @if(count($orders) > 0)

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover text-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center">المبلغ</th>
                                        <th class="text-center">البنك</th>
                                        <th class="text-center">الفرع</th>
                                        <th class="text-center">رقم الحساب</th>
                                        <th class="text-center">ملاحظات</th>
                                        <th class="text-center">العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)

                                        <tr>

                                            <td>{{$order->amount}}</td>

                                            <td>{{$order->bank}}</td>

                                            <td>{{$order->branch}}</td>

                                            <td>{{$order->account_number}}</td>

                                            <td>
                                                @if($order->notes == null)
                                                    لا توجد
                                                @else
                                                    {{$order->notes}}
                                                @endif
                                            </td>

                                            <td>

                                                @if($order->showed == 0)

                                                    <a href="{{url('/revoke_orders/'.$order->id.'/edit')}}" class="text-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;

                                                |

                                                    &nbsp;<a href="{{url('/revoke_orders/'.$order->id.'/delete')}}" class="text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                                @else

                                                    -

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        @else

                            <h1>لا توجد لديك طلبات سحب رصيد جديدة</h1>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection


