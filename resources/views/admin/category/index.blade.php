@extends('admin.layout.app')
@section('title', 'Category')
@section('category', 'active')

@section('content')

    {{-- Load Khmer Battambang font --}}
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
                <h3 class="mb-0 fw-bold">ប្រភេទម្ហូប</h3>
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i> បន្ថែមប្រភេទ
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
                    <h4 class="card-title mb-0">បញ្ជីប្រភេទម្ហូប</h4>
                </div>

                <div class="card-body p-0">
                    <div class="scroll">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>រូបភាព</th>
                                    <th>ឈ្មោះ</th>
                                    <th>ពិពណ៌នា</th>
                                    <th style="width:160px">សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <td>{{ $categories->firstItem() + $index }}</td>
                                        <td>
                                            @if ($category->image)
                                                <img src="{{ asset('category/images/' . $category->image) }}"
                                                    alt="{{ $category->name }}"
                                                    style="width:80px; height:60px; object-fit:cover; border-radius:5px;">
                                            @else
                                                <img src="https://placehold.co/80x60" alt="No Image" style="border-radius:5px;">
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description ?? '-' }}</td>
                                        <td>
                                            {{-- View Button --}}
                                            <a href="#" class="btn btn-sm btn-outline-secondary me-1"
                                                data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}"
                                                title="View Details">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-sm btn-outline-primary me-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('category.delete', $category->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('តើអ្នកប្រាកដថាចង់លុបប្រភេទនេះ?')"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">មិនមានប្រភេទម្ហូបទេ</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- Pagination --}}
                <div class="p-3 d-flex justify-content-end">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    @foreach ($categories as $category)
        <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1"
            aria-labelledby="categoryModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content shadow border-0 rounded-4">

                    {{-- Modal Header --}}
                    <div class="modal-header bg-primary text-white py-3 px-4 rounded-top-4">
                        <h5 class="modal-title fw-bold" id="categoryModalLabel{{ $category->id }}">
                            <i class="fa-solid fa-list me-2"></i> ព័ត៌មានប្រភេទ
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="modal-body p-4" style="font-family: 'Battambang', sans-serif;">
                        <div class="text-center mb-3">
                            @if ($category->image)
                                <img src="{{ asset('category/images/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="rounded shadow-sm border" style="width:150px; height:120px; object-fit:cover;">
                            @else
                                <img src="https://placehold.co/150x120" alt="No Image" class="rounded border">
                            @endif
                        </div>

                        <h4 class="fw-bold mb-2 text-center">{{ $category->name }}</h4>

                        <p class="text-muted mb-0"><strong>ពិពណ៌នា:</strong> {{ $category->description ?? '-' }}</p>
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


    {{-- Include messages --}}
    @include('admin.msg.index')

    {{-- Auto-dismiss alert after 5 seconds --}}
    <script>
        setTimeout(() => {
            const alertEl = document.getElementById('alert-message');
            if (alertEl) {
                const bsAlert = new bootstrap.Alert(alertEl);
                bsAlert.close();
            }
        }, 5000);
    </script>
 <style>
    .scroll {
        display: block;
        max-height: 450px;
        /* adjust height */
        overflow-y: auto;
        /* vertical scroll */
        overflow-x: auto;
        /* horizontal scroll if too many columns */
    }
</style>
@endsection
