<?php

require_once __DIR__ . '/../src/bootstrap.php';

?>

<html>
<head>
    <style>
        .item-level-1 {
            color: red;
        }

        .item-level-1.item-parent {
            color: darkred;
        }

        .item-level-2 {
            color: green;
        }

        .item-level-2.item-parent {
            color: darkgreen;
        }

        .item-level-3 {
            color: blue;
        }

        .item-level-3.item-parent {
            color: darkblue;
        }
    </style>
</head>
<body>
<ul><?php include __DIR__ . '/../src/views/menu.php' ?></ul>
</body>
</html>
