<div class="card">
    <div class="card-header">
        <h3 class="card-title">Latest Orders</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Popularity</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todayOrders as $order)
                        <tr>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="link-primary">
                                    OR{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                </a>
                            </td>
                            <td>
                                @if ($order->orderItems->count() > 0)
                                    {{ $order->orderItems->first()->food?->title ?? $order->orderItems->first()->food_name }}
                                    @if ($order->orderItems->count() > 1)
                                        + {{ $order->orderItems->count() - 1 }} more
                                    @endif
                                @else
                                    No items
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusClass = match (strtolower($order->status)) {
                                        'completed' => 'success',
                                        'pending' => 'warning',
                                        'delivered' => 'danger',
                                        'processing' => 'info',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge text-bg-{{ $statusClass }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <div id="table-sparkline-{{ $order->id }}"></div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No orders today</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer clearfix">
        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-primary float-start">
            Place New Order
        </a>
        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary float-end">
            View All Orders
        </a>
    </div>
</div>

<!-- Sparklines JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script>
    @foreach ($todayOrders as $order)
        $('#table-sparkline-{{ $order->id }}').sparkline([{{ implode(',', [rand(1,10), rand(1,10), rand(1,10), rand(1,10)]) }}], {
            type: 'line',
            width: '100%',
            height: '30',
            lineColor: '#0d6efd',
            fillColor: false,
            spotColor: '#0d6efd',
            minSpotColor: '#0d6efd',
            maxSpotColor: '#0d6efd'
        });
    @endforeach
</script>
