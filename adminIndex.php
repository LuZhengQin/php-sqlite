<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../static/pkg/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/css/admin/index.css">
    <script src="../../static/pkg/jquery-3.6.0/jquery-3.6.0.min.js"></script>
</head>

<body>
<div class="container" style="box-shadow: 2px 2px 12px 2px #ccc;">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">学号</th>
            <th scope="col">姓名</th>
            <th scope="col">学院</th>
            <th scope="col">班级</th>
            <th scope="col">电话</th>
            <th scope="col">邮箱</th>
            <th scope="col">性别</th>
            <th scope="col">简介</th>
            <th scope="col">操作1</th>
            <th scope="col">操作2</th>
        </tr>
        </thead>
        <tbody id="userList">
        <!-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr> -->
        </tbody>
    </table>
</div>

<script src="../../static/pkg/bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
<script>
    fetch('getUserList.php', {
        method: 'GET',
        mode: 'cors',
        credentials: 'include'
    }).then(response => {
        return response.json()
    }).then(
        data => {
            let userList = document.querySelector("#userList");

            data.forEach(v => {
                userList.innerHTML += `
                    <tr>
                        <th scope="row">${v[0]}</th>
                        <td>${v[1]}</td>
                        <td>${v[2]}</td>
                        <td>${v[3]}</td>
                        <td>${v[4]}</td>
                        <td>${v[5]}</td>
                        <td>${v[6]}</td>
                        <td>${v[7]}</td>
                        <td><a class="btn btn-danger" href="deleteUser.php?uid=${v[0]}">删除</a></td>
                        <td><a class="btn btn-danger" href="shenhe.php?uid=${v[0]}&name=${v[1]}&college=${v[2]}&class=${v[3]}&phone=${v[4]}&email=${v[5]}&uid=${v[6]}&gender=${v[7]}&description=${v[8]}">审核</a></td>
                    </tr>
                `;
            });

            console.log(data)
        }
    )
</script>
</body>

</html>