@extends('frontend.layouts.user_panel')

@section('panel_content')
    {{-- <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Products') }}</h1>
        </div>
      </div>
    </div> --}}

    <div class="row gutters-10">


        @php
            $customer_package = \App\Models\CustomerPackage::find(Auth::user()->customer_package_id);
        @endphp


    </div>

    <div class="card">
        <div class="card-header">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Your Products') }}</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ translate('Name')}}</th>
                        <th data-breakpoints="lg">{{ translate('Price')}}</th>
                        <th data-breakpoints="lg">{{ translate('Available Status')}}</th>
                        <th data-breakpoints="lg">{{ translate('Admin Status')}}</th>
                        <th class="text-right">{{ translate('Options')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><a href="{{ route('customer.product', $product->slug) }}">{{ $product->name }}</a></td>
                        <td>{{ single_price($product->unit_price) }}</td>
                        <td><label class="aiz-switch aiz-switch-success mb-0">
                            <input onchange="update_status(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->status == 1) echo "checked";?> >
                            <span class="slider round"></span></label>
                        </td>
                        <td>
                            @if ($product->published == '1')
                                <span class="badge badge-inline badge-success">{{ translate('PUBLISHED')}}</span>
                            @else
                                <span class="badge badge-inline badge-info">{{ translate('PENDING')}}</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('customer.products.edit', encrypt($product->id) )}}" title="{{ translate('Edit') }}">
							   <i class="las la-edit"></i>
						    </a>

                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('customer.products.destroy', $product->id)}}" title="{{ translate('Delete') }}">
                              <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $products->links() }}
          	</div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('customer_products.update.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Status has been updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

    </script>
@endsection
