@extends('admin.layout.app')
@section('title', 'របាយការណ៍ម្ហូប')
@section('content')
    @include('admin.font.index')

    <div class="container-fluid py-4">
        <h3>របាយការណ៍ម្ហូប</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-primary text-white">មុខម្ហូបដែលលក់ច្រើន</div>
                    {{-- <div class="card-body"> --}}
                    <table class="table table-sm table-bordered">
                        <thead  >
                            <tr>
                                <th style="width:200px;">ម្ហូប</th>
                                <th class="text-center">ចំនួនលក់</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($topFoods as $item)
                                <tr>

                                    <td>{{ $item->food->title }}</td>
                                    <td class="text-center">{{ $item->total_qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-danger text-white">មុខម្ហូបដែលមិនទាន់លក់</div>
                    <div class="card-body">
                        <ul>
                            @forelse($unsoldFoods as $food)
                                <li>{{ $food->title }}</li>
                                {{-- <li>{{ $food->stock->quantity }}</li> --}}
                            @empty
                                <li class="text-muted">ទាំងអស់មានការលក់</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
