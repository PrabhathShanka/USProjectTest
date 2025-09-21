<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="editAssignmentModal">
    <div class="relative top-20 mx-auto p-4 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">
                Edit Assignment
            </h3>
            <button type="button" onclick="closeEditModal()"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal body -->
        <form id="editAssignmentForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 gap-6 mb-6">
                    <!-- Title -->
                    <div>
                        <label for="edit_title" class="block mb-2 text-sm font-medium text-gray-900">Title *</label>
                        <input type="text" id="edit_title" name="title" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <span id="edit_title_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="edit_subject" class="block mb-2 text-sm font-medium text-gray-900">Subject</label>
                        <input type="text" id="edit_subject" name="subject"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <span id="edit_subject_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="edit_description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="edit_description" name="description" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                        <span id="edit_description_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Deadline -->
                    <div>
                        <label for="edit_deadline" class="block mb-2 text-sm font-medium text-gray-900">Deadline</label>
                        <input type="date" id="edit_deadline" name="deadline"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <span id="edit_deadline_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Contact Type -->
                    <div>
                        <label for="edit_contact_type" class="block mb-2 text-sm font-medium text-gray-900">Contact Type *</label>
                        <select id="edit_contact_type" name="contact_type" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="whatsapp">WhatsApp</option>
                            <option value="telegram">Telegram</option>
                            <option value="email">Email</option>
                            <option value="other">Other</option>
                        </select>
                        <span id="edit_contact_type_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <label for="edit_contact_info" class="block mb-2 text-sm font-medium text-gray-900">Contact Information *</label>
                        <input type="text" id="edit_contact_info" name="contact_info" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <span id="edit_contact_info_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Currency Type -->
                    <div>
                        <label for="edit_currency_type" class="block mb-2 text-sm font-medium text-gray-900">Currency Type</label>
                        <select id="edit_currency_type" name="currency_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="$">USD ($)</option>
                            <option value="€">Euro (€)</option>
                            <option value="£">Pound (£)</option>
                            <option value="₹">Rupee (₹)</option>
                        </select>
                        <span id="edit_currency_type_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="edit_price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                        <input type="number" id="edit_price" name="price" step="0.01" min="0"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <span id="edit_price_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="edit_status" class="block mb-2 text-sm font-medium text-gray-900">Status *</label>
                        <select id="edit_status" name="status" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                        <span id="edit_status_error" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <!-- Attachments -->
                    <div>
                        <label for="edit_attachments" class="block mb-2 text-sm font-medium text-gray-900">Attachments</label>
                        <input type="file" id="edit_attachments" name="attachments[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <span id="edit_attachments_error" class="text-red-500 text-xs mt-1"></span>
                        <div id="current-attachments" class="mt-2 space-y-2"></div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update Assignment
                </button>
                <button type="button" onclick="closeEditModal()"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
