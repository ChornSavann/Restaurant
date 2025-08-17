@extends('admin.layout.app')
@section('title', 'Food')
@section('food', 'food-menu-open')
@section('content')
@include('admin.font.index')
    <div class="app-content-header py-3">
        <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0" style="font-family: Cambria; font-weight:bold;">Foods Details</h3>
            <a href="{{ route('food.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-bowl-food me-1"></i> Add Food
            </a>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
                <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-message">
                <i class="fa fa-times-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Foods Table --}}
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">List of Foods</h4>
                <span class="text-muted small">{{ $foods->total() }} item(s)</span>
            </div>

            <div class="card-body p-0 table-responsive kh-battambang">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 70px;">រូបភាព</th>
                            <th>ឈ្មោះម្ហូប</th>
                            <th>ប្រភេទ</th>
                            <th>ពណ៌នា</th>
                            <th style="width: 230px;">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($foods as $index => $food)
                            <tr>
                                <!-- Number -->
                                <td class="text-center">{{ $foods->firstItem() + $index }}</td>

                                <!-- Image -->
                                <td class="text-center">
                                    <img src="{{ $food->image ? asset('foods/image/' . $food->image) : asset('images/default-food.png') }}"
                                        alt="{{ $food->title }}" class="rounded border"
                                        style="width:60px; height:60px; object-fit:cover;">
                                </td>

                                <!-- Food Name -->
                                <td class="fw-semibold text-center">{{ $food->title }}</td>

                                <!-- Category -->
                                <td class="fw-semibold text-center">{{ $food->category->name ?? 'មិនមានប្រភេទ' }}</td>

                                <!-- Description with tooltip -->
                                <td class="text-truncate" style="max-width: 250px;" title="{{ $food->desc ?? '-' }}">
                                    {{ $food->desc ?? '-' }}
                                </td>

                                <!-- Actions -->
                                <td class="text-center">
                                    <!-- View -->
                                    <a href="#" class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal"
                                        data-bs-target="#foodModal{{ $food->id }}" title="មើលលម្អិត">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('food.edit', $food->id) }}"
                                        class="btn btn-sm btn-outline-primary me-1" title="កែប្រែមុខម្ហូប">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('food.delete', $food->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('តើអ្នកប្រាកដថាចង់លុបម្ហូបនេះ?')"
                                            class="btn btn-sm btn-outline-danger" title="លុបម្ហូប">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-utensils fa-lg me-2"></i>មិនមានម្ហូប។
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="m-2 mt-2">
                {{ $foods->links() }}
            </div>
        </div>
    </div>

    {{-- Food Details Modal --}}
    @foreach ($foods as $food)
        <div class="modal fade kh-battambang" id="foodModal{{ $food->id }}" tabindex="-1"
            aria-labelledby="foodModalLabel{{ $food->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow border-0 rounded-4">

                    {{-- Modal Header --}}
                    <div class="modal-header bg-primary text-white py-3 px-4 rounded-top-4">
                        <h4 class="modal-title mb-0 fs-5" id="foodModalLabel{{ $food->id }}">
                            <i class="fas fa-utensils me-2"></i> ព័ត៌មានម្ហូប
                        </h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="modal-body p-4">
                        <div class="row align-items-center">

                            {{-- Food Image --}}
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <img src="{{ $food->image ? asset('foods/image/' . $food->image) : asset('images/default-food.png') }}"
                                    class="rounded shadow-sm border" style="width:150px; height:150px; object-fit:cover;"
                                    alt="{{ $food->title }}">
                            </div>

                            {{-- Food Details --}}
                            <div class="col-md-8 ps-md-4">
                                {{-- Title --}}
                                <h3 class="fw-bold mb-2" style="color:#2c3e50;">
                                    <i class="fa-solid fa-bowl-food me-1"></i> {{ $food->title }}
                                </h3>

                                {{-- Price --}}
                                <span class="badge rounded-pill text-white px-3 py-2 mb-3"
                                    style="background: linear-gradient(90deg, #ff7e5f, #feb47b); font-size:1.1rem;">
                                    <i class="fa-solid fa-dollar-sign me-1"></i> {{ number_format($food->price, 2) }} $
                                </span>

                                {{-- Description --}}
                                <p class="mb-2" style="color:#34495e;">
                                    <strong>ពណ៌នា:</strong> {{ $food->desc ?? '-' }}
                                </p>

                                {{-- Category --}}
                                <p class="mb-0">
                                    <strong>ប្រភេទ:</strong>
                                    <span class="text-white px-2 py-1 rounded" style="background-color: #3498db;">
                                        {{ $food->category->name ?? '-' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="modal-footer bg-light py-2 px-3 rounded-bottom-4">
                        <button type="button" class="btn btn-sm btn-outline-secondary fs-6" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> បិទ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Auto-dismiss alert after 5 seconds --}}
    <script>
        setTimeout(() => {
            document.querySelectorAll('#alert-message').forEach(alertEl => {
                const bsAlert = new bootstrap.Alert(alertEl);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @include('admin.msg.index')
@endsection
