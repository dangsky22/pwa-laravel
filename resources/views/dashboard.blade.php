<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- PWA -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="/logo.png">
    <link rel="manifest" href="/manifest.json">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Ionicons CDN for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto max-w-900 p-6 pt-6">
        <div class="header bg-white rounded-b-3xl shadow-md p-5 pb-3">
            <div class="profile-row flex items-center mb-4">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="avatar w-11 h-11 rounded-full mr-3 object-cover" alt="Avatar">
                <div>
                    <div class="greeting text-sm text-gray-500">Good Evening!</div>
                    <div class="name text-lg font-bold text-gray-800">Isabella Chen</div>
                </div>
                <div class="spacer flex-1"></div>
                <span class="notif text-2xl text-gray-800"><i class="far fa-bell"></i></span>
            </div>
            <form class="search-row flex items-center bg-gray-200 rounded-xl h-10 px-2 mb-4">
                <span class="search-icon text-xl text-gray-500"><i class="fas fa-search"></i></span>
                <input type="text" class="search-input flex-1 text-base text-gray-800 bg-transparent border-none outline-none mx-2 placeholder-gray-500" placeholder="Food, Groceries, Drinks etc.">
                <span class="tune-icon text-xl text-gray-500"><i class="fas fa-sliders-h"></i></span>
            </form>
            <div class="tab-row flex mb-2">
                <button class="tab px-5 py-2 rounded-2xl bg-transparent text-gray-500 font-medium text-base mr-2.5 active:bg-purple-700 active:text-white active:font-bold">Popular</button>
                <button class="tab px-5 py-2 rounded-2xl bg-transparent text-gray-500 font-medium text-base mr-2.5">Nearby</button>
                <button class="tab px-5 py-2 rounded-2xl bg-transparent text-gray-500 font-medium text-base">Recommended</button>
            </div>
        </div>
        <!-- Anarta House Section -->
        <div class="section mt-4.5 pl-5">
            <div class="section-header flex justify-between items-center mb-2.5 pr-5">
                <span class="section-title text-lg font-bold text-gray-800">Anarta House</span>
                <a href="#" class="see-all text-purple-700 font-medium text-sm">See All</a>
            </div>
            <div class="card-list flex overflow-x-auto pb-2">
                <div class="card min-w-[200px] bg-white rounded-2xl mr-4 mb-2 p-3 shadow-md flex flex-col items-start">
                    <img src="/assets/images/Anarta.png" class="card-image w-full h-24 rounded-xl mb-2 object-cover" alt="Anarta1">
                    <div class="card-title text-base font-bold text-gray-800 mt-2">Koze Anarta H2-9</div>
                    <div class="card-row flex items-center mt-1 justify-between w-full">
                        <span class="card-price text-sm text-purple-700 font-bold">Rp 1.500.000/bulan</span>
                        <span class="card-rating-row flex items-center ml-2">
                            <span class="star text-yellow-500 text-base mr-0.5"><i class="fas fa-star"></i></span>
                            <span class="card-rating text-sm text-gray-800 font-medium">4.8</span>
                        </span>
                    </div>
                </div>
                <div class="card min-w-[200px] bg-white rounded-2xl mr-4 mb-2 p-3 shadow-md flex flex-col items-start">
                    <img src="/assets/images/Anarta2.png" class="card-image w-full h-24 rounded-xl mb-2 object-cover" alt="Anarta2">
                    <div class="card-title text-base font-bold text-gray-800 mt-2">Koze Anarta H2-10</div>
                    <div class="card-row flex items-center mt-1 justify-between w-full">
                        <span class="card-price text-sm text-purple-700 font-bold">Rp 1.500.000/bulan</span>
                        <span class="card-rating-row flex items-center ml-2">
                            <span class="star text-yellow-500 text-base mr-0.5"><i class="fas fa-star"></i></span>
                            <span class="card-rating text-sm text-gray-800 font-medium">4.9</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Alesha House Section -->
        <div class="section mt-4.5 pl-5">
            <div class="section-header flex justify-between items-center mb-2.5 pr-5">
                <span class="section-title text-lg font-bold text-gray-800">Alesha House</span>
                <a href="#" class="see-all text-purple-700 font-medium text-sm">See All</a>
            </div>
            <div class="card-list flex overflow-x-auto pb-2">
                <div class="card min-w-[200px] bg-white rounded-2xl mr-4 mb-2 p-3 shadow-md flex flex-col items-start">
                    <img src="/assets/images/Alesha.png" class="card-image w-full h-24 rounded-xl mb-2 object-cover" alt="Alesha1">
                    <div class="card-title text-base font-bold text-gray-800 mt-2">Koze Alesha Blue 1-1</div>
                    <div class="card-row flex items-center mt-1 justify-between w-full">
                        <span class="card-price text-sm text-purple-700 font-bold">1.600.000/bulan</span>
                        <span class="card-rating-row flex items-center ml-2">
                            <span class="star text-yellow-500 text-base mr-0.5"><i class="fas fa-star"></i></span>
                            <span class="card-rating text-sm text-gray-800 font-medium">4.7</span>
                        </span>
                    </div>
                </div>
                <div class="card min-w-[200px] bg-white rounded-2xl mr-4 mb-2 p-3 shadow-md flex flex-col items-start">
                    <img src="/assets/images/Alesha2.png" class="card-image w-full h-24 rounded-xl mb-2 object-cover" alt="Alesha2">
                    <div class="card-title text-base font-bold text-gray-800 mt-2">Koze Alesha Blue 1-2</div>
                    <div class="card-row flex items-center mt-1 justify-between w-full">
                        <span class="card-price text-sm text-purple-700 font-bold">1.600.000/bulan</span>
                        <span class="card-rating-row flex items-center ml-2">
                            <span class="star text-yellow-500 text-base mr-0.5"><i class="fas fa-star"></i></span>
                            <span class="card-rating text-sm text-gray-800 font-medium">4.6</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PWA Script -->
    <script src="/sw.js"></script>
    <script>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                }
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>
</html>