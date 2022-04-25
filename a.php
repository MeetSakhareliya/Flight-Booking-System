<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $a=$_POST['inp'];

        $file='b.php?a='.$a;
        $loc='Location: '.$file;
        header($loc);
    }
?>

<html>
    <body>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" value="1" name="inp">
            <button type="submit">Submit</button>
        </form>
    </body>

</html>