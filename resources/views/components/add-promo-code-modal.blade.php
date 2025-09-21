<div id="addPromoCodeModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="w-full max-w-md p-6 mt-10 bg-white shadow-lg rounded-xl">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2 border-b" id="modelTitleCrate">
            <div class="mb-4 flex">
                <h2 id="modalTitle" class="text-lg font-semibold">New Promotion Code</h2>
            </div>
            <button id="closeDiscountModalBtn" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <!-- Form -->
        <form method="POST" id="addDiscountForm" enctype="multipart/form-data" class="mt-4 space-y-4" action="#">
            @csrf

            <div class="flex gap-4 justify-between hidden" id="editPromoCodeForm">

                <!-- Discount Percentage -->
                <div class="mb-4 flex-1">
                    <label class="block text-sm font-medium mb-1">Promotion Code</label>
                    <input type="text" step="0.01" name="promo_code" id="promo_code" readonly
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <!-- Status -->
                <div class="mb-4 flex-1">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                        <option value="1">Active</option>
                        <option value="2">Expired</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

            </div>
            <div class="flex gap-4 justify-between">

                <!-- Discount Percentage -->
                <div class="mb-4 flex-1">
                    <label for="discount_percentage" class="block text-sm font-medium text-gray-700">Discount Percentage
                        (%)</label>
                    <input type="number" name="discount_percentage" id="discount_percentage"
                        class="block w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="e.g. 15">
                    @error('discount_percentage')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expiry Date -->
                <div class="mb-4 flex-1">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" name="expiry_date" id="expiry_date"
                        class="block w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('expiry_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-2 pt-2">
                <button type="button" id="closeDiscountBtn"
                    class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
                <button type="submit" id="submitDiscount"
                    class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            fetchAllPromoCodes();

            $("#addDiscountForm").submit(function(e) {
                e.preventDefault();
                let url = "{{ route('admin.promotions-code.store') }}";
                let method = "POST";
                if ($(this).data('mode') == 'update') {
                    let promoCodeId = $(this).data("id");
                    url = "{{ route('admin.promotions-code.update', ':id') }}".replace(':id', promoCodeId);
                }
                let formData = new FormData(this);
                if ($(this).data('mode') == 'update') {
                    formData.append('_method', 'PUT');
                }
                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            closeModal();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                            fetchAllPromoCodes();

                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $(".error-text").remove();
                            if (errors.discount_percentage) {
                                $("#discount_percentage").after(
                                    '<p class="error-text text-red-600">' + errors
                                    .discount_percentage[0] + '</p>');
                            }
                            if (errors.expiry_date) {
                                $("#expiry_date").after('<p class="error-text text-red-600">' +
                                    errors.expiry_date[0] + '</p>');
                            }

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: 'Please try again.',
                                timer: 3000,
                            });
                            fetchAllPromoCodes();

                        }

                    }
                });
            });

            $(document).on('click', '.promoCodeEdit', function(e) {
                e.preventDefault();
                let promoCodeId = $(this).attr('id');
                $.ajax({
                    url: '/admin/promotions-code/edit/' + promoCodeId,
                    method: 'GET',
                    success: function(response) {
                        if (response.status == 200) {
                            $('#addPromoCodeModal').removeClass('hidden');
                            $('#editPromoCodeForm').removeClass('hidden');
                            $('#modalTitle').html("Edit Promotion code")
                            $('#submitDiscount').html("Update")
                            $("#promo_code").val(response.promoCode.promo_code);
                            $("#assigned_to").val(response.promoCode.assigned_to);
                            $("#status").val(response.promoCode.status);
                            $("#discount_percentage").val(response.promoCode
                                .discount_percentage);
                            $("#expiry_date").val(response.promoCode.expiry_date);

                            $("#addDiscountForm").data('mode', 'update').data('id',
                                promoCodeId);
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: 'Please try again.',
                            timer: 3000,
                        });
                    }
                });

            });

            $(document).on('click', '.promoCodeDelete', function(e) {
                e.preventDefault();
                let promoCodeId = $(this).attr('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/promotions-code/delete/' + promoCodeId,
                            method: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    fetchAllPromoCodes();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: response.message,
                                        timer: 3000,
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed!',
                                    text: 'Delete failed. Please try again.',
                                    timer: 3000,
                                });
                                fetchAllPromoCodes();
                            }
                        });
                    }
                });
            });
        });

        $('#openAddModalBtn').click(function() {
            $('#addPromoCodeModal').removeClass('hidden');
        });

        function closeModal() {
            $('#addPromoCodeModal').addClass('hidden');
            $('#addDiscountForm').trigger('reset');
            $('#editPromoCodeForm').addClass('hidden');
            $('#modalTitle').html("New Promotion Code");
            $('#submitDiscount').html("Save");
            $("#addDiscountForm").removeData('mode').removeData('id');
        }

        $('#closeDiscountModalBtn').click(function() {
            closeModal();
        });

        $('#closeDiscountBtn').click(function() {
            closeModal();
        });

        $('#addPromoCodeModal').on('click', function(event) {
            if (event.target === this) {
                closeModal();
                $(".error-text").remove();
            }
        });
    </script>
@endpush
