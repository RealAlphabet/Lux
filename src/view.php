<?php

$sections = [];

function exception_handler($exception) {
    $content = View::compile("error", true);

    ob_start();
    eval("?> $content");
    print_r(ob_get_clean());
    return false;
}

set_exception_handler('exception_handler');

function extendLayout($layout) {
    global $sections;
    $content = View::compile($layout);
    eval("?>$content");
}

function startSection($name) {
    global $section;
    $section = $name;
    ob_start();
}

function endSection() {
    global $section, $sections;
    $sections[$section] = ob_get_clean(); 
}

function yieldContent($name) {
    global $sections;
    return isset($sections[$name]) ? trim($sections[$name]) . "\n" : '';
}

function e($str) {
    return htmlentities($str);
}

class View {
    public static function render($path, $data = []) {
        extract($data);
        $content = self::compile($path);

        ob_start();
        eval("?>$content");
        return ob_get_clean();
    }

    public static function compile($file, $dontRecompile = true) {
        $path       = __DIR__ . "/../views/$file.blade.php";
        $compiled   = __DIR__ . "/../storage/views/$file.blade.php";

        if ($dontRecompile && file_exists($compiled) && filemtime($path) == filemtime($compiled)) {
            // Load file as string
            $content = file_get_contents($compiled);

        } else {
            // Load file as string
            $content = file_get_contents($path);

            // Compile Layout
            $content = preg_replace('/(.*)@extends\((.+?)\)(.*)/s', '$1$3<?php extendLayout($2); ?>', $content);
            
            // Compile Section
            $content = preg_replace('/@section\((.+?)\)/', '<?php startSection($1); ?>', $content);
            $content = preg_replace('/@endsection/', '<?php endSection(); ?>', $content);
            $content = preg_replace('/@yield\((.+?)\)/', '<?php echo yieldContent($1); ?>', $content);
            
            // Compile Foreach
            $content = preg_replace('/@foreach\((.+?) as (.+?)\)/', '<?php foreach ($1 as $2): ?>', $content);
            $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);
            
            // Compile Conditional
            $content = preg_replace('/@if\((.+?)\)/', '<?php if ($1): ?>', $content);
            $content = preg_replace('/@isset\((.+?)\)/', '<?php if (isset($1)): ?>', $content);
            $content = preg_replace('/@elseif\((.+?)\)/', '<?php elseif ($1): ?>', $content);
            $content = preg_replace('/@else/', '<?php else: ?>', $content);
            $content = preg_replace('/@endif/', '<?php endif; ?>', $content);

            // Compile Echo
            $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo e($1); ?>', $content);
            $content = preg_replace('/{!!\s*(.+?)\s*!!}/', '<?php echo $1; ?>', $content);
            $content = trim($content);

            // Store compiled file
            file_put_contents($compiled, $content);
            touch($compiled, filemtime($path));
        }

        return $content;
    }
}