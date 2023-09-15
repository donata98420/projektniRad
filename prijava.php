<link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
<link href="./styles/prijava/prijava.css" rel="stylesheet" type="text/css" />
<script src="./scripts/accessibility.js"></script>
<div class='layout'>
   

<div class='layout'>

    <div class='container'>

	<a class="wrapper" href="index.php"><img class="navigation__image" src="./media/logo/Logo.png" alt="logo"></a><br><br><br>
        <h2 class="title">Prijava</h2>
        <form action='prijava_action.php' method='POST'>
            <input type="text" required placeholder="Korisničko ime" name="username">
            <input type="password" required placeholder="Lozinka" name="password">
            <br /><br />
            <input type="submit" name="submit" value="Prijava">
            <br /><br />
        </form>

		
        <p><?php echo isset($_GET['error']) ? $_GET['error'] : ""; ?></p>
    </div>
    
</div>

