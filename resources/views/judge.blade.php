<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>评委评分 - 我不是歌神 S1</title>
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

        .input-group input[type="number"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #1f2937;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff
        }

        .input-group select[name="score"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #1f2937;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff
        }

        .input-group input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #1f2937;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff
        }

        .input-group select[id="sensei"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #1f2937;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff
        }

        .input-group input[id="player"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #1f2937;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff
        }

        .input-group input[id="song"] {
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

        .button {
            display: block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #007bff;
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
    <h1>评分项目</h1>
    <p>请按照每项10分满分打分，系统会自动计算总分</p>
    <ul>
        <li>
            <strong>音准和气息:</strong>
            <ul>
                <li>稳定性:音准稳定，是否无明显偏差</li>
                <li>科学性:完成音准的方式是否科学</li>
                <li>气息:气息是否充沛，均匀稳定，换气自然</li>
            </ul>
        </li>

        <li>
            <strong>节奏:</strong>
            <ul>
                <li>稳定性:能准确把握歌曲的旋律，与伴奏配合默契，不脱节，不抢拍</li>
                <li>自然性:停顿与连接是否自然</li>
            </ul>
        </li>

        <li>
            <strong>音色:</strong>
            <ul>
                <li>技巧性 :声音扎实稳定，音色优美。</li>
                <li>纯净度 :音色纯净，没有明显的破音、嘶哑等问题</li>
            </ul>
        </li>

        <li>
            <strong>情感、个人表现:</strong>
            <ul>
                <li>切题性:情绪表达是否自然、情绪是否与曲目适配</li>
                <li>个人风格:是否具吸引力、感染力，使歌曲情感更加丰富</li>
            </ul>
        </li>
    </ul>

    <div class="input-group">
        <label for="score1">评委：</label>
        <select id="sensei">
            <option value="๑0w0๑">๑0w0๑</option>
            <option value="悟我">悟我</option>
            <option value="Annie">Annie</option>
            <option value="月初的雪">月初的雪</option>
            <option value="Oniya">Oniya</option>
        </select>
    </div>

    <div class="input-group">
        <label for="score1">选手：</label>
        <input type="player" name="player" id="player" value="" disabled>
    </div>

    <div class="input-group">
        <label for="score1">歌曲：</label>
        <input type="player" name="song" id="song" value="" disabled>
    </div>

    <div class="input-group">
        <label for="score1">音准：</label>
        <input type="number" name="number" id="score1" min="0" max="10" value="0" step="0.5">
    </div>

    <div class="input-group">
        <label for="score2">音色：</label>
        <input type="number" name="number" id="score2" min="0" max="10" value="0">
    </div>

    <div class="input-group">
        <label for="score3">节奏：</label>
        <input type="number" name="number" id="score3" min="0" max="10" value="0">
    </div>

    <div class="input-group">
        <label for="score4">情感及个人表现</label>
        <input type="number" name="number" id="score4" min="0" max="10" value="0">
    </div>

    <div class="input-group">
        <label for="score5">评委个人分：</label>
        <input type="number" name="number" id="score5" min="0" max="10" value="0">
    </div>

    <div class="total-score">
        <label for="totalScore">总分：</label>
        <span id="totalScore">0.00</span>
    </div>

    <button class="button" onclick="calculateTotalScore()" id="submitButton">计算并提交</button>
</div>

<script>
    const submitButton = document.getElementById('submitButton');
    const inputElements = document.getElementsByName('number');

    for (const inputElement of inputElements) {
        inputElement.addEventListener('input', () => {
            const inputValue = parseFloat(inputElement.value);

            // 检查输入值是否为有效数字
            if (isNaN(inputValue)) {
                alert('无效输入。请输入一个数字。');
                return;
            }

            // 检查输入值是否在有效范围内
            if (inputValue < 0 || inputValue > 10) {
                alert('无效输入。请输入介于0和10之间的数字，包括半整数值（例如：0.5、1.5、2.5）。');
                submitButton.disabled = true;
                submitButton.style.backgroundColor = "#494949";
            } else {
                submitButton.disabled = false;
                submitButton.style.backgroundColor = "#007bff";
            }
        });
    }


    setInterval(function() {
        $.ajax({
            url: "/api/v1/admin/getCurrentStatus", //请求的 URL
            type: "GET", //请求的类型（GET、POST 等）
            dataType: "json", //预期服务器返回的数据类型
            success: function (data) {
                //请求成功时执行的回调函数
                console.log(data);
                var player = data.data.singer
                window.player_id = data.data.singer_id
                window.song_id = data.data.song_id
                $('#player').val(player);
                $('#song').val(data.data.song);
            },
            error: function (error) {
                //请求失败时执行的回调函数
                console.log(error);
            }
        });
    }, 3000)

    function calculateTotalScore() {
        $(document).ready(function(){
            var result = confirm("您确定要执行此操作吗?");
            if (result) {
                const score1 = parseFloat(document.getElementById('score1').value);
                const score2 = parseFloat(document.getElementById('score2').value);
                const score3 = parseFloat(document.getElementById('score3').value);
                const score4 = parseFloat(document.getElementById('score4').value);
                const score5 = parseFloat(document.getElementById('score5').value);
                const sensei = document.getElementById('sensei');
                const senseiname = sensei.value.trim();
                const totalScore = (score1 * 0.30) + (score2 * 0.20) + (score3 * 0.20) + (score4 * 0.20) + (score5 * 0.10);
                document.getElementById('totalScore').textContent = totalScore.toFixed(2);
                const player_id = window.player_id;
                const song_id = window.song_id;

                const data = {
                    judge: senseiname,
                    singer_id: player_id,
                    song_id: song_id,
                    scores: {
                        A: score1,
                        B: score2,
                        D: score3,
                        C: score4,
                        E: score5,
                    },
                };

                // 将值转换为 JSON 格式
                var jsonData = JSON.stringify(data);

                // 发送 AJAX 请求
                $.ajax({
                    url: "/api/v1/judges/submitScore", // API 的 URL
                    type: "POST", // 请求的类型（GET、POST 等）
                    contentType: "application/json", // 请求的内容类型
                    data: jsonData, // 要提交的数据
                    success: function (response) {
                        // 请求成功时执行的回调函数
                        console.log(response);
                        alert('提交成功')
                    },
                    error: function (error) {
                        // 请求失败时执行的回调函数
                        console.log(error);
                        alert('提交失败')
                    }
                });
            } else {
                alert('操作已取消');
            }
        });
    }
</script>
</body>

</html>
