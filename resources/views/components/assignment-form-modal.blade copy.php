<div id="newAssignmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-screen overflow-y-auto"> <!-- Increased max-width -->
        <div class="border-b px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">Add New Assignment</h3>
        </div>
        <div class="px-6 py-4">
            <form id="assignmentForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        id="title" name="title" value="{{ old('title', $assignment->title ?? '') }}">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="deadline">
                        Deadline <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                        class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        id="deadline" name="deadline">
                    @error('deadline')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="contactType">
                        Contact Type <span class="text-red-500">*</span>
                    </label>
                    <select
                        class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        id="contactType" name="contact_type">
                        <option value="">Select contact type</option>
                        <option>WhatsApp</option>
                        <option>Telegram</option>
                        <option>Email</option>
                        <option>Other</option>
                    </select>
                    @error('contact_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4" id="contactInfoInput" style="display: none;">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="contactInfo" id="contactInfoLabel">
                        Contact Information <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        id="contactInfo" name="contact_info">
                    @error('contact_info')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">
                        Subject <span class="text-red-500">*</span>
                    </label>
                    <select
                        class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        id="subject" name="subject">
                        <option value="">Select a subject</option>
                        @foreach (App\Enums\Subject::values() as $value => $name)
                            <option value="{{ $value }}"
                                {{ old('subject', $assignment->subject ?? '') == $value ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea
                        class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        id="description" name="description" rows="3"></textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Attachment Section -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Attachments (Optional)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-md p-4 text-center">
                        <input type="file" id="fileInput" multiple class="hidden" name="attachments[]">
                        <div id="fileDropArea" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-indigo-500 text-3xl mb-2"></i>
                            <p class="text-sm text-gray-600">Drag & drop files here or click to browse</p>
                            <p class="text-xs text-gray-500 mt-1">Maximum 5 files, 100MB each</p>
                        </div>
                        @error('attachments')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Selected files list -->
                    <div id="fileList" class="mt-3 space-y-2 max-h-40 overflow-y-auto hidden">
                        <p class="text-sm font-medium text-gray-700">Selected files:</p>
                        <div id="fileItems" class="space-y-2"></div>
                    </div>
                </div>

                <!-- Promo Code Section -->
                <div class="mb-4 p-4 bg-indigo-50 rounded-lg">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="promoCode">
                        Promo Code (Optional)
                    </label>
                    <div class="flex space-x-2">
                        <input type="text"
                            class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            id="promoCode" name="promo_code" placeholder="Enter promo code">
                        <button type="button" id="applyPromo"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Apply
                        </button>
                    </div>
                    <div id="promoMessage" class="mt-2 text-sm hidden"></div>
                    @error('promo_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t px-6 py-4 flex justify-between">
                    <button id="cancelAssignment"
                        class="px-4 py-2  bg-gray-300 text-gray-900 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel
                    </button>
                    <button type="submit" form="assignmentForm"
                        class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Create
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
    <script>
        const fileInput = document.getElementById('fileInput');
        const fileDropArea = document.getElementById('fileDropArea');
        const fileList = document.getElementById('fileList');
        const fileItems = document.getElementById('fileItems');

        // Keep all selected files here
        let selectedFiles = [];

        // Click to select files
        fileDropArea.addEventListener('click', () => fileInput.click());

        // Drag & Drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileDropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => fileDropArea.classList.add('bg-indigo-50', 'border-indigo-300'));
        ['dragleave', 'drop'].forEach(eventName => fileDropArea.classList.remove('bg-indigo-50', 'border-indigo-300'));

        fileDropArea.addEventListener('drop', e => handleFiles(e.dataTransfer.files));
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
            this.value = ''; // reset input so same file can be selected again
        });

        function handleFiles(files) {
            if (files.length === 0) return;

            if (selectedFiles.length + files.length > 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Max 5 files allowed.'
                });
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (file.size > 100 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: `File "${file.name}" too large.`
                    });
                    continue;
                }

                selectedFiles.push(file);

                const fileItem = document.createElement('div');
                fileItem.className = 'file-item flex items-center justify-between bg-gray-50 p-2 rounded';
                fileItem.innerHTML = `
            <div class="flex items-center truncate">
                <i class="fas fa-file text-indigo-500 mr-2"></i>
                <span class="text-sm truncate">${file.name}</span>
                <span class="text-xs text-gray-500 ml-2">(${formatFileSize(file.size)})</span>
            </div>
            <button type="button" class="remove-file text-red-500 hover:text-red-700">Remove</button>
        `;

                fileItem.querySelector('.remove-file').addEventListener('click', function() {
                    selectedFiles = selectedFiles.filter(f => f !== file); // remove from array
                    fileItem.remove();
                    updateFileListVisibility();
                });

                fileItems.appendChild(fileItem);
            }
            updateFileListVisibility();
        }

        function updateFileListVisibility() {
            fileList.classList.toggle('hidden', fileItems.children.length === 0);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024,
                sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        $("#contactType").on("change", function() {
            let selected = $(this).val();

            if (selected !== "") {
                $("#contactInfoInput").show();
                if (selected === "Email") {
                    $("#contactInfoInput").attr("type", "email");
                    $("#contactInfoLabel").text("Enter your email address");
                }
                else if (selected === "Other") {
                    $("#contactInfoLabel").text("Contact Information (" + selected + ")");
                    $("#contactInfoInput").attr("type", "text");
                } else {
                    $("#contactInfoInput").attr("type", "text");
                    $("#contactInfoLabel").text("Enter your " + selected + " number");
                }
            } else {
                $("#contactInfoInput").hide();
            }
        });

        // Modal functionality
        document.getElementById('cancelAssignment').addEventListener('click', function() {
            closeModel();
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('newAssignmentModal');
            if (event.target === modal) {
                closeModel();
            }
        });

        function closeModel() {
            document.getElementById('newAssignmentModal').classList.add('hidden');
            document.getElementById('assignmentForm').reset();
            document.getElementById('promoCode').value = '';
            $('#promoMessage').empty();
            $('#fileInput').val('');
            $('#fileItems').empty();
            $(".error-text").remove();
            $('#fileList').addClass('hidden');
            selectedFiles = [];
        }
    </script>
@endpush
