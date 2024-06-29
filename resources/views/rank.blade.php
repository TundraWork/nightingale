<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>选手排名 - 我不是歌神 S1</title>

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
        .space-y-4 tbody tr {
            height: 40px;
        }
    </style>
</head>
<body>
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
                    <span class="hidden sm:inline">选手排名 - 我不是歌神 S1</span>
                </a>
            </div>
            <!-- Left Section -->

            <!-- Right Section -->
            <div class="flex items-center gap-2">
                <!-- links to other pages -->
                <a href="#" class="hidden sm:inline font-medium text-gray-400 hover:text-white">
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
                            第一名：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="rank1">Null</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt
                            class="text-sm font-semibold uppercase tracking-wider text-gray-400"
                        >
                            第二名：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="rank2">Null</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt
                            class="text-sm font-semibold uppercase tracking-wider text-gray-400"
                        >
                            第三名：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="rank3">Null</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt
                            class="text-sm font-semibold uppercase tracking-wider text-gray-400"
                        >
                            第四名：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="rank4">Null</dd>
                    </dl>
                </div>
            </div>
            <!-- END Quick Stats -->

            <!-- Details -->
            <div class="grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">

                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <table class="w-full text-sm space-y-4" id="data-table">
                        <thead>
                        <tr>
                            <th class="p-2 text-left font-medium text-gray-400">排名</th>
                            <th class="p-2 text-center font-medium text-gray-400">名字</th>
                            <th class="p-2 text-center font-medium text-gray-400">歌曲</th>
                            <th class="p-2 text-right font-medium text-gray-400">总分</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Data will be appended here -->
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
                <span> / </span>
                <span>UI -
              <a class="font-medium text-blue-400 hover:text-blue-500 hover:underline" href="https://vrchat.com/home/user/usr_0e9c75fa-ec70-4043-9fca-264c9e0af6ba">Oniya</a>
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
    $.ajax({
        url: "/api/v1/guest/collectAllScores",
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('#rank1').text(data.data[0].name);
            $('#rank2').text(data.data[1].name);
            $('#rank3').text(data.data[2].name);
            $('#rank4').text(data.data[3].name);
            $.each(data.data, function(key, value) {
                var row = $('<tr>').append(
                    $("<td> class='text-left'>").text(key + 1),
                    $("<td class='text-center'>").text(value.name),
                    $("<td class='text-center'>").text(value.songs[0].song),
                    $("<td class='text-right'>").text(value.game_score + '分')
                );
                $('#data-table tbody').append(row);
            });
        },
        error: function (error) {
            console.log(error);
        }
    })
</script>
</body>
</html>
