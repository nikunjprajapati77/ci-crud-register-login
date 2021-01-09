<footer class="footer">
      <div class="container">
        <p class="text-danger">Developed By Nikunj Prajapati</p>
      </div>
    </footer>
</body>
</html>
<?php
if(isset($_SESSION['msg_success'])){
    unset($_SESSION['msg_success']);
}
if(isset($_SESSION['msg_error'])){
    unset($_SESSION['msg_error']);
}
?>
