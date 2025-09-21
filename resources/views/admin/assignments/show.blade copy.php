<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .subject-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background-color: #e0e7ff;
            color: #3730a3;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .contact-badge {
            display: flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            background-color: #f1f5f9;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .attachment-card {
            transition: all 0.2s ease;
        }

        .attachment-card:hover {
            background-color: #f8fafc;
        }

        .drawer {
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            .drawer {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 80%;
                max-width: 300px;
                z-index: 50;
                overflow-y: auto;
            }

            .drawer.open {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.open {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Mobile Header -->
    <header class="bg-white shadow-sm sticky top-0 z-30 lg:hidden">
        <div class="flex items-center justify-between p-4">
            <button id="menuButton" class="p-2 rounded-md text-gray-700">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-bold text-gray-800">Assignment Details</h1>
            <a href="#" class="p-2 rounded-md text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>
    </header>

    <!-- Overlay for mobile menu -->
    <div id="overlay" class="overlay"></div>

    <div class="flex">
        <!-- Sidebar for larger screens, drawer for mobile -->
        <div class="drawer bg-white shadow-lg lg:shadow-none lg:static lg:transform-none lg:w-64 lg:block">
            <div class="p-5 border-b border-gray-200 flex items-center justify-between lg:justify-center">
                <h2 class="text-xl font-bold text-indigo-700">Assignments</h2>
                <button id="closeMenu" class="lg:hidden p-1 rounded-md text-gray-500 hover:bg-gray-100">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center p-3 rounded-lg text-white bg-indigo-100 text-indigo-700">
                            <i class="fas fa-list mr-3"></i>
                            <span>All Assignments</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-clock mr-3"></i>
                            <span>Pending</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-spinner mr-3"></i>
                            <span>In Progress</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-check-circle mr-3"></i>
                            <span>Completed</span>
                        </a>
                    </li>
                    <li class="pt-4 mt-4 border-t border-gray-200">
                        <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-4 lg:p-6">
            <!-- Back button and title -->
            <div class="mb-6 hidden lg:flex items-center">
                <a href="#" class="flex items-center text-indigo-600 hover:text-indigo-800 mr-4">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Assignment Details</h1>
            </div>

            <!-- Assignment Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <!-- Header with status -->
                <div class="bg-indigo-50 p-4 border-b border-indigo-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center mb-3 sm:mb-0">
                            <span class="subject-tag mr-3">Mathematics</span>
                            <span class="status-badge bg-yellow-100 text-yellow-800">Pending</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            Due: 25 Dec 2023
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Differential Equations Problem Set</h2>

                    <div class="mb-5">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Description</h3>
                        <p class="text-gray-700">
                            Solve the following differential equations with initial conditions. Show all steps and
                            methodology.
                            Problems include first-order linear equations and separable equations.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Contact Information</h3>
                            <div class="contact-badge">
                                <i class="fab fa-whatsapp mr-2 text-green-600"></i>
                                +1 (234) 567-8901
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Price</h3>
                            <div class="flex items-baseline">
                                <span class="text-2xl font-bold text-indigo-600">$45.00</span>
                                <span class="text-sm text-gray-500 line-through ml-2">$50.00</span>
                                <span class="text-sm text-green-600 font-medium ml-2">10% off</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Attachments</h3>
                        <div class="space-y-2">
                            <div
                                class="attachment-card flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <i class="far fa-file-pdf text-red-500 text-xl mr-3"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Problem_Set_3.pdf</p>
                                        <p class="text-xs text-gray-500">2.4 MB</p>
                                    </div>
                                </div>
                                <button class="text-indigo-600 hover:text-indigo-800">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                            <div
                                class="attachment-card flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <i class="far fa-file-word text-blue-500 text-xl mr-3"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Instructions.docx</p>
                                        <p class="text-xs text-gray-500">1.1 MB</p>
                                    </div>
                                </div>
                                <button class="text-indigo-600 hover:text-indigo-800">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200">
                        <button
                            class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </button>
                        <button
                            class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-check-circle mr-2"></i> Mark Complete
                        </button>
                        <button
                            class="flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            <i class="fas fa-clock mr-2"></i> In Progress
                        </button>
                        <button class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Meta Information -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Assignment Details</h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Created</h3>
                            <p class="text-gray-800">Dec 10, 2023 at 2:30 PM</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Last Updated</h3>
                            <p class="text-gray-800">Dec 15, 2023 at 10:15 AM</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Assignment ID</h3>
                            <p class="text-gray-800">#12345</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Client</h3>
                            <p class="text-gray-800">John Smith</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Assignments -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Related Assignments</h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Related Assignment 1 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex justify-between items-start mb-3">
                                <span class="subject-tag">Physics</span>
                                <span class="status-badge bg-blue-100 text-blue-800">In Progress</span>
                            </div>
                            <h3 class="font-medium text-gray-800 mb-2">Quantum Mechanics Problems</h3>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Due: 28 Dec</span>
                                <span>$60.00</span>
                            </div>
                        </div>

                        <!-- Related Assignment 2 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex justify-between items-start mb-3">
                                <span class="subject-tag">Mathematics</span>
                                <span class="status-badge bg-green-100 text-green-800">Completed</span>
                            </div>
                            <h3 class="font-medium text-gray-800 mb-2">Linear Algebra</h3>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Due: 15 Dec</span>
                                <span>$35.00</span>
                            </div>
                        </div>

                        <!-- Related Assignment 3 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex justify-between items-start mb-3">
                                <span class="subject-tag">Computer Science</span>
                                <span class="status-badge bg-yellow-100 text-yellow-800">Pending</span>
                            </div>
                            <h3 class="font-medium text-gray-800 mb-2">Algorithm Analysis</h3>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Due: 30 Dec</span>
                                <span>$75.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menuButton');
            const closeMenu = document.getElementById('closeMenu');
            const overlay = document.getElementById('overlay');
            const drawer = document.querySelector('.drawer');

            function openMenu() {
                drawer.classList.add('open');
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeMenuFunc() {
                drawer.classList.remove('open');
                overlay.classList.remove('open');
                document.body.style.overflow = 'auto';
            }

            menuButton.addEventListener('click', openMenu);
            closeMenu.addEventListener('click', closeMenuFunc);
            overlay.addEventListener('click', closeMenuFunc);

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeMenuFunc();
                }
            });
        });
    </script>
</body>

</html>
