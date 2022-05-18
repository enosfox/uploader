<link rel="stylesheet" href="style.css">

<div class="form">
    <form name="env" method="post" enctype="multipart/form-data">
        <?php
        require __DIR__ . "/../src/Uploader.php";
        require __DIR__ . "/../src/Image.php";

        //$image = new KitsuneCode\Uploader\Image("uploads", "images", false); //SEM PASTAS DE ANO E MÊS
        $image = new KitsuneCode\Uploader\Image(uploadDir:"uploads", fileTypeDir:"images", nameDir:$_POST['name'] ?? '');

        if ($_FILES) {
            try {
                $upload = $image->uploadWebp($_FILES['image'], $_POST['name'],100,['webp'=>100]);
                echo "<img src='{$upload}' width='100%'>";
            } catch (Exception $e) {
                echo "<p>(!) {$e->getMessage()}</p>";
            }
        }
        ?>
        <input type="text" name="name" placeholder="Image Name" required/>
        <input type="file" name="image" required/>
        <button>Send Image</button>
    </form>
</div>


