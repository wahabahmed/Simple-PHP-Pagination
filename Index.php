<?php
    require_once 'Paginator.class.php';
 
    $conn       = new mysqli( '127.0.0.1', 'root', 'root', 'testDB' );
 
    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 15;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
    $query      = "SELECT id, artist, title, mainGenre FROM movies";
 
    $Paginator  = new Paginator( $conn, $query );
 
    $results    = $Paginator->getData( $limit, $page );
?>


<html>
    <head>
        <title>PHP Pagination</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
                <div class="col-md-10 col-md-offset-1">
                <h1>PHP Pagination</h1>
                <table class="table table-striped table-condensed table-bordered table-rounded">
                        <thead>
                                <tr>
                                <th>Id</th>
                                <th width="20%">Artist</th>
                                <th width="20%">Title</th>
                                <th width="25%">Category</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
							<tr>
									<td><?php echo $results->data[$i]['id']; ?></td>
									<td><?php echo $results->data[$i]['artist']; ?></td>
									<td><?php echo $results->data[$i]['title']; ?></td>
									<td><?php echo $results->data[$i]['mainGenre']; ?></td>
							</tr>
						<?php endfor; ?>
						</tbody>											
                </table>
				<?php echo $Paginator->createLinks( $links, 'pagination', 'page-item', 'page-link'); ?>
                </div>
        </div>
        </body>
</html>