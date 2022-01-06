<html>
<head>
    <title>Forms</title>
</head>
<body>
    <div class="header">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Some pages</a></li>
            <li><a href="#">Log in</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Musu title</h1>
        <p>Lorem ipsum..</p>
        <form action="functions.php" method="post">
            <input type="text" name="user_email" placeholder="john@email.com"/>
            <input type="submit" value="ok" name="create"/>
        </form>
        <form action="functions.php" method="post">
            <input type="number" name="number" placeholder="number">
            <select name="veiksmas">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <input type="number" name="number1" placeholder="number">
            <input type="submit" value="ok" placeholder="create">
        </form>
    </div>
</body>
</html>
