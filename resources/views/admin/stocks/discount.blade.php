@extends('admin.layout.app')
@section('title', 'Discount Stocks')
@section('discount', 'active')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        .btn,
        input,
        textarea,
        select {
            font-family: 'Battambang', sans-serif !important;
        }
    </style>

    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 fw-bold">បញ្ជី Discount Stocks</h3>
                <a href="#" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> បន្ថែម Discount
                </a>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
                    <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0">បញ្ជី Discount</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>រូបភាព</th>
                                <th>ម្ហូប</th>
                                <th>តម្លៃដើម</th>
                                <th>បញ្ចុះតម្លៃ (%)</th>
                                <th>តម្លៃក្រោយបញ្ចុះ</th>
                                <th>ថ្ងៃចាប់ផ្តើម</th>
                                <th>ថ្ងៃផុតកំណត់</th>
                                <th>ប្រភេទ</th>
                                <th style="width:160px">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($discounts as $index => $discount)
                                <tr>
                                    <td>{{ $discounts->firstItem() + $index }}</td>

                                    <td>
                                        @if(optional($discount->food)->image)
                                            <img src="{{ asset('foods/image/' . $discount->food->image) }}"
                                                 alt="{{ $discount->food->title }}"
                                                 style="width:80px; height:60px; object-fit:cover; border-radius:5px;">
                                        @else
                                            <img src="https://placehold.co/80x60" alt="No Image" style="border-radius:5px;">
                                        @endif
                                    </td>

                                    <td>{{ optional($discount->food)->title ?? '-' }}</td>
                                    <td>{{ number_format(optional($discount->stock)->price ?? 0, 2) }} $</td>
                                    <td>{{ $discount->discount_percent }} %</td>
                                    <td>
                                        {{ number_format((optional($discount->stock)->price ?? 0) * (1 - $discount->discount_percent / 100), 2) }} $
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($discount->start_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($discount->end_date)->format('d/m/Y') }}</td>
                                    <td>{{ optional(optional($discount->food)->category)->name ?? '-' }}</td>

                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                           data-bs-target="#discountModal{{ $discount->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{route('discount.edit',$discount->id)}}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{route('discount.destroy',$discount->id)}}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('តើអ្នកប្រាកដថាចង់លុប Discount នេះ?')"
                                                    class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">មិនមាន Discount Stocks ទេ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                {{-- Pagination --}}
                <div class="p-3 d-flex justify-content-end">
                    {{ $discounts->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Discount Modal --}}
    @foreach ($discounts as $discount)
        <div class="modal fade" id="discountModal{{ $discount->id }}" tabindex="-1"
            aria-labelledby="discountModalLabel{{ $discount->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow border-0 rounded-4">

                    {{-- Modal Header --}}
                    <div class="modal-header bg-primary text-white py-3 px-4 rounded-top-4">
                        <h5 class="modal-title fw-bold" id="discountModalLabel{{ $discount->id }}">
                            <i class="fa-solid fa-percent me-2"></i> Discount Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="modal-body p-4">
                        <div class="row align-items-center">

                            {{-- Food Image --}}
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                @if (optional($discount->food)->image)
                                    <img src="{{ asset('foods/image/' . $discount->food->image) }}"
                                        class="rounded shadow-sm border"
                                        style="width:150px; height:150px; object-fit:cover;"
                                        alt="{{ $discount->food->title }}">
                                @else
                                    <img src="https://placehold.co/150x150" class="rounded border" alt="No Image">
                                @endif
                            </div>

                            {{-- Food & Discount Details --}}
                            <div class="col-md-8 ps-md-4">
                                <h4 class="fw-bold mb-2">{{ optional($discount->food)->title ?? '-' }}</h4>

                                <p class="mb-1"><strong>តម្លៃដើម:</strong>
                                    {{ number_format(optional($discount->food)->price ?? 0, 2) }} $</p>
                                <p class="mb-1"><strong>បញ្ចុះតម្លៃ:</strong> {{ $discount->discount_percent }} %</p>
                                <p class="mb-1"><strong>តម្លៃក្រោយបញ្ចុះ:</strong>
                                    {{ number_format((optional($discount->food)->price ?? 0) * (1 - $discount->discount_percent / 100), 2) }}
                                    $</p>
                                <p class="mb-1"><strong>ថ្ងៃចាប់ផ្តើម:</strong>
                                    {{ \Carbon\Carbon::parse($discount->start_date)->format('d/m/Y') }}</p>
                                <p class="mb-1"><strong>ថ្ងៃផុតកំណត់:</strong>
                                    {{ \Carbon\Carbon::parse($discount->end_date)->format('d/m/Y') }}</p>
                                <p class="mb-0"><strong>ប្រភេទ:</strong>
                                    {{ optional($discount->food?->category)->name ?? '-' }}</p>
                                <p class="mb-0"><strong>ពិពណ៌នា:</strong> {{ optional($discount->food)->desc ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="modal-footer bg-light py-2 px-3 rounded-bottom-4">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> បិទ
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    {{-- Auto-dismiss alert --}}
    <script>
        setTimeout(() => {
            const alertEl = document.getElementById('alert-message');
            if (alertEl) {
                const bsAlert = new bootstrap.Alert(alertEl);
                bsAlert.close();
            }
        }, 5000);
    </script>
@endsection
