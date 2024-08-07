<!doctype html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>首页 - 我不是歌神 S1</title>

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
    <header id="page-header"
            class="left-0 right-0 top-0 z-30 flex h-16 flex-none items-center bg-gray-900 shadow-sm">
        <div class="container mx-auto flex justify-between px-4 lg:px-8 xl:max-w-6xl">
            <!-- Left Section -->
            <div class="flex items-center">
                <a href="javascript:void(0)"
                   class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-white hover:text-white/90">
                    <svg fill="#2040AA" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 364.59 364.591" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M360.655,258.05V25c0-13.807-11.191-25-25-25H130.09c-13.807,0-25,11.193-25,25v206.27 c-10.569-3.184-22.145-4.271-34.058-2.768C29.527,233.738-0.293,268.3,4.427,305.695c4.719,37.396,42.189,63.464,83.694,58.226 c40.015-5.049,66.969-37.146,66.969-73.181V50h155.564v146.794c-10.591-3.2-22.19-4.297-34.134-2.79 c-41.504,5.237-71.323,39.798-66.604,77.193s42.188,63.464,83.694,58.227C332.951,324.458,360.655,293.275,360.655,258.05z"></path> </g> </g> </g></svg>
                    <a href="/"><span class="text-xl font-bold sm:inline">我不是歌神 S1</span></a><span class="text-l ml-2 sm:inline">首页</span>
                </a>
            </div>
            <!-- Left Section -->

            <!-- Right Section -->
            <div class="flex items-center gap-2">
                <!-- links to other pages -->
                <a href="/stats" class="sm:inline font-medium text-gray-400 hover:text-white">
                    <span>分数</span>
                </a>
                <a href="/rank" class="sm:inline font-medium text-gray-400 hover:text-white">
                    <span>排名</span>
                </a>
                <a href="/vote" class="sm:inline font-medium text-gray-400 hover:text-white">
                    <span>投票</span>
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
            <!-- Details -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">

                <!-- Referrers -->
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <a href="/stats"><button
                            class="w-full h-16 bg-gray-700 text-white font-bold rounded-lg shadow hover:bg-blue-800">选手实时分数</button></a>
                </div>
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <a href="/rank"><button
                            class="w-full h-16 bg-gray-700 text-white font-bold rounded-lg shadow hover:bg-blue-800">全部选手排名</button></a>
                </div>
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <a href="/vote"><button
                            class="w-full h-16 bg-gray-700 text-white font-bold rounded-lg shadow hover:bg-red-800">参与观众投票</button></a>
                </div>
                <!-- END Referrers -->
            </div>
            <!-- Details -->
            <!-- Readme -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-1 lg:gap-8">
                <div class="rounded-2xl bg-gray-900/50 p-5">
                    <h2 class="text-xl font-bold mb-2">赛事宗旨</h2>
                    <p class="mb-4">作为《我不是歌神》的组织方，我们希望能够让有潜力的好声音被更多人听到，同时使得更多人可以看见VRChat这个平台。我们期待为观众提供良好的体验，并希望后续可以延续此活动丰富VRChat中文社群。</p>

                    <h2 class="text-xl font-bold mb-2">报名参赛</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li>本次大赛采取开放报名制，不会采取预定邀约，除非有例外发生，将会采取预定邀约，并且我们会审查报名人员，为了保护大赛过程不发生任何冲突以及意外。</li>
                        <li>当前报名已结束。欢迎通过现场观看或官方直播方式参与我们。</li>
                    </ul>

                    <h2 class="text-xl font-bold mb-2">赛制内容</h2>
                    <h3 class="text-lg font-bold mb-2">海选</h3>
                    <ul class="list-disc list-inside mb-4">
                        <li>6/30 18:00进场 19:00开始 不公开直播</li>
                        <li>每位选手准备自我介绍+半首歌</li>
                        <li>四位导师逐个听完后进行评分</li>
                        <li>时间限制：曲目+介绍 限制3分钟</li>
                        <li>评分后最高的15位选手晋级至正赛 结果不会立刻出来，需要等所有选手表演完成后，选择15位分数最高的选手进入正赛</li>
                        <li>选手可以自由选择留下观看或离开</li>
                    </ul>

                    <h3 class="text-lg font-bold mb-2">正赛</h3>
                    <h4 class="text-md font-bold mb-2">第一场 战队争夺赛</h4>
                    <ul class="list-disc list-inside mb-4">
                        <li>15个选手只取10个名额，每组导师会有5个人员名额</li>
                        <li>所有选手轮流上台演唱，演唱过程导师可以选择是否要转身选择该选手，到该选手演唱结束前都有选择的机会。</li>
                        <li>若有两组导师同时邀请同一位选手进入自己战对由选手自行选择要加入哪一方，若只有一组导师转身则该选手直接加入该导师战对。</li>
                        <li>若直到所有歌手演唱结束之前导师组的人员未满5人，则会到未被选择的参赛人员中邀请剩余数目的人员进自己的战对内</li>
                        <li>若在此遇到同一位选手被两组导师邀请，同样由参赛选手自行决定要加入哪个战对。</li>
                    </ul>

                    <h4 class="text-md font-bold mb-2">第二场 战队对抗赛</h4>
                    <ul class="list-disc list-inside mb-4">
                        <li>内容将随比赛进行逐步揭晓，敬请期待</li>
                        <li>随机抽取各组人员进行 1V1 随机主题单挑赛</li>
                        <li>会由主办方人员先行抽取各组人员上前来，随机抽取主题</li>
                        <li>得知主题后选择对方战对其中一名人员来和自己进行单挑</li>
                        <li>若对方拒绝和你单挑，则由主办方随机抽取对方一名选手</li>
                        <li>和该选手进行单挑，对方无法拒绝</li>
                        <li>以此类推，抽完5种主题后由导师们和学员们进行讨论及训练</li>
                        <li>比赛当天会以直播以及现场观众的投票计分</li>
                        <li>由票数较多的队伍获胜，成绩则会在五组比试结束后公布</li>
                        <li>总计获胜多的队伍胜利，输的则全队淘汰</li>
                    </ul>

                    <h4 class="text-md font-bold mb-2">第三场 幸存者生死战</h4>
                    <ul class="list-disc list-inside mb-4">
                        <li>内容将随比赛进行逐步揭晓，敬请期待</li>
                    </ul>

                    <h2 class="text-xl font-bold mb-2">責任相关</h2>
                    <ol class="list-decimal list-inside mb-4">
                        <li>本次大赛主办方有权利对大赛规则进行合理的中途更改，但是会尽最大可能提前通知所有参赛人员。</li>
                        <li>选手参加比赛并出场，即代表选手已认真阅读并同意大赛各项规则制度。</li>
                        <li>从大赛开始到大赛结束乃至整个赛制结束，请勿提到政治立场、歧视内容、暴力相关、情色内容等，还请各位遵守。</li>
                        <li>此参赛人员、主持人、评审等，如赛前或赛后，如有侮辱到此活动等相关，严重将一律加入黑名单。</li>
                        <li>当日比赛无报到或是比赛前未到，幕后人员有权力直接判为弃赛来决定。</li>
                        <li>比赛当中，如有非官方等恶意宣传，将一律进入黑名单列表里面。</li>
                        <li>本活动有权利去监督任何的参赛人员，而参赛人员也须全力配合幕后人员，如幕后人员有恶意骚扰等不舒服状况，请立刻回应给主办方，主办方将会立即介入了解情况。</li>
                        <li>大赛过程中有任何工作人员因私人原因导致耽误比赛行程，主办方会对此幕后人员进行处分，并将当事参赛人员加入黑名单内，永久拒绝往来。</li>
                        <li>这次比赛请主办方、幕后人员、评审、主持人、参赛人员等，遵守此活动规定，如有触犯，一律照规矩处理，不会有任何宽待。</li>
                    </ol>
                </div>
            </div>
            <!-- Readme -->
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
                <span> ／ </span>
                <span>UI
                        <a class="font-medium text-blue-400 hover:text-blue-500 hover:underline"
                           href="https://vrchat.com/home/user/usr_0e9c75fa-ec70-4043-9fca-264c9e0af6ba">Oniya</a>
                    </span>
                <span> ／ </span>
                <span>Backend & hosting
                        <a class="font-medium text-blue-400 hover:text-blue-500 hover:underline"
                           href="https://tun.cat">Tundra</a>
                    </span>
            </div>
        </div>
    </footer>
    <!-- END Page Footer -->
</div>
<!-- END Page Container -->
</body>

</html>
