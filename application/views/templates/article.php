<!-- Source: https://github.com/StartBootstrap/startbootstrap-blog-post -->

<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">Welcome to Blog Post!</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on January 1, 2022 by Start Bootstrap</div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4">Science is an enterprise that should be cherished as an activity of the free human mind. Because it transforms who we are, how we live, and it gives us an understanding of our place in the universe.</p>
                    <p class="fs-5 mb-4">The universe is large and old, and the ingredients for life as we know it are everywhere, so there's no reason to think that Earth would be unique in that regard. Whether of not the life became intelligent is a different question, and we'll see if we find that.</p>
                    <p class="fs-5 mb-4">If you get asteroids about a kilometer in size, those are large enough and carry enough energy into our system to disrupt transportation, communication, the food chains, and that can be a really bad day on Earth.</p>
                    <h2 class="fw-bolder mb-4 mt-5">I have odd cosmic thoughts every day</h2>
                    <p class="fs-5 mb-4">For me, the most fascinating interface is Twitter. I have odd cosmic thoughts every day and I realized I could hold them to myself or share them with people who might be interested.</p>
                    <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p>
                </section>
            </article>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <form action="<?=base_url('blog/submit_comment')?>" method="post">
                <!-- Add Comment Form -->
                <div class="card p-3">
                    <?php
                    $previous_name    = $this->session->flashdata('previous_name');
                    $previous_comment = $this->session->flashdata('previous_comment');
                    $invalid_name     = $this->session->flashdata('invalid_name');
                    $invalid_comment  = $this->session->flashdata('invalid_comment');
                    $invalid_captcha  = $this->session->flashdata('invalid_captcha');
                    ?>
                    <h4 class="card-title mb-4">Add your comment</h4>
                    <div class="form-floating mb-2">
                        <input type="text" id="form-name" name="form-name"
                            class="form-control <?= $invalid_name ? 'is-invalid' : '' ?>"
                            placeholder="Your name" />
                        <label class="form-label" for="form-name">Your name</label>
                        <div class="invalid-feedback">
                            Name cannot be empty or have more than 30 characters.
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" id="form-comment" name="form-comment"
                            class="form-control <?= $invalid_comment ? 'is-invalid' : '' ?>"
                            placeholder="Your comment" />
                        <label class="form-label" for="form-comment">Your comment</label>
                        <div class="invalid-feedback">
                            Comment cannot be empty.
                        </div>
                    </div>
                    <!-- Captcha -->
                    <?=$captcha_img?>
                    <input type="text" id="form-captcha"
                        name="form-captcha"
                        class="form-control mb-2 <?= $invalid_captcha ? 'is-invalid' : '' ?>"
                        placeholder="Type in the CAPTCHA above" />
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <?php require_once("application/views/templates/comments.php"); ?>
        </div>
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>