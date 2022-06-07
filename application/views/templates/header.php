<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid position-relative d-flex flex-row-reverse">
        <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="#">
            <img src="assets/images/logo.png" alt="Logo"
                style="width: 3rem;">
        </a>
        <?php
        // Display logout button if it is currently logged in
        if ($this->session->has_userdata("logged_in"))
        {
            echo "<form action='" . base_url('admin/logout'). <<<EOD
            ' method='post' class='d-flex'>
            <button class='btn' type='submit'>
            <h5 class='text-white'>Logout</h5>
            </button>
            </form>
            EOD;
        }
        // Display login button if it is not currently logged in
        else
        {
            echo "<form action='" . base_url('login'). <<<EOD
            ' method='post' class='d-flex'>
                <button class='btn' type='submit'>
                    <img src='assets/images/profile_icon.png' alt='Login'
                        style='width: 2rem;'>
                </button>
            </form>
            EOD;
        }
        ?>
        </div>
    </div>
</nav>