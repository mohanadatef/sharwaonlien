<!DOCTYPE html>
<html>
<head>
    @include('includes.admin.header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('includes.admin.main-header')
    @include('includes.admin.main-sidebar')
    <div class="content-wrapper">
        @include('includes.admin.error')
        <div style="margin-left: 30px;margin-right: 30px">
            <div align="center">{{ __('Information company delivery') }}</div>
            name : <input type="text" disabled value="{{$company_delivery->name}}" class="form-control">
            modile : <input type="text" disabled value="{{$company_delivery->modile}}" class="form-control">
            address : <input type="text" disabled value="{{$company_delivery->address}}" class="form-control">
            email : <input type="text" disabled value="{{$company_delivery->email}}" class="form-control">
            description : <textarea type="text" disabled class="form-control" name="description"
                                    placeholder="Enter You description">{{$company_delivery->description}}</textarea>
            @permission('company-delivery-cost')
            @if($company_delivery->performance == 0 || $company_delivery->count_order == 0 )
                performance : <input type="text" disabled value="0" class="form-control" name="performance"
                                     placeholder="Enter You count_order">
            @else
                performance : <input type="text" disabled
                                     value="{{$my_company_delivery->performance / $my_company_delivery->count_order}}"
                                     class="form-control">
            @endif
            count_order : <input type="text" disabled value="{{$company_delivery->count_order}}" class="form-control">
            paid_acount : <input type="text" disabled value="{{$company_delivery->paid_acount}}" class="form-control">
            remaining_account : <input type="text" disabled value="{{$company_delivery->remaining_account}}"
                                       class="form-control">
            @endpermission
            @if($company_delivery->statues == 1 )
                statues : <input type="text" disabled value="active" class="form-control">
            @else
                statues : <input type="text" disabled value="dactive" class="form-control">
            @endif
            <br>
            <div align="center">
                <a href="{{url('/admin/company_delivery')}}" class="btn btn-sm btn-primary">back</a>
            </div>
            <br>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>