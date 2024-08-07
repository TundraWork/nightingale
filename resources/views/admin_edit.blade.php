<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>歌曲设定</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1f2937;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #18202f;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            color: #fff
        }

        .input-group {
            display: flex;
            margin-bottom: 20px;
        }

        .input-group label {
            width: 20%;
            text-align: right;
            margin-right: 10px;
            color: #fff;
        }

        .input-group select {
            width: 80%;
            padding: 10px;
            border: 1px solid #1f2937;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff
        }

        .input-group input {
            width: 80%;
            padding: 10px;
            border: 1px solid #1f2937;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff
        }

        .total-score {
            text-align: center;
            margin-top: 30px;
        }

        .total-score label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .total-score span {
            font-size: 24px;
            font-weight: bold;
        }

        .button1 {
            display: inline-block;
            margin-top: 30px;
            margin-left: 30px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button2 {
            display: inline-block;
            margin-top: 30px;
            margin-left: 30px;
            padding: 10px 20px;
            background-color: #c812ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button3 {
            display: inline-block;
            margin-top: 30px;
            margin-left: 30px;
            padding: 10px 20px;
            background-color: #ff5757;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button4 {
            display: inline-block;
            margin-top: 30px;
            margin-left: 30px;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div class="container">
    <h1>歌曲和选手设定</h1>
    <p>这里用来设定观众和评委正在打分的歌曲和选手</p>

    <div class="input-group">
        <label for="score1">选择选手:</label>
        <select id="singer">
        </select>
    </div>

    <div class="input-group">
        <label for="score1">选择歌曲:</label>
        <select id="song">
        </select>
    </div>

    <div class="input-group">
        <label for="score1">选择战队:</label>
        <select id="team">
        </select>
    </div>

    <div class="input-group">
        <label for="score1">添加选手:</label>
        <input type="text" name="text" id="addsinger" placeholder="支持批量添加，请用英文逗号分离">
    </div>

    <div class="input-group">
        <label for="score2">添加歌曲:</label>
        <input type="text" name="text" id="addsong" placeholder="支持批量添加，请用英文逗号分离">
    </div>

    <div class="input-group">
        <label for="score3">添加战队:</label>
        <input type="text" name="text" id="addteam" placeholder="支持批量添加，请用英文逗号分离">
    </div>

    <div class="input-group">
        <button class="button button1" onclick="submit()" id="button1">设定歌曲/歌手/战队</button>
    </div>
    <div class="input-group">
        <button class="button button2" onclick="add()" id="button2">添加歌曲或歌手</button>
        <button class="button button2" onclick="addTeams()" id="button2">添加战队</button>
    </div>
    <div class="input-group">
        <button class="button button3" onclick="del()" id="button3">删除歌曲或歌手</button>
        <button class="button button4" onclick="delAll()" id="button4">删除全部歌曲或歌手</button>
        <button class="button button4" onclick="delTeams()" id="button4">删除全部战队</button>
    </div>
    <div class="input-group">
        <button class="button button1" onclick="switchVoteOpen()" id="button1">切换投票开关</button>
        <button class="button button1" onclick="switchVoteDisplay()" id="button1">切换投票结果显示</button>
    </div>
</div>

<script>
    var apiUrls = [
        '/api/v1/admin/getSingers',
        '/api/v1/admin/getSongs',
        '/api/v1/admin/getTeams',
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
        const singerData = allData[0]
        const songData = allData[1]
        const teamData = allData[2]
        const singers = document.getElementById("singer");
        const songs = document.getElementById("song");
        const teams = document.getElementById("team");

        var optionSingerDefault = document.createElement("option");
        optionSingerDefault.value = "";
        optionSingerDefault.textContent = "请选择 / 不选择=保持此项状态不变";
        singers.appendChild(optionSingerDefault);

        var optionSongDefault = document.createElement("option");
        optionSongDefault.value = "";
        optionSongDefault.textContent = "请选择 / 不选择=保持此项状态不变";
        songs.appendChild(optionSongDefault);

        var optionTeamDefault = document.createElement("option");
        optionTeamDefault.value = "";
        optionTeamDefault.textContent = "请选择 / 不选择=保持此项状态不变";
        teams.appendChild(optionTeamDefault);

        Object.entries(singerData.data).forEach((singer, _) => {
            const optionSinger = document.createElement("option");
            optionSinger.value = singer[0];
            optionSinger.textContent = singer[1];
            singers.appendChild(optionSinger);
        });
        Object.entries(songData.data).forEach((song, _) => {
            const optionSong = document.createElement("option");
            optionSong.value = song[0];
            optionSong.textContent = song[1];
            songs.appendChild(optionSong);
        });
        Object.entries(teamData.data).forEach((team, _) => {
            const optionTeam = document.createElement("option");
            optionTeam.value = team[0];
            optionTeam.textContent = team[1];
            teams.appendChild(optionTeam);
        });
    });

    function submit() {
        const singer = document.getElementById("singer").value;
        const song = document.getElementById("song").value;
        const team = document.getElementById("team").value;
        if (singer === "" || song === "") {
            alert("请选择选手和歌曲");
        } else {
            $.ajax({
                url: '/api/v1/admin/setCurrentStatus',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    "singer_id": singer,
                    "song_id": song,
                    "team_id": team
                }),
                success: function (data) {
                    console.log(data);
                    alert("设置成功");
                },
                error: function (error) {
                    console.error('Error:', error);
                    alert("设置失败：" + error.responseJSON.message);
                }
            });
        }
    }

    function add() {
        const singer = document.getElementById("addsinger").value;
        const song = document.getElementById("addsong").value;

        if (!singer && !song) {
            alert("请输入歌手或者歌曲名称");
            return;
        }

        var singerArray = singer.split(",").map(function (name) {
            return name.trim();
        });
        var songsArray = song.split(",").map(function (name) {
            return name.trim();
        });
        var singerjsonData = {
            names: singerArray
        };
        var songsjsonData = {
            names: songsArray
        };
        $.ajax({
            url: '/api/v1/admin/addSingers',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(singerjsonData),
            success: function (data) {
                console.log(data);
            },
            error: function (error) {
                console.error('Error:', error);
                alert("添加失败：" + error.responseJSON.message);
            }
        })
        $.ajax({
            url: '/api/v1/admin/addSongs',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(songsjsonData),
            success: function (data) {
                console.log(data);
            },
            error: function (error) {
                console.error('Error:', error);
                alert("添加失败：" + error.responseJSON.message);
            }
        })
        alert("添加操作完成");
    }

    function addTeams() {
        const team = document.getElementById("addteam").value;

        if (!team) {
            alert("请输入战队名称");
            return;
        }

        var teamsArray = team.split(",").map(function (name) {
            return name.trim();
        });
        var teamsjsonData = {
            names: teamsArray
        };
        $.ajax({
            url: '/api/v1/admin/addTeams',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(teamsjsonData),
            success: function (data) {
                console.log(data);
                alert("添加成功");
            },
            error: function (error) {
                console.error('Error:', error);
                alert("添加失败：" + error.responseJSON.message);
            }
        })
    }

    function del() {
        const singer = document.getElementById("singer").value;
        const song = document.getElementById("song").value;

        if (!singer && !song) {
            alert("请选择歌手或者歌曲名称");
            return;
        }

        var singerArray = singer.split(",").map(function (name) {
            return name.trim();
        });
        var songsArray = song.split(",").map(function (name) {
            return name.trim();
        });
        var singerjsonData = {
            ids: singerArray
        };
        var songsjsonData = {
            ids: songsArray
        };

        if (!singer === false) {
            $.ajax({
                url: '/api/v1/admin/clearSingers',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(singerjsonData),
                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    console.error('Error:', error);
                    alert("删除失败：" + error.responseJSON.message);
                }
            })
        }
        if (!song === false) {
            $.ajax({
                url: '/api/v1/admin/clearSongs',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(songsjsonData),
                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    console.error('Error:', error);
                    alert("删除失败：" + error.responseJSON.message);
                }
            })
        }
        alert("删除操作结束");
    }

    function delAll() {
        $(document).ready(function(){
            var result = confirm("您确定要删除所有歌手和歌曲吗？");
            if (result) {
                $.ajax({
                    url: '/api/v1/admin/clearSingers',
                    type: 'POST',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log(data);
                    }, error: function (error) {
                        console.error('Error:', error);
                        alert("删除失败：" + error.responseJSON.message);
                    }
                })
                $.ajax({
                    url: '/api/v1/admin/clearSongs',
                    type: 'POST',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log(data);
                        alert("删除成功");
                    }, error: function (error) {
                        console.error('Error:', error);
                        alert("删除失败：" + error.responseJSON.message);
                    }
                })
            } else {
                console.log("删除操作已取消");
            }
        });
    }

    function delTeams() {
        $(document).ready(function(){
            var result = confirm("您确定要删除所有战队吗？");
            if (result) {
                $.ajax({
                    url: '/api/v1/admin/clearTeams',
                    type: 'POST',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log(data);
                        alert("删除成功");
                    }, error: function (error) {
                        console.error('Error:', error);
                        alert("删除失败：" + error.responseJSON.message);
                    }
                })
            } else {
                console.log("删除操作已取消");
            }
        });
    }

    function switchVoteOpen() {
        $.ajax({
            url: '/api/v1/admin/switchVoteOpen',
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                console.log(data);
                alert("投票开关已切换：" + data.message);
            },
            error: function (error) {
                console.error('Error:', error);
                alert("投票开关切换失败：" + error.responseJSON.message);
            }
        })
    }

    function switchVoteDisplay() {
        $.ajax({
            url: '/api/v1/admin/switchVoteDisplay',
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                console.log(data);
                alert("投票结果显示已切换：" + data.message);
            },
            error: function (error) {
                console.error('Error:', error);
                alert("投票结果显示切换失败：" + error.responseJSON.message);
            }
        })
    }
</script>
</body>

</html>
