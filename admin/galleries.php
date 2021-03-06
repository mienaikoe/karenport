<?php    
    ob_start();
    require_once '../models/Gallery.php';
    require_once '../models/Photo.php';
?>


<!DOCTYPE html>
<html>
    <head>
      <?php require '_headers.php' ?>
    </head>
    <body>
        <div id="main">
        <div class="header">Galleries</div>
        
        <div class="righty"><a href=".">Admin Home</a></div>
        
        <table id="galleries">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Folder Name</th>
					<th>Layout</th>
                    <th>View Images</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $galleries = Gallery::all();
                    foreach ( $galleries as $gallery ): 
                ?>
              <form action="task/post_update_gallery.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $gallery->id ?>"/>
                    <tr class="gallery <?php echo ($gallery->homepage_position % 2) ? "even" : "odd" ?>">
                        <td><input type="number" name="position" value="<?php echo $gallery->homepage_position ?>"/></td>
                        <td><input type="text"   name="name"     value="<?php echo $gallery->name ?>"/></td>
                        <td><textarea            name='description'><?php echo $gallery->description ?></textarea></td>
						<td>
							<select name='layout'>
								<option value="gallery" <?php echo (($gallery->layout == 'gallery') ? 'selected' : '');?>>Gallery</option>
								<option value="scroll" <?php echo (($gallery->layout == 'scroll') ? 'selected' : '');?>>Scrolling List</option>
							</select>
						</td>
						<td><a class="viewImages" href="gallery.php?id=<?php echo $gallery->id ?>">View Images</a></td>
                        <td><button type="submit"/>Update</td>
						<td><a href="task/get_delete_gallery.php?id=<?php echo $gallery->id; ?>"><button type="button">Delete</button</a></td>
                    </tr>
                </form>
                <?php endforeach; ?>
                
                          <form action="task/post_new_gallery.php" method="post">
                    <tr class="new gallery">
                        <?php $new_gal_position = sizeof($galleries)*5; ?>
                        <td><input type="hidden"  name="position" value="<?php echo $new_gal_position ?>"></input><div><?php echo $new_gal_position ?></div></td>
                        <td><input type="text"    name="name"   value="New Gallery"></input></td>
                        <td><textarea name='description'></textarea></td>
						<td><select name='layout'>
								<option value="gallery">Gallery</option>
								<option value="scroll">Scrolling List</option>
							</select>
						</td>
                        <td></td>
                        <td><button type="submit"/>Create</td>
                        <td></td>
                    </tr>
                </form>
            </tbody>
        </table>
        </div>
        
        

    </body>
</html>
