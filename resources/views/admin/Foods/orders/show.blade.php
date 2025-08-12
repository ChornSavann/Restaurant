<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table m-0">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Popularity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('orders.today') }}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                {{ $order->order_number }}
                            </a>
                        </td>
                        <td>
                            @foreach ($order->orderItems as $item)
                                <div>{{ $item->food_name }} (x{{ $item->quantity }})</div>
                            @endforeach
                        </td>
                        <td>
                            <span class="badge text-bg-{{ $order->statusBadgeClass() }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <div id="table-sparkline-{{ $loop->iteration }}"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<div class="card-footer clearfix">
    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary float-end">
        View All Orders
    </a>
    {{-- <div class="my-2 px-3">
        {{ $orders->links() }}

    </div> --}}
</div>
