@extends('admin.layout.app')
@section('title', 'Stock')
@section('stock', 'active')

@section('content')
    @include('admin.font.index')

    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 fw-bold">Stock ផលិតផល</h3>
                <a href="{{ route('stocks.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> បន្ថែម Stock
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
                    <h4 class="card-title mb-0">បញ្ជី Stock</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px">#</th>
                                <th>រូបភាព</th>
                                <th>ឈ្មោះ</th>
                                <th>តម្លៃ</th>
                                <th>ចំនួននៅក្នុងស្តុក</th>
                                <th>ឯកតា</th>
                                <th>ពិពណ៌នា</th>
                                <th style="width:210px">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stocks as $index => $stock)
                                <tr>
                                    <td>{{ $stocks->firstItem() + $index }}</td>
                                    <td>
                                        @if ($stock->food && $stock->food->image)
                                            <img src="{{ asset('foods/image/' . $stock->food->image) }}"
                                                alt="{{ $stock->food->title }}"
                                                style="width:80px; height:60px; object-fit:cover; border-radius:5px;">
                                        @else
                                            <img src="https://placehold.co/80x60" alt="No Image" style="border-radius:5px;">
                                        @endif
                                    </td>
                                    <td>{{ $stock->food->title ?? '-' }}</td>
                                    <td>{{ $stock->food ? number_format($stock->food->price, 2) : '-' }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->unit ?? '-' }}</td>
                                    <td>{{ $stock->description ?? '-' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary me-1"
                                            data-bs-toggle="modal" data-bs-target="#stockModal{{ $stock->id }}"
                                            title="View Details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('stocks.edit', $stock->id) }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <!-- Discount -->
                                        <a href="#" class="btn btn-sm btn-outline-success me-1" data-bs-toggle="modal"
                                            data-bs-target="#discountModal{{ $stock->id }}" title="កំណត់ការបញ្ចុះតម្លៃ">
                                            <i class="fa-solid fa-percent"></i>
                                        </a>

                                        <form action="{{ route('stocks.delete', $stock->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('តើអ្នកប្រាកដថាចង់លុប Stock នេះ?')"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">មិនមាន Stock ទេ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-3 d-flex justify-content-end">
                    {{ $stocks->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Stock Modal --}}
    @foreach ($stocks as $stock)
        <div class="modal fade" id="stockModal{{ $stock->id }}" tabindex="-1"
            aria-labelledby="stockModalLabel{{ $stock->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content shadow border-0 rounded-4">
                    <div class="modal-header bg-primary text-white py-3 px-4 rounded-top-4">
                        <h5 class="modal-title fw-bold" id="stockModalLabel{{ $stock->id }}">
                            <i class="fa-solid fa-boxes-stacked me-2"></i> ព័ត៌មាន Stock
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4" style="font-family: 'Battambang', sans-serif;">
                        <div class="text-center mb-3">
                            @if ($stock->food && $stock->food->image)
                                <img src="{{ asset('foods/image/' . $stock->food->image) }}"
                                    alt="{{ $stock->food->title }}" class="rounded shadow-sm border"
                                    style="width:150px; height:120px; object-fit:cover;">
                            @else
                                <img src="https://placehold.co/150x120" alt="No Image" class="rounded border">
                            @endif
                        </div>
                        <h4 class="fw-bold mb-2 text-center">{{ $stock->food->title ?? '-' }}</h4>
                        <p class="text-muted mb-1"><strong>តម្លៃ:</strong>
                            {{ $stock->food ? number_format($stock->food->price, 2) : '-' }} $</p>
                        <p class="text-muted mb-1"><strong>ចំនួននៅក្នុងស្តុក:</strong> {{ $stock->quantity }}
                            {{ $stock->unit ?? '' }}</p>
                        <p class="text-muted mb-0"><strong>ពិពណ៌នា:</strong> {{ $stock->description ?? '-' }}</p>
                    </div>
                    <div class="modal-footer bg-light py-2 px-3 rounded-bottom-4">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> បិទ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

     {{-- Discount Modal --}}
     @foreach ($stocks as $stock )
     <div class="modal fade kh-battambang" id="discountModal{{ $stock->id }}" tabindex="-1"
         aria-labelledby="discountModalLabel{{ $stock->id }}" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content shadow border-0 rounded-4">

                 {{-- Modal Header --}}
                 <div class="modal-header bg-success text-white">
                     <h5 class="modal-title" id="discountModalLabel{{ $stock->id }}">
                         <i class="fa-solid fa-percent me-2"></i> កំណត់ការបញ្ចុះតម្លៃ
                     </h5>
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                 </div>

                 {{-- Modal Body --}}
                 <div class="modal-body">
                     <form action="{{route('discount.store',$stock->id)}}" method="POST">
                         @csrf
                         <input type="hidden" name="food_id" value="{{ $stock->id }}">

                         <div class="mb-3">
                             <label class="form-label">បញ្ចុះតម្លៃ (%)</label>
                             <input type="number" name="discount_percent" class="form-control" min="0"
                                 max="100" placeholder="ឧ. 10%">
                         </div>

                         <div class="mb-3">
                             <label class="form-label">ថ្ងៃចាប់ផ្តើម</label>
                             <input type="date" name="start_date" class="form-control">
                         </div>

                         <div class="mb-3">
                             <label class="form-label">ថ្ងៃបញ្ចប់</label>
                             <input type="date" name="end_date" class="form-control">
                         </div>

                         <button type="submit" class="btn btn-success w-100">
                             <i class="fa-solid fa-save me-1"></i> រក្សាទុក
                         </button>
                     </form>
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
