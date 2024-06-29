<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/favicon.png">
    <link rel="shortcut icon" href="/assets/favicon.png">
    <title>认证页 - 我不是歌神 S1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/cover.css">
</head>

<body class="text-center">
<div class="cover-container d-flex w-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">认证页 - 我不是歌神 S1</h3>
        </div>
    </header>
    <main role="main" class="inner cover">
        <form action="/edit/auth" method="POST">
            <div class="form-group">
                <label class="form-label">认证凭据</label>
                <input type="password" class="form-control" name="token">
                <div id="emailHelp" class="form-text text-muted">评委/后台人员请联系赛事管理人员获取认证凭据</div>
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery-slim@3.0.0/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
