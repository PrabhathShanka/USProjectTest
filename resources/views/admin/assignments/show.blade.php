 @extends('layouts.app')

 @section('title', 'Assignments Management')
 @section('meta_description',
     'Easily manage and track all your university assignments with our efficient Assignments
     Management system. Upload, monitor deadlines, and stay organized effortlessly.')

 @section('content')


 @section('content')
     <!-- Header Section -->
     <div class="bg-indigo-600 px-4 sm:px-6 py-4 text-white">
         <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-3 sm:space-y-0">
             <div class="flex">
                 <h1 class="text-xl sm:text-2xl font-bold"> {{ $assignment->title }} Details</h1>
                 <span
                     class=" px-3 py-2 ml-4 rounded-full text-xs sm:text-sm font-medium
            @if ($assignment->status === 'pending') bg-yellow-100 text-yellow-800
            @elseif($assignment->status === 'in_progress') bg-blue-100 text-blue-800
            @elseif($assignment->status === 'completed') bg-green-100 text-green-800 @endif">
                     {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                 </span>
             </div>
             <div class="flex flex-col xs:flex-row space-y-2 xs:space-y-0 xs:space-x-2 sm:space-x-2">
                 <a href="{{ route('admin.assignments.index') }}"
                     class="px-3 py-2 sm:px-4 sm:py-2 bg-[#3c1667] text-white rounded-md hover:bg-indigo-800 text-center text-sm sm:text-base">
                     <i class="fas fa-arrow-left mr-1"></i> Back to List
                 </a>
             </div>
         </div>
     </div>
     <!-- Main Content -->
     <div class="p-4 sm:p-6">
         <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

             <!-- Right Column - Meta Info & Pricing -->
             <div class="lg:col-span-1 order-1 lg:order-2">
                 <!-- Pricing Information -->
                 <div class="bg-gray-50 p-3 sm:p-4 rounded-lg border border-gray-200 mb-4 sm:mb-6">
                     <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-2 sm:mb-3">Pricing</h3>

                     @if ($assignment->price)
                         @if ($assignment->promotionCode)
                             @php
                                 $discount = $assignment->promotionCode->discount_percentage;
                                 $discountAmount = ($assignment->price * $discount) / 100;
                                 $finalPrice = $assignment->price - $discountAmount;
                             @endphp
                             <div class="mb-2">
                                 <p class="text-xs sm:text-sm text-gray-600">Original Price</p>
                                 <p class="text-base sm:text-lg line-through text-gray-400">
                                     {{ $assignment->currency_type }}{{ number_format($assignment->price, 2) }}
                                 </p>
                             </div>
                             <div class="mb-2">
                                 <p class="text-xs sm:text-sm text-gray-600">Discount ({{ $discount }}%)</p>
                                 <p class="text-base sm:text-lg text-red-600">
                                     -{{ $assignment->currency_type }}{{ number_format($discountAmount, 2) }}
                                 </p>
                             </div>
                             <div class="mb-2 pt-2 border-t border-gray-200">
                                 <p class="text-xs sm:text-sm text-gray-600">Final Price</p>
                                 <p class="text-xl sm:text-2xl font-bold text-indigo-600">
                                     {{ $assignment->currency_type }}{{ number_format($finalPrice, 2) }}
                                 </p>
                             </div>
                             <div class="mt-2 text-xs sm:text-sm text-green-600">
                                 <i class="fas fa-tag mr-1"></i>
                                 Promo Code: {{ $assignment->promotionCode->promo_code }}
                             </div>
                         @else
                             <p class="text-xl sm:text-2xl font-bold text-indigo-600">
                                 {{ $assignment->currency_type }}{{ number_format($assignment->price, 2) }}
                             </p>
                         @endif
                     @else
                         <p class="text-gray-400 italic text-sm sm:text-base">Price not set</p>
                     @endif
                 </div>

                 <!-- Assignment Meta Information -->
                 <div class="bg-gray-50 p-3 sm:p-4 rounded-lg border border-gray-200 mb-4 sm:mb-6">
                     <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-2 sm:mb-3">Assignment Details</h3>
                     <div class="space-y-2">
                         @if ($assignment->user)
                             <div class="flex justify-between">
                                 <span class="text-xs sm:text-sm text-gray-600">Client</span>
                                 <span class="text-xs sm:text-sm text-gray-800">{{ $assignment->user->name }}</span>
                             </div>
                         @endif
                         <div class="flex justify-between">
                             <span class="text-xs sm:text-sm text-gray-600">Deadline</span>
                             <span class="text-xs sm:text-sm text-gray-800">
                                 {{ \Carbon\Carbon::parse($assignment->deadline)->format('F j, Y') }}</span>
                         </div>
                         <div class="flex justify-between">
                             <span class="text-xs sm:text-sm text-gray-600">Created</span>
                             <span
                                 class="text-xs sm:text-sm text-gray-800">{{ $assignment->created_at->format('M j, Y g:i A') }}</span>
                         </div>
                         <div class="flex justify-between">
                             <span class="text-xs sm:text-sm text-gray-600">Last Updated</span>
                             <span
                                 class="text-xs sm:text-sm text-gray-800">{{ $assignment->updated_at->format('M j, Y g:i A') }}</span>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Left Column - Basic Info -->
             <div class="lg:col-span-2 order-2 lg:order-1">
                 <!-- Title & Status -->
                 <div
                     class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-4 sm:mb-6 space-y-2 lg:space-y-0">
                     <h2 class="text-xl sm:text-2xl font-bold text-gray-800 break-words">
                         {{ $assignment->title }}
                     </h2>
                     <span
                         class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium
            @if ($assignment->status === 'pending') bg-yellow-100 text-yellow-800
            @elseif($assignment->status === 'in_progress') bg-blue-100 text-blue-800
            @elseif($assignment->status === 'completed') bg-green-100 text-green-800 @endif">
                         {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                     </span>
                 </div>


                 <!-- Subject & Deadline -->
                 <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4 sm:mb-6">
                     <div>
                         <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-1">Subject</h3>
                         <p class="text-base sm:text-lg">{{ $assignment->subject ?? 'Not specified' }}</p>
                     </div>
                     <div>
                         <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-1">Deadline</h3>
                         <p class="text-base sm:text-lg">
                             @if ($assignment->deadline)
                                 {{ \Carbon\Carbon::parse($assignment->deadline)->format('F j, Y') }}
                             @else
                                 No deadline set
                             @endif
                         </p>
                     </div>
                 </div>

                 <!-- Description -->
                 <div class="mb-4 sm:mb-6">
                     <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-1">Description</h3>
                     <div class="bg-gray-50 p-3 sm:p-4 rounded-lg border border-gray-200">
                         @if ($assignment->description)
                             <p class="text-gray-800 whitespace-pre-line text-sm sm:text-base">
                                 {{ $assignment->description }}</p>
                         @else
                             <p class="text-gray-400 italic text-sm sm:text-base">No description provided</p>
                         @endif
                     </div>
                 </div>

                 <!-- Contact Information -->
                 <div class="mb-4 sm:mb-6">
                     <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-1">Contact Information</h3>
                     <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
                         @if ($assignment->contact_type === 'whatsapp')
                             <i class="fab fa-whatsapp text-xl sm:text-2xl text-green-600 mr-2 sm:mr-3"></i>
                             <div>
                                 <p class="font-medium text-sm sm:text-base">WhatsApp</p>
                                 <p class="text-gray-600 text-sm sm:text-base">{{ $assignment->contact_info }}</p>
                             </div>
                         @elseif($assignment->contact_type === 'telegram')
                             <i class="fab fa-telegram text-xl sm:text-2xl text-blue-500 mr-2 sm:mr-3"></i>
                             <div>
                                 <p class="font-medium text-sm sm:text-base">Telegram</p>
                                 <p class="text-gray-600 text-sm sm:text-base">{{ $assignment->contact_info }}</p>
                             </div>
                         @elseif($assignment->contact_type === 'email')
                             <i class="fas fa-envelope text-xl sm:text-2xl text-red-500 mr-2 sm:mr-3"></i>
                             <div>
                                 <p class="font-medium text-sm sm:text-base">Email</p>
                                 <p class="text-gray-600 text-sm sm:text-base">{{ $assignment->contact_info }}</p>
                             </div>
                         @else
                             <i class="fas fa-comment-alt text-xl sm:text-2xl text-gray-500 mr-2 sm:mr-3"></i>
                             <div>
                                 <p class="font-medium text-sm sm:text-base">Other Contact Method</p>
                                 <p class="text-gray-600 text-sm sm:text-base">{{ $assignment->contact_info }}</p>
                             </div>
                         @endif
                     </div>
                 </div>

                 <!-- Attachments -->
                 <div class="bg-gray-50 p-3 sm:p-4 rounded-lg border border-gray-200 mb-4 sm:mb-0">
                     <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-2 sm:mb-3">Attachments</h3>

                     @if ($assignment->attachments && count($assignment->attachments) > 0)
                         <div class="space-y-2">
                             @foreach ($assignment->attachments as $attachment)
                                 <div class="flex items-center justify-between p-2 bg-white rounded border">
                                     <div class="flex items-center truncate">
                                         <i class="fas fa-paperclip text-gray-400 mr-2 text-sm sm:text-base"></i>
                                         <span
                                             class="text-xs sm:text-sm truncate">{{ basename($attachment->file_path) }}</span>
                                     </div>
                                     <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank"
                                         class="text-indigo-600 hover:text-indigo-800 ml-2 text-sm sm:text-base">
                                         <i class="fas fa-download"></i>
                                     </a>
                                 </div>
                             @endforeach
                         </div>
                     @else
                         <p class="text-gray-400 italic text-sm sm:text-base">No attachments available</p>
                     @endif
                 </div>

                 <div
                     class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200 flex flex-col xs:flex-row justify-end space-y-3 xs:space-y-0 xs:space-x-3">


                     {{--  edit button  --}}

                     <!-- Add this button where you want the edit functionality -->
                     <button onclick="openEditModal({{ $assignment->id }})"
                         class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                         <i class="fas fa-edit mr-1"></i> Edit Assignment
                     </button>

                     <!-- Include the edit form component at the bottom of your view -->
                     {{--  @include('components.assignment-edit-form')  --}}


                 </div>

             </div>


         </div>
     </div>
 @endsection

@endsection

@push('styles')
 <style>
     #editAssignmentModal {
         display: none;
         transition: opacity 0.3s ease;
     }

     #editAssignmentModal:not(.hidden) {
         display: flex;
         align-items: flex-start;
         justify-content: center;
     }

     .overflow-hidden {
         overflow: hidden;
     }
 </style>
@endpush

@push('scripts')
 <script>
     let currentAssignmentId = null;

     // Function to open edit modal
     function openEditModal(assignmentId) {
         currentAssignmentId = assignmentId;
         fetchAssignmentData(assignmentId);
         document.getElementById('editAssignmentModal').classList.remove('hidden');
         document.body.classList.add('overflow-hidden');
     }

     // Function to close edit modal
     function closeEditModal() {
         document.getElementById('editAssignmentModal').classList.add('hidden');
         document.body.classList.remove('overflow-hidden');
         clearErrorMessages();
     }

     // Fetch assignment data via AJAX
     function fetchAssignmentData(assignmentId) {
         fetch(`/admin/assignments/${assignmentId}/edit`)
             .then(response => {
                 if (!response.ok) {
                     throw new Error('Network response was not ok');
                 }
                 return response.json();
             })
             .then(data => {
                 populateEditForm(data);
             })
             .catch(error => {
                 console.error('Error fetching assignment data:', error);
                 alert('Error loading assignment data. Please try again.');
             });
     }

     // Populate form with assignment data
     function populateEditForm(data) {
         document.getElementById('edit_title').value = data.title || '';
         document.getElementById('edit_subject').value = data.subject || '';
         document.getElementById('edit_description').value = data.description || '';
         document.getElementById('edit_deadline').value = data.deadline || '';
         document.getElementById('edit_contact_type').value = data.contact_type || 'whatsapp';
         document.getElementById('edit_contact_info').value = data.contact_info || '';
         document.getElementById('edit_currency_type').value = data.currency_type || '$';
         document.getElementById('edit_price').value = data.price || '';
         document.getElementById('edit_status').value = data.status || 'pending';

         // Display current attachments
         const attachmentsContainer = document.getElementById('current-attachments');
         if (data.attachments && data.attachments.length > 0) {
             attachmentsContainer.innerHTML = '<p class="text-sm font-medium text-gray-700">Current Attachments:</p>';
             data.attachments.forEach(attachment => {
                 const attachmentElement = document.createElement('div');
                 attachmentElement.className = 'flex items-center justify-between p-2 bg-gray-100 rounded';
                 attachmentElement.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-paperclip text-gray-400 mr-2"></i>
                        <span class="text-sm">${attachment.file_name}</span>
                    </div>
                    <button type="button" onclick="deleteAttachment(${attachment.id})" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                 attachmentsContainer.appendChild(attachmentElement);
             });
         } else {
             attachmentsContainer.innerHTML = '<p class="text-sm text-gray-500">No attachments</p>';
         }
     }

     // Handle form submission
     document.getElementById('editAssignmentForm').addEventListener('submit', function(e) {
         e.preventDefault();

         const formData = new FormData(this);

         fetch(`/admin/assignments/${currentAssignmentId}`, {
                 method: 'POST',
                 body: formData,
                 headers: {
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                         'content'),
                     'X-HTTP-Method-Override': 'PUT'
                 }
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     // Close modal and refresh page or update UI
                     closeEditModal();
                     alert('Assignment updated successfully!');
                     window.location.reload(); // Or update specific elements instead of reloading
                 } else if (data.errors) {
                     // Display validation errors
                     displayErrors(data.errors);
                 }
             })
             .catch(error => {
                 console.error('Error updating assignment:', error);
                 alert('Error updating assignment. Please try again.');
             });
     });

     // Display validation errors
     function displayErrors(errors) {
         clearErrorMessages();

         for (const field in errors) {
             const errorElement = document.getElementById(`edit_${field}_error`);
             if (errorElement) {
                 errorElement.textContent = errors[field][0];
             }
         }
     }

     // Clear error messages
     function clearErrorMessages() {
         const errorElements = document.querySelectorAll('[id$="_error"]');
         errorElements.forEach(element => {
             element.textContent = '';
         });
     }

     // Delete attachment
     function deleteAttachment(attachmentId) {
         if (confirm('Are you sure you want to delete this attachment?')) {
             fetch(`/admin/assignment-attachments/${attachmentId}`, {
                     method: 'DELETE',
                     headers: {
                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                         'Content-Type': 'application/json'
                     }
                 })
                 .then(response => response.json())
                 .then(data => {
                     if (data.success) {
                         // Remove attachment from UI
                         fetchAssignmentData(currentAssignmentId);
                     } else {
                         alert('Error deleting attachment.');
                     }
                 })
                 .catch(error => {
                     console.error('Error deleting attachment:', error);
                     alert('Error deleting attachment. Please try again.');
                 });
         }
     }
 </script>
@endpush
