<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>数据大盘 - 我不是歌神 S1</title>

    <!-- Icons -->
    <link
        rel="icon"
        href="https://cdn.pixelcave.com/favicon.svg"
        sizes="any"
        type="image/svg+xml"
    />
    <link
        rel="icon"
        href="https://cdn.pixelcave.com/favicon.png"
        type="image/png"
    />

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
    <script
        defer
        src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

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
<div
    x-data="{ userDropdownOpen: false, mobileNavOpen: false }"
    class="mx-auto flex min-h-screen w-full flex-col bg-gray-800 text-gray-300"
>
    <!-- Page Header -->
    <header
        id="page-header"
        class="left-0 right-0 top-0 z-30 flex h-16 flex-none items-center bg-gray-900 shadow-sm"
    >
        <div
            class="container mx-auto flex justify-between px-4 lg:px-8 xl:max-w-6xl"
        >
            <!-- Left Section -->
            <div class="flex items-center">
                <a
                    href="javascript:void(0)"
                    class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-white hover:text-white/90"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        data-slot="icon"
                        class="hi-mini hi-cursor-arrow-rays inline-block size-5 text-blue-300 group-hover:text-blue-400 group-active:scale-90"
                    >
                        <path
                            d="M10 1a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 1ZM5.05 3.05a.75.75 0 0 1 1.06 0l1.062 1.06A.75.75 0 1 1 6.11 5.173L5.05 4.11a.75.75 0 0 1 0-1.06ZM14.95 3.05a.75.75 0 0 1 0 1.06l-1.06 1.062a.75.75 0 0 1-1.062-1.061l1.061-1.06a.75.75 0 0 1 1.06 0ZM3 8a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 3 8ZM14 8a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 14 8ZM7.172 10.828a.75.75 0 0 1 0 1.061L6.11 12.95a.75.75 0 0 1-1.06-1.06l1.06-1.06a.75.75 0 0 1 1.06 0ZM10.766 7.51a.75.75 0 0 0-1.37.365l-.492 6.861a.75.75 0 0 0 1.204.65l1.043-.799.985 3.678a.75.75 0 0 0 1.45-.388l-.978-3.646 1.292.204a.75.75 0 0 0 .74-1.16l-3.874-5.764Z"
                        />
                    </svg>
                    <a href="/"><span class="hidden sm:inline">我不是歌神 S1</span></a><span class="hidden sm:inline"> - 数据大盘</span>
                </a>
            </div>
            <!-- Left Section -->

            <!-- Right Section -->
            <div class="flex items-center gap-2">
            </div>
            <!-- END Right Section -->
        </div>
    </header>
    <!-- END Page Header -->

    <!-- Page Content -->
    <main id="page-content" class="flex max-w-full flex-auto flex-col">

        <!-- Page Section -->
        <div
            class="container mx-auto space-y-4 p-4 lg:space-y-8 lg:p-8 xl:max-w-6xl"
        >
            <!-- Quick Stats -->
            <div
                class="grid grid-cols-2 rounded-2xl bg-gray-900/50 p-5 lg:grid-cols-4"
            >
                <div class="p-5">
                    <dl>
                        <dt
                            class="text-sm font-semibold uppercase tracking-wider text-gray-400"
                        >
                            当前选手：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="player">暂无</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt
                            class="text-sm font-semibold uppercase tracking-wider text-gray-400"
                        >
                            当前歌曲：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="song">暂无</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt
                            class="text-sm font-semibold uppercase tracking-wider text-gray-400"
                        >
                            评委总分：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="judge-score">暂无</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt
                            class="text-sm font-semibold uppercase tracking-wider text-gray-400"
                        >
                            当前第一：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="team">暂无</dd>
                    </dl>
                </div>
            </div>
            <!-- END Quick Stats -->

            <!-- Details -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">

                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <table class="w-full text-sm" id="annie">
                        <thead>
                        <tr>
                            <th class="p-2 text-left font-medium text-gray-400">
                                Annie评委
                            </th>
                            <th class="p-2 text-right font-medium text-gray-400">
                                分数
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音准
                                </p>
                            </td>
                            <td class="text-right" id="A">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音色
                                </p>
                            </td>
                            <td class="text-right" id="B">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    节奏
                                </p>
                            </td>
                            <td class="text-right" id="C">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    情感及个人表现
                                </p>
                            </td>
                            <td class="text-right" id="D">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    评委个人分
                                </p>
                            </td>
                            <td class="text-right" id="E">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    总分
                                </p>
                            </td>
                            <td class="text-right" id="total">暂无</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Referrers -->
                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <table class="w-full text-sm" id="wuwo">
                        <thead>
                        <tr>
                            <th class="p-2 text-left font-medium text-gray-400">
                                悟我评委
                            </th>
                            <th class="p-2 text-right font-medium text-gray-400">
                                分数
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音准
                                </p>
                            </td>
                            <td class="text-right" id="A">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音色
                                </p>
                            </td>
                            <td class="text-right" id="B">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    节奏
                                </p>
                            </td>
                            <td class="text-right" id="C">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    情感及个人表现
                                </p>
                            </td>
                            <td class="text-right" id="D">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    评委个人分
                                </p>
                            </td>
                            <td class="text-right" id="E">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    总分
                                </p>
                            </td>
                            <td class="text-right" id="total">暂无</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Referrers -->
                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <table class="w-full text-sm" id="ling">
                        <thead>
                        <tr>
                            <th class="p-2 text-left font-medium text-gray-400">
                                ๑0w0๑评委
                            </th>
                            <th class="p-2 text-right font-medium text-gray-400">
                                分数
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音准
                                </p>
                            </td>
                            <td class="text-right" id="A">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音色
                                </p>
                            </td>
                            <td class="text-right" id="B">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    节奏
                                </p>
                            </td>
                            <td class="text-right" id="C">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    情感及个人表现
                                </p>
                            </td>
                            <td class="text-right" id="D">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    评委个人分
                                </p>
                            </td>
                            <td class="text-right" id="E">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    总分
                                </p>
                            </td>
                            <td class="text-right" id="total">暂无</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Referrers -->
                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <table class="w-full text-sm" id="yue">
                        <thead>
                        <tr>
                            <th class="p-2 text-left font-medium text-gray-400">
                                月初的雪评委
                            </th>
                            <th class="p-2 text-right font-medium text-gray-400">
                                分数
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音准
                                </p>
                            </td>
                            <td class="text-right" id="A">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音色
                                </p>
                            </td>
                            <td class="text-right" id="B">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    节奏
                                </p>
                            </td>
                            <td class="text-right" id="C">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    情感及个人表现
                                </p>
                            </td>
                            <td class="text-right" id="D">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    评委个人分
                                </p>
                            </td>
                            <td class="text-right" id="E">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    总分
                                </p>
                            </td>
                            <td class="text-right" id="total">暂无</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Referrers -->
                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <table class="w-full text-sm" id="oniya">
                        <thead>
                        <tr>
                            <th class="p-2 text-left font-medium text-gray-400">
                                Oniya评委
                            </th>
                            <th class="p-2 text-right font-medium text-gray-400">
                                分数
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音准
                                </p>
                            </td>
                            <td class="text-right" id="A">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    音色
                                </p>
                            </td>
                            <td class="text-right" id="B">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    节奏
                                </p>
                            </td>
                            <td class="text-right" id="C">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    情感及个人表现
                                </p>
                            </td>
                            <td class="text-right" id="D">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    评委个人分
                                </p>
                            </td>
                            <td class="text-right" id="E">暂无</td>
                        </tr>
                        <tr>
                            <td class="relative p-2">
                                <div
                                    class="absolute bottom-0 left-0 top-0 my-px w-3/4 bg-white opacity-5"
                                    style="width: 0%"
                                ></div>
                                <p>
                                    总分
                                </p>
                            </td>
                            <td class="text-right" id="total">暂无</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Referrers -->
            </div>
            <!-- Details -->
        </div>
        <!-- END Page Section -->
    </main>
    <!-- END Page Content -->

    <!-- Page Footer -->
    <footer
        id="page-footer"
        class="flex flex-none items-center bg-gray-900/75"
    >
        <div
            class="container mx-auto flex flex-col px-4 text-center text-sm md:flex-row md:justify-between md:text-left lg:px-8 xl:max-w-6xl"
        >
            <div class="pb-1 pt-4 md:pb-4">
                &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script>
                <span class="font-medium">我不是歌神</span>
            </div>
            <div
                class="inline-flex items-center justify-center gap-1 pb-4 pt-1 md:pt-4"
            >
                <span>Crafted with</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    data-slot="icon"
                    class="hi-mini hi-heart inline-block size-5 text-rose-500"
                >
                    <path
                        d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z"
                    />
                </svg>
                <span> ／ </span>
                <span>UI
              <a class="font-medium text-blue-400 hover:text-blue-500 hover:underline" href="https://vrchat.com/home/user/usr_0e9c75fa-ec70-4043-9fca-264c9e0af6ba">Oniya</a>
            </span>
                <span> ／ </span>
                <span>Backend & hosting
              <a class="font-medium text-blue-400 hover:text-blue-500 hover:underline" href="https://tun.cat">Tundra</a>
            </span>
            </div>
        </div>
    </footer>
    <!-- END Page Footer -->
</div>
<!-- END Page Container -->

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<!-- Page JS Code -->
<script>
    function fetchData() {
        var apiUrls = [
            '/api/v1/admin/getCurrentStatus',
            '/api/v1/admin/collectAllScores',
        ];
        $.when.apply($, apiUrls.map(function(url) {
            return $.ajax({
                url: url,
                method: 'GET'
            });
        })).done(function() {
            // 所有请求完成，将所有数据集合到一个数组中
            var allData = $.map(arguments, function(response) {
                return response[0];
            });

            // 处理所有数据
            $('#player').text(allData[0].data.singer);
            $('#song').text(allData[0].data.song);
            if (allData[1].data[0].name == null) {
                $('#team').text('暂无');
            } else {
                $('#team').text(allData[1].data[0].name)
            }
            var player_id = allData[0].data.singer_id;
            var song_id = allData[0].data.song_id;
            var jsonData = "singer_id=" + player_id + "&song_id=" + song_id;

            $.ajax({
                url: "/api/v1/admin/collectScore", // API 的 URL
                type: "GET", // 请求的类型（GET、POST 等）
                contentType: "text/plain", // 请求的内容类型
                data: jsonData, // 要提交的数据
                success: function (response) {
                    // 请求成功时执行的回调函数
                    $('#judge-score').text(response.data.final_score + '分');
                    var judgeMap = {
                        '๑0w0๑': 'ling',
                        '悟我': 'wuwo',
                        'Annie': 'annie',
                        '月初的雪': 'yue',
                        'Oniya': 'oniya'
                    };

                    var getElement = function(judge) {
                        var element = judgeMap[judge] || 'ling';
                        return '#' + element;
                    };

                    var updateScores = function(response) {
                        for (var i = 0; i < response.data.scores.length; i++) {
                            var element = getElement(response.data.scores[i].judge);

                            $(element + ' #A').text(response.data.scores[i].data[0].score + '分');
                            $(element + ' #B').text(response.data.scores[i].data[1].score + '分');
                            $(element + ' #C').text(response.data.scores[i].data[2].score + '分');
                            $(element + ' #D').text(response.data.scores[i].data[3].score + '分');
                            $(element + ' #E').text(response.data.scores[i].data[4].score + '分');
                            $(element + ' #total').text(response.data.scores[i].total_score + '分');
                        }
                    };
                    updateScores(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // 请求失败时执行的回调函数
                    if (jqXHR.status === 404) {
                        $('#judge-score').text('暂无');
                        $('#ling #A').text('暂无');
                        $('#ling #B').text('暂无');
                        $('#ling #C').text('暂无');
                        $('#ling #D').text('暂无');
                        $('#ling #E').text('暂无');
                        $('#ling #total').text('暂无');
                        $('#wuwo #A').text('暂无');
                        $('#wuwo #B').text('暂无');
                        $('#wuwo #C').text('暂无');
                        $('#wuwo #D').text('暂无');
                        $('#wuwo #E').text('暂无');
                        $('#wuwo #total').text('暂无');
                        $('#annie #A').text('暂无');
                        $('#annie #B').text('暂无');
                        $('#annie #C').text('暂无');
                        $('#annie #D').text('暂无');
                        $('#annie #E').text('暂无');
                        $('#annie #total').text('暂无');
                        $('#yue #A').text('暂无');
                        $('#yue #B').text('暂无');
                        $('#yue #C').text('暂无');
                        $('#yue #D').text('暂无');
                        $('#yue #E').text('暂无');
                        $('#yue #total').text('暂无');
                        $('#oniya #A').text('暂无');
                        $('#oniya #B').text('暂无');
                        $('#oniya #C').text('暂无');
                        $('#oniya #D').text('暂无');
                        $('#oniya #E').text('暂无');
                        $('#oniya #total').text('暂无');
                    }
                }
            });
        });
    }

    function init() {
        fetchData();
    }

    setInterval(function() {
        fetchData();
    }, 1000);
</script>
</body>
</html>
