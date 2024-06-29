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
                    <svg fill="#2040AA" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 364.59 364.591" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M360.655,258.05V25c0-13.807-11.191-25-25-25H130.09c-13.807,0-25,11.193-25,25v206.27 c-10.569-3.184-22.145-4.271-34.058-2.768C29.527,233.738-0.293,268.3,4.427,305.695c4.719,37.396,42.189,63.464,83.694,58.226 c40.015-5.049,66.969-37.146,66.969-73.181V50h155.564v146.794c-10.591-3.2-22.19-4.297-34.134-2.79 c-41.504,5.237-71.323,39.798-66.604,77.193s42.188,63.464,83.694,58.227C332.951,324.458,360.655,293.275,360.655,258.05z"></path> </g> </g> </g></svg>
                    <a href="/"><span class="text-xl font-bold hidden sm:inline">我不是歌神 S1</span></a><span class="text-xl ml-2 hidden sm:inline"> - 观众投票</span>
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
        <div class="container mx-auto space-y-4 p-4 lg:space-y-8 lg:p-8 xl:max-w-6xl">
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 rounded-2xl bg-gray-900/50 p-5 lg:grid-cols-4">
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            当前选手：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="player">暂无</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            属于队伍：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="team">暂无</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            红队票数：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="vote-count-a">暂无</dd>
                    </dl>
                </div>
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                            白队票数：
                        </dt>
                        <dd class="pb-3 pt-2 text-4xl font-semibold" id="vote-count-b">暂无</dd>
                    </dl>
                </div>
            </div>
            <!-- END Quick Stats -->

            <!-- Details -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-1 lg:gap-8">
                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <button class="w-full h-16 bg-gray-700 text-white font-bold rounded-lg shadow hover:bg-red-800"
                            id="vote-button" disabled>正在加载，请稍后...</button>
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

<!-- Page JS Code -->
<script>
    let singer_id = "";
    let team_id = "";

    $(document).on('click', '#vote-button', function () {
        $.ajax({
            url: '/api/v1/guests/submitVote',
            type: 'POST',
            contentType: "application/json", // 请求的内容类型
            data: JSON.stringify({ "singer_id": singer_id, "team_id": team_id }), // 要提交的数据
            success: function (response) {
                alert('投票成功！');
                $('#vote-button').text('已投票');
                $('#vote-button').prop("disabled", true);
                localStorage.setItem('voted_singer_id', singer_id);
            },
            error: function (response) {
                alert('投票失败！' + response.responseJSON.message);
            }
        })
    });

    function loadTeams() {
        $.ajax({
            url: "/api/v1/guests/getCurrentStatus",
            type: "GET",
            dataType: "json",
            success: function (data) {
                singer_id = data.data.singer_id;
                team_id = data.data.team_id;
                let vote_button = $('#vote-button');
                if (singer_id === localStorage.getItem('voted_singer_id')) {
                    vote_button.text('已投票');
                    vote_button.prop("disabled", true);
                } else {
                    vote_button.text('给' + allData[0].data.team + '投票');
                    vote_button.prop("disabled", false);
                }
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    function fetchData() {
        var apiUrls = [
            '/api/v1/guests/getCurrentStatus',
            '/api/v1/guests/collectAllVotes',
        ];
        $.when.apply($, apiUrls.map(function (url) {
            return $.ajax({
                url: url,
                method: 'GET'
            });
        })).done(function () {
            // 所有请求完成，将所有数据集合到一个数组中
            const allData = $.map(arguments, function (response) {
                return response[0];
            });
            // 处理所有数据
            singer_id = allData[0].data.singer_id;
            team_id = allData[0].data.team_id;
            $('#player').text(allData[0].data.singer);
            if (allData[0].data.team == null) {
                $('#team').text('暂无');
            } else {
                $('#team').text(allData[0].data.team);
            };
            $('#vote-count-a').text(allData[1].data[0].total_votes);
            $('#vote-count-b').text(allData[1].data[1].total_votes);
            let vote_button = $('#vote-button');
            if (singer_id === localStorage.getItem('voted_singer_id')) {
                vote_button.text('已投票');
                vote_button.prop("disabled", true);
            } else {
                vote_button.text('给' + allData[0].data.team + '投票');
                vote_button.prop("disabled", false);
            }
        });
    }

    function init() {
        fetchData();
        loadTeams();
    }

    setInterval(function () {
        fetchData();
    }, 5000);
</script>
</body>

</html>
