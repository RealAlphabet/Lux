<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lux | Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Nunito:200,600');

        html, body {
            background-color: #fff;
            color: #99AAB5;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        #trace {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
        }

        #preview {
            flex: 1 1 auto;
        }

        .header {
            background-color: #23272A;
            padding: 1rem;
        }

        .full-height {
            height: 100vh;
        }

        .flex {
            display: flex;
        }

        .flex-auto {
            flex: 1 1 auto;
        }

        .list-flex > li {
            display: flex;
        }

        .bold {
            font-weight: 700;
        }

        .trace-line {
            padding: .75rem 1rem;
        }

        .trace-error {
            background: #efefef;
            color: #ff7a7a;
            padding: 2rem;
        }
    </style>

    <div class="flex full-height">
        <div id="trace">
            <div class="header">
                Trace
            </div>

            <div class="trace-error">
                <h3><?php echo e(ucfirst($exception->getMessage())); ?></h3>
            </div>

            <div class="flex">
                <div class="flex-auto border-right">
                    <?php foreach (array_reverse($exception->getTrace()) as $trace): ?>
                        <div class="trace-line">
                            <?php echo e($trace['file']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="bold">
                    <?php foreach (array_reverse($exception->getTrace()) as $trace): ?>
                        <div class="trace-line">
                            <?php echo e($trace['line']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div id="preview">
            <div class="header">
                Preview
            </div>

            <div class="content">

            </div>
        </div>
    </div>
</body>
</html>