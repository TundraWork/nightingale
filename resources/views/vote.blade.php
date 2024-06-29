<!doctype html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>观众投票 - 我不是歌神 S1</title>

    <!-- Icons -->
    <link rel="icon" href="https://cdn.pixelcave.com/favicon.svg" sizes="any" type="image/svg+xml" />
    <link rel="icon" href="https://cdn.pixelcave.com/favicon.png" type="image/png" />

    <!-- Tailwind CSS Play CDN (mainly for development/testing purposes) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>

    <!-- Tailwind CSS v3 Configuration -->
    <script>
        const defaultTheme = tailwind.defaultTheme;
        const colors = tailwind.colors;
        const plugin = tailwind.plugin;

        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", ...defaultTheme.fontFamily.sans],
                    },
                },
            },
        };
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Alpine.js (x-cloak - https://alpinejs.dev/directives/cloak) -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body onload="init()">
<!-- Page Container -->
<div x-data="{ userDropdownOpen: false, mobileNavOpen: false }"
     class="mx-auto flex min-h-screen w-full flex-col bg-gray-800 text-gray-300">
    <!-- Page Header -->
    <header id="page-header" class="left-0 right-0 top-0 z-30 flex h-16 flex-none items-center bg-gray-900 shadow-sm">
        <div class="container mx-auto flex justify-between px-4 lg:px-8 xl:max-w-6xl">
            <!-- Left Section -->
            <div class="flex items-center">
                <a href="javascript:void(0)"
                   class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-white hover:text-white/90">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" data-slot="icon"
                         class="hi-mini hi-cursor-arrow-rays inline-block size-5 text-blue-300 group-hover:text-blue-400 group-active:scale-90">
                        <path
                            d="M10 1a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 1ZM5.05 3.05a.75.75 0 0 1 1.06 0l1.062 1.06A.75.75 0 1 1 6.11 5.173L5.05 4.11a.75.75 0 0 1 0-1.06ZM14.95 3.05a.75.75 0 0 1 0 1.06l-1.06 1.062a.75.75 0 0 1-1.062-1.061l1.061-1.06a.75.75 0 0 1 1.06 0ZM3 8a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 3 8ZM14 8a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 14 8ZM7.172 10.828a.75.75 0 0 1 0 1.061L6.11 12.95a.75.75 0 0 1-1.06-1.06l1.06-1.06a.75.75 0 0 1 1.06 0ZM10.766 7.51a.75.75 0 0 0-1.37.365l-.492 6.861a.75.75 0 0 0 1.204.65l1.043-.799.985 3.678a.75.75 0 0 0 1.45-.388l-.978-3.646 1.292.204a.75.75 0 0 0 .74-1.16l-3.874-5.764Z" />
                    </svg>
                    <span class="hidden sm:inline">观众投票 - 我不是歌神 S1</span>
                </a>
            </div>
            <!-- Left Section -->

            <!-- Right Section -->
            <div class="flex items-center gap-2">
                <!-- links to other pages -->
                <a href="/vote" class="hidden sm:inline font-medium text-gray-400 hover:text-white">
                    <span>观众投票</span>
                </a>
                <a href="/rank" class="hidden sm:inline font-medium text-gray-400 hover:text-white">
                    <span>选手排名</span>
                </a>
            </div>
            <!-- END Right Section -->
        </div>
    </header>
    <!-- END Page Header -->

    <!-- Page Content -->
    <main id="page-content" class="flex max-w-full flex-auto flex-col">

        <!-- Page Section -->
        <div class="container mx-auto space-y-4 p-4 lg:space-y-8 lg:p-8 xl:max-w-6xl">
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 rounded-2xl bg-gray-900/50 p-5 lg:grid-cols-4">
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            当前选手：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="player">Null</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            属于队伍：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="team">Null</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            红队票数：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="voteRed">Null</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            白队票数：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="voteWhite">Null</dd>
                    </dl>
                </div>
            </div>
            <!-- END Quick Stats -->

            <!-- Details -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">

                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <button class="w-full h-16 bg-gray-700 text-white font-bold rounded-lg shadow hover:bg-red-800"
                            id="red-team">给红队投票</button>
                </div>
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <button class="w-full h-16 bg-gray-700 text-white font-bold rounded-lg shadow hover:bg-gray-600"
                            id="white-team">给白队投票</button>
                </div>
                <!-- END Referrers -->
            </div>
            <!-- Details -->
        </div>
        <!-- END Page Section -->
    </main>
    <!-- END Page Content -->

    <!-- Page Footer -->
    <footer id="page-footer" class="flex flex-none items-center bg-gray-900/75">
        <div
            class="container mx-auto flex flex-col px-4 text-center text-sm md:flex-row md:justify-between md:text-left lg:px-8 xl:max-w-6xl">
            <div class="pb-1 pt-4 md:pb-4">
                &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script>
                <span class="font-medium">我不是歌神</span>
            </div>
            <div class="inline-flex items-center justify-center gap-1 pb-4 pt-1 md:pt-4">
                <span>Crafted with</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" data-slot="icon"
                     class="hi-mini hi-heart inline-block size-5 text-rose-500">
                    <path
                        d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z" />
                </svg>
                <span> / </span>
                <span>UI -
            <a class="font-medium text-blue-400 hover:text-blue-500 hover:underline"
               href="https://vrchat.com/home/user/usr_0e9c75fa-ec70-4043-9fca-264c9e0af6ba">Oniya</a>
          </span>
                <span> / </span>
                <span>Backend & hosting -
            <a class="font-medium text-blue-400 hover:text-blue-500 hover:underline" href="https://tun.cat">Tundra</a>
          </span>
            </div>
        </div>
    </footer>
    <!-- END Page Footer -->
</div>
<!-- END Page Container -->

<!-- Page JS Code -->
<script>
    //按下red-team按钮后，发送ajax请求给后端
    function random() {
        return Math.floor(Math.random() * 10000000000).toString().padStart(10, '0');
    }

    $(document).on('click', '#red-team', function () {
        if (localStorage.getItem('id') == localStorage.getItem('voted_id')) {
            alert('您已投票，请勿重复投票！');
            return;
        } else {
            $.ajax({
                url: '/api/v1/guests/submitVote',
                type: 'POST',
                contentType: "application/json", // 请求的内容类型
                data: JSON.stringify({ "guest": random(), "team_id": "667dc3d59094f" }), // 要提交的数据
                success: function (response) {
                    alert('投票成功！');
                    localStorage.setItem('voted_id', localStorage.getItem('id'));
                }
            })
        }
    });

    $(document).on('click', '#white-team', function () {
        if (localStorage.getItem('id') == localStorage.getItem('voted_id')) {
            alert('您已投票，请勿重复投票！');
            return;
        } else {
            $.ajax({
                url: '/api/v1/guests/submitVote',
                type: 'POST',
                contentType: "application/json", // 请求的内容类型
                data: JSON.stringify({ "guest": random(), "team_id": "667dc3d590acb" }), // 要提交的数据
                success: function (response) {
                    alert('投票成功！'); // 打印响应结果
                    localStorage.setItem('voted_id', localStorage.getItem('id'));
                }
            })
        }
    });

    function fetchData() {
        var apiUrls = [
            '/api/v1/guest/getCurrentStatus',
            '/api/v1/guest/collectAllVotes',
        ];
        $.when.apply($, apiUrls.map(function (url) {
            return $.ajax({
                url: url,
                method: 'GET'
            });
        })).done(function () {
            // 所有请求完成，将所有数据集合到一个数组中
            var allData = $.map(arguments, function (response) {
                return response[0];
            });

            // 处理所有数据
            $('#player').text(allData[0].data.singer);
            if (allData[0].data.team == null) {
                $('#team').text('暂无');
            } else {
                $('#team').text(allData[0].data.team);
            };
            $('#voteRed').text(allData[1].data[0].total_votes);
            $('#voteWhite').text(allData[1].data[1].total_votes);
            localStorage.setItem('id', allData[0].data.singer_id);
        });
    }

    function init() {
        fetchData();
    }

    setInterval(function () {
        fetchData();
    }, 5000);
</script>
</body>

</html>