<?php
session_start();

if(!isset($_SESSION['username'])){
    // header('location:login.php');
    ?>
<script>
    // alert('Harap Login!');
    location.href = 'index.php';
</script>
<?php
}
?>