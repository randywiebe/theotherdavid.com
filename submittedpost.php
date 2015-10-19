<!DOCTYPE html>
<html>
	<body>
		<?php
			ini_set('display_errors', 'On');
			error_reporting(E_ALL);
						
			$author = $_POST['author'];
			$date = $_POST['date'];
			$content = $_POST['content'];
			$imagegallery = $_POST['imagegallery'];
			$previewimage1 = $_POST['previewimage1'];
			$previewimage2 = $_POST['previewimage2'];
			$previewimage3 = $_POST['previewimage3'];
			$title = $_POST['title'];

			echo "Author: $author<br/>";
			echo "Date: $date<br/>";
			echo "Content: $content<br/>";
			echo "Image Gallery Url: $imagegallery<br/>";
			echo "Image Preview Url: $previewimage1<br/>";
			echo "Image Preview Url: $previewimage2<br/>";
			echo "Image Preview Url: $previewimage3<br/>";
			echo "Title: $title<br/>";

			echo "Attemping connection...";

			require_once 'dbconfig.php';

			try {				
				$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
				echo "Connected to $dbname at $host successfully.<br/>";				
				
				$s = 'CALL SAVE_BLOG_POST('.$author.', '.$date.' , '.$content.', '.$imagegallery.', '.$previewimage1.', '.$previewimage2.', '.$previewimage3.', '.$title.')';
				echo "$s";

				//$sql = 'CALL SAVE_BLOG_POST($author, $date , $content, $imagegallery, $previewimage1, $previewimage2, $previewimage3, $title)';
				$sql = $conn->prepare("CALL SAVE_BLOG_POST(?, ?, ?, ?, ?, ?, ?, ?)");
				$sql->bindParam(1, $author);
				$sql->bindParam(2, $date);
				$sql->bindParam(3, $content);
				$sql->bindParam(4, $imagegallery);
				$sql->bindParam(5, $previewimage1);
				$sql->bindParam(6, $previewimage2);
				$sql->bindParam(7, $previewimage3);
				$sql->bindParam(8, $title);
								
				//$q = $conn->query($sql);
				$sql->execute();

				//$q->setFetchMode(PDO::FETCH_OBJ);
			} catch (PDOException $pe) {
				die ("Could not connect to the database $dbname :" . $pe->getMessage());
			}
		?>
		<table>
			<tr>			
				<th>Author</th>
				<th>Blog Date</th>
				<th>Content</th>
				<th>Gallery Url</th>
				<th>Image Preview Url 1</th>
				<th>Image Preview Url 2</th>
				<th>Image Preview Url 3</th>
				<th>Blog Title</th>
			</tr>
			<!--
			<?php while ($r = $q->fetch()): ?>
				<tr>
					<td><?php echo $r['Author'] ?></td>
				</tr>
			<?php endwhile; ?>
			-->
		</table>
	</body>
</html>