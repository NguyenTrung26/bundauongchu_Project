<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="view/css/style.css">
</head>

<body>
    <div class="boxcenter">
        <div class="row mb header">
            <!-- Logo với fallback -->
        <img src="ongchu.jpg" alt="Logo Bún Đậu Ông Chú" class="header-logo" 
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="header-logo-fallback" style="display: none;">
            <i class="fas fa-bowl-food"></i>
        </div>
        
        <h1 class="header-h1">Bún Đậu Ông Chú</h1>
        <p class="header-p">Hương vị truyền thống - Chất lượng tận tâm</p>
        </div>
        <div class="row mb menu">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="index.php?act=introduce">INTRODUCE</a></li>
                <li><a href="index.php?act=contact">CONTACT</a></li>
                <li><a href="index.php?act=binhluan">COMMENTS</a></li>
                <li><a href="index.php?act=hoidap">FAQ</a></li>
            </ul>
        </div>