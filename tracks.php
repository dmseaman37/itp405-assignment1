<?php
	$pdo = new PDO("sqlite:chinook.db");

	$sql = "SELECT tracks.Name AS trackName,
    albums.Title AS albumTitle, 
	artists.Name AS artistName, 
	tracks.UnitPrice 
	FROM tracks, albums, artists, genres
	WHERE tracks.AlbumId = albums.AlbumId
	AND albums.ArtistId = artists.ArtistId
	AND tracks.GenreId = genres.GenreId";

	if (isset($_GET['genre']) && !empty($_GET['genre']))
	{
		$genre = $_GET['genre'];
		$sql = $sql . " AND genres.name = '$genre'";
	}

	$sql = $sql . ";";

	$statement = $pdo->prepare($sql);
	$statement->execute();

	$tracks = $statement->fetchAll(PDO::FETCH_OBJ);
	// var_dump($tracks);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Assignment 1</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
	<table class="table">
		<tr>
			<th>Track</th>
			<th>Album</th>
			<th>Artist</th>
			<th>Price</th>
		</tr>
		<?php foreach($tracks as $track): ?>
			<tr>
				<td>
					<?php echo $track->trackName; ?>
				</td>
				<td>
					<?php echo $track->albumTitle; ?>
				</td>
				<td>
					<?php echo $track->artistName; ?>
				</td>
				<td>
					<?php echo $track->UnitPrice; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>