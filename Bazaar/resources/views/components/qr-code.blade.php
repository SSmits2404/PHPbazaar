<div>
<<<<<<< Updated upstream
{!! QrCode::size(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!}
=======
<?php
    include 'phpqrcode/qrlib.php';
    $text = "codedamn.com";
    QRcode::png($text, 'qrcodes/image.png');
    ?>
 
    <img src="qrcodes/image.png" alt="">
>>>>>>> Stashed changes
</div>