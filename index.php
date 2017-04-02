<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yasaklı Kelime</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 40px;
    }
  </style>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Yasaklı Kelime</h3>
        </div>
        <div class="panel-body">
          <?php
          if(isset($_POST['send'])){
            $sentences = $_POST['sentences'];
            $bad = $_POST['bad'];

            $badWords = explode(", ", $bad);
            $output = preg_replace_callback('/\w+/u', 'filtrele', $sentences);

            ?>
            <div class="alert alert-danger">
              <p><strong>Çıktı: </strong><?php echo $output; ?></p>
            </div>
            <?php
          }

          function filtrele($matches) {
            global $badWords;
            $uc = mb_strtolower($matches[0]);
            $replace = in_array($uc, $badWords) ? true : false;
            return $replace ? str_repeat("*", strlen($matches[0])) : $matches[0];
          }
          ?>
          <form action="index.php" method="POST">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Metni Giriniz</span>
                <textarea class="form-control" name="sentences"><?php if(isset($_POST['sentences'])){ echo $_POST['sentences']; } ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Yasaklı Kelimeler</span>
                <input type="text" placeholder="Yasaklı kelimeleri giriniz. Örn: ahmet, veli, mehmet" class="form-control" value="<?php if(isset($_POST['bad'])){ echo $_POST['bad']; } ?>" name="bad" />
              </div>
            </div>
            <p class="text-center">
              <button type="submit" name="send" class="btn btn-info btn-block">Filtrele</button>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
