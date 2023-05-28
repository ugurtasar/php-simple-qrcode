<?php
require('vendor/autoload.php');
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
if(isset($_POST['submit'])){
	$filename = 'qrcode.png';
	$result = Builder::create()
		->writer(new PngWriter())
		->writerOptions([])
		->data($_POST['content'])
		->encoding(new Encoding('UTF-8'))
		->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
		->size(300)
		->margin(10)
		->roundBlockSizeMode(new RoundBlockSizeModeMargin())
		->labelText($_POST['label'])
		->labelAlignment(new LabelAlignmentCenter())
		->validateResult(false)
		->build();
	$result->saveToFile(__DIR__.'/'.$filename);
	$resultURL = $filename;
}
?>
<!DOCTYPE html>
<html lang="tr" class="h-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>QR Code Generator</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
	<style>.container{max-width: 500px;}</style>
</head>
<body class="bg-light">
<main class="my-4 text-center">
	<div class="container">
		<div class="bg-white border p-3">
			<h1 class="fs-4 mb-3"><a href="index.php" class="link-dark text-decoration-none">QR Code Generator</a></h1>
			<?php if(isset($resultURL)): ?>
			<div class="text-center">
			<img src="<?php echo $resultURL; ?>" class="d-block img-fluid mb-3 d-table mx-auto" />
			<a type="button" class="fw-bold btn btn-success text-center fw-bold fs-5 mb-3" id="btn-download" href="download.php">DOWNLOAD</a>
			</div>
			<?php else: ?>
			<img src="example.png" class="img-fluid mb-3" />
			<?php endif; ?>
			<form method="post" action="">
				<div class="form-floating mb-3">
				  <textarea class="form-control" name="content" id="content" style="height: 100px"></textarea>
				  <label for="content">QR Code Content:</label>
				</div>
				<div class="form-floating">
				  <input type="text" class="form-control" name="label" id="label">
				  <label for="floatingPassword">Label Text:</label>
				</div>
				<button type="submit" name="submit" class="btn btn-primary mt-3 w-100 py-2 fw-bold fs-5">GENERATE</button>
			</form>
		</div>
	</div>
</main>
</body>
</html>