<html>
<body>
    <form action="/posts/store" method="post">
        @csrf
        <input type = 'text' name = 'title' placeholder = 'title' ><br/>
        <textarea name = 'content' placeholder = 'content' ></textarea><br/>
        <input type = 'submit' value="등록">
    </form>
</body>
</html>