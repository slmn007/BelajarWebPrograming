<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .warna_kolom {
            background-color: silver;
        }
    </style>
    <title>Latihan 1</title>
</head>
<body>
    <table border="1" cellpadding="10" cellspasing="0">
        <?php  
            for($i = 1; $i <= 3; $i++) {
                echo "<tr>";
                for($j=1; $j <= 5; $j++) {
                    echo "<td>$i, $j";
                    echo "</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    <br>
    <table border="1" cellpadding="10" cellspasing="0">
        <?php for($k=1; $k<=5; $k++) : ?>
            <?php if($k%2==1) : ?>
                <tr class="warna_kolom">
            <?php else : ?>
                <tr>
            <?php endif; ?>
                <?php for($l=1; $l<=5; $l++) : ?>
                    <td>
                        <?= $k, ", ", $l ?>
                    </td>
                <?php  endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</body>
</html>