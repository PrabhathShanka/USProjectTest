 @extends('layouts.app')

 @section('title', 'Assignments Management')
 @section('meta_description',
     'Easily manage and track all your university assignments with our efficient Assignments
     Management system. Upload, monitor deadlines, and stay organized effortlessly.')

 @section('content')

     <!-- Header -->
     <div class="flex items-center justify-between mb-6">
         <h2 class="text-2xl font-bold text-gray-800">Assignments</h2>
         <button id="newAssignmentBtn"
             class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
             <i class="mr-1 fas fa-plus"></i> New Assignment
         </button>
     </div>

     <!-- Stats Cards -->
     <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
         <div class="bg-white p-4 rounded-lg shadow">
             <div class="flex items-center">
                 <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                     <i class="fas fa-file-alt text-xl"></i>
                 </div>
                 <div class="ml-4">
                     <p class="text-sm font-medium text-gray-600">Total Assignments</p>
                     <p class="text-2xl font-bold text-gray-900">{{ $assignments['total'] }}</p>
                 </div>
             </div>
         </div>

         <div class="bg-white p-4 rounded-lg shadow">
             <div class="flex items-center">
                 <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                     <i class="fas fa-clock text-xl"></i>
                 </div>
                 <div class="ml-4">
                     <p class="text-sm font-medium text-gray-600">Pending</p>
                     <p class="text-2xl font-bold text-gray-900">{{ $assignments['pending'] }}</p>
                 </div>
             </div>
         </div>

         <div class="bg-white p-4 rounded-lg shadow">
             <div class="flex items-center">
                 <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                     <i class="fas fa-spinner text-xl"></i>
                 </div>
                 <div class="ml-4">
                     <p class="text-sm font-medium text-gray-600">In Progress</p>
                     <p class="text-2xl font-bold text-gray-900">{{ $assignments['inProgress'] }}</p>
                 </div>
             </div>
         </div>

         <div class="bg-white p-4 rounded-lg shadow">
             <div class="flex items-center">
                 <div class="p-3 rounded-full bg-green-100 text-green-600">
                     <i class="fas fa-check-circle text-xl"></i>
                 </div>
                 <div class="ml-4">
                     <p class="text-sm font-medium text-gray-600">Completed</p>
                     <p class="text-2xl font-bold text-gray-900">{{ $assignments['completed'] }}</p>
                 </div>
             </div>
         </div>
     </div>

     <!-- Filters and Search -->
     <div class="bg-white p-4 rounded-lg shadow mb-6">
         <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
             <div class="flex-1">
                 <div class="relative">
                     <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                         <i class="fas fa-search text-gray-400"></i>
                     </div>
                     <input type="text" name="search"
                         class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                         placeholder="Search assignments title...">
                 </div>
             </div>
             <div class="flex space-x-4">
                 <select name="status"
                     class="border border-gray-300 rounded-md px-7 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                     <option value="">All Assignments</option>
                     <option value="pending">Pending Assignments</option>
                     <option value="in_progress">In Progress Assignments</option>
                     <option value="completed">Completed Assignments</option>
                 </select>
             </div>

             {{--  reset button  --}}
             <div>
                 <button id="resetFilters"
                     class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ml-3">
                     Reset Filters
                 </button>
             </div>
         </div>
     </div>

     <div id="assignmentGrid">
         <x-assignment-grid :assignments="$assignments['assignments']" />
     </div>

     <!-- Pagination -->
     <div class="mt-6" id="paginationLinks">
         {{ $assignments['assignments']->links() }}
     </div>


     <x-assignment-form-modal />

 @endsection

 @push('style')
     <style>
         .card-hover {
             transition: all 0.3s ease;
         }

         .card-hover:hover {
             transform: translateY(-5px);
             box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.2);
         }

         .status-badge {
             padding: 0.25rem 0.75rem;
             border-radius: 9999px;
             font-size: 0.75rem;
             font-weight: 600;
         }

         .subject-tag {
             display: inline-block;
             padding: 0.25rem 0.5rem;
             border-radius: 0.375rem;
             font-size: 0.75rem;
             font-weight: 500;
             background-color: #e0e7ff;
             color: #3730a3;
         }

         .contact-badge {
             display: inline-flex;
             align-items: center;
             padding: 0.25rem 0.5rem;
             border-radius: 0.375rem;
             font-size: 0.75rem;
             font-weight: 500;
             background-color: #f0f9ff;
             color: #0c4a6e;
         }

         .discount-badge {
             display: inline-flex;
             align-items: center;
             padding: 0.25rem 0.5rem;
             border-radius: 0.375rem;
             font-size: 0.75rem;
             font-weight: 500;
             background-color: #dcfce7;
             color: #166534;
         }
     </style>
 @endpush

 @push('scripts')
     <script>
         $(document).ready(function() {
             $('#applyPromo').on('click', function() {
                 let promoCode = $('#promoCode').val();
                 if (!promoCode) {
                     $('#promoMessage')
                         .removeClass('hidden text-green-600')
                         .addClass('text-red-600')
                         .text('Please enter a promo code.');
                     return;
                 }
                 let regex = /^USPC\d{5}$/;
                 if (!regex.test(promoCode)) {
                     $('#promoMessage')
                         .removeClass('hidden text-green-600')
                         .addClass('text-red-600')
                         .text('Invalid promo code.');
                     return;
                 }

                 $.ajax({
                     url: "/admin/promotions-code/check",
                     method: "GET",
                     data: {
                         promo_code: promoCode,
                     },
                     success: function(response) {
                         if (response.status == 200) {
                             $('#promoMessage')
                                 .removeClass('hidden text-red-600')
                                 .addClass('text-green-600')
                                 .text(response.message);
                             $('.promo_code').val(response.id);
                         } else {
                             $('#promoMessage')
                                 .removeClass('hidden text-green-600')
                                 .addClass('text-red-600')
                                 .text(response.message);
                             $('#promoCodeId').val('');
                         }
                     }
                 });
             });

             $('#assignmentForm').on('submit', function(e) {
                 e.preventDefault();

                 $(".error-text").remove();

                 let formData = new FormData(this);

                 // Clear old files from formData (if any)
                 formData.delete('attachments[]');

                 // Append selected files
                 selectedFiles.forEach(file => {
                     formData.append('attachments[]', file);
                 });

                 $.ajax({
                     url: '/admin/assignments/store',
                     method: 'POST',
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(res) {
                         Swal.fire('Success!', 'Assignment created successfully.', 'success');
                         closeModel();
                         loadAssignments();
                     },
                     error: function(xhr, status, error) {
                         if (xhr.status === 422) {
                             var errors = xhr.responseJSON.errors;
                             console.log(errors);

                             // Handle all validation errors
                             if (errors.title) {
                                 $("#title").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.title[0] + '</p>');
                             }
                             if (errors.subject) {
                                 $("#subject").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.subject[0] + '</p>');
                             }
                             if (errors.description) {
                                 $("#description").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.description[0] + '</p>');
                             }
                             if (errors.contact_info) {
                                 $("#contactInfo").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.contact_info[0] + '</p>');
                             }
                             if (errors.contact_type) {
                                 $("#contactType").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.contact_type[0] + '</p>');
                             }
                             if (errors.deadline) {
                                 $("#deadline").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.deadline[0] + '</p>');
                             }
                             if (errors.promo_code) {
                                 $("#promoCode").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.promo_code[0] + '</p>');
                             }
                             if (errors.attachments) {
                                 $("#fileInput").after(
                                     '<p class="error-text text-red-600 text-xs mt-1">' +
                                     errors.attachments[0] + '</p>');
                             }
                             for (const key in errors) {
                                 if (key.startsWith('attachments.')) {
                                     $("#fileInput").after(
                                         '<p class="error-text text-red-600 text-xs mt-1">' +
                                         errors[key][0] + '</p>');
                                 }
                             }

                         } else {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Failed!',
                                 text: 'Please try again.',
                                 timer: 3000,
                             });
                             closeModel();
                         }
                     }
                 });
             });


             //delete assignment
             $(document).on('click', '.assignmentDelete', function(e) {
                 e.preventDefault();
                 let assignmentId = $(this).attr('id');
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
                             url: '/admin/assignments/delete/' + assignmentId,
                             method: 'DELETE',
                             data: {
                                 "_token": "{{ csrf_token() }}",
                             },
                             success: function(response) {
                                 if (response.status == 200) {
                                    alert(response.status);
                                     loadAssignments();
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
                                 loadAssignments();
                             }
                         });
                     }
                 });
             });




         });
         // Modal functionality
         document.getElementById('newAssignmentBtn').addEventListener('click', function() {
             document.getElementById('newAssignmentModal').classList.remove('hidden');
         });


         function loadAssignments(extraFilters = {}) {
             // Always get current filter values
             let filters = {
                 search: $("input[name='search']").val(),
                 status: $("select[name='status']").val(),
             };

             // Merge pagination or any other extra filter
             filters = {
                 ...filters,
                 ...extraFilters
             };

             $.ajax({
                 url: "{{ route('admin.assignments.filter') }}",
                 type: "GET",
                 data: filters,
                 success: function(res) {
                     $("#assignmentGrid").html(res.html);
                     $("#paginationLinks").html(res.pagination);
                     attachPaginationHandlers();
                 }
             });
         }

         // Function to attach pagination event handlers
         function attachPaginationHandlers() {
             $(document).off("click", "#paginationLinks a"); // Remove existing handlers
             $(document).on("click", "#paginationLinks a", function(e) {
                 e.preventDefault();
                 let page = $(this).attr("href").split("page=")[1];
                 loadAssignments({
                     page: page
                 });
             });
         }

         // Search event
         $("input[name='search']").on("keyup", function() {
             loadAssignments();
         });

         // Status filter
         $("select[name='status']").on("change", function() {
             loadAssignments();
         });

         //resetFilters
         $("#resetFilters").on("click", function() {
             $("input[name='search']").val("");
             $("select[name='status']").val("");
             loadAssignments();
         })
     </script>
 @endpush
