<?php
    // Execute Python script
    $output = shell_exec('"C:\\Users\\Hp\\AppData\\Local\\Microsoft\\WindowsApps\\python.exe" "C:\\xampp\\htdocs\\SE_PRO_v2\\SE_PRO\\face_det_final.py" 2>&1');
    
    // Output result
    if ($output === null) {
        echo "Error executing Python script.";
    } else {
        echo "<pre>$output</pre>";
    }
?>
