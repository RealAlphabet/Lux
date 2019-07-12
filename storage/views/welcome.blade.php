<?php startSection('body's); ?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Nunito:200,600');

        html,
        body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
        }

        .full-height {
        height: 100vh;
        }

        .flex-center {
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .text-center {
        text-align: center;
        }

        .title {
        font-size: 3.5rem;
        font-weight: 100;
        margin-bottom: 1rem;
        }

        .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        }
    </style>

    <div class="flex-center full-height">
        <div class="text-center">
            <div class="title"><?php echo e($title ?? "Lux"); ?></div>

            <div class="links">
                <a href="#">Docs</a>
                <a href="#">Creator</a>
                <a href="#">GitHub</a>
            </div>
        </div>
    </div>
<?php endSection(); ?><?php extendLayout('layout'); ?>