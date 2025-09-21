@extends('layouts.app')

@section('title', 'Promotions Code Management')
@section('meta_description',
    'Easily manage and track all your university assignments with our efficient Assignments
    Management system. Upload, monitor deadlines, and stay organized effortlessly.')

@section('content')
    <div class="container mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Promotions Code</h2>
            <button type="button" id="openAddModalBtn" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                New Code
            </button>

        </div>

        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="overflow-x-auto">

                <div id="tableContainer">
                </div>
            </div>
        </div>
        <x-add-promo-code-modal />
    </div>
@endsection

@push('scripts')
    <script>
        $('#openAddModalBtn').click(function() {
            $('#addPromoCodeModal').removeClass('hidden');
        })

        function fetchAllPromoCodes() {
            $.ajax({
                url: "{{ route('admin.promotions-code.fetchAllPromoCodes') }}",
                method: 'GET',
                success: function(response) {
                    $('#tableContainer').html(response);
                    $('#myTable').DataTable();
                }

            });
        }

    </script>
@endpush


@push('style')
    <style>
        div.dt-container select.dt-input {
            padding-right: 24px;
        }
    </style>
@endpush
