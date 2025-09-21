<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($assignments as $assignment)
        <div class="bg-gray-100 rounded-lg shadow card-hover overflow-hidden">
            <div class="p-6">

                <!-- Subject + Status -->
                <div class="flex justify-between items-start mb-4">
                    <span class="subject-tag">{{ ucfirst($assignment->subject) }}</span>
                    <span
                        class="status-badge
                        @if ($assignment->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($assignment->status === 'in_progress') bg-blue-100 text-blue-800
                        @elseif($assignment->status === 'completed') bg-green-100 text-green-800 @endif
                    ">
                        {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                    </span>
                </div>

                <!-- Title -->
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    {{ $assignment->title }}
                </h3>

                <!-- Contact + Deadline -->
                <div class="flex justify-between">
                    <div class="flex flex-col items-start text-sm text-gray-500 mb-4">
                        <div class="contact-badge mr-2">
                            @if ($assignment->contact_type === 'whatsapp')
                                <i class="fab fa-whatsapp mr-1 text-green-600"></i> {{ $assignment->contact_info }}
                            @elseif($assignment->contact_type === 'telegram')
                                <i class="fab fa-telegram mr-1 text-blue-500"></i> {{ $assignment->contact_info }}
                            @elseif($assignment->contact_type === 'email')
                                <i class="fas fa-envelope mr-1 text-red-500"></i> {{ $assignment->contact_info }}
                            @else
                                <i class="fa fa-superpowers mr-1 text-gray-500"></i> Other
                                <div>{{ $assignment->contact_info }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="flex text-sm text-gray-500 mb-4">
                        <span><i class="far fa-calendar-alt mr-2"></i></span>
                        <span>Due: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}</span>
                    </div>
                </div>

                <!-- Price + Discount -->
                <div class="flex justify-between items-center ">
                    <div>
                        @if ($assignment->promotionCode && !is_null($assignment->price))
                            @php
                                $discount = $assignment->promotionCode->discount_percentage;
                                $discountAmount = ($assignment->price * $discount) / 100;
                                $finalPrice = $assignment->price - $discountAmount;
                            @endphp
                            <span class="text-lg font-bold text-indigo-600">
                                {{ $assignment->currency_type }}{{ number_format($finalPrice, 2) }}
                            </span>
                            <span class="text-sm text-gray-500 line-through ml-2">
                                {{ $assignment->currency_type }}{{ number_format($assignment->price, 2) }}
                            </span>
                            <span class="text-green-600 font-medium ">
                                {{ $discount }}% off
                            </span>
                        @elseif(is_null($assignment->price))
                            <span class="text-gray-400 italic">Price not set</span>
                        @else
                            <span class="text-lg font-bold text-indigo-600">
                                {{ $assignment->currency_type }}{{ number_format($assignment->price, 2) }}
                            </span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.assignments.show', $assignment->id) }}"
                            class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-full">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" id="{{ $assignment->id }}"
                            class="assignmentDelete p-2 text-red-600 hover:bg-red-50 rounded-full">
                            <i class="fas fa-trash"></i>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
