<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-indigo-600 px-6 py-4 text-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Assignment Details</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.assignments.edit', $assignment->id) }}"
                           class="px-4 py-2 bg-white text-indigo-600 rounded-md hover:bg-indigo-50">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <a href="{{ route('admin.assignments.index') }}"
                           class="px-4 py-2 bg-indigo-700 text-white rounded-md hover:bg-indigo-800">
                            <i class="fas fa-arrow-left mr-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column - Basic Info -->
                    <div class="lg:col-span-2">
                        <!-- Title & Status -->
                        <div class="flex justify-between items-start mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $assignment->title }}</h2>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($assignment->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($assignment->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($assignment->status === 'completed') bg-green-100 text-green-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                            </span>
                        </div>

                        <!-- Subject & Deadline -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Subject</h3>
                                <p class="text-lg">{{ $assignment->subject ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Deadline</h3>
                                <p class="text-lg">
                                    @if($assignment->deadline)
                                        {{ \Carbon\Carbon::parse($assignment->deadline)->format('F j, Y') }}
                                    @else
                                        No deadline set
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Description</h3>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                @if($assignment->description)
                                    <p class="text-gray-800 whitespace-pre-line">{{ $assignment->description }}</p>
                                @else
                                    <p class="text-gray-400 italic">No description provided</p>
                                @endif
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Contact Information</h3>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
                                @if ($assignment->contact_type === 'whatsapp')
                                    <i class="fab fa-whatsapp text-2xl text-green-600 mr-3"></i>
                                    <div>
                                        <p class="font-medium">WhatsApp</p>
                                        <p class="text-gray-600">{{ $assignment->contact_info }}</p>
                                    </div>
                                @elseif($assignment->contact_type === 'telegram')
                                    <i class="fab fa-telegram text-2xl text-blue-500 mr-3"></i>
                                    <div>
                                        <p class="font-medium">Telegram</p>
                                        <p class="text-gray-600">{{ $assignment->contact_info }}</p>
                                    </div>
                                @elseif($assignment->contact_type === 'email')
                                    <i class="fas fa-envelope text-2xl text-red-500 mr-3"></i>
                                    <div>
                                        <p class="font-medium">Email</p>
                                        <p class="text-gray-600">{{ $assignment->contact_info }}</p>
                                    </div>
                                @else
                                    <i class="fas fa-comment-alt text-2xl text-gray-500 mr-3"></i>
                                    <div>
                                        <p class="font-medium">Other Contact Method</p>
                                        <p class="text-gray-600">{{ $assignment->contact_info }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Meta Info & Attachments -->
                    <div class="lg:col-span-1">
                        <!-- Pricing Information -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Pricing</h3>

                            @if($assignment->price)
                                @if ($assignment->promotionCode)
                                    @php
                                        $discount = $assignment->promotionCode->discount_percentage;
                                        $discountAmount = ($assignment->price * $discount) / 100;
                                        $finalPrice = $assignment->price - $discountAmount;
                                    @endphp
                                    <div class="mb-2">
                                        <p class="text-sm text-gray-600">Original Price</p>
                                        <p class="text-lg line-through text-gray-400">
                                            {{ $assignment->currency_type }}{{ number_format($assignment->price, 2) }}
                                        </p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-sm text-gray-600">Discount ({{ $discount }}%)</p>
                                        <p class="text-lg text-red-600">
                                            -{{ $assignment->currency_type }}{{ number_format($discountAmount, 2) }}
                                        </p>
                                    </div>
                                    <div class="mb-2 pt-2 border-t border-gray-200">
                                        <p class="text-sm text-gray-600">Final Price</p>
                                        <p class="text-2xl font-bold text-indigo-600">
                                            {{ $assignment->currency_type }}{{ number_format($finalPrice, 2) }}
                                        </p>
                                    </div>
                                    <div class="mt-2 text-sm text-green-600">
                                        <i class="fas fa-tag mr-1"></i>
                                        Promo Code: {{ $assignment->promotionCode->code }}
                                    </div>
                                @else
                                    <p class="text-2xl font-bold text-indigo-600">
                                        {{ $assignment->currency_type }}{{ number_format($assignment->price, 2) }}
                                    </p>
                                @endif
                            @else
                                <p class="text-gray-400 italic">Price not set</p>
                            @endif
                        </div>

                        <!-- Assignment Meta Information -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Assignment Details</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Created</span>
                                    <span class="text-gray-800">{{ $assignment->created_at->format('M j, Y g:i A') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Last Updated</span>
                                    <span class="text-gray-800">{{ $assignment->updated_at->format('M j, Y g:i A') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Assignment ID</span>
                                    <span class="text-gray-800">#{{ $assignment->id }}</span>
                                </div>
                                @if($assignment->user)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Client</span>
                                    <span class="text-gray-800">{{ $assignment->user->name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Attachments Section -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Attachments</h3>

                            @if($assignment->attachments && count($assignment->attachments) > 0)
                                <div class="space-y-2">
                                    @foreach($assignment->attachments as $attachment)
                                        <div class="flex items-center justify-between p-2 bg-white rounded border">
                                            <div class="flex items-center">
                                                <i class="fas fa-paperclip text-gray-400 mr-2"></i>
                                                <span class="text-sm truncate">{{ basename($attachment->file_path) }}</span>
                                            </div>
                                            <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                               target="_blank"
                                               class="text-indigo-600 hover:text-indigo-800 ml-2">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-400 italic">No attachments available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    @if($assignment->status !== 'completed')
                        <form action="#" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                <i class="fas fa-check-circle mr-1"></i> Mark as Completed
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.assignments.destroy', $assignment->id) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            <i class="fas fa-trash mr-1"></i> Delete Assignment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
