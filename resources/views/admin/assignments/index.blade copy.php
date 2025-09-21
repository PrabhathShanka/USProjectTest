 @extends('layouts.app')

 @section('title', 'Assignments Management')
 @section('meta_description',
     'Easily manage and track all your university assignments with our efficient Assignments
     Management system. Upload, monitor deadlines, and stay organized effortlessly.')

 @section('content')
     <div class="container mx-auto px-6 py-8">
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
                         <p class="text-2xl font-bold text-gray-900">24</p>
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
                         <p class="text-2xl font-bold text-gray-900">8</p>
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
                         <p class="text-2xl font-bold text-gray-900">12</p>
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
                         <p class="text-2xl font-bold text-gray-900">4</p>
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
                         <input type="text"
                             class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                             placeholder="Search assignments...">
                     </div>
                 </div>
                 <div class="flex space-x-4">
                     <select
                         class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                         <option>All Subjects</option>
                         <option>Computer Science</option>
                         <option>Medicine</option>
                         <option>Management</option>
                         <option>Other</option>
                     </select>
                     <select
                         class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                         <option>All Status</option>
                         <option>Pending</option>
                         <option>In Progress</option>
                         <option>Completed</option>
                     </select>
                 </div>
             </div>
         </div>

         <!-- Assignments Grid -->
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
             <!-- Assignment Card 1 -->
             <div class="bg-white rounded-lg shadow card-hover overflow-hidden">
                 <div class="p-6">
                     <div class="flex justify-between items-start mb-4">
                         <span class="subject-tag">Computer Science</span>
                         <span class="status-badge bg-yellow-100 text-yellow-800">Pending</span>
                     </div>
                     <h3 class="text-lg font-semibold text-gray-800 mb-2">Data Structures Project</h3>
                     <p class="text-gray-600 mb-4">Implement a binary search tree with traversal algorithms and test cases.
                     </p>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <i class="far fa-calendar-alt mr-2"></i>
                         <span>Due: 15 Aug 2023</span>
                     </div>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <span class="contact-badge mr-2">
                             <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                         </span>
                         <span>+1 234-567-890</span>
                     </div>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <span class="discount-badge mr-2">
                             <i class="fas fa-tag mr-1"></i> SUMMER2023
                         </span>
                         <span class="text-green-600 font-medium">15% off</span>
                     </div>

                     <div class="flex justify-between items-center">
                         <div>
                             <span class="text-lg font-bold text-indigo-600">$45.00</span>
                             <span class="text-sm text-gray-500 line-through ml-2">$53.00</span>
                         </div>
                         <div class="flex space-x-2">
                             <button class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-full">
                                 <i class="fas fa-edit"></i>
                             </button>
                             <button class="p-2 text-red-600 hover:bg-red-50 rounded-full">
                                 <i class="fas fa-trash"></i>
                             </button>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Assignment Card 2 -->
             <div class="bg-white rounded-lg shadow card-hover overflow-hidden">
                 <div class="p-6">
                     <div class="flex justify-between items-start mb-4">
                         <span class="subject-tag">Medicine</span>
                         <span class="status-badge bg-blue-100 text-blue-800">In Progress</span>
                     </div>
                     <h3 class="text-lg font-semibold text-gray-800 mb-2">Pharmacology Case Study</h3>
                     <p class="text-gray-600 mb-4">Analyze drug interactions in a complex patient case with multiple
                         comorbidities.</p>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <i class="far fa-calendar-alt mr-2"></i>
                         <span>Due: 20 Aug 2023</span>
                     </div>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <span class="contact-badge mr-2">
                             <i class="fas fa-envelope mr-1"></i> Email
                         </span>
                         <span>student@example.com</span>
                     </div>

                     <div class="flex justify-between items-center">
                         <span class="text-lg font-bold text-indigo-600">$65.00</span>
                         <div class="flex space-x-2">
                             <button class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-full">
                                 <i class="fas fa-edit"></i>
                             </button>
                             <button class="p-2 text-red-600 hover:bg-red-50 rounded-full">
                                 <i class="fas fa-trash"></i>
                             </button>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Assignment Card 3 -->
             <div class="bg-white rounded-lg shadow card-hover overflow-hidden">
                 <div class="p-6">
                     <div class="flex justify-between items-start mb-4">
                         <span class="subject-tag">Management</span>
                         <span class="status-badge bg-green-100 text-green-800">Completed</span>
                     </div>
                     <h3 class="text-lg font-semibold text-gray-800 mb-2">Business Strategy Analysis</h3>
                     <p class="text-gray-600 mb-4">Develop a comprehensive business strategy for a tech startup entering a
                         competitive market.</p>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <i class="far fa-calendar-alt mr-2"></i>
                         <span>Due: 10 Aug 2023</span>
                     </div>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <span class="contact-badge mr-2">
                             <i class="fab fa-telegram mr-1"></i> Telegram
                         </span>
                         <span>@student_user</span>
                     </div>

                     <div class="flex items-center text-sm text-gray-500 mb-4">
                         <span class="discount-badge mr-2">
                             <i class="fas fa-tag mr-1"></i> STUDENT15
                         </span>
                         <span class="text-green-600 font-medium">10% off</span>
                     </div>

                     <div class="flex justify-between items-center">
                         <div>
                             <span class="text-lg font-bold text-indigo-600">$55.00</span>
                             <span class="text-sm text-gray-500 line-through ml-2">$61.00</span>
                         </div>
                         <div class="flex space-x-2">
                             <button class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-full">
                                 <i class="fas fa-edit"></i>
                             </button>
                             <button class="p-2 text-red-600 hover:bg-red-50 rounded-full">
                                 <i class="fas fa-trash"></i>
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Load More Button -->
         <div class="mt-8 text-center">
             <button
                 class="px-6 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                 Load More Assignments
             </button>
         </div>
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
                             // Handle attachment.* errors (individual file errors)
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
         });
         // Modal functionality
         document.getElementById('newAssignmentBtn').addEventListener('click', function() {
             document.getElementById('newAssignmentModal').classList.remove('hidden');
         });
     </script>
 @endpush
